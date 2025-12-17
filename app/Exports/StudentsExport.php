<?php

namespace App\Exports;

use App\Models\StudentParentDetails;
use App\Models\PalikaProfile;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentsExport implements FromCollection, WithHeadings
{
    protected $search;
    protected $student_enrollment_class;

    public function __construct($search = null, $student_enrollment_class = null)
    {
        $this->search = $search;
        $this->student_enrollment_class = $student_enrollment_class;
    }

    public function collection()
    {
        $palika = PalikaProfile::first();
        $schoolCode = $palika?->school_code;

        $query = StudentParentDetails::query();

        // Search by student name
        if (!empty($this->search)) {
            $query->where('student_full_name', 'LIKE', '%' . $this->search . '%');
        }

        // Filter by grade
        if (!empty($this->student_enrollment_class)) {
            $query->where('student_enrollment_class', $this->student_enrollment_class);
        }

        return $query->orderBy('id', 'desc')
            ->get([
                'student_full_name',
                'student_enrollment_class',
                's_province',
                's_district',
                's_municipality',
                'student_fathers_name',
                'student_email',
                'unique_id',
                'academic_year',
            ])
            ->map(function ($row) use ($schoolCode) {
                return [
                    'student_full_name'           => $row->student_full_name,
                    'student_enrollment_class'    => $row->student_enrollment_class,
                    's_province'                  => $row->s_province,
                    's_district'                  => $row->s_district,
                    's_municipality'              => $row->s_municipality,
                    'student_fathers_name'        => $row->student_fathers_name,
                    'student_email'               => $row->student_email,
                    'unique_id'                   => $row->unique_id,
                    'academic_year'                   => $row->academic_year,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Student Name',
            'Student Code',
            'Grade',
            'Province',
            'District',
            'Municipality',
            'Father Name',
            'Email',
            'Student Code',
            'Academic Year',
        ];
    }
}
