<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherEducationDetails extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules =  [
            'teachers_id'               => 'required|numeric',
            //slc details
            'slc_passed_year'               => 'required',
            'slc_school_name'               => 'required',
            'slc_percent'                   => 'required',
            'slc_pass_marks'                => 'required',
            'slc_major_subject'             => 'nullable',
            'slc_certificate_upload'        => 'nullable|mimes:jpg,png,jpeg,pdf|max:2048',
            'slc_marksheet_upload'          => 'nullable|mimes:jpg,png,jpeg,pdf|max:2048',
            //plus 2
            'plustwo_passed_year'           => 'required',
            'plustwo_school_name'           => 'required',
            'plustwo_school_address'        => 'required',
            'plustwo_faculty'               => 'required',
            'plustwo_percentage'            => 'required',
            'plustwo_pass_marks'            => 'required',
            'plustwo_certificate_upload'    => 'nullable|mimes:jpg,png,jpeg,pdf|max:2048',
            'plustwo_marksheet_upload'      => 'nullable|mimes:jpg,png,jpeg,pdf|max:2048',
            'plustwo_transcript_upload'     => 'nullable|mimes:jpg,png,jpeg,pdf|max:2048',
            // 'plsutwo_major_subject'         => 'nullable',
            //bacheclors
            'bachelor_passed_year'          => 'nullable',
            'bachelor_school_name'          => 'nullable',
            'bachelor_school_address'       => 'nullable' ,
            'bachelor_uuniversity_name'     => 'nullable',
            'bachelor_faculty'              => 'nullable',
            'bachelor_percentage'           => 'nullable',
            'bachelor_pass_marks'           => 'nullable',
            'bachelor_major_subject'        => 'nullable',
            'bachelor_certificate_upload'   => 'nullable|mimes:jpg,png,jpeg,pdf|max:2048',
            'bachelor_marksheet_upload'     => 'nullable|mimes:jpg,png,jpeg,pdf|max:2048',
            'bachelor_transcript_upload'    => 'nullable|mimes:jpg,png,jpeg,pdf|max:2048',
            //if has beded
            'bed_passed_year'               => 'nullable',
            'bed_school_name'               => 'nullable',
            'bed_school_address'            => 'nullable',
            'bed_university_name'           => 'nullable',
            'bed_faculty'                   => 'nullable',
            'bed_percentage'                => 'nullable',
            'bed_pass_marks'                => 'nullable',
            'bed_major_subject'             => 'nullable',
            'bed_certificate_upload'        => 'nullable|mimes:jpg,png,jpeg,pdf|max:2048',
            'bed_marksheet_upload'          => 'nullable|mimes:jpg,png,jpeg,pdf|max:2048',
            'bed_transcript_upload'         => 'nullable|mimes:jpg,png,jpeg,pdf|max:2048',
            //masters
            'masters_passed_year'           => 'nullable',
            'masters_school_name'           => 'nullable',
            'masters_school_address'        => 'nullable' ,
            'masters_university_name'       => 'nullable',
            'masters_percentage'            => 'nullable',
            'masters_pass_marks'            => 'nullable' ,
            'masters_major_subject'         => 'nullable' ,
            'masters_certificate_upload'    => 'nullable|mimes:jpg,png,jpeg,pdf|max:2048',
            'masters_marksheet_upload'      => 'nullable|mimes:jpg,png,jpeg,pdf|max:2048',
            'masters_transcript_upload'     => 'nullable|mimes:jpg,png,jpeg,pdf|max:2048',
            'others_certificate_upload'     => 'nullable|mimes:jpg,png,jpeg,pdf|max:2048',
        ];
        return $rules;
    }
}
