<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentsEducationDetail extends Model
{
    use HasFactory;
    protected $table = 'table_student_parent_education_details';
    protected $fillable = [
        'prev_school_name',
        'student_id',
        'prev_school_address',
        'prev_school_left_grade',
        'prev_school_obtained_percentage',
        'prev_school_left_certificate',
    ];
}
