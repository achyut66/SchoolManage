<?php

namespace App\Http\Controllers;
use App\Models\TeachersPersonalDetail;
use App\Models\TeachersEducationDetail;
use App\Models\TeachersWorkDetails;
use App\Models\SchoolDetails;
use App\Models\Religion;
use App\Models\LicenseLevel;
use App\Models\Caste;
use Illuminate\Http\Request;
use App\Http\Requests\TeacherPersonalDetals;
use App\Models\PalikaProfile;
use App\Models\SettingCurriculum;
use App\Models\GradeSetting;
use App\Models\AcademicYear;
use Response;

use App\Exports\TeacherExport;
use App\Exports\ExportTeachersDetailsBySearch;
use Maatwebsite\Excel\Facades\Excel;

use Maatwebsite\Excel\Concerns\ToModel;


class TeachersPersonalDetailController extends Controller
{

    public function index()
    {
        $schools = SchoolDetails::all();
        $data = TeachersPersonalDetail::where('flag',1)->paginate(10)->withQueryString();
        $year = AcademicYear::where('flag',1)->value('academic_year');
        // dd($year);
        return view('teacherspd.list', compact('data','schools'));
    }

    public function teacher_as_type(Request $request)
    {
        $query = TeachersPersonalDetail::query();

        // 🔍 Search by Teacher Name (English)
        if ($request->filled('teachers_name_english')) {
            $query->where('teachers_name_eng', 'LIKE', '%' . $request->teachers_name_english . '%');
        }

        // 🔍 Search by Teacher Type (Class / Subject)
        if ($request->filled('type')) {
            $type = strtolower($request->type);

            if ($type === 'class teacher') {
                $query->where('is_class_teacher', 1);
            } elseif ($type === 'subject teacher') {
                $query->where('is_class_teacher', 2);
            }
        }

        // 🔍 Search by Teaching Grade
        if ($request->filled('teaching_grade')) {
            $query->where('teaching_grade', $request->teaching_grade);
        }
        // search by section
        if ($request->filled('section')) {
            $query->where(
                'section',
                $request->section
            );
        }

        $data = $query->where('flag',1)->paginate(10)->withQueryString();
        $grades = GradeSetting::all();
        return view('teacherspd.type.list', compact('data','grades'));
    }

    public function create()
    {
        $nameschool = SchoolDetails::all();
        $caste      = Caste::all();
        $religion   = Religion::all();
        $level      = LicenseLevel::all();
        $curriculum = GradeSetting::get();
        // dd($curriculum);
        return view('teacherspd.add', compact('nameschool','religion','caste','level','curriculum'));
    }

    public function store(TeacherPersonalDetals $request)
    {
        $profile = PalikaProfile::first();
        $t_code  = $profile->school_code;

        $validated = $request->validated();

        if ($request->file('teachers_cit_upload')) {
            $validated['teachers_cit_upload'] = fileUploads(
                $request->file('teachers_cit_upload'),
                'cit'
            );
        }

        if ($request->file('teachers_teacher_license_upload')) {
            $validated['teachers_teacher_license_upload'] = fileUploads(
                $request->file('teachers_teacher_license_upload'),
                'license'
            );
        }

        if ($request->file('teachers_pan_upload')) {
            $validated['teachers_pan_upload'] = fileUploads(
                $request->file('teachers_pan_upload'),
                'pan'
            );
        }
        $validated['flag'] = 1;
        $validated['salary_cleared'] = 0;
        $ac_year = AcademicYear::where('flag', 1)->value('academic_year');
        $teacher = TeachersPersonalDetail::create($validated);
        $teacher_code = $t_code . '-T-' . str_pad($teacher->id, 4, '0', STR_PAD_LEFT);
        $teacher->update([
            'unique_id' => $teacher_code,
            'academic_year' => $ac_year
        ]);
        return redirect()->route('teachers-education-create', ['id' => $teacher->id]);
    }

    public function show($id)
    {
        $teacherDetail      = TeachersPersonalDetail::with('educationDetails','workDetails')->find($id);
        $educationDetail    = TeachersEducationDetail::where('teachers_id', $id)->get();
        $workDetail         = TeachersWorkDetails::where('teachers_id', $id)->get();
        $licenseLevel       = LicenseLevel::where('id', $teacherDetail->teachers_teacher_licensestep)->first();
        return view('teacherspd.profile', compact('teacherDetail','educationDetail','workDetail','licenseLevel'));
    }

    public function edit($id)
    {
        $row_data = TeachersPersonalDetail::find($id);
        $schools = SchoolDetails::all();
        $caste      = Caste::all();
        $religion   = Religion::all();
        $level      = LicenseLevel::all();
        $curriculum = GradeSetting::get();
        return view('teacherspd.edit', compact('row_data','schools','religion','caste','level','curriculum'));
    }
    
    public function update(TeacherPersonalDetals $request, $id)
    {
        $validated = $request->validated();
        if ($request->hasFile('teachers_cit_upload')) {
            $validated['teachers_cit_upload'] = fileUploads(
                $request->file('teachers_cit_upload'),
                'cit'
            );
        }
        if ($request->hasFile('teachers_teacher_license_upload')) {
            $validated['teachers_teacher_license_upload'] = fileUploads(
                $request->file('teachers_teacher_license_upload'),
                'license'
            );
        }
        if ($request->hasFile('teachers_pan_upload')) {
            $validated['teachers_pan_upload'] = fileUploads(
                $request->file('teachers_pan_upload'),
                'pan'
            );
        }
        $teacher = TeachersPersonalDetail::findOrFail($id);
        if (empty($teacher->teacher_code)) {
            $schoolCode = PalikaProfile::first()?->school_code;

            $validated['teacher_code'] =
                $schoolCode . '-T-' . str_pad($teacher->id, 4, '0', STR_PAD_LEFT);
        }
        if (empty($teacher->academic_year)) {
            $academicYear = AcademicYear::where('flag', 1)->value('academic_year');

            $validated['academic_year'] = $academicYear;
        }
        $teacher->update($validated);
        return redirect('/teachers-personal-list')
            ->with('success', 'Successfully Updated!!!');
    }

    public function destroy(TeachersPersonalDetail $teachersPersonalDetail,$id)
    {
        TeachersPersonalDetail::where('id', $id)->delete();
        return redirect('/teachers-personal-list')->with('success', 'Remove Success !!!');
    }

    public function search(Request $request) 
    {
       
            $name       = $request->name;
            $statusID   = $request->statusID;
            $licenceNo  = $request->licenceNo;
            
            $data       = TeachersPersonalDetail::
                            when(!empty($statusID) , function ($query) use($statusID){
                            return $query->where('teacher_enroll_status', $statusID);
                            })->when(!empty($name) , function ($query) use($name){
                                return $query->where('teachers_name_nep', 'LIKE', '%' .$name. '%');
                            })->when(!empty($licenceNo) , function ($query) use($licenceNo){
                            return $query->where('teachers_teacher_licenseno', $licenceNo);
                            })->where('flag',1)->get();
            $view = view('teacherspd.ajaxlist',compact('data','statusID','name','licenceNo'))->render();
            return Response::json(['status' => 200, 'view' => $view]);
        // } else {
        //     echo 'invalid request';
        // }
    }

    public function convertBSTOAD(Request $request) 
    {
        if($request->ajax()) {
            $bs = $request->dob;
            $ad = convertBS($bs);
            return $ad;
        } else {
           return '';
        }
    }

    public function printDetails()
    {
    
        $row = PalikaProfile::first();
        $newdata = TeachersPersonalDetail::where('flag',1)->get();
        return view('printPage.teacherspdprint', compact('newdata','row'));    
    }

    public function teachers_type_print(Request $request)
    {
        $row = PalikaProfile::first();
        $query = TeachersPersonalDetail::query();
        if ($request->filled('search')) {
            $query->where('teachers_name_english', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('teacher_type')) {
            $query->where('is_class_teacher', $request->teacher_type);
        }
        if ($request->filled('teaching_grade')) {
            $query->where('teaching_grade', $request->teaching_grade);
        }
        // search by section
        if ($request->filled('section')) {
            $query->where(
                'section',
                $request->section
            );
        }
        $newdata = $query->where('flag',1)->get();
        return view('teacherspd.type.print', compact('row', 'newdata'));
    }

    public function printajaxDetails($statusID, $name, $licenceNo) 
    {
        $statusID = explode('-', $statusID);
        $name = explode('-', $name);
        $licenceNo = explode('-', $licenceNo);

        $status =  $statusID[1];
        $sname = $name[1];
        $lno = $licenceNo[1];
        
        $newdata = TeachersPersonalDetail::
                    when(!empty($status) , function ($query) use($status){
                        return $query->where('teacher_enroll_status',$status);
                    })->when(!empty($sname) , function ($query) use($sname){
                        return $query->where('teachers_name_nep',$sname);
                    })->when(!empty($lno) , function ($query) use($lno){
                        return $query->where('teachers_teacher_licenseno',$lno);
                    })->get();
        return view('printPage.teacherspdprint',compact('newdata'));
    }

    public function export() 
    {
        return Excel::download(new TeacherExport, 'Teachers List.xlsx');
    }
    
    public function exportBySearch($statusID, $name, $licenceNo) 
    {
        $statusID = explode('-', $statusID);
        $name = explode('-', $name);
        $licenceNo = explode('-', $licenceNo);

        $status =  $statusID[1];
        $sname = $name[1];
        $lno = $licenceNo[1];
        return Excel::download(new ExportTeachersDetailsBySearch($status,$sname,$lno), 'Teachers Details.xlsx');
    }

    public function importDetails() 
    {
        $view = view('teacherspd.importexcel')->render();
        return Response::json(['status' => 200, 'view' => $view]);
    }

    public function saveImportDetails(Request $request) 
    {
        if($request->hasFile('file')) {
            $data   = [];
            $educationDetail = [];
            $supported_mimes = ['xls','xlsx','csv'];
            $extension = $request->file->getClientOriginalExtension();
            if(in_array($extension, $supported_mimes)) {
                $array  = Excel::toArray(new TeachersPersonalDetail(), request()->file('file'));
                foreach($array as $key =>  $val) {
                    foreach($val as $key => $d) {
                        $data[] = [
                            'id'                                    => $d[0],
                            'school_id'                             => 1,
                            'teacher_enroll_status'                 => $d[31],
                            'teachers_name_nep'                     => $d[1],
                            'teachers_name_eng'                     => $d[2],
                            'teachers_caste'                        => $d[3],
                            'teachers_religion'                     => $d[4] ,
                            'teachers_gender'                       => $d[5],
                            'teachers_mobno'                        => $d[6],
                            'teachers_email'                        => $d[7],
                            'teachers_province'                     => $d[8],
                            'teachers_zone'                         => $d[9],
                            'teachers_localadd'                     => $d[10],
                            'teachers_ward'                         => $d[11],
                            'teachers_tole'                         => $d[12],
                            'teachers_birth_place'                  => $d[13],
                            'teachers_dob_bs'                       => $d[14],
                            'teachers_dob_ad'                       => $d[15],
                            'teachers_marriage_satatus'             => $d[16],
                            'teachers_marriage_date'                => $d[17],
                            'teachers_hw_name'                      => $d[18],
                            'teachers_citno'                        => $d[19],
                            'teachers_cit_jari_date'                => $d[20],
                            'teachers_cit_jari_district'            => $d[21],
                            'teachers_gf_name'                      => $d[22],
                            'teachers_f_name'                       => $d[23],
                            'teachers_m_name'                       => $d[24],
                            'teachers_teacher_licensestep'          => $d[25],
                            'teachers_teacher_license_sub'          => $d[26],
                            'teachers_teacher_licenseno_jari_date'  => $d[27],
                            'teachers_teacher_licenseno'            => $d[28],
                            'teachers_teacher_license_upload'       => "",
                            'teachers_panno'                        => $d[29],
                            'teachers_pan_upload'                   => '',
                        ];

                        $educationDetail[] = [
                            'teachers_id'                   => $d[0],
                            'slc_school_name'               => $d[32],
                            'slc_passed_year'               => $d[33],
                            'slc_percent'                   => $d[34],
                            'slc_pass_marks'                => $d[35],
                            'slc_major_subject'             => $d[36],
                            'slc_certificate_upload'        => '',
                            'slc_marksheet_upload'          => '',

                            'plustwo_school_name'          => $d[37],
                            'plustwo_faculty'              => $d[38],
                            'plustwo_passed_year'           => $d[39],
                            'plustwo_percentage'            => $d[40],
                            'plustwo_pass_marks'            => $d[41],

                            'plustwo_school_address'        => '',
                            
                            'plustwo_certificate_upload'    => '',
                            'plustwo_marksheet_upload'      => '',
                            'plustwo_transcript_upload'     => '',

                            'bachelor_uuniversity_name'    => $d[44],
                            'bachelor_school_name'          => $d[45],
                            'bachelor_school_address'       => '',
                            'bachelor_faculty'              => $d[46],
                            'bachelor_passed_year'         => $d[47],
                            'bachelor_percentage'           => $d[48],
                            'bachelor_pass_marks'           => $d[49],
                            'bachelor_major_subject'        => $d[50],
                            
                            'bachelor_certificate_upload'   => '',
                            'bachelor_marksheet_upload'     => '',
                            'bachelor_transcript_upload'    => '',

                            'masters_university_name'       => $d[51],
                            'masters_school_name'           => $d[52],
                            'masters_school_address'        => '',
                            'masters_passed_year'           => $d[53],
                            'masters_percentage'            => $d[54],
                            'masters_pass_marks'            => $d[55],
                            'masters_major_subject'         => $d[56],
                            'masters_certificate_upload'    => '',
                            'masters_marksheet_upload'      => '',
                            'masters_transcript_upload'     => '',
                        ];
                    }
                }
            unset($data[0]);
            unset($educationDetail[0]);
            TeachersPersonalDetail::insert($data);
            TeachersEducationDetail::insert($educationDetail);
            return redirect('/teachers-personal-list')->with('success', 'Successfully created');
            } else {
                return redirect('/teachers-personal-list')->with('fail', 'file type not supported [$supported_mimes = [xls,xlsx,csv]');
             }
        } else {
            return redirect('/teachers-personal-list')->with('fail', 'please select file to import');
        }
    }

    public function disableTeacherInformation($id)
    {
        // dd($id);
        $student = TeachersPersonalDetail::findOrFail($id);
        $student->update([
            'flag' => 0
        ]);
        return redirect()->back()->with('success', 'Teachers Information disabled successfully.');
    }

    public function teachersSalaryCollection(Request $request)
    {
        // dd('heer');
        $query = TeachersPersonalDetail::query();

        // 🔍 Search by Teacher Name (English)
        if ($request->filled('teachers_name_english')) {
            $query->where('teachers_name_eng', 'LIKE', '%' . $request->teachers_name_english . '%');
        }

        // 🔍 Search by Teacher Type (Class / Subject)
        if ($request->filled('type')) {
            $type = strtolower($request->type);

            if ($type === 'class teacher') {
                $query->where('is_class_teacher', 1);
            } elseif ($type === 'subject teacher') {
                $query->where('is_class_teacher', 2);
            }
        }

        // 🔍 Search by Teaching Grade
        if ($request->filled('teaching_grade')) {
            $query->where('teaching_grade', $request->teaching_grade);
        }
        // search by section
        if ($request->filled('section')) {
            $query->where(
                'section',
                $request->section
            );
        }

        $data = $query->where('flag',1)->where('salary_cleared', 0)->paginate(10)->withQueryString();
        $grades = GradeSetting::all();
        return view('teacher-account.list', compact('data','grades'));
    }
}