@extends('components.dashmaster')

@section('body')
<style>
    .quiz-create-container {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
        padding: 20px 0;
    }
    
    .back-navigation {
        margin-bottom: 20px;
        animation: slideInLeft 0.6s ease;
    }
    
    .back-btn {
        background: white;
        color: #2c3e50;
        padding: 12px 20px;
        border-radius: 25px;
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        border: 2px solid #e9ecef;
    }
    
    .back-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        color: #2c3e50;
        text-decoration: none;
    }
    
    .page-header {
        background: white;
        border-radius: 20px;
        padding: 30px;
        margin-bottom: 30px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        text-align: center;
        animation: fadeInUp 0.6s ease;
    }
    
    .page-title {
        color: #2c3e50;
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 10px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .page-description {
        color: #7f8c8d;
        font-size: 1.1rem;
        margin-bottom: 0;
    }
    
    .form-container {
        background: white;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        animation: fadeInUp 0.8s ease;
    }
    
    .form-section {
        margin-bottom: 40px;
        position: relative;
    }
    
    .section-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 25px;
        padding-bottom: 10px;
        border-bottom: 3px solid #667eea;
        display: flex;
        align-items: center;
    }
    
    .section-title i {
        margin-right: 10px;
        color: #667eea;
    }
    
    .form-group {
        margin-bottom: 25px;
    }
    
    .form-label {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
    }
    
    .form-label i {
        margin-right: 8px;
        color: #667eea;
    }
    
    .required {
        color: #e74c3c;
        margin-left: 3px;
    }
    
    .form-control {
        border: 2px solid #e9ecef;
        border-radius: 15px;
        padding: 15px 20px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: #f8f9fa;
    }
    
    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        background: white;
        transform: translateY(-2px);
    }
    
    .form-control.is-invalid {
        border-color: #e74c3c;
    }
    
    .error-message {
        color: #e74c3c;
        font-size: 0.9rem;
        margin-top: 5px;
        display: flex;
        align-items: center;
        font-weight: 500;
    }
    
    .error-message i {
        margin-right: 5px;
        font-size: 0.8rem;
    }
    
    .quiz-type-selector {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 30px;
    }
    
    .type-option {
        position: relative;
    }
    
    .type-option input[type="radio"] {
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
    }
    
    .type-card {
        background: #f8f9fa;
        border: 3px solid #e9ecef;
        border-radius: 20px;
        padding: 25px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    
    .type-card:hover {
        border-color: #667eea;
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(102, 126, 234, 0.15);
    }
    
    .type-option input[type="radio"]:checked + label .type-card {
        border-color: #667eea;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(102, 126, 234, 0.3);
    }
    
    .type-icon {
        font-size: 3rem;
        margin-bottom: 15px;
        color: #667eea;
    }
    
    .type-option input[type="radio"]:checked + label .type-icon {
        color: white;
    }
    
    .type-card h4 {
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 10px;
        color: #2c3e50;
    }
    
    .type-option input[type="radio"]:checked + label .type-card h4 {
        color: white;
    }
    
    .type-card p {
        color: #7f8c8d;
        margin-bottom: 20px;
        font-size: 0.95rem;
    }
    
    .type-option input[type="radio"]:checked + label .type-card p {
        color: rgba(255, 255, 255, 0.9);
    }
    
    .type-features {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
    
    .type-features span {
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
        color: #2c3e50;
    }
    
    .type-option input[type="radio"]:checked + label .type-features span {
        color: rgba(255, 255, 255, 0.9);
    }
    
    .type-features i {
        margin-right: 8px;
        font-size: 0.8rem;
    }
    
    .file-upload-area {
        border: 3px dashed #dee2e6;
        border-radius: 20px;
        padding: 40px 20px;
        text-align: center;
        background: #f8f9fa;
        transition: all 0.3s ease;
        cursor: pointer;
        position: relative;
    }
    
    .file-upload-area:hover {
        border-color: #667eea;
        background: rgba(102, 126, 234, 0.05);
    }
    
    .file-upload-area.dragover {
        border-color: #667eea;
        background: rgba(102, 126, 234, 0.1);
        transform: scale(1.02);
    }
    
    .file-upload-input {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }
    
    .upload-icon {
        font-size: 3rem;
        color: #667eea;
        margin-bottom: 15px;
    }
    
    .upload-text {
        font-size: 1.1rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 10px;
    }
    
    .upload-hint {
        color: #7f8c8d;
        font-size: 0.9rem;
        margin-bottom: 15px;
    }
    
    .file-selected {
        background: #2ecc71;
        color: white;
        padding: 10px 20px;
        border-radius: 25px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-weight: 600;
    }
    
    .question-card {
        background: #f8f9fa;
        border: 2px solid #e9ecef;
        border-radius: 20px;
        padding: 25px;
        margin-bottom: 25px;
        transition: all 0.3s ease;
        position: relative;
    }
    
    .question-card:hover {
        border-color: #667eea;
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.1);
    }
    
    .question-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 15px 20px;
        border-radius: 15px;
        font-weight: 600;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    
    .question-number {
        display: flex;
        align-items: center;
    }
    
    .question-number i {
        margin-right: 8px;
    }
    
    .remove-question-btn {
        background: rgba(231, 76, 60, 0.2);
        border: none;
        color: #e74c3c;
        padding: 5px 10px;
        border-radius: 50%;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .remove-question-btn:hover {
        background: #e74c3c;
        color: white;
        transform: scale(1.1);
    }
    
    .options-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        margin-top: 15px;
    }
    
    .option-group {
        position: relative;
    }
    
    .option-label {
        background: #667eea;
        color: white;
        padding: 5px 10px;
        border-radius: 10px 10px 0 0;
        font-size: 0.9rem;
        font-weight: 600;
        text-align: center;
    }
    
    .option-input {
        border-radius: 0 0 10px 10px !important;
        border-top: none !important;
        margin-top: 0 !important;
    }
    
    .correct-answer-section {
        margin-top: 20px;
        padding: 15px;
        background: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%);
        border-radius: 15px;
        color: white;
    }
    
    .correct-answer-label {
        font-weight: 600;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
    }
    
    .correct-answer-label i {
        margin-right: 8px;
    }
    
    .correct-answer-select {
        background: white !important;
        color: #2c3e50 !important;
        border: none !important;
        font-weight: 600;
    }
    
    .action-buttons {
        background: #f8f9fa;
        padding: 30px;
        border-radius: 20px;
        text-align: center;
        margin-top: 30px;
        border: 2px dashed #dee2e6;
    }
    
    .modern-btn {
        padding: 15px 30px;
        border-radius: 25px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin: 10px;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        font-size: 1rem;
        display: inline-flex;
        align-items: center;
    }
    
    .modern-btn i {
        margin-right: 8px;
    }
    
    .btn-add-question {
        background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
        color: white;
    }
    
    .btn-add-question:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(52, 152, 219, 0.4);
        color: white;
    }
    
    .btn-create {
        background: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%);
        color: white;
    }
    
    .btn-create:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(46, 204, 113, 0.4);
        color: white;
    }
    
    .btn-save-draft {
        background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
        color: white;
    }
    
    .btn-save-draft:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(243, 156, 18, 0.4);
        color: white;
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
    
    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    .animate-fade-in {
        animation: fadeInUp 0.6s ease-out;
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .quiz-type-selector {
            grid-template-columns: 1fr;
        }
        
        .options-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="content-wrapper quiz-create-container">
    <div class="container-fluid">
        <!-- Back Navigation -->
        <div class="back-navigation">
            <a href="{{ route('quizzes.index') }}" class="back-btn">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Quiz Management
            </a>
        </div>

        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">
                <i class="fas fa-plus-circle mr-3"></i>
                Create New Quiz
            </h1>
            <p class="page-description">
                Design your quiz with questions or upload a file. Configure all settings to create an engaging learning experience for your students.
            </p>
        </div>

        <!-- Form Container -->
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div class="form-container animate-fade-in">
                    <form id="quizCreateForm" action="{{ route('quizzes.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Basic Information Section -->
                        <div class="form-section">
                            <div class="section-title">
                                <i class="fas fa-info-circle"></i>
                                Basic Information
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="title">
                                            <i class="fas fa-heading"></i>
                                            Quiz Title<span class="required">*</span>
                                        </label>
                                        <input type="text" 
                                               name="title" 
                                               id="title" 
                                               class="form-control @error('title') is-invalid @enderror" 
                                               value="{{ old('title') }}" 
                                               required
                                               placeholder="Enter quiz title">
                                        @error('title')
                                            <div class="error-message">
                                                <i class="fas fa-exclamation-triangle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="duration">
                                            <i class="fas fa-clock"></i>
                                            Duration (minutes)<span class="required">*</span>
                                        </label>
                                        <input type="number" 
                                               name="duration" 
                                               id="duration" 
                                               class="form-control @error('duration') is-invalid @enderror" 
                                               value="{{ old('duration') }}" 
                                               required
                                               min="1"
                                               placeholder="Quiz duration in minutes">
                                        @error('duration')
                                            <div class="error-message">
                                                <i class="fas fa-exclamation-triangle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="description">
                                    <i class="fas fa-align-left"></i>
                                    Quiz Description<span class="required">*</span>
                                </label>
                                <textarea name="description" 
                                          id="description" 
                                          class="form-control @error('description') is-invalid @enderror" 
                                          rows="3" 
                                          required
                                          placeholder="Provide a clear description of the quiz">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="error-message">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Class & Subject Section -->
                        <div class="form-section">
                            <div class="section-title">
                                <i class="fas fa-graduation-cap"></i>
                                Class & Subject Details
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="class_id">
                                            <i class="fas fa-users"></i>
                                            Select Class<span class="required">*</span>
                                        </label>
                                        <select name="class_id" 
                                                id="class_id" 
                                                class="form-control @error('class_id') is-invalid @enderror" 
                                                required>
                                            <option value="">Choose a class...</option>
                                            @foreach($classes as $class)
                                                <option value="{{ $class->id }}" {{ old('class_id') == $class->id ? 'selected' : '' }}>
                                                    {{ $class->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('class_id')
                                            <div class="error-message">
                                                <i class="fas fa-exclamation-triangle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="subject_id">
                                            <i class="fas fa-book"></i>
                                            Select Subject<span class="required">*</span>
                                        </label>
                                        <select name="subject_id" 
                                                id="subject_id" 
                                                class="form-control @error('subject_id') is-invalid @enderror" 
                                                required>
                                            <option value="">First select a class...</option>
                                        </select>
                                        @error('subject_id')
                                            <div class="error-message">
                                                <i class="fas fa-exclamation-triangle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Schedule Section -->
                        <div class="form-section">
                            <div class="section-title">
                                <i class="fas fa-calendar-alt"></i>
                                Quiz Schedule
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="start_time">
                                            <i class="fas fa-play"></i>
                                            Start Time<span class="required">*</span>
                                        </label>
                                        <input type="datetime-local" 
                                               name="start_time" 
                                               id="start_time" 
                                               class="form-control @error('start_time') is-invalid @enderror" 
                                               value="{{ old('start_time') }}" 
                                               required>
                                        @error('start_time')
                                            <div class="error-message">
                                                <i class="fas fa-exclamation-triangle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="end_time">
                                            <i class="fas fa-stop"></i>
                                            End Time<span class="required">*</span>
                                        </label>
                                        <input type="datetime-local" 
                                               name="end_time" 
                                               id="end_time" 
                                               class="form-control @error('end_time') is-invalid @enderror" 
                                               value="{{ old('end_time') }}" 
                                               required>
                                        @error('end_time')
                                            <div class="error-message">
                                                <i class="fas fa-exclamation-triangle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Quiz Type Selection Section -->
                        <div class="form-section">
                            <div class="section-title">
                                <i class="fas fa-cogs"></i>
                                Quiz Type Selection
                            </div>
                            
                            <div class="quiz-type-selector">
                                <div class="type-option" data-type="questions">
                                    <input type="radio" 
                                           name="quiz_type" 
                                           value="questions" 
                                           id="type_questions" 
                                           {{ old('quiz_type', 'questions') == 'questions' ? 'checked' : '' }}>
                                    <label for="type_questions">
                                        <div class="type-card">
                                            <i class="fas fa-question-circle type-icon"></i>
                                            <h4>Question-Based Quiz</h4>
                                            <p>Create quiz with individual questions and multiple choice answers</p>
                                            <div class="type-features">
                                                <span><i class="fas fa-check"></i> Multiple choice questions</span>
                                                <span><i class="fas fa-check"></i> Auto-grading</span>
                                                <span><i class="fas fa-check"></i> Instant feedback</span>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                
                                <div class="type-option" data-type="file">
                                    <input type="radio" 
                                           name="quiz_type" 
                                           value="file" 
                                           id="type_file" 
                                           {{ old('quiz_type') == 'file' ? 'checked' : '' }}>
                                    <label for="type_file">
                                        <div class="type-card">
                                            <i class="fas fa-file-upload type-icon"></i>
                                            <h4>File-Based Quiz</h4>
                                            <p>Upload quiz as PDF, Word document, or other formats</p>
                                            <div class="type-features">
                                                <span><i class="fas fa-check"></i> PDF documents</span>
                                                <span><i class="fas fa-check"></i> Word documents</span>
                                                <span><i class="fas fa-check"></i> Rich formatting</span>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- File Upload Section (for file-based quizzes) -->
                        <div class="form-section" id="file-section" style="display: {{ old('quiz_type') == 'file' ? 'block' : 'none' }};">
                            <div class="section-title">
                                <i class="fas fa-cloud-upload-alt"></i>
                                Quiz File Upload
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label" for="quiz_file">
                                    <i class="fas fa-file-upload"></i>
                                    Upload Quiz File<span class="required">*</span>
                                </label>
                                <div class="file-upload-area" id="fileUploadArea">
                                    <input type="file" 
                                           class="file-upload-input" 
                                           id="quiz_file" 
                                           name="quiz_file" 
                                           accept=".pdf,.docx,.doc,.csv,.xlsx,.xls,.json">
                                    <div class="upload-content">
                                        <i class="fas fa-cloud-upload-alt upload-icon"></i>
                                        <div class="upload-text">Click to select or drag & drop your quiz file</div>
                                        <div class="upload-hint">
                                            Supported formats: PDF, Word (.docx, .doc), Excel (.xlsx, .xls), CSV, JSON<br>
                                            Maximum file size: 10MB
                                        </div>
                                        <div class="file-selected" id="fileSelected" style="display: none;">
                                            <i class="fas fa-check-circle"></i>
                                            <span id="fileName">No file selected</span>
                                        </div>
                                    </div>
                                </div>
                                @error('quiz_file')
                                    <div class="error-message">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Questions Section (for question-based quizzes) -->
                        <div class="form-section" id="questions-section" style="display: {{ old('quiz_type', 'questions') == 'questions' ? 'block' : 'none' }};">
                            <div class="section-title">
                                <i class="fas fa-question-circle"></i>
                                Quiz Questions
                            </div>
                            
                            <div class="questions-container" id="questionsContainer">
                                @if(old('questions'))
                                    @foreach(old('questions') as $index => $question)
                                        <div class="question-card" data-question-index="{{ $index }}">
                                            <div class="question-header">
                                                <div class="question-number">
                                                    <i class="fas fa-question-circle"></i>
                                                    Question {{ $index + 1 }}
                                                </div>
                                                <button type="button" class="remove-question-btn" onclick="removeQuestion(this)">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="form-label">
                                                    <i class="fas fa-pencil-alt"></i>
                                                    Question Text<span class="required">*</span>
                                                </label>
                                                <input type="text" 
                                                       name="questions[{{ $index }}][question_text]" 
                                                       class="form-control" 
                                                       value="{{ $question['question_text'] }}" 
                                                       required
                                                       placeholder="Enter your question here...">
                                                <input type="hidden" name="questions[{{ $index }}][question_type]" value="multiple_choice">
                                            </div>
                                            
                                            <label class="form-label">
                                                <i class="fas fa-list"></i>
                                                Answer Options<span class="required">*</span>
                                                <small>(Click the check icon to mark the correct answer)</small>
                                            </label>
                                            
                                            <div class="options-grid">
                                                @foreach(['a', 'b', 'c', 'd'] as $optionIndex => $option)
                                                    <div class="option-group">
                                                        <div class="option-label">Option {{ strtoupper($option) }}</div>
                                                        <input type="text" 
                                                               name="questions[{{ $index }}][option_{{ $option }}]" 
                                                               class="form-control option-input" 
                                                               value="{{ $question['option_' . $option] ?? '' }}" 
                                                               required
                                                               placeholder="Enter option {{ strtoupper($option) }}">
                                                    </div>
                                                @endforeach
                                            </div>
                                            
                                            <div class="correct-answer-section">
                                                <label class="correct-answer-label">
                                                    <i class="fas fa-check-circle"></i>
                                                    Select Correct Answer
                                                </label>
                                                <select name="questions[{{ $index }}][correct_answer]" 
                                                        class="form-control correct-answer-select" 
                                                        required>
                                                    <option value="">Choose correct option...</option>
                                                    <option value="a" {{ ($question['correct_answer'] ?? '') == 'a' ? 'selected' : '' }}>Option A</option>
                                                    <option value="b" {{ ($question['correct_answer'] ?? '') == 'b' ? 'selected' : '' }}>Option B</option>
                                                    <option value="c" {{ ($question['correct_answer'] ?? '') == 'c' ? 'selected' : '' }}>Option C</option>
                                                    <option value="d" {{ ($question['correct_answer'] ?? '') == 'd' ? 'selected' : '' }}>Option D</option>
                                                </select>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <!-- Default first question -->
                                    <div class="question-card" data-question-index="0">
                                        <div class="question-header">
                                            <div class="question-number">
                                                <i class="fas fa-question-circle"></i>
                                                Question 1
                                            </div>
                                            <button type="button" class="remove-question-btn" onclick="removeQuestion(this)" style="display: none;">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="form-label">
                                                <i class="fas fa-pencil-alt"></i>
                                                Question Text<span class="required">*</span>
                                            </label>
                                            <input type="text" 
                                                   name="questions[0][question_text]" 
                                                   class="form-control" 
                                                   required
                                                   placeholder="Enter your question here...">
                                            <input type="hidden" name="questions[0][question_type]" value="multiple_choice">
                                        </div>
                                        
                                        <label class="form-label">
                                            <i class="fas fa-list"></i>
                                            Answer Options<span class="required">*</span>
                                            <small>(Click the check icon to mark the correct answer)</small>
                                        </label>
                                        
                                        <div class="options-grid">
                                            @foreach(['a', 'b', 'c', 'd'] as $optionIndex => $option)
                                                <div class="option-group">
                                                    <div class="option-label">Option {{ strtoupper($option) }}</div>
                                                    <input type="text" 
                                                           name="questions[0][option_{{ $option }}]" 
                                                           class="form-control option-input" 
                                                           required
                                                           placeholder="Enter option {{ strtoupper($option) }}">
                                                </div>
                                            @endforeach
                                        </div>
                                        
                                        <div class="correct-answer-section">
                                            <label class="correct-answer-label">
                                                <i class="fas fa-check-circle"></i>
                                                Select Correct Answer
                                            </label>
                                            <select name="questions[0][correct_answer]" 
                                                    class="form-control correct-answer-select" 
                                                    required>
                                                <option value="">Choose correct option...</option>
                                                <option value="a">Option A</option>
                                                <option value="b">Option B</option>
                                                <option value="c">Option C</option>
                                                <option value="d">Option D</option>
                                            </select>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="text-center mt-4">
                                <button type="button" id="addQuestion" class="modern-btn btn-add-question">
                                    <i class="fas fa-plus-circle"></i>
                                    Add New Question
                                </button>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="action-buttons">
                            <button type="button" class="modern-btn btn-save-draft" onclick="window.history.back()">
                                <i class="fas fa-arrow-left"></i>
                                Cancel
                            </button>
                            <button type="submit" class="modern-btn btn-create">
                                <i class="fas fa-plus"></i>
                                Create Quiz
                            </button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="main-footer">
    <strong>Copyright &copy; <span id="currentYear"></span> <a href="https://sumajkt.go.tz">Visit Our Website</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        {{-- <b>Version</b> 3.2.0 --}}
    </div>
</footer>

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
document.addEventListener('DOMContentLoaded', function() {
    let questionCount = {{ old('questions') ? count(old('questions')) : 1 }};
    
    // Quiz type switching
    const quizTypeRadios = document.querySelectorAll('input[name="quiz_type"]');
    const fileSection = document.getElementById('file-section');
    const questionsSection = document.getElementById('questions-section');
    
    quizTypeRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === 'file') {
                fileSection.style.display = 'block';
                questionsSection.style.display = 'none';
                // Remove required from questions when file type is selected
                questionsSection.querySelectorAll('input[required], select[required]').forEach(input => {
                    input.removeAttribute('required');
                });
                // Add required to file input
                document.getElementById('quiz_file').setAttribute('required', 'required');
            } else {
                fileSection.style.display = 'none';
                questionsSection.style.display = 'block';
                // Remove required from file when questions type is selected
                document.getElementById('quiz_file').removeAttribute('required');
                // Add required back to questions
                questionsSection.querySelectorAll('input[data-required], select[data-required]').forEach(input => {
                    input.setAttribute('required', 'required');
                });
            }
            
            // Update type option visual states
            document.querySelectorAll('.type-option').forEach(option => {
                option.classList.remove('active');
            });
            this.closest('.type-option').classList.add('active');
        });
    });
    
    // Set initial state
    const activeType = document.querySelector('input[name="quiz_type"]:checked');
    if (activeType) {
        activeType.dispatchEvent(new Event('change'));
    }
    
    // File upload handling
    const fileInput = document.getElementById('quiz_file');
    const fileUploadArea = document.getElementById('fileUploadArea');
    const fileSelected = document.getElementById('fileSelected');
    const fileName = document.getElementById('fileName');
    
    if (fileInput && fileUploadArea) {
        // Drag and drop functionality
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            fileUploadArea.addEventListener(eventName, preventDefaults, false);
        });
        
        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }
        
        ['dragenter', 'dragover'].forEach(eventName => {
            fileUploadArea.addEventListener(eventName, highlight, false);
        });
        
        ['dragleave', 'drop'].forEach(eventName => {
            fileUploadArea.addEventListener(eventName, unhighlight, false);
        });
        
        function highlight(e) {
            fileUploadArea.classList.add('drag-over');
        }
        
        function unhighlight(e) {
            fileUploadArea.classList.remove('drag-over');
        }
        
        fileUploadArea.addEventListener('drop', handleDrop, false);
        
        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            fileInput.files = files;
            handleFiles(files);
        }
        
        fileInput.addEventListener('change', function(e) {
            handleFiles(e.target.files);
        });
        
        function handleFiles(files) {
            if (files.length > 0) {
                const file = files[0];
                fileName.textContent = file.name;
                fileSelected.style.display = 'block';
                fileUploadArea.querySelector('.upload-content').style.opacity = '0.7';
            }
        }
        
        // Click to select file
        fileUploadArea.addEventListener('click', function() {
            fileInput.click();
        });
    }
    
    // Add question functionality
    const addQuestionBtn = document.getElementById('addQuestion');
    const questionsContainer = document.getElementById('questionsContainer');
    
    if (addQuestionBtn) {
        addQuestionBtn.addEventListener('click', function() {
            const newQuestionHTML = `
                <div class="question-card" data-question-index="${questionCount}">
                    <div class="question-header">
                        <div class="question-number">
                            <i class="fas fa-question-circle"></i>
                            Question ${questionCount + 1}
                        </div>
                        <button type="button" class="remove-question-btn" onclick="removeQuestion(this)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-pencil-alt"></i>
                            Question Text<span class="required">*</span>
                        </label>
                        <input type="text" 
                               name="questions[${questionCount}][question_text]" 
                               class="form-control" 
                               required
                               data-required="true"
                               placeholder="Enter your question here...">
                        <input type="hidden" name="questions[${questionCount}][question_type]" value="multiple_choice">
                    </div>
                    
                    <label class="form-label">
                        <i class="fas fa-list"></i>
                        Answer Options<span class="required">*</span>
                        <small>(Click the check icon to mark the correct answer)</small>
                    </label>
                    
                    <div class="options-grid">
                        <div class="option-group">
                            <div class="option-label">Option A</div>
                            <input type="text" 
                                   name="questions[${questionCount}][option_a]" 
                                   class="form-control option-input" 
                                   required
                                   data-required="true"
                                   placeholder="Enter option A">
                        </div>
                        <div class="option-group">
                            <div class="option-label">Option B</div>
                            <input type="text" 
                                   name="questions[${questionCount}][option_b]" 
                                   class="form-control option-input" 
                                   required
                                   data-required="true"
                                   placeholder="Enter option B">
                        </div>
                        <div class="option-group">
                            <div class="option-label">Option C</div>
                            <input type="text" 
                                   name="questions[${questionCount}][option_c]" 
                                   class="form-control option-input" 
                                   required
                                   data-required="true"
                                   placeholder="Enter option C">
                        </div>
                        <div class="option-group">
                            <div class="option-label">Option D</div>
                            <input type="text" 
                                   name="questions[${questionCount}][option_d]" 
                                   class="form-control option-input" 
                                   required
                                   data-required="true"
                                   placeholder="Enter option D">
                        </div>
                    </div>
                    
                    <div class="correct-answer-section">
                        <label class="correct-answer-label">
                            <i class="fas fa-check-circle"></i>
                            Select Correct Answer
                        </label>
                        <select name="questions[${questionCount}][correct_answer]" 
                                class="form-control correct-answer-select" 
                                required
                                data-required="true">
                            <option value="">Choose correct option...</option>
                            <option value="a">Option A</option>
                            <option value="b">Option B</option>
                            <option value="c">Option C</option>
                            <option value="d">Option D</option>
                        </select>
                    </div>
                </div>
            `;
            
            questionsContainer.insertAdjacentHTML('beforeend', newQuestionHTML);
            questionCount++;
            
            // Update question numbers and show remove buttons
            updateQuestionNumbers();
        });
    }
    
    // Update question numbers and remove button visibility
    function updateQuestionNumbers() {
        const questionCards = document.querySelectorAll('.question-card');
        questionCards.forEach((card, index) => {
            const questionNumber = card.querySelector('.question-number');
            if (questionNumber) {
                questionNumber.innerHTML = `<i class="fas fa-question-circle"></i> Question ${index + 1}`;
            }
            
            const removeBtn = card.querySelector('.remove-question-btn');
            if (removeBtn) {
                removeBtn.style.display = questionCards.length > 1 ? 'block' : 'none';
            }
            
            // Update form field names
            card.setAttribute('data-question-index', index);
            const inputs = card.querySelectorAll('input, select');
            inputs.forEach(input => {
                if (input.name) {
                    input.name = input.name.replace(/questions\[\d+\]/, `questions[${index}]`);
                }
            });
        });
    }
    
    // Remove question function (global scope for onclick)
    window.removeQuestion = function(button) {
        const questionCard = button.closest('.question-card');
        const questionCards = document.querySelectorAll('.question-card');
        
        if (questionCards.length > 1) {
            questionCard.remove();
            updateQuestionNumbers();
            questionCount--;
        }
    };
    
    // Form validation
    const form = document.getElementById('quizCreateForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            const activeQuizType = document.querySelector('input[name="quiz_type"]:checked').value;
            
            if (activeQuizType === 'questions') {
                const questionCards = document.querySelectorAll('.question-card');
                if (questionCards.length === 0) {
                    e.preventDefault();
                    alert('Please add at least one question.');
                    return;
                }
                
                // Validate each question
                let isValid = true;
                questionCards.forEach((card, index) => {
                    const questionText = card.querySelector(`input[name="questions[${index}][question_text]"]`);
                    const correctAnswer = card.querySelector(`select[name="questions[${index}][correct_answer]"]`);
                    const options = card.querySelectorAll('input[name*="option_"]');
                    
                    if (!questionText.value.trim()) {
                        isValid = false;
                        questionText.focus();
                        alert(`Question ${index + 1} text is required.`);
                        return;
                    }
                    
                    let hasEmptyOption = false;
                    options.forEach(option => {
                        if (!option.value.trim()) {
                            hasEmptyOption = true;
                            option.focus();
                        }
                    });
                    
                    if (hasEmptyOption) {
                        isValid = false;
                        alert(`All options for Question ${index + 1} must be filled.`);
                        return;
                    }
                    
                    if (!correctAnswer.value) {
                        isValid = false;
                        correctAnswer.focus();
                        alert(`Please select the correct answer for Question ${index + 1}.`);
                        return;
                    }
                });
                
                if (!isValid) {
                    e.preventDefault();
                    return;
                }
            } else if (activeQuizType === 'file') {
                const fileInput = document.getElementById('quiz_file');
                if (!fileInput.files.length) {
                    e.preventDefault();
                    alert('Please select a quiz file to upload.');
                    fileInput.focus();
                    return;
                }
            }
        });
    }
    
    // Initialize question numbers on page load
    updateQuestionNumbers();
    
    // Notification function
    function showNotification(type, title, message) {
        const config = {
            title: title,
            text: message,
            showConfirmButton: true,
            timer: 5000,
            timerProgressBar: true,
            allowOutsideClick: false,
            allowEscapeKey: false,
        };

        switch (type) {
            case 'success':
                config.icon = 'success';
                config.iconColor = '#28a745';
                config.confirmButtonColor = '#28a745';
                break;
            case 'error':
                config.icon = 'error';
                config.iconColor = '#dc3545';
                config.confirmButtonColor = '#dc3545';
                break;
            case 'warning':
                config.icon = 'warning';
                config.iconColor = '#ffc107';
                config.confirmButtonColor = '#ffc107';
                break;
            case 'info':
                config.icon = 'info';
                config.iconColor = '#17a2b8';
                config.confirmButtonColor = '#17a2b8';
                break;
        }

        Swal.fire(config);
    }
    
    // Handle server-side flash messages
    @if(session('success'))
        showNotification('success', 'Success!', '{{ session('success') }}');
    @endif

    @if(session('error'))
        showNotification('error', 'Error!', '{{ session('error') }}');
    @endif

    @if($errors->any())
        let errorMessages = '';
        @foreach($errors->all() as $error)
            errorMessages += '{{ $error }}\n';
        @endforeach
        showNotification('error', 'Validation Errors', errorMessages);
    @endif
});

// Enhanced form submission with loading state
document.getElementById('quizCreateForm').addEventListener('submit', function(e) {
    const submitBtn = this.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    
    // Show loading state
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Creating Quiz...';
    
    // Optional: Add a small delay to show the loading state
    setTimeout(() => {
        // Form will submit normally after this
    }, 500);
});
</script>
<script>
document.getElementById('class_id').addEventListener('change', function() {
    const classId = this.value;    // Fetch subjects based on the selected class
    fetch(`/teacher/get-subjects/${classId}`)
        .then(response => response.json())
        .then(data => {
            const subjectSelect = document.getElementById('subject_id');
            subjectSelect.innerHTML = '<option value="">Select Subject</option>'; // Reset the dropdown

            // Populate the subjects dropdown
            data.forEach(subject => {
                const option = document.createElement('option');
                option.value = subject.id;
                option.textContent = subject.name;
                subjectSelect.appendChild(option);
            });
        })
        .catch(error => console.error('Error fetching subjects:', error));
});


   // footer js
    document.getElementById("currentYear").textContent = new Date().getFullYear();

    // calendar js
    document.addEventListener('DOMContentLoaded', function () {
      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          selectable: true,
          editable: true,
          events: '/admin/events', // Endpoint to fetch events (create this if you have event data)
          dateClick: function(info) {
              alert('Date: ' + info.dateStr);
          },
          eventClick: function(info) {
              alert('Event: ' + info.event.title);
          }
      });
      calendar.render();
  });
    </script>
    
@endsection

