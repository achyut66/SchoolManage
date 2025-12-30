<?php

namespace App\Http\Controllers;

use App\Models\StudentParentDetails;
use App\Models\StudentsEducationDetail;
use App\Models\StudentsGuardianDetail;
use Illuminate\Http\Request;
use App\Models\Caste;
use App\Models\Religion;
use App\Models\GradeSetting;
use Illuminate\Support\Facades\Storage;
use App\Models\PalikaProfile;
use App\Models\AcademicYear;
use App\Models\StudentMigration;
use App\Models\SettingCurriculum;
use App\Models\StudentResult;
use App\Models\SettingExam;

use App\Exports\TeacherExport;
use App\Exports\ExportTeachersDetailsBySearch;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use App\Models\SettingSection;
use App\Models\ExamScheduleSetting;
use App\Models\ExamTypeResult;

use Maatwebsite\Excel\Concerns\ToModel;

use App\Exports\StudentsExport;


class StudentParentDetailsController extends Controller
{

    public function index(Request $request)
    {
        $grades = GradeSetting::get();
        $students = StudentParentDetails::query();
        $resultStudentIds = StudentResult::pluck('student_id')->toArray();
        // Search by student name
        if ($request->filled('search')) {
            $students->where(
                'student_full_name',
                'LIKE',
                '%' . $request->search . '%'
            );
        }
        if ($request->filled('student_enrollment_class')) {
            $students->where(
                'student_enrollment_class',
                $request->student_enrollment_class
            );
        }

        if ($request->filled('student_enrollment_section')) {
            $students->where(
                'student_enrollment_section',
                $request->student_enrollment_section
            );
        }

        $sections = ['A','B','C','D','E','F'];
        $students = $students
            ->where('flag',1)
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString();
        return view('studentdetails.list', compact('students', 'grades','resultStudentIds','sections'));
    }

    public function create()
    {
        $caste      = Caste::all();
        $religion   = Religion::all();
        $grade    = GradeSetting::orderBy('id')->get();
        // dd($section);
        return view('studentdetails.add', compact('religion','caste','grade'));
    }

    public function getSections($grade)
    {
        $sections = SettingSection::where('grade', $grade)->pluck('sections');
        return response()->json($sections);
    }


    public function store(Request $request)
    {
        $palika = PalikaProfile::first();
        $s_code = $palika->school_code;

        $validated = $request->validate([
            'student_full_name'          => 'required|string|max:255',
            'student_enrollment_class'   => 'required|string',
            'student_enrollment_section' => 'required|string',
            's_caste'                    => 'required',
            's_gender'                   => 'required',
            's_birthplace'               => 'nullable|string',
            's_province'                 => 'nullable|string',
            's_district'                 => 'nullable|string',
            's_municipality'             => 'nullable|string',
            's_ward'                     => 'nullable|string',
            's_tol'                      => 'nullable|string',
            'student_email'              => 'nullable|string',
            'student_address'            => 'nullable|string',
            's_religion'                 => 'nullable|string',
            'student_fathers_name'       => 'nullable|string',
            'student_mothers_name'       => 'nullable|string',
            's_gf_name'                  => 'nullable|string',
            'student_dob'                => 'nullable|date',
            'student_contact'            => 'nullable|string',
            's_bccopy'                   => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'flag'                       => '1',
            'fee_cleared'                => '0',
        ]);
        $validated['flag'] = 1;
        // dd($validated);
        // -------- File Upload --------
        if ($request->hasFile('s_bccopy')) {
            $validated['s_bccopy'] = $request->file('s_bccopy')->store('bccopies', 'public');
        }
        $student = StudentParentDetails::create($validated);
        $student_code = $s_code . '-S-' . str_pad($student->id, 4, '0', STR_PAD_LEFT);
        $ac_year = AcademicYear::where('flag', 1)->value('academic_year');
        $student->update([
            'unique_id' => $student_code,
            'academic_year' => $ac_year
        ]);
        return redirect()
            ->route('students.education', $student->id)
            ->with('success', 'Personal details saved. Continue with education.');
    }

    public function personalForm($id){
        $student = StudentParentDetails::findOrFail($id);
        return view('studentdetails.add', compact('student'));
    }

    public function educationForm($id)
    {
        $student = StudentParentDetails::findOrFail($id);
        return view('studentdetails.education', compact('student'));
    }

    public function parentForm($id)
    {
        $student = StudentParentDetails::findOrFail($id);
        return view('studentdetails.guardian', compact('student'));
    }

    public function show($id)
    {
        $student = StudentParentDetails::findOrFail($id);
        $education = StudentsEducationDetail::where('student_id', $student->id)->first();
        $guardian  = StudentsGuardianDetail::where('student_id', $student->id)->first();
        return view('studentdetails.profile', compact(
            'student',
            'education',
            'guardian'
        ));
    }


    public function edit($id)
    {
        // dd('here');
        $student   = StudentParentDetails::findOrFail($id);
        // dd($student);
        $caste     = Caste::all();
        $religion  = Religion::all();
        $grade    = GradeSetting::orderBy('id')->get();
        return view('studentdetails.edit', compact('student','caste','religion','grade'));
    }

    public function update(Request $request, $id)
    {
        $student = StudentParentDetails::findOrFail($id);
        $validated = $request->validate([
            'student_full_name'          => 'required|string|max:255',
            'student_enrollment_class'   => 'required|string',
            'student_enrollment_section' => 'required|string',
            's_caste'                    => 'required',
            's_gender'                   => 'required',
            's_birthplace'               => 'nullable|string',
            's_province'                 => 'nullable|string',
            's_district'                 => 'nullable|string',
            's_municipality'             => 'nullable|string',
            's_ward'                     => 'nullable|string',
            's_tol'                      => 'nullable|string',
            'student_email'              => 'nullable|email',
            'student_address'            => 'nullable|string',
            's_religion'                 => 'nullable|string',
            'student_fathers_name'       => 'nullable|string',
            'student_mothers_name'       => 'nullable|string',
            's_gf_name'                  => 'nullable|string',
            'student_dob'                => 'nullable|date',
            'student_contact'            => 'nullable|string',
            's_bccopy'                   => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // -------- Update File --------
        if ($request->hasFile('s_bccopy')) {

            // delete old file if exists
            if ($student->s_bccopy && Storage::disk('public')->exists($student->s_bccopy)) {
                Storage::disk('public')->delete($student->s_bccopy);
            }

            // upload new file
            $validated['s_bccopy'] = $request->file('s_bccopy')->store('bccopies', 'public');
        }

        $student->update($validated);

        return redirect()
            ->route('student-parent-list')
            ->with('success', 'Student details updated successfully!');
    }

    public function destroy($id)
    {
        $student = StudentParentDetails::findOrFail($id);

        // delete file
        if ($student->s_bccopy && Storage::disk('public')->exists($student->s_bccopy)) {
            Storage::disk('public')->delete($student->s_bccopy);
        }

        $student->delete();

        return redirect()
            ->route('student-parent-list')
            ->with('success', 'Student details deleted successfully!');
    }
// print
        public function print(Request $request)
    {
        $query = StudentParentDetails::query();
        $palikaProfile = PalikaProfile::first();
        $code = $palikaProfile->school_code;
        if ($request->filled('search')) {
            $query->where('student_full_name', 'LIKE', '%' . $request->search . '%');
        }
        if ($request->filled('student_enrollment_class')) {
            $query->where('student_enrollment_class', 'LIKE', '%' . $request->student_enrollment_class . '%');
        }
        if ($request->filled('student_enrollment_section')) {
            $query->where(
                'student_enrollment_section',
                $request->student_enrollment_section
            );
        }

        // $sections = ['A','B','C','D','E','F'];
        $students = $query->where('flag',1)->orderBy('id', 'desc')->get();
        return view('studentdetails.print', compact('students','palikaProfile','code'));
    }
// excel
    public function export(Request $request)
    {
        return Excel::download(
            new StudentsExport($request->search),
            'students.xlsx'
        );
    }

    // students record transfer
    public function recordTransfer(Request $request)
    {
        $grades = GradeSetting::get();
        $students = StudentParentDetails::query();
        
        // Search by student name
        if ($request->filled('search')) {
            $students->where(
                'student_full_name',
                'LIKE',
                '%' . $request->search . '%'
            );
        }
        if ($request->filled('student_enrollment_class')) {
            $students->where(
                'student_enrollment_class',
                $request->student_enrollment_class
            );
        }
        $students = $students
            ->where('flag',1)
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString();
        return view('studentdetails.transfer.recordtransfer', compact('students', 'grades'));
    }

    public function migrationSave(Request $request)
    {
        // dd('kjddj');
        // dd($request->all());
        $validated = $request->validate([
            'student_id'     => 'required|integer',
            'student_name'   => 'required|string|max:255',
            'academic_year'  => 'required|string|max:20',
            'grade'          => 'required|string|max:20',
            'student_enrollment_section'        => 'required|string|max:20',
        ]);
        // dd($validated);

        DB::transaction(function () use ($validated) {
            StudentMigration::create([
                'student_id'    => $validated['student_id'],
                'student_name'  => $validated['student_name'],
                'academic_year' => $validated['academic_year'],
                'grade'         => $validated['grade'],
                'section'       => $validated['student_enrollment_section'],
            ]);
            StudentParentDetails::where('id', $validated['student_id'])
                ->update([
                    'student_enrollment_class' => $validated['grade'],
                    'academic_year'            => $validated['academic_year'],
                    'student_enrollment_section'            => $validated['student_enrollment_section'],
                ]);
        });

        return redirect()->back()
            ->with('success', 'Student transferred successfully.');
    }

    public function getAllMigration(Request $request)
    {
        $grades = GradeSetting::get();
        $students = StudentMigration::with('student');
        if ($request->filled('search')) {
            $students->where('student_name', 'LIKE', '%' . $request->search . '%');
        }
        if ($request->filled('student_enrollment_class')) {
            $students->where(
                'grade',
                $request->student_enrollment_class
            );
        }
        $students = $students
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString();
        return view('transferreport.list', compact('students', 'grades'));
    }

    public function printMigration(Request $request)
    {
        $grades = GradeSetting::get();
        $students = StudentMigration::with('student');
        if ($request->filled('search')) {
            $students->where('student_name', 'LIKE', '%' . $request->search . '%');
        }
        if ($request->filled('student_enrollment_class')) {
            $students->where('grade', $request->student_enrollment_class);
        }
        $students = $students
            ->orderBy('id', 'desc')
            ->get(); // ❗ get() NOT paginate for print
        return view('transferreport.print', compact('students'));
    }

    // disable the admission for student
    public function disableAdmission($id)
    {
        $student = StudentParentDetails::findOrFail($id);
        // dd($student);
        $student->update([
            'flag' => 0
        ]);
        return redirect()->back()->with('success', 'Admission disabled successfully.');
    }

//    result add
    public function goToResultAdd($id, $typeId)
    {
        $student = StudentParentDetails::where('flag', 1)->findOrFail($id);

        $result = StudentResult::where('student_id', $id)->first();

        $type_name = SettingExam::findOrFail($typeId);
        $name = $type_name->exam_name;

        $curriculum = SettingCurriculum::where(
            'grade',
            $student->student_enrollment_class
        )->get();

        return view('result.add', compact(
            'student',
            'curriculum',
            'result',
            'name'
        ));
    }


    // student fee collector
    public function studentFeeCollection(Request $request)
    {
        $grades = GradeSetting::get();
        $students = StudentParentDetails::query();
        $resultStudentIds = StudentResult::pluck('student_id')->toArray();
        // Search by student name
        if ($request->filled('search')) {
            $students->where(
                'student_full_name',
                'LIKE',
                '%' . $request->search . '%'
            );
        }
        if ($request->filled('student_enrollment_class')) {
            $students->where(
                'student_enrollment_class',
                $request->student_enrollment_class
            );
        }

        if ($request->filled('student_enrollment_section')) {
            $students->where(
                'student_enrollment_section',
                $request->student_enrollment_section
            );
        }

        $sections = ['A','B','C','D','E','F'];
        $students = $students
            ->where('flag',1)
            ->where('fee_cleared',0)
            ->orderBy('id', 'desc') 
            ->paginate(10)
            ->withQueryString();
        return view('student-account.list', compact('students', 'grades','resultStudentIds','sections'));
    }

    // students exam record

    public function studentsExam(Request $request)
    {
        {
            $grades = GradeSetting::get();
            $students = StudentParentDetails::query();
            $exam =     ExamScheduleSetting::with('exam')->get();
            // dd($exam);
            $resultStudentIds = StudentResult::pluck('student_id')->toArray();
            if ($request->filled('search')) {
                $students->where(
                    'student_full_name',
                    'LIKE',
                    '%' . $request->search . '%'
                );
            }
            if ($request->filled('student_enrollment_class')) {
                $students->where(
                    'student_enrollment_class',
                    $request->student_enrollment_class
                );
            }
    
            if ($request->filled('student_enrollment_section')) {
                $students->where(
                    'student_enrollment_section',
                    $request->student_enrollment_section
                );
            }
    
            $sections = ['A','B','C','D','E','F'];
            $students = $students
                ->where('flag',1)
                ->orderBy('id', 'desc')
                ->paginate(10)
                ->withQueryString();
            return view('exam.list', compact('students', 'grades','resultStudentIds','sections','exam'));
        } 
    }

}

