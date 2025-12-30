<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SettingExam;
use App\Models\GradeSetting;
use Illuminate\Support\Facades\Response;


class ExamSettingController extends Controller
{
    /**
     * Display a listing of the exams.
     */
    public function index()
    {
        $exams = SettingExam::with('grade')->get();
        return view('exam-setting.list', compact('exams'));
    }


    /**
     * Show the form for creating a new exam.
     */
    public function create()
    {
        $view = view('exam-setting.add')->render();
        return Response::json([
            'status' => 200,
            'view'   => $view
        ]);
    }

    /**
     * Store a newly created exam in database.
     */
    public function store(Request $request)
    {
        $request->validate([
            // 'grade_id'  => 'required',
            'exam_name' => 'required|string|max:255',
        ]);
        // dd($request->all());

        SettingExam::create([
            // 'grade_id'  => $request->grade_id,
            'exam_name' => $request->exam_name,
        ]);

        return redirect()->route('exam-setting')
                         ->with('success', 'Exam created successfully.');
    }

    /**
     * Show the form for editing the exam.
     */
    public function edit(Request $request)
    {
        $st = $request->get('id');
        $row = SettingExam::find($st);
        $view = view('exam-setting.edit',compact('row'))->render();
        return Response::json(['status' => 200, 'view' => $view]);
    }

    /**
     * Update the exam in database.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'exam_name' => 'required|string|max:255',
        ]);
        // dd($request->all());
        $exam = SettingExam::findOrFail($id);
        $exam->update([
            'exam_name' => $request->exam_name,
        ]);

        return redirect()->route('exam-setting')
                         ->with('success', 'Exam updated successfully.');
    }

    /**
     * Remove the exam from database.
     */
    public function destroy($id)
    {
        $exam = SettingExam::findOrFail($id);
        $exam->delete();
        return redirect()->route('exam-setting')
                         ->with('success', 'Exam deleted successfully.');
    }
}
