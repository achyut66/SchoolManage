<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExamScheduleSetting;
use Illuminate\Support\Facades\Response;
use App\Models\SettingExam;
use App\Models\AcademicYear;


class ExamScheduleController extends Controller
{
    /**
     * Display a listing of the exams.
     */
    public function index()
    {
        $exams = ExamScheduleSetting::with('exam')->get();
        return view('exam-setting.schedule.list', compact('exams'));
    }


    /**
     * Show the form for creating a new exam.
     */
    public function create()
    {
        $exams = SettingExam::get();
        $ac_year = AcademicYear::where('flag',1)->first();
        // dd($ac_year);
        $view = view('exam-setting.schedule.add', compact('exams','ac_year'))->render();
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
        // dd('here');
        $request->validate([
            // 'grade_id'  => 'required',
            'exam_id' => 'required|integer',
            'academic_year' => 'required|string',
            'exam_start_date' => 'required|string',
            'exam_end_date' => 'required|string',
        ]);
        // dd($request->all());

        ExamScheduleSetting::create([
            // 'grade_id'  => $request->grade_id,
            'exam_id' => $request->exam_id,
            'academic_year' => $request->academic_year,
            'exam_start_date' => $request->exam_start_date,
            'exam_end_date' => $request->exam_end_date,
        ]);

        return redirect()->route('schedule-setting')
                         ->with('success', 'Exam Scheduled Successfully.');
    }

    /**
     * Show the form for editing the exam.
     */
    public function edit(Request $request)
    {
        $st = $request->get('id');
        $exams = SettingExam::get();
        $schedule = ExamScheduleSetting::find($st);
        $view = view('exam-setting.schedule.edit',compact('schedule','exams'))->render();
        return Response::json(['status' => 200, 'view' => $view]);
    }

    /**
     * Update the exam in database.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'exam_id' => 'required|integer',
            'academic_year' => 'required|string',
            'exam_start_date' => 'required|string',
            'exam_end_date' => 'required|string',
        ]);
        // dd($request->all());
        $exam = ExamScheduleSetting::findOrFail($id);
        $exam->update([
            'exam_id' => $request->exam_id,
            'academic_year' => $request->academic_year,
            'exam_start_date' => $request->exam_start_date,
            'exam_end_date' => $request->exam_end_date,
        ]);

        return redirect()->route('schedule-setting')
                         ->with('success', 'schedule updated successfully.');
    }

    /**
     * 
     * Remove the exam from database.
     */
    public function destroy($id)
    {
        $exam = ExamScheduleSetting::findOrFail($id);
        $exam->delete();
        return redirect()->route('exam-setting')
                         ->with('success', 'Exam deleted successfully.');
    }
}
