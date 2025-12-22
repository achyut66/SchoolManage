<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingStudentFee extends Model
{
    use HasFactory;
    protected $table = 'table_setting_students_fees';
    protected $fillable = [
        'grade_id',
        'fee_name',
        'fee_amount',
        'academic_year',
    ];

    public function grade()
    {
        return $this->belongsTo(GradeSetting::class, 'grade_id');
    }
}
