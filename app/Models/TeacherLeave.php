<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherLeave extends Model
{
    use HasFactory;
    protected $table = 'table_teacher_on_leave';
    protected $fillable = [
        'teachers_id',
        'leave_from',
        'leave_to',
        'reason',
        'academic_year',
    ];

    public function teacher()
    {
        return $this->belongsTo(TeachersPersonalDetail::class, 'teachers_id', 'id');
    }
}
