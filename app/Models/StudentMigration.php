<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StudentParentDetails;

class StudentMigration extends Model
{
    use HasFactory;
    protected $table = 'table_student_migration_details';
    protected $fillable = [
        'student_name',
        'student_id',
        'academic_year',
        'grade',
        'section'
    ];

    public function student()
    {
        return $this->belongsTo(StudentParentDetails::class, 'student_id');
    }

}
