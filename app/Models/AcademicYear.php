<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    use HasFactory;
    protected $table = 'table_academic_year_setting';

    protected $fillable = [
        'academic_year',
        'flag'
    ];
}
