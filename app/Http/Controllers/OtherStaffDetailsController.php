<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OtherStaffDetails;
use App\Models\OtherStaffPayment;
use App\Models\AcademicYear;

class OtherStaffDetailsController extends Controller
{
    /* ===============================
       LIST (INDEX)
    =============================== */
    public function index()
    {
        $data = OtherStaffDetails::orderBy('id', 'desc')->paginate(10);
        $ac_year = AcademicYear::where('flag', 1)->first();
        // dd($data);
        return view('other-staff.list', compact('data','ac_year'));
    }

    /* ===============================
       STORE DATA
    =============================== */
    public function store(Request $request)
    {
        // dd('here');
        $request->validate([
            'full_name'     => 'required|string|max:255',
            'address'       => 'required|string|max:255',
            'contact_no'    => 'required|string|max:20',
            'email'         => 'nullable|string',
            'post'          => 'required|string|max:100',
            'salary'        => 'required|string',
            'academic_year' => 'required|string',
        ]);
        // dd($request->all());

        OtherStaffDetails::create($request->all());

        return redirect()
            ->route('other-staff-details')
            ->with('success', 'Other staff added successfully.');
    }

    /* ===============================
       SHOW SINGLE STAFF
    =============================== */
    public function show($id)
    {
        $staff = OtherStaffDetails::findOrFail($id);
        return view('other-staff.show', compact('staff'));
    }

    /* ===============================
       EDIT FORM
    =============================== */
    public function edit($id)
    {
        $staff = OtherStaffDetails::findOrFail($id);
        return view('other-staff.edit', compact('staff'));
    }

    /* ===============================
       UPDATE DATA
    =============================== */
    public function update(Request $request)
    {
        // dd($id);
        $request->validate([
            'id'            => 'required',
            'full_name'     => 'required|string|max:255',
            'address'       => 'required|string|max:255',
            'contact_no'    => 'required|string|max:20',
            'email'         => 'nullable|string',
            'post'          => 'required|string|max:100',
            'salary'        => 'required|string',
            'academic_year' => 'required|string',
        ]);
        // dd($request->all());
        $staff = OtherStaffDetails::findOrFail($request->id);
        $staff->update($request->all());

        return redirect()
            ->route('other-staff-details')
            ->with('success', 'Other staff updated successfully.');
    }

    /* ===============================
       DELETE
    =============================== */
    public function destroy($id)
    {
        $staff = OtherStaffDetails::findOrFail($id);
        $staff->delete();

        return redirect()
            ->route('other-staff.index')
            ->with('success', 'Other staff deleted successfully.');
    }

    // made a payment

    public function gotoPayment($id)
    {
        $staff_detail = OtherStaffDetails::findOrFail($id);

        // Get latest payment (if exists)
        $existingPayment = OtherStaffPayment::where('staff_id', $id)
            ->latest()
            ->first();

        return view('other-staff.createpayment', compact(
            'staff_detail',
            'existingPayment'
        ));
    }

}