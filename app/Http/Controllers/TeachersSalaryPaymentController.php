<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TeachersSalaryPayment;
use App\Models\TeachersPersonalDetail;
use App\Models\GradeSetting;
use App\Models\SettingSalary;
use App\Models\PalikaProfile;
use App\Models\TeacherLeave;
use DB;
use Carbon\Carbon;

class TeachersSalaryPaymentController extends Controller
{
    /* =========================
     *  INDEX (LIST)
     * ========================= */
    public function index($id)
    {
        // dd($id);
        $student_details = TeachersPersonalDetail::select(
                'id',
                'teachers_name_eng',
                'teachers_mobno',
                'teachers_email',
                'created_at',
                'teaching_grade',
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
            $student_details->teaching_grade
        )->firstOrFail();

        // ✅ now grade_id exists
        $fee_setting = SettingSalary::where(
                'grade_id',
                $grade_set->id
            )
            ->where('academic_year', $student_details->academic_year)
            ->get();

        $totalPaid = TeachersSalaryPayment::where('teachers_id', $id)
            ->sum('total_paid_amount');
        
        $payments = TeachersSalaryPayment::where('teachers_id', $id)
            ->orderBy('id', 'desc')
            ->first();
        
        $leave = TeacherLeave::where('teachers_id', $id)
        ->where('academic_year', $student_details->academic_year)
        ->orderBy('id','desc')
        ->get();
        
        // $day_on_leave = $leave->leave_to - $leave->leave_from;
        $totalLeaveDays = $leave->sum(function ($l) {
            $from = Carbon::parse($l->leave_from);
            $to   = Carbon::parse($l->leave_to);
        
            return $from->diffInDays($to) + 1;
        });
       
        return view(
            'teacher-account.payment',
            compact('totalPaid', 'student_details', 'fee_setting','payments','totalLeaveDays')
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
        // dd('here');
        $request->validate([
            'teachers_id'         => 'required|string',
            'teachers_code'       => 'required|string',
            'academic_year'       => 'required|string',
            'grade'               => 'required|string',
            'payment_from_date'   => 'required|date',
            'payment_to_date'     => 'required|string',
            'enrollment_date'      => 'required|date',
            'total_paid_amount'   => 'required',
            'due_amount'          => 'required',
        ]);
        // dd('here');
        DB::transaction(function () use ($request) {

            TeachersSalaryPayment::create($request->all());

            // ✅ simple check only
            if ((float) $request->due_amount === 0.0) {
                DB::table('teachers_personal_details')
                    ->where('id', $request->teachers_id)
                    ->update(['salary_cleared' => 1]);
            }
        });

        return redirect()
            ->route('teachers-account')
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

        $studentPayments = TeachersSalaryPayment::query()
            ->select('table_teachers_salary_account.*')
            ->join(DB::raw('(
                SELECT teachers_id, MAX(id) as max_id
                FROM table_teachers_salary_account
                GROUP BY teachers_id
            ) as latest'), 'table_teachers_salary_account.id', '=', 'latest.max_id')

            ->with('teacher')

            // 🔍 SEARCH FILTER (FIXED COLUMN)
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->whereHas('teacher', function ($q) use ($request) {
                    $q->where('teachers_name_eng', 'LIKE', '%' . $request->search . '%');
                });
            })

            // 🎓 GRADE FILTER
            ->when($request->filled('teaching_grade'), function ($query) use ($request) {
                $query->whereHas('teacher', function ($q) use ($request) {
                    $q->where('teaching_grade', $request->teaching_grade);
                });
            })

            // 🅰️ SECTION FILTER
            ->when($request->filled('section'), function ($query) use ($request) {
                $query->whereHas('teacher', function ($q) use ($request) {
                    $q->where('section', $request->section);
                });
            })

            ->paginate(10)
            ->appends($request->query());

        return view(
            'teacher-account.salarypaidteacher',
            compact('studentPayments', 'grades', 'sections')
        );
    }

    public function gotoLedger($id)
    {
        // dd('here');
        $ledgerPayments = TeachersSalaryPayment::orderBy('teachers_id')
            ->where('teachers_id',$id)
            ->with('teacher')
            ->get();
        // dd($ledgerPayments);

        return view('teacher-account.ledger',compact('ledgerPayments'));
    }

    public function gotoLedgerPrint($id)
    {
        $ledgerPayments = TeachersSalaryPayment::orderBy('teachers_id')
            ->where('teachers_id',$id)
            ->with('teacher')
            ->get();
        $profile = PalikaProfile::first();
        // dd($profile);

        return view('teacher-account.ledgerPrint',compact('ledgerPayments','profile'));
    }

}
