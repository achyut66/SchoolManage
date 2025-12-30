<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GradeSetting;

class SettingExam extends Model
{
    use HasFactory;
    protected $table = 'table_exam_name_settings';
    protected $fillable = [
        'grade_id',
        'exam_name',
    ];

    public function grade()
    {
        return $this->belongsTo(GradeSetting::class, 'grade_id', 'id');
    }
}
