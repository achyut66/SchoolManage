<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExamTypeResult;

class ExamTypeResultController extends Controller
{
    //
    public function index()
    {
        $exam_result = ExamTypeResult::get();
        return view('',compact('exam_result'));
    }

    // store function
        public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id'     => 'required|integer',
            'academic_year'  => 'required|string',
            'exam_type_id'   => 'required|integer',
        ]);

        $exists = ExamTypeResult::where('student_id', $validated['student_id'])
            ->where('academic_year', $validated['academic_year'])
            ->where('exam_type_id', $validated['exam_type_id'])
            ->exists();

        if ($exists) {
            return redirect()->back()
                ->with('error', 'Result already exists for this exam type.');
        }

        $result = ExamTypeResult::create($validated);

        return redirect()->route('student-result-add', [
            'id'     => $result->student_id,
            'typeId' => $result->exam_type_id,
        ]);
    }


}
