<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingSalary extends Model
{
    use HasFactory;
    protected $table = 'table_settings_teachers_salary';
    protected $fillable = [
        'grade_id',
        'allowance_type',
        'allowance_amount',
        'academic_year',
    ];

    public function grade()
    {
        return $this->belongsTo(GradeSetting::class, 'grade_id');
    }
}
