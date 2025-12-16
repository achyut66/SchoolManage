<?php

namespace App\Http\Controllers;

use App\Models\StudentsGuardianDetail;
use App\Models\StudentParentDetails;
use Illuminate\Http\Request;

class StudentsGuardianDetailsController extends Controller
{
    /**
     * Show guardian form for a student
     */
    public function index(Request $request)
    {
    $search = trim($request->input('search'));

    $parents = StudentsGuardianDetail::with('student')
        ->when($search !== '', function ($query) use ($search) {
            $query->whereRaw('LOWER(parent_name) LIKE ?', [
                '%' . strtolower($search) . '%'
            ]);
        })
        ->paginate(10)
        ->withQueryString();

    return view('parentdetails.view', compact('parents', 'search'));
    }

    public function create($studentId)
    {
        $student  = StudentParentDetails::findOrFail($studentId);
        $guardian = StudentsGuardianDetail::where('student_id', $studentId)->first();

        return view('studentdetails.guardian', compact('student', 'guardian'));
    }
    // modal

    public function showModal($id)
    {
        $parent = StudentsGuardianDetail::with('student')->findOrFail($id);
        return view('parentdetails.modal', compact('parent'));
    }
    // print function
    public function print(Request $request)
    {
        $search = trim($request->input('search'));

        $parents = StudentsGuardianDetail::with('student')
            ->when($search !== '', function ($query) use ($search) {
                $query->where('parent_name', 'like', "%{$search}%");
            })
            ->get(); // ❗ NO pagination for printing

        return view('parentdetails.print', compact('parents', 'search'));
    }


    /**
     * Store guardian details
     */
    public function store(Request $request, $studentId)
    {
        $validated = $request->validate([
            'parent_name'           => 'required|string|max:255',
            'relation_to_student'   => 'required|string|max:100',
            'contact_no'            => 'required|string|max:20',
            'address'               => 'required|string|max:255',
            'occupation'            => 'nullable|string|max:255',
            'emergency_contact'          => 'nullable|string|max:20',
            'medical_condition'          => 'nullable|string|max:255',
        ]);

        $validated['student_id'] = $studentId;

        StudentsGuardianDetail::create($validated);

        return redirect()
            ->route('student-parent-list')
            ->with('success', 'Guardian details saved successfully!');
    }

    /**
     * Edit guardian details
     */
    public function edit($studentId)
    {
        $student  = StudentParentDetails::findOrFail($studentId);
        $guardian = StudentsGuardianDetail::where('student_id', $studentId)->firstOrFail();
        return view('studentdetails.guardian_edit', compact('student', 'guardian'));
    }

    /**
     * Update guardian details
     */
    public function update(Request $request, $studentId)
    {
        $guardian = StudentsGuardianDetail::where('student_id', $studentId)->firstOrFail();

        $validated = $request->validate([
            'parent_name'           => 'required|string|max:255',
            'relation_to_student'   => 'required|string|max:100',
            'contact_no'            => 'required|string|max:20',
            'address'               => 'required|string|max:255',
            'occupation'            => 'nullable|string|max:255',
            'emergency_contact'          => 'nullable|string|max:20',
            'medical_condition'          => 'nullable|string|max:255',
        ]);

        $guardian->update($validated);

        return redirect()
            ->route('student-parent-list')
            ->with('success', 'Guardian details updated successfully!');
    }
}
