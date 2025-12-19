<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SchoolDetails;
use App\Models\TeachersPersonalDetail;
use App\Models\StudentParentDetails;
use App\Models\GradeSetting;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class DashboardController extends Controller
{
    public function index()
    {
        $count         = SchoolDetails::count();
        $tot_school    = SchoolDetails::all();

        $tot_steachers = TeachersPersonalDetail::where('teacher_enroll_status', 1)->count();
        $tot_ateachers = TeachersPersonalDetail::where('teacher_enroll_status', 2)->count();
        $tot_teachers  = TeachersPersonalDetail::count();

        $sthai_teacher  = TeachersPersonalDetail::where('teacher_enroll_status', 1)->get();
        $asthai_teacher = TeachersPersonalDetail::where('teacher_enroll_status', 2)->get();

        $tot_students = StudentParentDetails::count();
        $grade        = GradeSetting::all();

        $studentsByGrade = StudentParentDetails::selectRaw(
            'student_enrollment_class as grade, COUNT(*) as total'
        )
        ->groupBy('student_enrollment_class')
        ->get();

        $teachersByGrade = TeachersPersonalDetail::selectRaw(
            'teaching_grade as grade, COUNT(*) as total'
        )
        ->groupBy('teaching_grade')
        ->get();

        /* ================= STUDENTS BY GRADE ================= */
        return view('pages.dashboard', compact(
            'count',
            'tot_school',
            'tot_steachers',
            'tot_ateachers',
            'tot_teachers',
            'sthai_teacher',
            'asthai_teacher',
            'tot_students',
            'grade',
            'studentsByGrade',
            'teachersByGrade'
        ));
    }
}
