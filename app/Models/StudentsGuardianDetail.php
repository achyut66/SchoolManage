<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StudentParentDetails;

class StudentsGuardianDetail extends Model
{
    use HasFactory;
    protected $table = 'table_student_guardian_details';
    protected $fillable = [
        'parent_name',
        'student_id',
        'relation_to_student',
        'contact_no',
        'address',
        'occupation',
        'emergency_contact',
        'medical_condition',
    ];
    
    public function student()
    {
        return $this->belongsTo(StudentParentDetails::class, 'student_id');
    }
}
