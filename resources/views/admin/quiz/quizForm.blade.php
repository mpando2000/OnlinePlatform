@extends('components.dashmaster')

@section('body')

<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- SweetAlert2 CSS and JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>

<style>
/* Enhanced Quiz Creation Styling */
.create-container {
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    min-height: 100vh;
    padding: 20px 0;
}

.page-header {
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    margin-bottom: 30px;
    padding: 40px 30px;
    animation: fadeInDown 0.8s ease;
    position: relative;
    overflow: hidden;
    text-align: center;
}

.page-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    opacity: 0.05;
    z-index: 0;
}

.page-title {
    color: #2c3e50;
    font-size: 2.5rem;
    font-weight: 700;
    margin: 0 0 15px 0;
    position: relative;
    z-index: 1;
    display: flex;
    align-items: center;
    justify-content: center;
}

.page-title i {
    margin-right: 15px;
    color: #9b59b6;
    background: linear-gradient(135deg, #667eea, #764ba2);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.page-description {
    color: #7f8c8d;
    font-size: 1.2rem;
    margin: 0 0 25px 0;
    position: relative;
    z-index: 1;
    line-height: 1.6;
}

.create-badge {
    background: linear-gradient(45deg, #2ecc71, #27ae60);
    color: white;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    box-shadow: 0 4px 15px rgba(46, 204, 113, 0.3);
    position: relative;
    z-index: 1;
}

.create-form-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    animation: fadeInUp 0.8s ease;
    overflow: hidden;
    margin-bottom: 30px;
}

.form-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 25px 30px;
    margin: 0;
    font-size: 1.4rem;
    font-weight: 600;
    display: flex;
    align-items: center;
}

.form-header i {
    margin-right: 12px;
    font-size: 1.2rem;
}

.form-body {
    padding: 40px;
}

.form-section {
    margin-bottom: 35px;
}

.section-title {
    color: #2c3e50;
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid #f1f3f4;
    display: flex;
    align-items: center;
}

.section-title i {
    margin-right: 10px;
    color: #667eea;
}

.enhanced-form-group {
    margin-bottom: 25px;
    position: relative;
}

.enhanced-label {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    font-size: 0.95rem;
}

.enhanced-label i {
    margin-right: 8px;
    color: #667eea;
    width: 16px;
    text-align: center;
}

.enhanced-input, .enhanced-select, .enhanced-textarea {
    border: 2px solid #e9ecef;
    border-radius: 12px;
    padding: 12px 16px;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    background: #fafbfc;
    width: 100%;
}

.enhanced-input:focus, .enhanced-select:focus, .enhanced-textarea:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
    background: white;
    outline: none;
}

.enhanced-input:hover, .enhanced-select:hover, .enhanced-textarea:hover {
    border-color: #b8c6db;
}

.enhanced-input.is-invalid, .enhanced-select.is-invalid, .enhanced-textarea.is-invalid {
    border-color: #dc3545;
    box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.15);
    background: #fff5f5;
}

.enhanced-input.is-valid, .enhanced-select.is-valid, .enhanced-textarea.is-valid {
    border-color: #28a745;
    box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.15);
    background: #f8fff8;
}

.question-card {
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    border: 2px solid #e9ecef;
    border-radius: 15px;
    padding: 25px;
    margin-bottom: 20px;
    position: relative;
    transition: all 0.3s ease;
    animation: fadeInUp 0.5s ease;
}

.question-card:hover {
    border-color: #667eea;
    box-shadow: 0 5px 20px rgba(102, 126, 234, 0.1);
    transform: translateY(-2px);
}

.question-header {
    display: flex;
    align-items: center;
    justify-content: between;
    margin-bottom: 20px;
}

.question-number {
    background: linear-gradient(45deg, #667eea, #764ba2);
    color: white;
    width: 35px;
    height: 35px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 0.9rem;
    margin-right: 10px;
}

.question-title {
    color: #2c3e50;
    font-weight: 600;
    font-size: 1.1rem;
    flex: 1;
}

.remove-question {
    background: linear-gradient(45deg, #e74c3c, #c0392b);
    color: white;
    border: none;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.remove-question:hover {
    transform: scale(1.1);
    box-shadow: 0 3px 10px rgba(231, 76, 60, 0.3);
}

.options-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
    margin-top: 15px;
}

.option-input {
    position: relative;
}

.option-input .enhanced-input {
    padding-left: 40px;
}

.option-label {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    background: linear-gradient(45deg, #3498db, #2980b9);
    color: white;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.8rem;
    font-weight: 600;
}

.correct-answer-section {
    margin-top: 20px;
    padding: 15px;
    background: linear-gradient(135deg, #e8f5e8 0%, #f0f8f0 100%);
    border-radius: 10px;
    border: 2px solid #27ae60;
}

.time-inputs-row {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 20px;
}

.class-subject-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

.title-desc-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

.add-question-btn {
    background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
    color: white;
    border: none;
    border-radius: 25px;
    padding: 15px 30px;
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 8px 25px rgba(52, 152, 219, 0.3);
    margin: 20px auto;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.add-question-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 35px rgba(52, 152, 219, 0.4);
}

.add-question-btn i {
    margin-right: 8px;
}

.submit-section {
    background: #f8f9fa;
    padding: 30px;
    margin: 0 -40px -40px -40px;
    border-radius: 0 0 20px 20px;
    text-align: center;
    border-top: 1px solid #e9ecef;
}

.submit-btn {
    background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
    color: white;
    padding: 15px 40px;
    border: none;
    border-radius: 25px;
    font-weight: 600;
    font-size: 1.1rem;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    box-shadow: 0 8px 25px rgba(39, 174, 96, 0.3);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    cursor: pointer;
    min-width: 200px;
    justify-content: center;
}

.submit-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 35px rgba(39, 174, 96, 0.4);
    background: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%);
}

.submit-btn i {
    margin-right: 10px;
    font-size: 1.1rem;
}

.back-btn {
    background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
    color: white;
    padding: 12px 25px;
    border: none;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    text-decoration: none;
    box-shadow: 0 5px 15px rgba(108, 117, 125, 0.3);
    margin-bottom: 20px;
}

.back-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(108, 117, 125, 0.4);
    color: white;
    text-decoration: none;
}

.back-btn i {
    margin-right: 8px;
}

.error-message {
    color: #e74c3c;
    font-size: 0.85rem;
    margin-top: 5px;
    display: flex;
    align-items: center;
    font-weight: 500;
}

.error-message i {
    margin-right: 5px;
    font-size: 0.8rem;
}

.help-text {
    color: #7f8c8d;
    font-size: 0.8rem;
    margin-top: 5px;
    font-style: italic;
}

.duration-info {
    background: linear-gradient(45deg, #3498db, #2980b9);
    color: white;
    padding: 15px 20px;
    border-radius: 12px;
    margin-top: 10px;
    display: flex;
    align-items: center;
    font-size: 0.9rem;
}

.duration-info i {
    margin-right: 10px;
    font-size: 1.1rem;
}

/* Animation Classes */
@keyframes fadeInDown {
    from {
        opacity: 0;
        transform: translateY(-30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive Design */
@media (max-width: 768px) {
    .page-title {
        font-size: 2rem;
        flex-direction: column;
        text-align: center;
    }
    
    .time-inputs-row,
    .class-subject-row,
    .title-desc-row {
        grid-template-columns: 1fr;
        gap: 15px;
    }
    
    .options-grid {
        grid-template-columns: 1fr;
    }
    
    .form-body {
        padding: 20px;
    }
    
    .submit-section {
        margin: 0 -20px -20px -20px;
        padding: 20px;
    }
}

/* Loading Animation */
.loading-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.9);
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

.loading-spinner {
    width: 50px;
    height: 50px;
    border: 4px solid #f3f3f3;
    border-top: 4px solid #667eea;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>

<div class="content-wrapper">
    <div class="create-container">
        <div class="container-fluid">
            <!-- Back Button -->
            <a href="{{ route('admin.quizzes.index') }}" class="back-btn">
                <i class="fas fa-arrow-left"></i>
                Back to Quiz Management
            </a>

            <!-- Page Header -->
            <div class="page-header">
                <h1 class="page-title">
                    <i class="fas fa-plus-circle"></i>
                    Create New Quiz
                </h1>
                <p class="page-description">
                    Design a comprehensive quiz for your students. Add multiple questions with various options and set up scheduling parameters to create an engaging learning experience.
                </p>
                <div class="create-badge">
                    <i class="fas fa-edit"></i>
                    Interactive Quiz Builder
                </div>
            </div>

            <!-- Create Form -->
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-9">

                    <div class="create-form-card">
                        <div class="form-header">
                            <i class="fas fa-edit"></i>
                            Quiz Creation Form
                        </div>
                        <div class="form-body">
                            <form action="{{ route('admin.quizzes.store') }}" method="POST" id="quizCreateForm">
                                @csrf
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="csrf-token">

                                <!-- Basic Information Section -->
                                <div class="form-section">
                                    <div class="section-title">
                                        <i class="fas fa-info-circle"></i>
                                        Basic Quiz Information
                                    </div>

                                    <div class="title-desc-row">
                                        <div class="enhanced-form-group">
                                            <label for="title" class="enhanced-label">
                                                <i class="fas fa-heading"></i>
                                                Quiz Title *
                                            </label>
                                            <input type="text" name="title" id="title" class="enhanced-input" value="{{ old('title') }}" required placeholder="Enter an engaging quiz title">
                                            <div class="help-text">Choose a clear and descriptive title for your quiz</div>
                                            @error('title')
                                                <div class="error-message">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="enhanced-form-group">
                                            <label for="description" class="enhanced-label">
                                                <i class="fas fa-align-left"></i>
                                                Quiz Description *
                                            </label>
                                            <textarea name="description" id="description" class="enhanced-textarea" rows="3" required placeholder="Provide a comprehensive description of the quiz content and objectives">{{ old('description') }}</textarea>
                                            <div class="help-text">Describe what students will learn and be tested on</div>
                                            @error('description')
                                                <div class="error-message">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Class and Subject Section -->
                                <div class="form-section">
                                    <div class="section-title">
                                        <i class="fas fa-graduation-cap"></i>
                                        Class & Subject Assignment
                                    </div>

                                    <div class="class-subject-row">
                                        <div class="enhanced-form-group">
                                            <label for="class_id" class="enhanced-label">
                                                <i class="fas fa-chalkboard"></i>
                                                Select Class *
                                            </label>
                                            <select name="class_id" id="class_id" class="enhanced-select" required>
                                                <option value="">Choose a class</option>
                                                @foreach($classes as $class)
                                                    <option value="{{ $class->id }}" {{ old('class_id') == $class->id ? 'selected' : '' }}>
                                                        {{ $class->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('class_id')
                                                <div class="error-message">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="enhanced-form-group">
                                            <label for="subject_id" class="enhanced-label">
                                                <i class="fas fa-book"></i>
                                                Select Subject *
                                            </label>
                                            <select name="subject_id" id="subject_id" class="enhanced-select" required>
                                                <option value="">First select a class</option>
                                            </select>
                                            @error('subject_id')
                                                <div class="error-message">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Schedule Section -->
                                <div class="form-section">
                                    <div class="section-title">
                                        <i class="fas fa-calendar-alt"></i>
                                        Quiz Schedule
                                    </div>

                                    <div class="time-inputs-row">
                                        <div class="enhanced-form-group">
                                            <label for="start_time" class="enhanced-label">
                                                <i class="fas fa-play"></i>
                                                Start Time *
                                            </label>
                                            <input type="datetime-local" name="start_time" id="start_time" class="enhanced-input" value="{{ old('start_time') }}" required>
                                            <div class="help-text">When students can begin taking the quiz</div>
                                            @error('start_time')
                                                <div class="error-message">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="enhanced-form-group">
                                            <label for="end_time" class="enhanced-label">
                                                <i class="fas fa-stop"></i>
                                                End Time *
                                            </label>
                                            <input type="datetime-local" name="end_time" id="end_time" class="enhanced-input" value="{{ old('end_time') }}" required>
                                            <div class="help-text">Final deadline for quiz submission</div>
                                            @error('end_time')
                                                <div class="error-message">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="enhanced-form-group">
                                            <label for="duration" class="enhanced-label">
                                                <i class="fas fa-hourglass-half"></i>
                                                Quiz Duration (minutes) *
                                            </label>
                                            <input type="number" name="duration" id="duration" class="enhanced-input" value="{{ old('duration') }}" required min="1" max="300" placeholder="60">
                                            <div class="duration-info">
                                                <i class="fas fa-info-circle"></i>
                                                Recommended: 30-90 minutes for comprehensive quizzes
                                            </div>
                                            @error('duration')
                                                <div class="error-message">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Questions Section -->
                                <div class="form-section">
                                    <div class="section-title">
                                        <i class="fas fa-question-circle"></i>
                                        Quiz Questions
                                    </div>

                                    <div id="questions-container">
                                        <!-- First question (default) -->
                                        <div class="question-card" data-question="0">
                                            <div class="question-header">
                                                <div class="question-number">1</div>
                                                <div class="question-title">Question 1</div>
                                                <button type="button" class="remove-question" onclick="removeQuestion(0)" style="display: none;">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>

                                            <div class="enhanced-form-group">
                                                <label class="enhanced-label">
                                                    <i class="fas fa-question"></i>
                                                    Question Text *
                                                </label>
                                                <textarea name="questions[0][question_text]" class="enhanced-textarea" rows="2" placeholder="Enter your question here..." required>{{ old('questions.0.question_text') }}</textarea>
                                            </div>

                                            <div class="options-grid">
                                                <div class="option-input">
                                                    <div class="option-label">A</div>
                                                    <input type="text" name="questions[0][option1]" class="enhanced-input" placeholder="Option A" required value="{{ old('questions.0.option1') }}">
                                                </div>
                                                <div class="option-input">
                                                    <div class="option-label">B</div>
                                                    <input type="text" name="questions[0][option2]" class="enhanced-input" placeholder="Option B" required value="{{ old('questions.0.option2') }}">
                                                </div>
                                                <div class="option-input">
                                                    <div class="option-label">C</div>
                                                    <input type="text" name="questions[0][option3]" class="enhanced-input" placeholder="Option C" required value="{{ old('questions.0.option3') }}">
                                                </div>
                                                <div class="option-input">
                                                    <div class="option-label">D</div>
                                                    <input type="text" name="questions[0][option4]" class="enhanced-input" placeholder="Option D" required value="{{ old('questions.0.option4') }}">
                                                </div>
                                            </div>

                                            <div class="correct-answer-section">
                                                <label class="enhanced-label">
                                                    <i class="fas fa-check-circle"></i>
                                                    Correct Answer *
                                                </label>
                                                <select name="questions[0][correct_option]" class="enhanced-select" required>
                                                    <option value="">Select correct answer</option>
                                                    <option value="option1" {{ old('questions.0.correct_option') == 'option1' ? 'selected' : '' }}>Option A</option>
                                                    <option value="option2" {{ old('questions.0.correct_option') == 'option2' ? 'selected' : '' }}>Option B</option>
                                                    <option value="option3" {{ old('questions.0.correct_option') == 'option3' ? 'selected' : '' }}>Option C</option>
                                                    <option value="option4" {{ old('questions.0.correct_option') == 'option4' ? 'selected' : '' }}>Option D</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="button" class="add-question-btn" id="add-question">
                                        <i class="fas fa-plus"></i>
                                        Add Another Question
                                    </button>
                                </div>

                                <!-- Submit Section -->
                                <div class="submit-section">
                                    <button type="submit" class="submit-btn" id="submitBtn">
                                        <i class="fas fa-save"></i>
                                        Create Quiz
                                    </button>
                                    <br><br>
                                    <small class="text-muted">
                                        <i class="fas fa-info-circle"></i>
                                        Make sure all questions have valid options and correct answers selected
                                    </small>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Loading Overlay -->
<div class="loading-overlay" id="loadingOverlay">
    <div class="loading-spinner"></div>
</div>

<script>
$(document).ready(function() {
    console.log('Quiz Creation Form initialized');
    
    let questionCount = 1;

    // Setup CSRF token for AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Dynamic subject loading based on class selection
    $('#class_id').on('change', function() {
        const classId = $(this).val();
        const subjectSelect = $('#subject_id');
        
        subjectSelect.html('<option value="">Loading subjects...</option>');
        
        if (classId) {
            fetch(`/admin/get-subjects/${classId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    subjectSelect.html('<option value="">Select Subject</option>');
                    data.forEach(subject => {
                        subjectSelect.append(`<option value="${subject.id}">${subject.name}</option>`);
                    });
                })
                .catch(error => {
                    console.error('Error fetching subjects:', error);
                    subjectSelect.html('<option value="">Error loading subjects</option>');
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            title: 'Error',
                            text: 'Failed to load subjects. Please try again.',
                            icon: 'error',
                            confirmButtonColor: '#dc3545'
                        });
                    }
                });
        } else {
            subjectSelect.html('<option value="">First select a class</option>');
        }
    });

    // Add Question functionality
    $('#add-question').on('click', function() {
        const container = $('#questions-container');
        const newQuestionHtml = createQuestionCard(questionCount);
        
        container.append(newQuestionHtml);
        questionCount++;
        updateQuestionNumbers();
        
        // Animate the new question
        const newCard = container.find('.question-card').last();
        newCard.hide().fadeIn(500);
        
        // Scroll to new question
        $('html, body').animate({
            scrollTop: newCard.offset().top - 100
        }, 500);
    });

    // Function to create question card HTML
    function createQuestionCard(index) {
        return `
            <div class="question-card" data-question="${index}">
                <div class="question-header">
                    <div class="question-number">${index + 1}</div>
                    <div class="question-title">Question ${index + 1}</div>
                    <button type="button" class="remove-question" onclick="removeQuestion(${index})">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <div class="enhanced-form-group">
                    <label class="enhanced-label">
                        <i class="fas fa-question"></i>
                        Question Text *
                    </label>
                    <textarea name="questions[${index}][question_text]" class="enhanced-textarea" rows="2" placeholder="Enter your question here..." required></textarea>
                </div>

                <div class="options-grid">
                    <div class="option-input">
                        <div class="option-label">A</div>
                        <input type="text" name="questions[${index}][option1]" class="enhanced-input" placeholder="Option A" required>
                    </div>
                    <div class="option-input">
                        <div class="option-label">B</div>
                        <input type="text" name="questions[${index}][option2]" class="enhanced-input" placeholder="Option B" required>
                    </div>
                    <div class="option-input">
                        <div class="option-label">C</div>
                        <input type="text" name="questions[${index}][option3]" class="enhanced-input" placeholder="Option C" required>
                    </div>
                    <div class="option-input">
                        <div class="option-label">D</div>
                        <input type="text" name="questions[${index}][option4]" class="enhanced-input" placeholder="Option D" required>
                    </div>
                </div>

                <div class="correct-answer-section">
                    <label class="enhanced-label">
                        <i class="fas fa-check-circle"></i>
                        Correct Answer *
                    </label>
                    <select name="questions[${index}][correct_option]" class="enhanced-select" required>
                        <option value="">Select correct answer</option>
                        <option value="option1">Option A</option>
                        <option value="option2">Option B</option>
                        <option value="option3">Option C</option>
                        <option value="option4">Option D</option>
                    </select>
                </div>
            </div>
        `;
    }

    // Remove question functionality
    window.removeQuestion = function(index) {
        if ($('.question-card').length <= 1) {
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: 'Cannot Remove',
                    text: 'You must have at least one question in your quiz.',
                    icon: 'warning',
                    confirmButtonColor: '#f39c12'
                });
            } else {
                alert('You must have at least one question in your quiz.');
            }
            return;
        }

        const questionCard = $(`.question-card[data-question="${index}"]`);
        questionCard.fadeOut(300, function() {
            $(this).remove();
            updateQuestionNumbers();
        });
    };

    // Update question numbers after add/remove
    function updateQuestionNumbers() {
        $('.question-card').each(function(index) {
            $(this).find('.question-number').text(index + 1);
            $(this).find('.question-title').text(`Question ${index + 1}`);
            $(this).attr('data-question', index);
            
            // Update form field names
            $(this).find('textarea[name*="question_text"]').attr('name', `questions[${index}][question_text]`);
            $(this).find('input[name*="option1"]').attr('name', `questions[${index}][option1]`);
            $(this).find('input[name*="option2"]').attr('name', `questions[${index}][option2]`);
            $(this).find('input[name*="option3"]').attr('name', `questions[${index}][option3]`);
            $(this).find('input[name*="option4"]').attr('name', `questions[${index}][option4]`);
            $(this).find('select[name*="correct_option"]').attr('name', `questions[${index}][correct_option]`);
            
            // Update remove button onclick
            $(this).find('.remove-question').attr('onclick', `removeQuestion(${index})`);
        });
        
        // Show/hide remove buttons
        if ($('.question-card').length > 1) {
            $('.remove-question').show();
        } else {
            $('.remove-question').hide();
        }
    }

    // Time input enhancements
    $('#duration').on('input', function() {
        const duration = parseInt($(this).val());
        let message = '';
        let color = '';

        if (duration < 15) {
            message = 'Very short quiz - consider 15+ minutes';
            color = '#e74c3c';
        } else if (duration <= 30) {
            message = 'Short quiz duration - good for quick assessments';
            color = '#f39c12';
        } else if (duration <= 60) {
            message = 'Standard quiz duration - recommended for most quizzes';
            color = '#27ae60';
        } else if (duration <= 120) {
            message = 'Long quiz - ensure students have adequate time';
            color = '#3498db';
        } else {
            message = 'Very long quiz - consider breaking into smaller parts';
            color = '#9b59b6';
        }

        $('.duration-info').css('background', `linear-gradient(45deg, ${color}, ${color}dd)`);
        $('.duration-info').find('span').remove();
        $('.duration-info').append(`<span style="margin-left: auto;">${message}</span>`);
    });

    // Auto-calculate end time based on duration
    $('#start_time, #duration').on('change', function() {
        const startTime = $('#start_time').val();
        const duration = parseInt($('#duration').val());
        
        if (startTime && duration) {
            const start = new Date(startTime);
            const end = new Date(start.getTime() + (duration * 60000)); // Add duration in milliseconds
            
            // Format for datetime-local input
            const endTimeString = end.toISOString().slice(0, 16);
            $('#end_time').val(endTimeString);
        }
    });

    // Form validation and submission
    $('#quizCreateForm').on('submit', function(e) {
        e.preventDefault();
        
        // Validate all required fields
        let isValid = true;
        let missingFields = [];
        
        // Check basic fields
        $(this).find('input[required], select[required], textarea[required]').each(function() {
            const $field = $(this);
            const fieldValue = $field.val();
            const fieldName = $field.attr('name') || $field.prev('label').text() || 'Unknown field';
            
            if (!fieldValue || fieldValue.trim() === '') {
                $field.addClass('is-invalid');
                missingFields.push(fieldName);
                isValid = false;
            } else {
                $field.removeClass('is-invalid').addClass('is-valid');
            }
        });

        if (!isValid) {
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: 'Please Complete All Fields',
                    text: 'Please fill in all required fields before creating the quiz.',
                    icon: 'warning',
                    confirmButtonColor: '#f39c12'
                });
            } else {
                alert('Please fill in all required fields before creating the quiz.');
            }
            
            // Scroll to first invalid field
            const firstInvalid = $('.is-invalid').first();
            if (firstInvalid.length) {
                $('html, body').animate({
                    scrollTop: firstInvalid.offset().top - 100
                }, 500);
            }
            return false;
        }

        // Show loading state
        showLoadingState();
        
        // Submit form normally (not AJAX for this one)
        this.submit();
    });

    function showLoadingState() {
        $('#loadingOverlay').show();
        $('#submitBtn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Creating Quiz...');
    }

    // Form field animations on focus
    $('.enhanced-input, .enhanced-select, .enhanced-textarea').on('focus', function() {
        $(this).parent().addClass('focused');
    }).on('blur', function() {
        $(this).parent().removeClass('focused');
    });

    // Clear validation states on input
    $(document).on('input change', '.enhanced-input, .enhanced-select, .enhanced-textarea', function() {
        $(this).removeClass('is-invalid is-valid');
    });

    // Success/Error message handling
    @if(session('success'))
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: 'Success!',
                text: '{{ session("success") }}',
                icon: 'success',
                confirmButtonColor: '#27ae60',
                confirmButtonText: 'Great!'
            }).then(() => {
                window.location.href = '{{ route("admin.quizzes.index") }}';
            });
        }
    @endif

    @if(session('error'))
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: 'Creation Failed!',
                text: '{{ session("error") }}',
                icon: 'error',
                confirmButtonColor: '#dc3545',
                confirmButtonText: 'Try Again'
            });
        }
    @endif

    console.log('Quiz creation form ready');
});
</script>

<!-- Footer -->
<footer class="main-footer">
    <strong>Copyright &copy; <span id="currentYear"></span> <a href="https://sumajkt.go.tz">Visit Our Website</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      {{-- <b>Version</b> 3.2.0 --}}
    </div>
</footer>

<script>
// Footer year update
document.getElementById("currentYear").textContent = new Date().getFullYear();
</script>
    
@endsection

