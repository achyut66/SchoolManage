<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TeacherLeave;
use Illuminate\Support\Facades\Validator;

class TeacherLeaveController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'teachers_id' => 'required|string',
            'leave_from' => 'required|string',
            'leave_to'   => 'required|string',
            'reason'   => 'required|string',
            'academic_year'   => 'required|string'
        ]);
        
        TeacherLeave::create($validator->validated());
        return redirect()->back()->with('success', 'Teacher leave added successfully.');
    }

}
