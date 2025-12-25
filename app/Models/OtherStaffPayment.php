<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherStaffPayment extends Model
{
    use HasFactory;
    protected $table = 'table_other_staff_salary_payemnt';
    protected $fillable = [
        'staff_id',
        'staff_name',
        'staff_post',
        'staff_salary',
        'paid_from',
        'paid_to',
        'academic_year',
        'total_paid_amount',
        'due_amount',
    ];
}
