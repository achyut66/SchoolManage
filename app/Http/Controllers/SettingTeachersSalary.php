<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SettingSalary;
use App\Models\GradeSetting;
use App\Models\AcademicYear;
use Illuminate\Support\Facades\DB;

class SettingTeachersSalary extends Controller
{
    public function index()
    {
        // dd('here');
        $data = SettingSalary::with('grade')
            ->orderBy('grade_id')
            ->get()
            ->groupBy('grade_id');
        // dd($data->first());
        return view('settingsalary.list', compact('data'));
    }

    public function create()
    {
        // dd(88);
        $grades = GradeSetting::all();
        return view('settingsalary.add', compact('grades'));
    }

    public function store(Request $request)
    {
        // dd(88);
        $request->validate([
            'grade_id'        => 'required|string',
            'allowance_type'        => 'required|array',
            'allowance_amount'      => 'required|array',
            'allowance_type.*'      => 'required|string',
            'allowance_amount.*'    => 'required|numeric'
        ]);

        $academic_year =  AcademicYear::where('flag',1)->first();
        $ac_year = $academic_year->academic_year;
        // dd($ac_year);

        DB::transaction(function () use ($request,$ac_year) {

            foreach ($request->allowance_type as $key => $feeName) {
                SettingSalary::create([
                    'grade_id'    => $request->grade_id,
                    'allowance_type'    => $feeName,
                    'allowance_amount'  => $request->allowance_amount[$key],
                    'academic_year' => $ac_year,
                ]);
            }

        });

        return redirect('/teacherssalary')
            ->with('success', 'Salary saved successfully!');
    }


    public function edit($grade)
    {
        $subjects = SettingSalary::where('grade', $grade)
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
    
        SettingSalary::where('grade', $grade)->delete();
    
        foreach ($request->subjects as $subject) {
            SettingSalary::create([
                'grade' => $grade,
                'subjects' => $subject
            ]);
        }
    
        return redirect('/curriculum')->with('success', 'Updated Successfully');
    }
    
    public function destroy($gradeId)
    {
        SettingSalary::where('grade_id', $gradeId)->delete();

        return redirect('/teacherssalary')
            ->with('success', 'Teachers Salary deleted successfully.');
    }

}