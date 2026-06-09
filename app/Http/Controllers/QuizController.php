<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\User;
use App\Models\Subject;
use App\Models\QuizResult;
use App\Models\UserAnswer;
use App\Models\SchoolClass;
use Illuminate\Http\Request;
use App\Imports\QuizResultsImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Exports\QuizTemplateExport;





use Maatwebsite\Excel\Facades\Excel;


class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::all();
        return view('teacher.quiz.index', compact('quizzes'));
    }
    public function adminIndex()
    {
        $quizzes = Quiz::all();
        return view('admin.quiz.index', compact('quizzes'));
    }

    public function studentIndex()
    {

    $student =Auth::user(); 

    $classId = $student->class_id; 
    $quizzes = Quiz::where('class_id', $classId)->get(); 

    return view('student.quiz.index', compact('quizzes'));
    }

    public function showQuiz(Quiz $quiz)
    {
        $quiz->load('questions'); 
    return view('teacher.quiz.show', compact('quiz'));
    }

    public function adminShowQuiz(Quiz $quiz)
    {
        $quiz->load('questions'); 
    return view('admin.quiz.show', compact('quiz'));
    }


    public function createQuiz()
    {
        $userId = Auth::id();
        
        // Fetch teacher with unique classes and subjects assigned
        $teacher = User::with(['classes' => function($query) {
            $query->distinct(); // Ensure no duplicate classes
        }, 'classes.subjects' => function($query) {
            $query->distinct(); // Ensure no duplicate subjects
        }])->findOrFail($userId);
        
        // Get only the assigned classes for the teacher
        $classes = $teacher->classes->unique('id'); // Use unique() to filter out duplicate classes
        
        return view('teacher.quiz.quizForm', compact('classes'));
    }
    
    public function adminCreateQuiz(){
        $classes = SchoolClass::all();
        $subjects = Subject::all();
        return view ('admin.quiz.quizForm', compact('classes','subjects'));
    }


public function adminGetSubjectsByClass($classId)
{
    $subjects = Subject::where('school_class_id', $classId)->get();
   

    return response()->json($subjects);
}

public function getSubjectsByClass($classId)
{
    $userId = Auth::id();

    // Find the teacher and get their assigned subjects for the class
    $teacher = User::findOrFail($userId);
    
    // Fetch subjects only assigned to the teacher for the selected class
    $subjects = $teacher->classes()->where('school_classes.id', $classId)
                    ->with(['subjects' => function($query) {
                        $query->distinct(); // Avoid duplicate subjects
                    }])
                    ->first()->subjects;

    return response()->json($subjects);
}
    public function storeQuiz(Request $request)
    {
        try {
            // Get quiz type
            $quizType = $request->input('quiz_type', 'questions');
            
            // Base validation rules
            $rules = [
                'title' => 'required|string|max:255',
                'description' => 'required|string|max:500',
                'class_id' => 'required|exists:school_classes,id',
                'subject_id' => 'required|exists:subjects,id',
                'start_time' => 'required|date',
                'end_time' => 'required|date|after:start_time',
                'duration' => 'required|integer|min:1',
                'quiz_type' => 'required|string|in:questions,file',
            ];
            
            // Add conditional validation based on quiz type
            if ($quizType === 'file') {
                $rules['quiz_file'] = 'required|file|mimes:pdf,doc,docx,csv,xlsx,xls,json|max:10240'; // 10MB max
            } else {
                $rules['questions'] = 'required|array|min:1';
                $rules['questions.*.question_text'] = 'required|string';
                $rules['questions.*.option_a'] = 'required|string';
                $rules['questions.*.option_b'] = 'required|string';
                $rules['questions.*.option_c'] = 'required|string';
                $rules['questions.*.option_d'] = 'required|string';
                $rules['questions.*.correct_answer'] = 'required|string|in:a,b,c,d';
            }
            
            $validatedData = $request->validate($rules);
            
            // Create the quiz
            $quizData = [
                'title' => $validatedData['title'],
                'description' => $validatedData['description'],
                'class_id' => $validatedData['class_id'],
                'subject_id' => $validatedData['subject_id'],
                'start_time' => $validatedData['start_time'],
                'end_time' => $validatedData['end_time'],
                'duration' => $validatedData['duration'],
            ];
            
            // Handle file upload for file-based quiz
            if ($quizType === 'file' && $request->hasFile('quiz_file')) {
                $quizFile = $request->file('quiz_file');
                $fileName = time() . '_' . $quizFile->getClientOriginalName();
                $quizFile->storeAs('public/quizzes', $fileName);
                $quizData['quiz_file'] = $fileName;
            }
            
            $quiz = Quiz::create($quizData);
            
            // Create questions for question-based quiz
            if ($quizType === 'questions' && isset($validatedData['questions'])) {
                foreach ($validatedData['questions'] as $questionData) {
                    $quiz->questions()->create([
                        'question_text' => $questionData['question_text'],
                        // New format fields
                        'option_a' => $questionData['option_a'],
                        'option_b' => $questionData['option_b'],
                        'option_c' => $questionData['option_c'],
                        'option_d' => $questionData['option_d'],
                        'correct_answer' => $questionData['correct_answer'],
                        'question_type' => 'multiple_choice',
                        // Backward compatibility - also fill old format fields
                        'option1' => $questionData['option_a'],
                        'option2' => $questionData['option_b'],
                        'option3' => $questionData['option_c'],
                        'option4' => $questionData['option_d'],
                        'correct_option' => 'option' . (['a' => '1', 'b' => '2', 'c' => '3', 'd' => '4'][$questionData['correct_answer']] ?? '1'),
                    ]);
                }
            }
            
            return redirect()->route('quizzes.index')->with('success', 'Quiz created successfully! Students can now access this quiz.');
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput()
                ->with('error', 'Please check the form for errors and try again.');
        } catch (\Exception $e) {
            // Log the actual error for debugging
            Log::error('Quiz creation error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            
            // Show detailed error in development
            if (config('app.debug')) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Quiz creation error: ' . $e->getMessage() . ' in ' . $e->getFile() . ' at line ' . $e->getLine());
            } else {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'An error occurred while creating the quiz. Please try again.');
            }
        }
    }

    public function adminStoreQuiz(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'class_id' => 'required|exists:school_classes,id',
            'subject_id' => 'required|exists:subjects,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'duration' => 'required|integer|min:1',
            'questions.*.question_text' => 'required|string',
            'questions.*.option1' => 'required|string',
            'questions.*.option2' => 'required|string',
            'questions.*.option3' => 'required|string',
            'questions.*.option4' => 'required|string',
            'questions.*.correct_option' => 'required|string|in:option1,option2,option3,option4',
        ]);
    
        // Create the quiz with the class and subject associated
        $quiz = Quiz::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'class_id' => $validatedData['class_id'],
            'subject_id' => $validatedData['subject_id'],
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'duration' => $request->duration,
        ]);
    
        foreach ($request->input('questions') as $questionData) {
            $quiz->questions()->create([
                'question_text' => $questionData['question_text'],
                'option1' => $questionData['option1'],
                'option2' => $questionData['option2'],
                'option3' => $questionData['option3'],
                'option4' => $questionData['option4'],
                'correct_option' => $questionData['correct_option'],
            ]);
        }
    
        return redirect()->route('admin.quizzes.index')->with('success', 'Quiz created successfully.');
    }
    

public function editQuiz(Quiz $quiz)
{
    $quiz->load('questions');
    $classes = SchoolClass::all();   
    $subjects = Subject::all();  
    $selectedSubjectId = $quiz->subject_id;    
    return view('teacher.quiz.edit', compact('quiz', 'classes', 'subjects','selectedSubjectId'));
}

public function adminEditQuiz(Quiz $quiz)
{
    $quiz->load('questions');
    $classes = SchoolClass::all();   
    $subjects = Subject::all();  
    $selectedSubjectId = $quiz->subject_id;      
    return view('admin.quiz.edit', compact('quiz', 'classes', 'subjects', 'selectedSubjectId'));
}

public function updateQuiz(Request $request, Quiz $quiz)
{
    // Get quiz type from request
    $quizType = $request->input('quiz_type', 'questions');
    
    // Base validation rules (always required)
    $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string|max:500',
        'class_id' => 'required|integer|exists:school_classes,id',
        'subject_id' => 'required|integer|exists:subjects,id',
        'start_time' => 'required|date',
        'end_time' => 'required|date|after:start_time',
        'duration' => 'required|integer|min:1',
        'quiz_type' => 'required|string|in:questions,file',
    ];
    
    // Add type-specific validation rules
    if ($quizType === 'file') {
        // File-based quiz validation
        $hasExistingFile = !empty($quiz->quiz_file);
        if (!$hasExistingFile) {
            $rules['quiz_file'] = 'required|file|mimes:pdf,doc,docx,csv,xlsx,xls,json|max:10240'; // 10MB max
        } else {
            $rules['quiz_file'] = 'nullable|file|mimes:pdf,doc,docx,csv,xlsx,xls,json|max:10240';
        }
    } else {
        // Question-based quiz validation
        $rules['questions'] = 'required|array|min:1';
        $rules['questions.*.question_text'] = 'required|string';
        $rules['questions.*.option1'] = 'required|string';
        $rules['questions.*.option2'] = 'required|string';
        $rules['questions.*.option3'] = 'required|string';
        $rules['questions.*.option4'] = 'required|string';
        $rules['questions.*.correct_option'] = 'required|string|in:option1,option2,option3,option4';
    }
    
    $validatedData = $request->validate($rules);

    // Update basic quiz information
    $updateData = [
        'title' => $request->input('title'),
        'description' => $request->input('description'),
        'class_id' => $request->input('class_id'),
        'subject_id' => $request->input('subject_id'),
        'start_time' => $request->input('start_time'),
        'end_time' => $request->input('end_time'),
        'duration' => $request->input('duration'),
    ];

    // Handle quiz type specific updates
    if ($quizType === 'file') {
        // Handle file upload
        if ($request->hasFile('quiz_file')) {
            // Delete old file if exists
            if ($quiz->quiz_file) {
                $oldFilePath = storage_path('app/public/quizzes/' . $quiz->quiz_file);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }
            
            // Store new file
            $quizFile = $request->file('quiz_file');
            $fileName = time() . '_' . $quizFile->getClientOriginalName();
            $quizFile->storeAs('quizzes', $fileName, 'public');
            $updateData['quiz_file'] = $fileName;
        }
        
        // Delete all questions for file-based quiz
        $quiz->questions()->delete();
        
    } else {
        // Handle questions update
        // Clear existing quiz file for question-based quiz
        if ($quiz->quiz_file) {
            $oldFilePath = storage_path('app/public/quizzes/' . $quiz->quiz_file);
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
            $updateData['quiz_file'] = null;
        }
        
        // Delete existing questions
        $quiz->questions()->delete();
        
        // Create new questions
        $questions = $request->input('questions', []);
        foreach ($questions as $questionData) {
            $quiz->questions()->create([
                'question_text' => $questionData['question_text'],
                'option1' => $questionData['option1'],
                'option2' => $questionData['option2'],
                'option3' => $questionData['option3'],
                'option4' => $questionData['option4'],
                'correct_option' => $questionData['correct_option'],
            ]);
        }
    }
    
    // Update the quiz
    $quiz->update($updateData);

    return redirect()->route('quizzes.index')->with('success', 'Quiz updated successfully.');
}

public function adminUpdateQuiz(Request $request, Quiz $quiz)
{
    // Get quiz type from request
    $quizType = $request->input('quiz_type', 'questions');
    
    // Base validation rules (always required)
    $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string|max:500',
        'class_id' => 'required|integer|exists:school_classes,id',
        'subject_id' => 'required|integer|exists:subjects,id',
        'start_time' => 'required|date',
        'end_time' => 'required|date|after:start_time',
        'duration' => 'required|integer|min:1',
        'quiz_type' => 'required|string|in:questions,file',
    ];
    
    // Add type-specific validation rules
    if ($quizType === 'file') {
        // File-based quiz validation
        $hasExistingFile = !empty($quiz->quiz_file);
        if (!$hasExistingFile) {
            $rules['quiz_file'] = 'required|file|mimes:pdf,doc,docx,csv,xlsx,xls,json|max:10240'; // 10MB max
        } else {
            $rules['quiz_file'] = 'nullable|file|mimes:pdf,doc,docx,csv,xlsx,xls,json|max:10240';
        }
    } else {
        // Question-based quiz validation
        $rules['questions'] = 'required|array|min:1';
        $rules['questions.*.question_text'] = 'required|string';
        $rules['questions.*.option1'] = 'required|string';
        $rules['questions.*.option2'] = 'required|string';
        $rules['questions.*.option3'] = 'required|string';
        $rules['questions.*.option4'] = 'required|string';
        $rules['questions.*.correct_option'] = 'required|string|in:option1,option2,option3,option4';
    }
    
    $validatedData = $request->validate($rules);

    // Update basic quiz information
    $updateData = [
        'title' => $request->input('title'),
        'description' => $request->input('description'),
        'class_id' => $request->input('class_id'),
        'subject_id' => $request->input('subject_id'),
        'start_time' => $request->input('start_time'),
        'end_time' => $request->input('end_time'),
        'duration' => $request->input('duration'),
    ];

    // Handle quiz type specific updates
    if ($quizType === 'file') {
        // Handle file upload
        if ($request->hasFile('quiz_file')) {
            // Delete old file if exists
            if ($quiz->quiz_file) {
                $oldFilePath = storage_path('app/public/quizzes/' . $quiz->quiz_file);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }
            
            // Store new file
            $quizFile = $request->file('quiz_file');
            $fileName = time() . '_' . $quizFile->getClientOriginalName();
            $quizFile->storeAs('quizzes', $fileName, 'public');
            $updateData['quiz_file'] = $fileName;
        }
        
        // Delete all questions for file-based quiz
        $quiz->questions()->delete();
        
    } else {
        // Handle questions update
        // Clear existing quiz file for question-based quiz
        if ($quiz->quiz_file) {
            $oldFilePath = storage_path('app/public/quizzes/' . $quiz->quiz_file);
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
            $updateData['quiz_file'] = null;
        }
        
        // Delete existing questions
        $quiz->questions()->delete();
        
        // Create new questions
        $questions = $request->input('questions', []);
        foreach ($questions as $questionData) {
            $quiz->questions()->create([
                'question_text' => $questionData['question_text'],
                'option1' => $questionData['option1'],
                'option2' => $questionData['option2'],
                'option3' => $questionData['option3'],
                'option4' => $questionData['option4'],
                'correct_option' => $questionData['correct_option'],
            ]);
        }
    }
    
    // Update the quiz
    $quiz->update($updateData);

    return redirect()->route('admin.quizzes.index')->with('success', 'Quiz updated successfully.');
}

public function destroyQuiz(Quiz $quiz)
{
    $quiz->questions()->delete(); 
    $quiz->delete();              
    return redirect()->route('quizzes.index')->with('success', 'Quiz deleted successfully.');
}

public function adminDestroyQuiz(Quiz $quiz)
{
    $quiz->questions()->delete(); 
    $quiz->delete();              
    return redirect()->route('admin.quizzes.index')->with('success', 'Quiz deleted successfully.');
}




public function startQuiz(Quiz $quiz)
{
    $studentId = Auth::id();
    $hasSubmitted = QuizResult::where('quiz_id', $quiz->id)
                              ->where('student_id', $studentId)
                              ->exists();

    if ($hasSubmitted) {
        return redirect()->back()->with('error', 'You have already taken this quiz. You cannot retake it.');
    }
    $questions = $quiz->questions;
    return view('student.quiz.start', compact('quiz', 'questions'));
}







public function takeQuiz(Quiz $quiz)
{
    if (now()->greaterThan($quiz->end_time)) {
        return redirect()->back()->with('error', 'The deadline for this quiz has passed. You cannot start it.');
    }
    $studentId = Auth::id();
    $hasSubmitted = QuizResult::where('quiz_id', $quiz->id)
                              ->where('student_id', $studentId)
                              ->exists();

    if ($hasSubmitted) {
        return redirect()->back()->with('error', 'You have already taken this quiz. You cannot retake it.');
    }
    $questions = $quiz->questions;
    return view('student.quiz.start', compact('quiz', 'questions'));
}

    

public function submitQuiz(Request $request, Quiz $quiz)
{
    $studentId = Auth::id();
    $submittedAnswers = $request->input('answers', []); 

    $score = 0;
    $totalQuestions = $quiz->questions->count();
    $percentageScore = 0;

    // Check if this is a question-based quiz
    if ($totalQuestions > 0) {
        // Handle question-based quiz submission
        foreach ($quiz->questions as $question) {
            if (isset($submittedAnswers[$question->id])) {
                $submittedAnswer = $submittedAnswers[$question->id];
                
                // Store the answer
                UserAnswer::create([
                    'user_id' => $studentId,
                    'quiz_id' => $quiz->id,
                    'question_id' => $question->id,
                    'selected_option' => $submittedAnswer,
                ]);

                // Check if answer is correct (support both old and new formats)
                $isCorrect = false;
                if ($question->correct_option) {
                    // Old format
                    $isCorrect = strtolower($submittedAnswer) == strtolower($question->correct_option);
                } elseif ($question->correct_answer) {
                    // New format - convert letter to option format
                    $correctOption = 'option' . (['a' => '1', 'b' => '2', 'c' => '3', 'd' => '4'][$question->correct_answer] ?? '1');
                    $isCorrect = strtolower($submittedAnswer) == strtolower($correctOption);
                }
                
                if ($isCorrect) {
                    $score++;
                }
            }
        }
        
        // Calculate percentage score
        $percentageScore = ($score / $totalQuestions) * 100;
    } else {
        // Handle file-based quiz submission
        // For file-based quizzes, we can't auto-grade, so we set default values
        $totalQuestions = 1; // Represent the entire quiz as one unit
        $score = 0; // Default to 0, teacher will manually grade
        $percentageScore = 0; // Default to 0, will be updated when manually graded
    }

    // Store or update quiz result
    QuizResult::updateOrCreate(
        [
            'quiz_id' => $quiz->id,
            'student_id' => $studentId
        ],
        [
            'score' => $score,
            'total_questions' => $totalQuestions,
            'percentage' => round($percentageScore, 2),
        ]
    );

    // Return appropriate message based on quiz type
    if ($quiz->questions->count() > 0) {
        return redirect()->route('quizzes.results', $quiz->id)
                         ->with('success', 'Quiz submitted successfully! Your score is ' . round($percentageScore, 2) . '%.');
    } else {
        return redirect()->route('student.quizzes')
                         ->with('success', 'Quiz submitted successfully! Your teacher will review and grade your submission.');
    }
}


    public function showQuizResults(Quiz $quiz)
    {
       
        $studentId = Auth::id();
        $quizResult = QuizResult::where('quiz_id', $quiz->id)
                                ->where('student_id', $studentId)
                                ->firstOrFail();
    
       
        return view('student.quiz.results', compact('quizResult'));
    }
    

    // public function viewQuizResults(Quiz $quiz)
    // {
    //     $quizResults = QuizResult::where('quiz_id', $quiz->id)
    //     ->distinct('student_id')
    //     ->get();
    
    //     return view('teacher.quiz.results', compact('quiz', 'quizResults'));
    // }
    public function resultsIndex()
    {
       
        $quizzes = Quiz::all();
        return view('teacher.quiz.resultList', compact('quizzes'));
    }
    
    // public function viewQuizResults(Quiz $quiz)
    // {
    //     // Fetch the quiz results for the selected quiz
    //     $quizResults = QuizResult::where('quiz_id', $quiz->id)->distinct('student_id')->get();
    
    //     return view('teacher.quizzes.results', compact('quiz', 'quizResults'));
    // }
    
    public function viewQuizResults(Quiz $quiz)
    {
        $quizResults = QuizResult::where('quiz_id', $quiz->id)
            ->distinct('student_id')
            ->get();
        
        return view('teacher.quiz.results', compact('quiz', 'quizResults'));
    }

    public function adminViewQuizResults(Quiz $quiz)
    {
        $quizResults = QuizResult::where('quiz_id', $quiz->id)
        ->distinct('student_id')
        ->with(['student.schoolClass'])
        ->get();
        
        // Manually load school data since the relationship has conflicts
        $quizResults->each(function($result) {
            if ($result->student && $result->student->school_id) {
                $result->student->schoolModel = \App\Models\School::find($result->student->school_id);
            }
        });
    
        return view('admin.quiz.results', compact('quiz', 'quizResults'));
    }

    public function storeQuizResults(Request $request, Quiz $quiz)
    {
        // Validate the uploaded file
        $request->validate([
            'results_file' => 'required|mimes:xlsx,xls,csv|max:10240', // 10MB max
        ]);

        try {
            // Use the QuizResultsImport class that already exists
            Excel::import(new QuizResultsImport($quiz), $request->file('results_file'));

            return redirect()->route('view.quizzes.results', $quiz->id)
                ->with('success', 'Quiz results uploaded successfully!');
                
        } catch (\Exception $e) {
            Log::error('Quiz results upload failed: ' . $e->getMessage());
            
            return redirect()->back()
                ->with('error', 'Failed to upload results. Please check your file format and try again.')
                ->withInput();
        }
    }

    public function downloadTemplate(Quiz $quiz)
    {
        $class = $quiz->class;
    
        $students = User::where('role', 'student')
            ->where('class_id', $class->id)
            ->get();
    
        return Excel::download(new QuizTemplateExport($students, $class->name), "quiz_template_{$class->name}.xlsx");
    }

    public function adminUploadQuizResults(Request $request, Quiz $quiz)
    {
        Excel::import(new QuizResultsImport($quiz), $request->file('results'));

        return redirect()->route('admin.quizzes.results', $quiz->id);
    }
    public function uploadQuizResultsForm(Quiz $quiz)
    {
        return view('teacher.quiz.upload-results', compact('quiz'));
    }

public function adminUploadQuizResultsForm(Quiz $quiz)
{
    return view('admin.quiz.resultForm', compact('quiz'));
}


public function uploadForm()
{
    $userId = Auth::id();
    
    // Fetch teacher with unique classes and subjects assigned
    $teacher = User::with(['classes' => function($query) {
        $query->distinct(); // Ensure no duplicate classes
    }, 'classes.subjects' => function($query) {
        $query->distinct(); // Ensure no duplicate subjects
    }])->findOrFail($userId);
    
    // Get only the assigned classes for the teacher
    $classes = $teacher->classes->unique('id'); // Use unique() to filter out duplicate classes
    
    return view('teacher.quiz.quizUpload', compact('classes'));
}
public function adminUploadForm()
{
    $classes = SchoolClass::all();
    $subjects = Subject::all();
    return view('admin.quiz.quizUpload', compact('classes','subjects'));
}
public function uploadQuiz(Request $request)
{
    // Validate the request
    $request->validate([
        'title' => 'required',
        'description' => 'required',
        'class_id' => 'required',
        'subject_id' => 'required',
        'start_time' => 'required|date',
        'end_time' => 'required|date|after:start_time',
        'duration' => 'required|integer',
        'quiz_file' => 'required|mimes:pdf,doc,docx|max:2048',
    ]);

    // Store the uploaded file
    $quizFile = $request->file('quiz_file');
    $quizFile->storeAs('quizzes', $quizFile->getClientOriginalName(), 'public');

    // Create a new quiz record
    $quiz = new Quiz();
    $quiz->title = $request->input('title');
    $quiz->description = $request->input('description');
    $quiz->class_id = $request->input('class_id');
    $quiz->subject_id = $request->input('subject_id');
    $quiz->start_time = $request->input('start_time');
    $quiz->end_time = $request->input('end_time');
    $quiz->duration = $request->input('duration');
    $quiz->quiz_file = $quizFile->getClientOriginalName();
    $quiz->save();

    // Redirect to the quiz list page
    return redirect()->route('quizzes.index');
}

public function adminUploadQuiz(Request $request)
{
    try {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'class_id' => 'required|exists:school_classes,id',
            'subject_id' => 'required|exists:subjects,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'duration' => 'required|integer|min:1|max:300',
            'quiz_file' => 'required|mimes:xlsx,csv,json,pdf,docx|max:10240',
        ]);

    // Store the uploaded file
    $quizFile = $request->file('quiz_file');
    $quizFile->storeAs('quizzes', $quizFile->getClientOriginalName(), 'public');

    // Create a new quiz record
    $quiz = new Quiz();
    $quiz->title = $request->input('title');
    $quiz->description = $request->input('description');
    $quiz->class_id = $request->input('class_id');
    $quiz->subject_id = $request->input('subject_id');
    $quiz->start_time = $request->input('start_time');
    $quiz->end_time = $request->input('end_time');
    $quiz->duration = $request->input('duration');
    $quiz->quiz_file = $quizFile->getClientOriginalName();
        $quiz->save();

        // Check if it's an AJAX request
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Quiz uploaded successfully!',
                'redirect' => route('admin.quizzes.index')
            ]);
        }

        // Redirect to the quiz list page with success message
        return redirect()->route('admin.quizzes.index')->with('success', 'Quiz uploaded successfully!');
        
    } catch (\Illuminate\Validation\ValidationException $e) {
        if ($request->expectsJson()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        }
        throw $e;
    } catch (\Exception $e) {
        if ($request->expectsJson()) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while uploading the quiz: ' . $e->getMessage()
            ], 500);
        }
        
        return redirect()->back()
            ->withInput()
            ->with('error', 'An error occurred while uploading the quiz. Please try again.');
    }
}


}
