<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentResult;
use App\Models\StudentParentDetails;
use Illuminate\Support\Facades\DB;

class StudentResultController extends Controller
{

    public function index(Request $request)
    {
        $query = StudentResult::select(
                'student_id',
                'student_name',
                'academic_year',
                'grade',
                \DB::raw('SUM(obtained_marks) as total_marks')
            )
            ->groupBy('student_id', 'student_name', 'academic_year', 'grade');

        // SEARCH BY STUDENT NAME
        if ($request->filled('student_name')) {
            $query->where('student_name', 'LIKE', '%' . $request->student_name . '%');
        }
        $results = $query->orderBy('student_name')->get();
        return view('result.list', compact('results'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'student_id'      => 'required',
            'subjects'        => 'required|array',
            'marks'           => 'required|array',
        ]);
        $student = StudentParentDetails::findOrFail($request->student_id);
        // dd($student);
        foreach ($request->subjects as $index => $subject) {
            StudentResult::create([
                'student_id'      => $student->id,
                'school_id'       => $student->unique_id ?? null,
                'student_name'    => $student->student_full_name,
                'academic_year'   => $student->academic_year,
                'grade'           => $student->student_enrollment_class,
                'subjects'        => $subject,
                'obtained_marks'  => $request->marks[$index],
            ]);
        }
        return redirect('student-result-list')
        ->with('success', 'Student result saved successfully');
    }
    /**
     * View result of a student
     */
    public function show($student_id)
    {
        $results = AddStudentResult::where('student_id', $student_id)->get();
        return view('results.show', compact('results'));
    }

    /**
     * Edit result
     */
    public function edit($student_id)
    {
        $results = StudentResult::where('student_id', $student_id)->get();

        if ($results->isEmpty()) {
            abort(404);
        }

        $student = $results->first(); // single row for info

        return view('result.edit', compact('student', 'results'));
    }


    /**
     * Update result
     */
    public function update(Request $request, $student_id)
    {
        $request->validate([
            'subjects'       => 'required|array',
            'obtained_marks' => 'required|array',
        ]);

        // delete old records
        foreach ($request->result_ids as $index => $resultId) {
            StudentResult::where('id', $resultId)->update([
                'obtained_marks' => $request->obtained_marks[$index],
            ]);
        }
        return redirect('student-result-list')->with('success', 'Result updated successfully');
    }

    /**
     * Delete result
     */
    public function destroy($student_id)
    {
        AddStudentResult::where('student_id', $student_id)->delete();

        return redirect()->back()->with('success', 'Result deleted successfully');
    }
}
