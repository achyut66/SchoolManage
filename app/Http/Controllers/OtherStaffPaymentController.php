<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OtherStaffPayment;
use Illuminate\Support\Facades\Validator;
use App\Models\PalikaProfile;

class OtherStaffPaymentController extends Controller
{
    public function store(Request $request)
    {
        // Validate request data
        $validator = Validator::make($request->all(), [
            'staff_id'            => 'required|string',
            'staff_name'          => 'required|string',
            'staff_post'          => 'required|string',
            'staff_salary'        => 'required|string',
            'paid_from'           => 'required|date',
            'paid_to'             => 'required|date',
            'academic_year'       => 'required|string',
            'total_paid_amount'   => 'required|numeric',
            'due_amount'          => 'required|numeric',
        ]);
        // dd($validator);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Store data
        OtherStaffPayment::create($validator->validated());

        return redirect()
        ->route('other-staff-details')
        ->with('success', 'Payment successful !!!');
    }

    public function gotoLedger($id)
    {
        // dd('here');
        $payment_detail = OtherStaffPayment::where('staff_id', $id)->get();
        return view('other-staff.ledger', compact('payment_detail'));
    }

    public function gotoLedgerPrint($id)
    {
        // dd('here');
        $profile = PalikaProfile::where('type',1)->first();
        $payment_detail = OtherStaffPayment::where('staff_id', $id)->get();
        return view('other-staff.ledgerPrint', compact('payment_detail','profile'));
    }
}
