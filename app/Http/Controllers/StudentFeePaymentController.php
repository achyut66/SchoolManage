<?php

namespace App\Http\Controllers;

use App\Models\StudentFeePayment;
use App\Models\StudentParentDetails;
use Illuminate\Http\Request;
use App\Models\GradeSetting;
use App\Models\SettingStudentFee;
use App\Models\PalikaProfile;
use DB;

class StudentFeePaymentController extends Controller
{
    /* =========================
     *  INDEX (LIST)
     * ========================= */
    public function index($id)
    {
        // dd('here');
        $student_details = StudentParentDetails::select(
                'id',
                'student_full_name',
                'student_dob',
                'created_at',
                'student_enrollment_class',
                'unique_id',
                'academic_year'
            )
            ->where('flag', 1)
            ->where('id', $id)
            ->firstOrFail();
        // dd($student_details);
        // ✅ get grade record using name
        $grade_set = GradeSetting::where(
            'name',
            $student_details->student_enrollment_class
        )->firstOrFail();

        // ✅ now grade_id exists
        $fee_setting = SettingStudentFee::where(
                'grade_id',
                $grade_set->id
            )
            ->where('academic_year', $student_details->academic_year)
            ->get();

        $totalPaid = StudentFeePayment::where('student_id', $id)
            ->sum('total_paid_amount');
        
        $payments = StudentFeePayment::where('student_id', $id)
            ->orderBy('id', 'desc')
            ->first();

        // dd($payments);

        return view(
            'student-account.payment',
            compact('totalPaid', 'student_details', 'fee_setting','payments')
        );
    }


    /* =========================
     *  CREATE FORM
     * ========================= */
    public function create()
    {
        return view('student_fee_payment.create');
    }

    /* =========================
     *  STORE
     * ========================= */
    public function store(Request $request)
    {
        $request->validate([
            'student_id'          => 'required|integer',
            'school_id'           => 'required|string',
            'academic_year'       => 'required|string',
            'grade'               => 'required|string',
            'payment_from_date'   => 'required|date',
            'payment_to_date'     => 'required|string',
            'admission_date'      => 'required|date',
            'total_paid_amount'   => 'required',
            'due_amount'          => 'required',
        ]);

        DB::transaction(function () use ($request) {

            StudentFeePayment::create($request->all());

            // ✅ simple check only
            if ((float) $request->due_amount === 0.0) {
                DB::table('students_parents_details')
                    ->where('id', $request->student_id)
                    ->update(['fee_cleared' => 1]);
            }
        });

        return redirect()
            ->route('students-fee-collection')
            ->with('success', 'Student fee payment added successfully.');
    }

    /* =========================
     *  EDIT FORM
     * ========================= */
    public function edit($id)
    {
        $payment = StudentFeePayment::findOrFail($id);

        return view('student_fee_payment.edit', compact('payment'));
    }

    /* =========================
     *  UPDATE
     * ========================= */
    public function update(Request $request, $id)
    {
        $request->validate([
            'student_id'          => 'required|integer',
            'school_id'           => 'required|integer',
            'academic_year'       => 'required|string',
            'grade'               => 'required|string',
            'payment_from_date'   => 'required|date',
            'payment_to_date'     => 'required|date|after_or_equal:payment_from_date',
            'admission_date'      => 'required|date',
            'total_paid_amount'   => 'required|numeric|min:0',
            'due_amount'          => 'required|numeric|min:0',
        ]);

        DB::transaction(function () use ($request, $id) {
            $payment = StudentFeePayment::findOrFail($id);
            $payment->update($request->all());
        });

        return redirect()
            ->route('student-fee-payment.index')
            ->with('success', 'Student fee payment updated successfully.');
    }

    /* =========================
     *  DELETE
     * ========================= */
    public function destroy($id)
    {
        $payment = StudentFeePayment::findOrFail($id);
        $payment->delete();

        return redirect()
            ->route('student-fee-payment.index')
            ->with('success', 'Student fee payment deleted successfully.');
    }

    // goto ledger list if fee paid already

    public function goToPaidList(Request $request)
    {
        $grades   = GradeSetting::get();
        $sections = ['A','B','C','D','E','F'];

        $studentPayments = StudentFeePayment::select('table_student_fee_payment.*')
            ->join(DB::raw('(
                SELECT student_id, MAX(id) as max_id
                FROM table_student_fee_payment
                GROUP BY student_id
            ) as latest'), 'table_student_fee_payment.id', '=', 'latest.max_id')
            ->with('student')

            // 🔍 SEARCH FILTER
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->whereHas('student', function ($q) use ($request) {
                    $q->where('student_full_name', 'LIKE', '%' . $request->search . '%');
                });
            })

            // 🎓 GRADE FILTER
            ->when($request->filled('student_enrollment_class'), function ($query) use ($request) {
                $query->whereHas('student', function ($q) use ($request) {
                    $q->where('student_enrollment_class', $request->student_enrollment_class);
                });
            })

            // 🅰️ SECTION FILTER
            ->when($request->filled('student_enrollment_section'), function ($query) use ($request) {
                $query->whereHas('student', function ($q) use ($request) {
                    $q->where('student_enrollment_section', $request->student_enrollment_section);
                });
            })

            ->paginate(10)
            ->appends($request->query()); // ✅ keep filters on pagination

        return view(
            'student-account.feepaidstudent',
            compact('studentPayments', 'grades', 'sections')
        );
    }

    public function gotoLedger($id)
    {
        // dd('here');
        $ledgerPayments = StudentFeePayment::orderBy('student_id')
            ->where('student_id',$id)
            ->with('student')
            ->get();
        // dd($ledgerPayments);

        return view('student-account.ledger',compact('ledgerPayments'));
    }

    public function gotoLedgerPrint($id)
    {
        $ledgerPayments = StudentFeePayment::orderBy('student_id')
            ->where('student_id',$id)
            ->with('student')
            ->get();
        $profile = PalikaProfile::first();
        // dd($profile);

        return view('student-account.ledgerPrint',compact('ledgerPayments','profile'));
    }

}
