<?php

namespace App\Http\Controllers;

use App\Models\StudentFeePayment;
use App\Models\StudentParentDetails;
use Illuminate\Http\Request;
use App\Models\GradeSetting;
use App\Models\SettingStudentFee;
use DB;

class StudentFeePaymentController extends Controller
{
    /* =========================
     *  INDEX (LIST)
     * ========================= */
    public function index($id)
    {
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

        $payments = StudentFeePayment::where('student_id', $id)
            ->orderBy('id', 'desc')
            ->get();

        return view(
            'student-account.payment',
            compact('payments', 'student_details', 'fee_setting')
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
            'school_id'           => 'required|integer',
            'academic_year'       => 'required|string',
            'grade'               => 'required|string',
            'payment_from_date'   => 'required|date',
            'payment_to_date'     => 'required|date|after_or_equal:payment_from_date',
            'admission_date'      => 'required|date',
            'total_paid_amount'   => 'required|numeric|min:0',
            'due_amount'          => 'required|numeric|min:0',
        ]);

        DB::transaction(function () use ($request) {
            StudentFeePayment::create($request->all());
        });

        return redirect()
            ->route('student-fee-payment.index')
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
}
