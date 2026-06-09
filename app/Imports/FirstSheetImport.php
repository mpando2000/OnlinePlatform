<?php

namespace App\Imports;

use App\Models\Quiz;
use App\Models\User;
use App\Models\QuizResult;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Log;

class FirstSheetImport implements ToModel
{
    private $quiz;

    public function __construct(Quiz $quiz)
    {
        $this->quiz = $quiz;
    }

    /**
     * Process each row in the sheet.
     *
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Skip the header row
        if ($row[0] === 'Student Name') {
            return null;
        }

        // Try to find the student by name, case-insensitive
        $student = User::where('name', 'ilike', $row[0])->first();

        if ($student) {
            // If the student is found, create a QuizResult entry
            return new QuizResult([
                'student_id' => $student->id,
                'percentage' => $row[1], // Assuming the second column is the score/percentage
                'quiz_id'    => $this->quiz->id,
            ]);
        } else {
            // Log missing student and continue
            Log::warning("Student not found: " . $row[0]);
            return null; // Skip this row
        }
    }
}
