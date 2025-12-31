<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StudentParentDetails;
use App\Models\StudentResult;

class ExamTypeResult extends Model
{
    use HasFactory;
    protected $table='table_student_result_with_exam_type';
    protected $fillable = [
        'student_id',
        'academic_year',
        'exam_type_id'
    ];

    public function student()
    {
        return $this->belongsTo(StudentParentDetails::class, 'student_id', 'id');
    }

    public function studentResult()
    {
        return $this->belongsTo(
            StudentResult::class,
            'student_id',
            'student_id'
        );
    }

}
