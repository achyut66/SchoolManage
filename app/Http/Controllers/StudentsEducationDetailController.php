<?php

namespace App\Http\Controllers;

use App\Models\StudentsEducationDetail;
use App\Models\StudentParentDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentsEducationDetailController extends Controller
{
    /**
     * Show education form for a student
     */
    public function create($studentId)
    {
        // dd("here");
        $student = StudentParentDetails::findOrFail($studentId);
        $education = StudentsEducationDetail::where('student_id', $studentId)->first();
        // dd($education);
        return view('studentdetails.education', compact('student','education'));
    }

    /**
     * Store education details
     */
    public function store(Request $request, $studentId)
    {
        $validated = $request->validate([
            'prev_school_name'                => 'required|string|max:255',
            'prev_school_address'             => 'required|string|max:255',
            'prev_school_left_grade'          => 'required|string|max:50',
            'prev_school_obtained_percentage' => 'required|numeric|min:0|max:100',
            'prev_school_left_certificate'    => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $validated['student_id'] = $studentId;

        if ($request->hasFile('prev_school_left_certificate')) {
            $validated['prev_school_left_certificate'] =
                $request->file('prev_school_left_certificate')
                        ->store('education-certificates', 'public');
        }

        StudentsEducationDetail::create($validated);

        return redirect()
            ->route('students.parents', $studentId)
            ->with('success', 'Education details saved successfully!');
    }

    /**
     * Edit education details
     */
    public function edit($studentId)
    {
        $student   = StudentParentDetails::findOrFail($studentId);
        $education = StudentsEducationDetail::where('student_id', $studentId)->first();
        // dd($education);
        return view('studentdetails.education_edit', compact('student', 'education'));
    }

    /**
     * Update education details
     */
    public function update(Request $request, $studentId)
    {
        $education = StudentsEducationDetail::where('student_id', $studentId)->firstOrFail();

        $validated = $request->validate([
            'prev_school_name'                => 'required|string|max:255',
            'prev_school_address'             => 'required|string|max:255',
            'prev_school_left_grade'          => 'required|string|max:50',
            'prev_school_obtained_percentage' => 'required|numeric|min:0|max:100',
            'prev_school_left_certificate'    => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($request->hasFile('prev_school_left_certificate')) {
            if ($education->prev_school_left_certificate &&
                Storage::disk('public')->exists($education->prev_school_left_certificate)) {
                Storage::disk('public')->delete($education->prev_school_left_certificate);
            }

            $validated['prev_school_left_certificate'] =
                $request->file('prev_school_left_certificate')
                        ->store('education-certificates', 'public');
        }

        $education->update($validated);

        return redirect()
            ->route('students.parents', $studentId)
            ->with('success', 'Education details updated successfully!');
    }
}
