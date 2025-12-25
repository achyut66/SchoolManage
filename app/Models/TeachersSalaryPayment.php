<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeachersSalaryPayment extends Model
{
    use HasFactory;
    protected $table = 'table_teachers_salary_account';
    protected $fillable = [
        'teachers_id',
        'teachers_code',
        'academic_year',
        'grade',
        'payment_from_date',
        'payment_to_date',
        'enrollment_date',
        'total_paid_amount',
        'due_amount'
    ];

    public function teacher()
    {
        return $this->belongsTo(TeachersPersonalDetail::class, 'teachers_id');
    }
}
