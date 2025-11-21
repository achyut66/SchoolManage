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
        'student_address',
        'student_fathers_name',
        'student_mothers_name',
        'student_dob',
        'student_contact',
        'student_email',
        'student_enrollment_class',
        'student_prev_school_name',
        'student_prev_school_certificate',
        'student_prev_school_cont_person',
        'student_parents_full_name',
        'student_parents_cont_no',
        'student_parents_email',
        'student_parents_address'
    ];
}
