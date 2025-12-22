<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SettingStudentFee;
use App\Models\GradeSetting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use App\Models\AcademicYear;

class SettingStudentFeeController extends Controller
{
    public function index()
    {
        $data = SettingStudentFee::with('grade')
            ->orderBy('grade_id')
            ->get()
            ->groupBy('grade_id');
        // dd($data->first());
        return view('settingsfee.list', compact('data'));
    }

    public function create()
    {
        // dd(88);
        $grades = GradeSetting::all();
        return view('settingsfee.add', compact('grades'));
    }

    public function store(Request $request)
    {
        // dd(88);
        $request->validate([
            'grade_id'        => 'required|string',
            'fee_name'        => 'required|array',
            'fee_amount'      => 'required|array',
            'fee_name.*'      => 'required|string',
            'fee_amount.*'    => 'required|numeric'
        ]);

        $academic_year =  AcademicYear::where('flag',1)->first();
        $ac_year = $academic_year->academic_year;
        // dd($ac_year);

        DB::transaction(function () use ($request,$ac_year) {

            foreach ($request->fee_name as $key => $feeName) {
                SettingStudentFee::create([
                    'grade_id'    => $request->grade_id,
                    'fee_name'    => $feeName,
                    'fee_amount'  => $request->fee_amount[$key],
                    'academic_year' => $ac_year,
                ]);
            }

        });

        return redirect('/studentfee')
            ->with('success', 'Fee saved successfully!');
    }


    public function edit($grade)
    {
        $subjects = SettingStudentFee::where('grade', $grade)
                      ->pluck('subjects')
                      ->toArray();
    
        return response()->json([
            'status' => 200,
            'view' => view('grade.edit', compact('grade', 'subjects'))->render()
        ]);
    }
    public function update(Request $request, $grade)
    {
        $request->validate([
            'subjects' => 'required|array',
            'subjects.*' => 'required|string'
        ]);
    
        SettingStudentFee::where('grade', $grade)->delete();
    
        foreach ($request->subjects as $subject) {
            SettingStudentFee::create([
                'grade' => $grade,
                'subjects' => $subject
            ]);
        }
    
        return redirect('/curriculum')->with('success', 'Updated Successfully');
    }
    
    public function destroy($gradeId)
    {
        SettingStudentFee::where('grade_id', $gradeId)->delete();

        return redirect('/studentfee')
            ->with('success', 'Grade and all subjects deleted successfully.');
    }

}