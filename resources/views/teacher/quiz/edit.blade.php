@extends('components.dashmaster')

@section('body')
<style>
    .quiz-edit-container {
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
    
    .btn-update {
        background: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%);
        color: white;
    }
    
    .btn-update:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(46, 204, 113, 0.4);
        color: white;
    }
    
    /* Ensure buttons are definitely clickable */
    .modern-btn {
        pointer-events: auto !important;
        z-index: 999 !important;
        position: relative !important;
    }
    
    /* DEBUGGING: Make update button very obvious */
    .btn-update {
        background: red !important;
        border: 5px solid yellow !important;
        font-size: 20px !important;
        min-height: 60px !important;
        cursor: pointer !important;
    }
    
    .btn-update:hover {
        background: darkred !important;
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
    
    .quiz-info-banner {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 20px;
        border-radius: 15px;
        margin-bottom: 30px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    
    .quiz-status {
        background: rgba(255, 255, 255, 0.2);
        padding: 8px 15px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 600;
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
    
    /* Quiz Type Selector Styles */
    .quiz-type-selector {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 20px;
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
    
    /* File Upload Styles */
    .current-file-display {
        margin-bottom: 25px;
    }
    
    .file-info-card {
        background: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%);
        color: white;
        border-radius: 15px;
        padding: 20px;
        display: flex;
        align-items: center;
        gap: 20px;
    }
    
    .file-icon {
        width: 60px;
        height: 60px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }
    
    .file-details h5 {
        margin-bottom: 5px;
        font-weight: 600;
    }
    
    .file-name {
        margin-bottom: 15px;
        opacity: 0.9;
        font-size: 0.9rem;
    }
    
    .file-actions {
        display: flex;
        gap: 10px;
    }
    
    .btn-view-file,
    .btn-download-file {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        padding: 8px 15px;
        border-radius: 20px;
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 600;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    
    .btn-view-file:hover,
    .btn-download-file:hover {
        background: rgba(255, 255, 255, 0.3);
        color: white;
        text-decoration: none;
        transform: translateY(-2px);
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
    
    /* Responsive Design for Quiz Type Selector */
    @media (max-width: 768px) {
        .quiz-type-selector {
            grid-template-columns: 1fr;
        }
        
        .type-card {
            padding: 20px;
        }
        
        .type-icon {
            font-size: 2.5rem;
        }
    }
</style>

<div class="content-wrapper quiz-edit-container">
    <div class="container-fluid">
        <!-- Back Navigation -->
        <div class="back-navigation">
            <a href="{{ route('quizzes.show', $quiz->id) }}" class="back-btn">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Quiz Details
            </a>
        </div>

        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">
                <i class="fas fa-edit mr-3"></i>
                Edit Quiz
            </h1>
            <p class="page-description">
                Update quiz details, questions, and settings. Make sure all information is accurate before saving.
            </p>
        </div>

        <!-- Quiz Info Banner -->
        <div class="quiz-info-banner animate-fade-in">
            <div>
                <h4 class="mb-1">{{ $quiz->title }}</h4>
                <p class="mb-0">{{ $quiz->class->name }} - {{ $quiz->subject->name }}</p>
            </div>
            <div class="quiz-status">
                @php
                    $status = $quiz->status ?? 'upcoming';
                @endphp
                <i class="fas fa-circle mr-1" style="font-size: 0.6rem;"></i>
                {{ ucfirst($status) }}
            </div>
        </div>

        <!-- Form Container -->
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div class="form-container animate-fade-in">
                    <form id="quizEditForm" action="{{ route('quizzes.update', $quiz->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

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
                                               value="{{ old('title', $quiz->title) }}" 
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
                                               value="{{ old('duration', $quiz->duration) }}" 
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
                                          placeholder="Provide a clear description of the quiz">{{ old('description', $quiz->description) }}</textarea>
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
                                                <option value="{{ $class->id }}" {{ old('class_id', $quiz->class_id) == $class->id ? 'selected' : '' }}>
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
                                            @foreach($subjects as $subject)
                                                <option value="{{ $subject->id }}" {{ old('subject_id', $quiz->subject_id) == $subject->id ? 'selected' : '' }}>
                                                    {{ $subject->name }}
                                                </option>
                                            @endforeach
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
                                               value="{{ old('start_time', $quiz->start_time->format('Y-m-d\TH:i')) }}" 
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
                                               value="{{ old('end_time', $quiz->end_time->format('Y-m-d\TH:i')) }}" 
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
                                Quiz Type Configuration
                            </div>
                            
                            <div class="quiz-type-selector">
                                <div class="type-option" data-type="questions">
                                    <input type="radio" 
                                           name="quiz_type" 
                                           value="questions" 
                                           id="type_questions" 
                                           {{ (!$quiz->hasQuizFile() && $quiz->questions->count() > 0) || old('quiz_type') == 'questions' ? 'checked' : '' }}>
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
                                           {{ $quiz->hasQuizFile() || old('quiz_type') == 'file' ? 'checked' : '' }}>
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
                        <div class="form-section" id="file-section" style="display: {{ $quiz->hasQuizFile() || old('quiz_type') == 'file' ? 'block' : 'none' }};">
                            <div class="section-title">
                                <i class="fas fa-cloud-upload-alt"></i>
                                Quiz File Upload
                            </div>
                            
                            @if($quiz->hasQuizFile())
                                <div class="current-file-display">
                                    <div class="file-info-card">
                                        <div class="file-icon">
                                            <i class="fas fa-file-pdf"></i>
                                        </div>
                                        <div class="file-details">
                                            <h5>Current Quiz File</h5>
                                            <p class="file-name">{{ basename($quiz->quiz_file) }}</p>
                                            <div class="file-actions">
                                                <a href="{{ $quiz->quiz_file_url }}" target="_blank" class="btn-view-file">
                                                    <i class="fas fa-eye"></i> View File
                                                </a>
                                                <a href="{{ $quiz->quiz_file_url }}" download class="btn-download-file">
                                                    <i class="fas fa-download"></i> Download
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            
                            <div class="form-group">
                                <label class="form-label" for="quiz_file">
                                    <i class="fas fa-file-upload"></i>
                                    {{ $quiz->hasQuizFile() ? 'Replace Quiz File (Optional)' : 'Upload Quiz File' }}<span class="required">*</span>
                                </label>
                                <div class="file-upload-area" id="fileUploadArea">
                                    <input type="file" 
                                           class="file-upload-input" 
                                           id="quiz_file" 
                                           name="quiz_file" 
                                           accept=".pdf,.docx,.doc,.csv,.xlsx,.xls,.json"
                                           {{ !$quiz->hasQuizFile() ? 'required' : '' }}>
                                    <div class="upload-content">
                                        <i class="fas fa-cloud-upload-alt upload-icon"></i>
                                        <div class="upload-text">Click to select or drag & drop your quiz file</div>
                                        <div class="upload-hint">
                                            Supported formats: PDF, Word (.docx, .doc), Excel (.xlsx, .xls), CSV, JSON
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
                        <div class="form-section" id="questions-section" style="display: {{ (!$quiz->hasQuizFile() && $quiz->questions->count() > 0) || old('quiz_type') == 'questions' ? 'block' : 'none' }};">
                            <div class="section-title">
                                <i class="fas fa-question-circle"></i>
                                Quiz Questions
                                <small class="ml-auto" style="font-size: 0.9rem; font-weight: 400;">
                                    Total: <span id="question-counter">{{ $quiz->questions->count() }}</span> questions
                                </small>
                            </div>
                            
                            <div id="questions-container">
                                @foreach($quiz->questions as $index => $question)
                                    <div class="question-card animate-fade-in" style="animation-delay: {{ $index * 0.1 }}s;" data-question-index="{{ $index }}">
                                        <div class="question-header">
                                            <div class="question-number">
                                                <i class="fas fa-question"></i>
                                                Question {{ $index + 1 }}
                                            </div>
                                            <button type="button" class="remove-question-btn" onclick="removeQuestion(this)">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="form-label" for="question_{{ $index }}">
                                                <i class="fas fa-edit"></i>
                                                Question Text<span class="required">*</span>
                                            </label>
                                            <textarea name="questions[{{ $index }}][question_text]" 
                                                      id="question_{{ $index }}" 
                                                      class="form-control @error("questions.{$index}.question_text") is-invalid @enderror" 
                                                      rows="2" 
                                                      required
                                                      placeholder="Enter your question here">{{ old('questions.' . $index . '.question_text', $question->question_text) }}</textarea>
                                            @error("questions.{$index}.question_text")
                                                <div class="error-message">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="options-grid">
                                            <div class="option-group">
                                                <div class="option-label">Option A</div>
                                                <input type="text" 
                                                       name="questions[{{ $index }}][option1]" 
                                                       class="form-control option-input" 
                                                       value="{{ old('questions.' . $index . '.option1', $question->option1) }}" 
                                                       placeholder="Enter option A" 
                                                       required>
                                            </div>
                                            <div class="option-group">
                                                <div class="option-label">Option B</div>
                                                <input type="text" 
                                                       name="questions[{{ $index }}][option2]" 
                                                       class="form-control option-input" 
                                                       value="{{ old('questions.' . $index . '.option2', $question->option2) }}" 
                                                       placeholder="Enter option B" 
                                                       required>
                                            </div>
                                            <div class="option-group">
                                                <div class="option-label">Option C</div>
                                                <input type="text" 
                                                       name="questions[{{ $index }}][option3]" 
                                                       class="form-control option-input" 
                                                       value="{{ old('questions.' . $index . '.option3', $question->option3) }}" 
                                                       placeholder="Enter option C" 
                                                       required>
                                            </div>
                                            <div class="option-group">
                                                <div class="option-label">Option D</div>
                                                <input type="text" 
                                                       name="questions[{{ $index }}][option4]" 
                                                       class="form-control option-input" 
                                                       value="{{ old('questions.' . $index . '.option4', $question->option4) }}" 
                                                       placeholder="Enter option D" 
                                                       required>
                                            </div>
                                        </div>

                                        <div class="correct-answer-section">
                                            <div class="correct-answer-label">
                                                <i class="fas fa-bullseye"></i>
                                                Correct Answer
                                            </div>
                                            <select name="questions[{{ $index }}][correct_option]" 
                                                    class="form-control correct-answer-select" 
                                                    required>
                                                <option value="">Choose correct answer...</option>
                                                <option value="option1" {{ old('questions.' . $index . '.correct_option', $question->correct_option) == 'option1' ? 'selected' : '' }}>Option A</option>
                                                <option value="option2" {{ old('questions.' . $index . '.correct_option', $question->correct_option) == 'option2' ? 'selected' : '' }}>Option B</option>
                                                <option value="option3" {{ old('questions.' . $index . '.correct_option', $question->correct_option) == 'option3' ? 'selected' : '' }}>Option C</option>
                                                <option value="option4" {{ old('questions.' . $index . '.correct_option', $question->correct_option) == 'option4' ? 'selected' : '' }}>Option D</option>
                                            </select>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="action-buttons">
                            <button type="button" class="modern-btn btn-add-question" id="add-question">
                                <i class="fas fa-plus"></i>
                                Add Question
                            </button>
                            <button type="button" class="modern-btn btn-save-draft">
                                <i class="fas fa-save"></i>
                                Save Draft
                            </button>
                            <button type="submit" class="modern-btn btn-update" onclick="console.log('HTML onclick works!'); alert('Direct HTML onclick works!');">
                                <i class="fas fa-sync-alt"></i>
                                Update Quiz
                            </button>
                        </div>
                    </form>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM Content Loaded - Quiz Edit Page');
    
    // Immediate test for Update Quiz button
    const testUpdateButton = document.querySelector('.btn-update');
    console.log('Update button found on load:', testUpdateButton);
    
    // Update button is ready
    if (testUpdateButton) {
        console.log('Update button detected and ready');
    }
    
    // Initialize variables
    let questionCount = {{ $quiz->questions->count() }};
    const questionContainer = document.getElementById('questions-container');
    const questionCounter = document.getElementById('question-counter');
    const addQuestionBtn = document.getElementById('add-question');
    const form = document.getElementById('quizEditForm');
    const fileSection = document.getElementById('file-section');
    const questionsSection = document.getElementById('questions-section');
    const fileInput = document.getElementById('quiz_file');
    const fileUploadArea = document.getElementById('fileUploadArea');
    const fileSelected = document.getElementById('fileSelected');
    const fileName = document.getElementById('fileName');
    
    console.log('All elements found:', {
        form: !!form,
        updateButton: !!testUpdateButton,
        addQuestionBtn: !!addQuestionBtn
    });

    // Footer year update
    const yearElement = document.getElementById("currentYear");
    if (yearElement) {
        yearElement.textContent = new Date().getFullYear();
    }

    // Quiz type switching functionality
    const quizTypeRadios = document.querySelectorAll('input[name="quiz_type"]');
    quizTypeRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === 'file') {
                fileSection.style.display = 'block';
                questionsSection.style.display = 'none';
                // Make file required if no existing file
                if (!{{ $quiz->hasQuizFile() ? 'true' : 'false' }}) {
                    fileInput.setAttribute('required', 'required');
                }
                // Remove required from questions
                document.querySelectorAll('#questions-section input[required], #questions-section textarea[required], #questions-section select[required]').forEach(input => {
                    input.removeAttribute('required');
                });
            } else {
                fileSection.style.display = 'none';
                questionsSection.style.display = 'block';
                fileInput.removeAttribute('required');
                // Make questions required
                document.querySelectorAll('#questions-section input, #questions-section textarea, #questions-section select').forEach(input => {
                    if (input.name && !input.name.includes('quiz_type')) {
                        input.setAttribute('required', 'required');
                    }
                });
            }
        });
    });

    // File upload handling
    if (fileInput && fileUploadArea) {
        // File input change handler
        fileInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                // Validate file size (10MB limit)
                if (file.size > 10 * 1024 * 1024) {
                    showNotification('error', 'File Too Large', 'Please select a file smaller than 10MB.');
                    this.value = '';
                    return;
                }

                // Validate file type
                const allowedTypes = ['.pdf', '.docx', '.doc', '.csv', '.xlsx', '.xls', '.json'];
                const fileExtension = '.' + file.name.split('.').pop().toLowerCase();
                
                if (!allowedTypes.includes(fileExtension)) {
                    showNotification('error', 'Invalid File Type', 'Please select a supported file format.');
                    this.value = '';
                    return;
                }

                // Show selected file
                fileName.textContent = file.name;
                fileSelected.style.display = 'inline-flex';
                fileUploadArea.classList.add('file-selected-state');
                
                showNotification('success', 'File Selected', `Selected: ${file.name}`);
            } else {
                fileSelected.style.display = 'none';
                fileUploadArea.classList.remove('file-selected-state');
            }
        });

        // Drag and drop functionality
        fileUploadArea.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.classList.add('dragover');
        });

        fileUploadArea.addEventListener('dragleave', function(e) {
            e.preventDefault();
            this.classList.remove('dragover');
        });

        fileUploadArea.addEventListener('drop', function(e) {
            e.preventDefault();
            this.classList.remove('dragover');
            
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                fileInput.files = files;
                fileInput.dispatchEvent(new Event('change'));
            }
        });
    }

    // Add Question Functionality
    if (addQuestionBtn) {
        addQuestionBtn.addEventListener('click', function() {
            console.log('Add Question button clicked');
            
            // Check if questions section is visible
            if (questionsSection.style.display === 'none') {
                showNotification('warning', 'Switch to Questions Mode', 'Please select "Question-Based Quiz" to add questions.');
                return;
            }
        const newQuestionHtml = `
            <div class="question-card animate-fade-in" data-question-index="${questionCount}">
                <div class="question-header">
                    <div class="question-number">
                        <i class="fas fa-question"></i>
                        Question ${questionCount + 1}
                    </div>
                    <button type="button" class="remove-question-btn" onclick="removeQuestion(this)">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="question_${questionCount}">
                        <i class="fas fa-edit"></i>
                        Question Text<span class="required">*</span>
                    </label>
                    <textarea name="questions[${questionCount}][question_text]" 
                              id="question_${questionCount}" 
                              class="form-control" 
                              rows="2" 
                              required
                              placeholder="Enter your question here"></textarea>
                </div>

                <div class="options-grid">
                    <div class="option-group">
                        <div class="option-label">Option A</div>
                        <input type="text" 
                               name="questions[${questionCount}][option1]" 
                               class="form-control option-input" 
                               placeholder="Enter option A" 
                               required>
                    </div>
                    <div class="option-group">
                        <div class="option-label">Option B</div>
                        <input type="text" 
                               name="questions[${questionCount}][option2]" 
                               class="form-control option-input" 
                               placeholder="Enter option B" 
                               required>
                    </div>
                    <div class="option-group">
                        <div class="option-label">Option C</div>
                        <input type="text" 
                               name="questions[${questionCount}][option3]" 
                               class="form-control option-input" 
                               placeholder="Enter option C" 
                               required>
                    </div>
                    <div class="option-group">
                        <div class="option-label">Option D</div>
                        <input type="text" 
                               name="questions[${questionCount}][option4]" 
                               class="form-control option-input" 
                               placeholder="Enter option D" 
                               required>
                    </div>
                </div>

                <div class="correct-answer-section">
                    <div class="correct-answer-label">
                        <i class="fas fa-bullseye"></i>
                        Correct Answer
                    </div>
                    <select name="questions[${questionCount}][correct_option]" 
                            class="form-control correct-answer-select" 
                            required>
                        <option value="">Choose correct answer...</option>
                        <option value="option1">Option A</option>
                        <option value="option2">Option B</option>
                        <option value="option3">Option C</option>
                        <option value="option4">Option D</option>
                    </select>
                </div>
            </div>
        `;
        
        questionContainer.insertAdjacentHTML('beforeend', newQuestionHtml);
        questionCount++;
        updateQuestionCounter();
        
        // Get the newly added question
        const newQuestion = questionContainer.lastElementChild;
        
        // Add event listeners to new form elements
        setupFormElementListeners(newQuestion);
        
        // Scroll to new question
        newQuestion.scrollIntoView({ behavior: 'smooth', block: 'center' });
        
        // Focus on the question text input
        newQuestion.querySelector('textarea').focus();
        
        showNotification('success', 'Question Added', 'New question has been added successfully!');
        });
    } else {
        console.error('Add Question button not found');
    }

    // Dynamic subject loading based on class selection
    const classSelect = document.getElementById('class_id');
    const subjectSelect = document.getElementById('subject_id');
    
    if (classSelect && subjectSelect) {
        classSelect.addEventListener('change', function() {
            const classId = this.value;
            
            if (classId) {
                // Store current subject value
                const currentSubject = subjectSelect.value;
                
                // Show loading state
                subjectSelect.innerHTML = '<option value="">Loading subjects...</option>';
                subjectSelect.disabled = true;
                
                fetch(`/subjects/${classId}`)
                    .then(response => response.json())
                    .then(data => {
                        subjectSelect.innerHTML = '<option value="">Select a subject...</option>';
                        
                        data.forEach(subject => {
                            const option = document.createElement('option');
                            option.value = subject.id;
                            option.textContent = subject.name;
                            if (subject.id == currentSubject) {
                                option.selected = true;
                            }
                            subjectSelect.appendChild(option);
                        });
                        
                        subjectSelect.disabled = false;
                    })
                    .catch(error => {
                        console.error('Error fetching subjects:', error);
                        subjectSelect.innerHTML = '<option value="">Error loading subjects</option>';
                        subjectSelect.disabled = false;
                        showNotification('error', 'Error', 'Failed to load subjects. Please try again.');
                    });
            } else {
                subjectSelect.innerHTML = '<option value="">First select a class...</option>';
                subjectSelect.disabled = false;
            }
        });
    }

    // Simple form submission handler
    if (form) {
        form.addEventListener('submit', function(e) {
            console.log('Form submission event triggered');
            
            // Show loading state
            const submitBtn = form.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Updating...';
                submitBtn.disabled = true;
            }
            
            console.log('Form is submitting...');
            // Allow natural form submission - don't prevent default
        });
    }

    // Auto-resize textareas
    document.querySelectorAll('textarea').forEach(textarea => {
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });
    });

    // Add visual feedback for form interactions
    document.querySelectorAll('.form-control').forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('focused');
            if (this.value.trim() !== '') {
                this.classList.add('has-value');
            } else {
                this.classList.remove('has-value');
            }
        });
    });

    // Initialize existing form controls
    document.querySelectorAll('.form-control').forEach(input => {
        if (input.value.trim() !== '') {
            input.classList.add('has-value');
        }
    });
    
    // ULTRA SIMPLE BUTTON HANDLER - MINIMAL APPROACH
    setTimeout(() => {
        const updateBtn = document.querySelector('button[type="submit"].btn-update');
        console.log('Looking for update button:', updateBtn);
        
        if (updateBtn) {
            console.log('Update button FOUND! Adding click handler...');
            
            // Add a very basic click handler
            updateBtn.onclick = function() {
                console.log('UPDATE BUTTON CLICKED!');
                alert('Button clicked! Form will submit now...');
                
                // Find form and submit
                const form = document.getElementById('quizEditForm');
                if (form) {
                    console.log('Submitting form...');
                    form.submit();
                } else {
                    console.error('No form found');
                }
            };
            
            // Also try addEventListener as backup
            updateBtn.addEventListener('click', function(e) {
                console.log('EVENT LISTENER: Button clicked!');
            });
            
        } else {
            console.error('UPDATE BUTTON NOT FOUND!');
            // Try to find any button with update class
            const anyUpdateBtn = document.querySelector('.btn-update');
            console.log('Any update button found:', anyUpdateBtn);
            
            // List all buttons
            const allButtons = document.querySelectorAll('button');
            console.log('All buttons found:', allButtons.length);
            allButtons.forEach((btn, index) => {
                console.log(`Button ${index}:`, btn.className, btn.type, btn.textContent.trim());
            });
        }
    }, 2000); // Wait 2 seconds for DOM to be ready
});

// Function to setup event listeners for form elements (for dynamically added elements)
function setupFormElementListeners(container) {
    if (!container) {
        container = document;
    }
    
    // Auto-resize textareas
    container.querySelectorAll('textarea').forEach(textarea => {
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });
    });

    // Add visual feedback for form interactions
    container.querySelectorAll('.form-control').forEach(input => {
        // Remove existing listeners to prevent duplicates
        input.removeEventListener('focus', handleFocus);
        input.removeEventListener('blur', handleBlur);
        
        // Add new listeners
        input.addEventListener('focus', handleFocus);
        input.addEventListener('blur', handleBlur);
        
        // Initialize existing values
        if (input.value.trim() !== '') {
            input.classList.add('has-value');
        }
    });
}

// Event handler functions (defined separately to avoid duplicates)
function handleFocus(event) {
    event.target.parentElement.classList.add('focused');
}

function handleBlur(event) {
    const input = event.target;
    input.parentElement.classList.remove('focused');
    if (input.value.trim() !== '') {
        input.classList.add('has-value');
    } else {
        input.classList.remove('has-value');
    }
}

// Remove question function
function removeQuestion(button) {
    const questionCard = button.closest('.question-card');
    const questionIndex = parseInt(questionCard.dataset.questionIndex);
    
    if (document.querySelectorAll('.question-card').length <= 1) {
        showNotification('warning', 'Cannot Remove', 'Quiz must have at least one question.');
        return;
    }
    
    // Confirm deletion
    if (confirm('Are you sure you want to remove this question?')) {
        questionCard.style.transform = 'translateX(-100%)';
        questionCard.style.opacity = '0';
        
        setTimeout(() => {
            questionCard.remove();
            updateQuestionNumbers();
            updateQuestionCounter();
            showNotification('success', 'Question Removed', 'Question has been removed successfully!');
        }, 300);
    }
}

// Update question numbers after removal
function updateQuestionNumbers() {
    document.querySelectorAll('.question-card').forEach((card, index) => {
        const questionNumber = card.querySelector('.question-number');
        questionNumber.innerHTML = `<i class="fas fa-question"></i>Question ${index + 1}`;
        
        // Update input names to maintain proper indexing
        card.querySelectorAll('input, textarea, select').forEach(input => {
            const name = input.name;
            if (name && name.includes('questions[')) {
                input.name = name.replace(/questions\[\d+\]/, `questions[${index}]`);
            }
        });
        
        // Update IDs
        const textarea = card.querySelector('textarea');
        if (textarea) {
            textarea.id = `question_${index}`;
        }
    });
}

// Update question counter
function updateQuestionCounter() {
    const counter = document.getElementById('question-counter');
    if (counter) {
        counter.textContent = document.querySelectorAll('.question-card').length;
    }
}

// Form validation function
function validateForm() {
    console.log('Starting form validation...');
    let isValid = true;
    let validationErrors = [];
    
    const selectedType = document.querySelector('input[name="quiz_type"]:checked')?.value;
    console.log('Selected quiz type:', selectedType);
    
    // Check basic required fields (always required)
    const basicFields = ['title', 'description', 'class_id', 'subject_id', 'start_time', 'end_time', 'duration'];
    basicFields.forEach(fieldName => {
        const field = document.querySelector(`[name="${fieldName}"]`);
        if (field && !field.value.trim()) {
            field.classList.add('is-invalid');
            validationErrors.push(`${fieldName} is required`);
            isValid = false;
        } else if (field) {
            field.classList.remove('is-invalid');
        }
    });
    
    // Validate based on quiz type
    if (selectedType === 'file') {
        // Check if file is uploaded (only if no existing file)
        const hasExistingFile = {{ $quiz->hasQuizFile() ? 'true' : 'false' }};
        const fileInput = document.getElementById('quiz_file');
        
        if (!hasExistingFile && (!fileInput || !fileInput.files || fileInput.files.length === 0)) {
            if (fileInput) fileInput.classList.add('is-invalid');
            validationErrors.push('Quiz file is required');
            showNotification('error', 'File Required', 'Please upload a quiz file.');
            isValid = false;
        } else if (fileInput) {
            fileInput.classList.remove('is-invalid');
        }
    } else if (selectedType === 'questions') {
        // Check if there are questions
        const questionCards = document.querySelectorAll('.question-card');
        console.log('Number of questions found:', questionCards.length);
        
        if (questionCards.length === 0) {
            validationErrors.push('At least one question is required');
            showNotification('error', 'Questions Required', 'Please add at least one question for the quiz.');
            isValid = false;
        } else {
            // Check each question's required fields (but be more lenient)
            let questionErrors = 0;
            questionCards.forEach((card, index) => {
                const questionText = card.querySelector('textarea[name*="question_text"]');
                const options = card.querySelectorAll('input[name*="option"]');
                const correctAnswer = card.querySelector('select[name*="correct_option"]');
                
                // Check question text
                if (questionText && !questionText.value.trim()) {
                    questionText.classList.add('is-invalid');
                    questionErrors++;
                } else if (questionText) {
                    questionText.classList.remove('is-invalid');
                }
                
                // Check options (at least first two options should be filled)
                let filledOptions = 0;
                options.forEach((option, optIndex) => {
                    if (option.value.trim()) {
                        option.classList.remove('is-invalid');
                        filledOptions++;
                    } else if (optIndex < 2) { // Only require first 2 options
                        option.classList.add('is-invalid');
                        questionErrors++;
                    }
                });
                
                // Check correct answer
                if (correctAnswer && !correctAnswer.value) {
                    correctAnswer.classList.add('is-invalid');
                    questionErrors++;
                } else if (correctAnswer) {
                    correctAnswer.classList.remove('is-invalid');
                }
            });
            
            if (questionErrors > 0) {
                validationErrors.push(`${questionErrors} question fields need to be completed`);
                isValid = false;
            }
        }
    }
    
    // Check if start time is before end time (but make this optional for drafts)
    const startTime = document.getElementById('start_time');
    const endTime = document.getElementById('end_time');
    
    if (startTime && endTime && startTime.value && endTime.value) {
        if (new Date(startTime.value) >= new Date(endTime.value)) {
            endTime.classList.add('is-invalid');
            validationErrors.push('End time must be after start time');
            showNotification('error', 'Invalid Schedule', 'End time must be after start time.');
            isValid = false;
        } else {
            endTime.classList.remove('is-invalid');
        }
    }
    
    console.log('Validation errors:', validationErrors);
    console.log('Form is valid:', isValid);
    
    if (!isValid && validationErrors.length > 0) {
        showNotification('error', 'Validation Error', `Please fix the following issues:\n• ${validationErrors.join('\n• ')}`);
    }
    
    return isValid;
}

// Enhanced notification function
function showNotification(type, title, message) {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.innerHTML = `
        <div class="notification-content">
            <div class="notification-icon">
                <i class="fas ${getNotificationIcon(type)}"></i>
            </div>
            <div class="notification-text">
                <div class="notification-title">${title}</div>
                <div class="notification-message">${message}</div>
            </div>
            <button class="notification-close" onclick="this.parentElement.remove()">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `;
    
    // Add styles if not already added
    if (!document.getElementById('notification-styles')) {
        const styles = document.createElement('style');
        styles.id = 'notification-styles';
        styles.textContent = `
            .notification {
                position: fixed;
                top: 20px;
                right: 20px;
                z-index: 10000;
                min-width: 300px;
                max-width: 400px;
                padding: 15px;
                border-radius: 10px;
                box-shadow: 0 10px 30px rgba(0,0,0,0.3);
                animation: slideInRight 0.3s ease;
                margin-bottom: 10px;
            }
            
            .notification-success {
                background: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%);
                color: white;
            }
            
            .notification-error {
                background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
                color: white;
            }
            
            .notification-warning {
                background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
                color: white;
            }
            
            .notification-content {
                display: flex;
                align-items: center;
                gap: 15px;
            }
            
            .notification-icon {
                font-size: 1.2rem;
            }
            
            .notification-text {
                flex: 1;
            }
            
            .notification-title {
                font-weight: 600;
                margin-bottom: 2px;
            }
            
            .notification-message {
                font-size: 0.9rem;
                opacity: 0.9;
            }
            
            .notification-close {
                background: none;
                border: none;
                color: inherit;
                cursor: pointer;
                opacity: 0.7;
                padding: 5px;
            }
            
            .notification-close:hover {
                opacity: 1;
            }
            
            @keyframes slideInRight {
                from {
                    transform: translateX(100%);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
        `;
        document.head.appendChild(styles);
    }
    
    document.body.appendChild(notification);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        if (notification.parentElement) {
            notification.remove();
        }
    }, 5000);
}

function getNotificationIcon(type) {
    switch(type) {
        case 'success': return 'fa-check-circle';
        case 'error': return 'fa-exclamation-circle';
        case 'warning': return 'fa-exclamation-triangle';
        default: return 'fa-info-circle';
    }
}
</script>


@endsection
