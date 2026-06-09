<?php

// namespace App\Exports;

// use Illuminate\Contracts\Support\Responsable;
// use Maatwebsite\Excel\Concerns\FromCollection;
// use Maatwebsite\Excel\Concerns\WithHeadings;

// class QuizTemplateExport implements FromCollection, WithHeadings
// {
//     protected $students;

//     public function __construct($students)
//     {
//         $this->students = $students;
//     }

//     public function collection()
//     {
//         return $this->students->map(function ($student) {
//             return [
//                 'Student Name' => $student->name,
//                 'Admission Number' => $student->admission_number,
//                 'Marks' => '', // Placeholder for marks entry
//             ];
//         });
//     }

//     public function headings(): array
//     {
//         return ['Student Name', 'Admission Number', 'Marks'];
//     }
// }

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class QuizTemplateExport implements FromCollection, WithHeadings, WithCustomStartCell
{
    protected $students;
    protected $className;

    public function __construct($students, $className)
    {
        $this->students = $students;
        $this->className = $className;
    }

    /**
     * Data for the rows in the Excel sheet.
     */
    public function collection()
    {
        return $this->students->map(function ($student) {
            return [
                'Student Name' => $student->name, // Include only the student name
                'Marks' => '', // Placeholder for marks entry
            ];
        });
    }

    /**
     * Headings for the student list.
     */
    public function headings(): array
    {
        return ['Student Name', 'Marks'];
    }

    /**
     * Specify the starting cell for headings.
     */
    public function startCell(): string
    {
        return 'A3'; // Start headings from cell A3
    }

    /**
     * Add custom data for the class name.
     */
    public function array(): array
    {
        return [
            [$this->className], // Class name as the first row
            [], // Empty row for spacing
        ];
    }
}


