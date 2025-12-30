<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SettingExam;

class ExamScheduleSetting extends Model
{
    use HasFactory;
    protected $table = 'table_schedule_exams_setting';
    protected $fillable = [
        'exam_id',
        'academic_year',
        'exam_start_date',
        'exam_end_date'
    ];

    public function exam()
    {
        return $this->belongsTo(SettingExam::class, 'exam_id', 'id');
    }
}
