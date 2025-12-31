<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ExamTypeResult;

class StudentResult extends Model
{
    use HasFactory;
    protected $table = 'table_add_students_result';
    protected $fillable = [
        'student_id',
        'school_id',
        'student_name',
        'academic_year',
        'grade',
        'subjects',
        'obtained_marks',
        'practical_marks',
        'exam_type_id'
    ];

    public function examType()
    {
        return $this->belongsTo(SettingExam::class, 'exam_type_id');
    }

}
