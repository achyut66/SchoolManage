<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SettingCurriculum;
use App\Models\GradeSetting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class CurriculmSettingController extends Controller
{
    public function index()
    {
        // Group subjects by grade value
        $data = SettingCurriculum::select('grade')
            ->groupBy('grade')
            ->get();

        return view('curriculum.list', compact('data'));
    }

    public function create()
    {
        $grades = GradeSetting::pluck('name');
        return view('curriculum.add', compact('grades'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'grade'      => 'required|string',
            'subjects'   => 'required|array',
            'subjects.*' => 'required|string'
        ]);

        DB::transaction(function () use ($request) {
            foreach ($request->subjects as $subject) {
                SettingCurriculum::create([
                    'grade'   => $request->grade,
                    'subjects' => $subject
                ]);
            }
        });

        return redirect('/curriculum')
            ->with('success', 'Curriculum saved successfully!');
    }

    public function edit($grade)
    {
        $subjects = SettingCurriculum::where('grade', $grade)
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
    
        SettingCurriculum::where('grade', $grade)->delete();
    
        foreach ($request->subjects as $subject) {
            SettingCurriculum::create([
                'grade' => $grade,
                'subjects' => $subject
            ]);
        }
    
        return redirect('/curriculum')->with('success', 'Updated Successfully');
    }
    
    public function destroy($grade)
    {
        SettingCurriculum::where('grade', $grade)->delete();

        return redirect('/curriculum')
            ->with('success', 'Grade and all subjects deleted successfully.');
    }

}
