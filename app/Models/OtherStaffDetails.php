<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherStaffDetails extends Model
{
    use HasFactory;
    protected $table = 'table_other_staffs_details';
    protected $fillable = [
        'full_name',
        'address',
        'contact_no',
        'email',
        'post',
        'salary',
        'academic_year',
    ];
}
