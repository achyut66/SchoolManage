<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentFeePayment extends Model
{
    use HasFactory;
    protected $table = 'table_student_fee_payment';
    protected $fillable = [
        'student_id',
        'school_id',
        'academic_year',
        'grade',
        'payment_from_date',
        'payment_to_date',
        'admission_date',
        'total_paid_amount',
        'due_amount',
    ];

    public function student()
    {
        return $this->belongsTo(StudentParentDetails::class, 'student_id');
    }

}
