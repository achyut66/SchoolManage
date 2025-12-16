<?php
namespace App\Exports;

use App\Models\StudentParentDetails;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentsExport implements FromCollection, WithHeadings
{
    protected $search;

    public function __construct($search = null)
    {
        $this->search = $search;
    }

    public function collection()
    {
        $query = StudentParentDetails::query();

        if (!empty($this->search)) {
            $query->where('student_full_name', 'LIKE', '%' . $this->search . '%');
        }

        return $query->orderBy('id', 'desc')->get([
            'student_full_name',
            'student_enrollment_class',
            's_province',
            's_district',
            's_municipality',
            'student_fathers_name',
            'student_email',
        ]);
    }

    public function headings(): array
    {
        return [
            'Student Name',
            'Grade',
            'Province',
            'District',
            'Municipality',
            'Father Name',
            'Email',
        ];
    }
}
