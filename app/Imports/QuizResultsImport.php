<?php

namespace App\Imports;

use App\Models\Quiz;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class QuizResultsImport implements WithMultipleSheets
{
    private $quiz;

    public function __construct(Quiz $quiz)
    {
        $this->quiz = $quiz;
    }

    /**
     * Define the sheets to import from the Excel file.
     *
     * @return array
     */
    public function sheets(): array
    {
        return [
            0 => new FirstSheetImport($this->quiz), // First sheet handling
            // You can add more sheets here as needed
        ];
    }
}