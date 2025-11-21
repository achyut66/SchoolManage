<?php

namespace App\Http\Controllers;

use App\Models\StudentParentDetails;
use Illuminate\Http\Request;

class StudentParentDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = StudentParentDetails::all();
        return view('studentdetails.list', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $nameschool = SchoolDetails::all();
        // $caste      = Caste::all();
        // $religion   = Religion::all();
        // $level      = LicenseLevel::all();
        // return view('teacherspd.add', compact('nameschool','religion','caste','level'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StudentParentDetails  $studentParentDetails
     * @return \Illuminate\Http\Response
     */
    public function show(StudentParentDetails $studentParentDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StudentParentDetails  $studentParentDetails
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentParentDetails $studentParentDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StudentParentDetails  $studentParentDetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentParentDetails $studentParentDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StudentParentDetails  $studentParentDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentParentDetails $studentParentDetails)
    {
        //
    }
}
