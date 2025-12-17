<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentParentDetails extends Model
{
    use HasFactory;
    protected $table = 'students_parents_details';
    protected $fillable = [
        'student_full_name',
        'student_enrollment_class',
        's_caste',
        's_gender',
        's_birthplace',
        's_province',
        's_district',
        's_municipality',
        's_ward',
        's_tol',
        'student_email',
        'student_address',
        's_religion',
        'student_fathers_name',
        'student_mothers_name',
        's_gf_name',
        'student_dob',
        'student_contact',
        's_bccopy',
        'unique_id',
        'academic_year'
    ];
}
