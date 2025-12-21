<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentResult;
use App\Models\StudentParentDetails;
use Illuminate\Support\Facades\DB;
use App\Models\PalikaProfile;
use Barryvdh\DomPDF\Facade\Pdf;


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
        $results = $query
        ->orderBy('student_name')
        ->paginate(10)
        ->withQueryString();

        return view('result.list', compact('results'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'student_id'      => 'required',
            'subjects'        => 'required|array',
            'marks'           => 'required|array',
            'practical_marks' => 'required|array',
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
                'practical_marks' => $request->practical_marks[$index],
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
        $results = StudentResult::where('student_id', $student_id)->get();
        $info = StudentParentDetails::findOrFail($student_id);
        $dob = $info->student_dob;
        if ($results->isEmpty()) {
            return redirect()->back()->with('error', 'Result not found.');
        }

        $student = $results->first();
        $school_profile = PalikaProfile::first();

        $totalMarks = $results->sum('obtained_marks') + $results->sum('practical_marks');

        $totalSubjects = $results->count();
        $percentage = $totalSubjects > 0
            ? ($totalMarks / ($totalSubjects * 100)) * 100
            : 0;

        $gradeData = calculateGpaFromPercentage($percentage);

        if ($percentage >= 60) {
            $division = 'FIRST DIVISION';
        } elseif ($percentage >= 45) {
            $division = 'SECOND DIVISION';
        } elseif ($percentage >= 32) {
            $division = 'THIRD DIVISION';
        } else {
            $division = 'FAIL';
        }    
        
        $rankedStudents = StudentResult::select(
                'student_id',
                \DB::raw('SUM(obtained_marks + practical_marks) as total')
            )
            ->groupBy('student_id')
            ->orderByDesc('total')
            ->get();

        $position = null;
        $rank = 1;

        foreach ($rankedStudents as $row) {
            if ($row->student_id == $student_id) {
                if ($rank == 1) $position = 'FIRST';
                elseif ($rank == 2) $position = 'SECOND';
                elseif ($rank == 3) $position = 'THIRD';
                break;
            }
            $rank++;
        }

        return view('result.view', [
            'student'        => $student,
            'results'        => $results,
            'division'       => $division,
            'totalMarks'     => $totalMarks,
            'percentage'     => $percentage,
            'gpa'            => $gradeData['gpa'],
            'gpa_class'      => $gradeData['grade'],
            'school_profile' => $school_profile,
            'dob'            => $dob,
            'position'       => $position,
        ]);
    }

    public function downloadPdf($student_id)
    {
        $results = StudentResult::where('student_id', $student_id)->get();
        $info = StudentParentDetails::findOrFail($student_id);
        $dob = $info->student_dob;
        if ($results->isEmpty()) {
            return redirect()->back()->with('error', 'Result not found.');
        }

        $student = $results->first();
        $school_profile = PalikaProfile::first();

        $totalMarks = $results->sum('obtained_marks') + $results->sum('practical_marks');

        $totalSubjects = $results->count();
        $percentage = $totalSubjects > 0
            ? ($totalMarks / ($totalSubjects * 100)) * 100
            : 0;

        $gradeData = calculateGpaFromPercentage($percentage);
        $gpa       = $gradeData['gpa'];
        $gpa_class = $gradeData['grade'];
        // dd($gradeData);

        $rankedStudents = StudentResult::select(
            'student_id',
            \DB::raw('SUM(obtained_marks + practical_marks) as total')
            )
            ->groupBy('student_id')
            ->orderByDesc('total')
            ->get();

        $position = null;
        $rank = 1;

        foreach ($rankedStudents as $row) {
            if ($row->student_id == $student_id) {
                if ($rank == 1) $position = 'FIRST';
                elseif ($rank == 2) $position = 'SECOND';
                elseif ($rank == 3) $position = 'THIRD';
                break;
            }
            $rank++;
        }

        if ($percentage >= 60) {
            $division = 'FIRST DIVISION';
        } elseif ($percentage >= 45) {
            $division = 'SECOND DIVISION';
        } elseif ($percentage >= 32) {
            $division = 'THIRD DIVISION';
        } else {
            $division = 'FAIL';
        }     

        $pdf = Pdf::loadView('result.view-pdf', compact(
            'student',
            'results' ,
            'division',
            'totalMarks',
            'percentage',
            'gpa',
            'gpa_class',
            'school_profile',
            'dob'   ,
            'position'        
        ))->setPaper('A4', 'landscape');
        // dd("im here");
        return $pdf->download('marksheet-'.$student->student_name.'.pdf');
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
            'subjects'        => 'required|array',
            'obtained_marks'  => 'required|array',
            'practical_marks' => 'required|array',
        ]);

        // delete old records
        foreach ($request->result_ids as $index => $resultId) {
            StudentResult::where('id', $resultId)->update([
                'obtained_marks'  => $request->obtained_marks[$index],
                'practical_marks' => $request->practical_marks[$index],
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
