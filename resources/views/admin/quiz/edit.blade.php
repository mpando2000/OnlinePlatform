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
    
    /* Modern Button Styles */
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
        pointer-events: auto !important;
        z-index: 999 !important;
        position: relative !important;
    }
    
    .modern-btn i {
        margin-right: 8px;
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
    
    /* Responsive Design */
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
        
        .options-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="content-wrapper quiz-edit-container">
    <div class="container-fluid">
        <!-- Back Navigation -->
        <div class="back-navigation">
            <a href="{{ route('admin.quizzes.index') }}" class="back-btn">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Quizzes
            </a>
        </div>

        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">
                <i class="fas fa-edit mr-3"></i>
                Edit Quiz (Admin)
            </h1>
            <p class="page-description">
                Update quiz details, questions, and settings with administrative privileges.
            </p>
        </div>

        <!-- Quiz Info Banner -->
        <div class="quiz-info-banner animate-fade-in">
            <div>
                <h4 class="mb-1">{{ $quiz->title }}</h4>
                <p class="mb-0">{{ $quiz->class->name ?? 'No Class' }} - {{ $quiz->subject->name ?? 'No Subject' }}</p>
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
                    <form id="adminQuizEditForm" action="{{ route('admin.quizzes.update', $quiz->id) }}" method="POST" enctype="multipart/form-data">
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
                                            @if(isset($classes))
                                                @foreach($classes as $class)
                                                    <option value="{{ $class->id }}" {{ old('class_id', $quiz->class_id) == $class->id ? 'selected' : '' }}>
                                                        {{ $class->name }}
                                                    </option>
                                                @endforeach
                                            @endif
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
                                            @if(isset($subjects))
                                                @foreach($subjects as $subject)
                                                    <option value="{{ $subject->id }}" {{ old('subject_id', $quiz->subject_id) == $subject->id ? 'selected' : '' }}>
                                                        {{ $subject->name }}
                                                    </option>
                                                @endforeach
                                            @endif
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
                                               value="{{ old('start_time', $quiz->start_time ? $quiz->start_time->format('Y-m-d\TH:i') : '') }}" 
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
                                               value="{{ old('end_time', $quiz->end_time ? $quiz->end_time->format('Y-m-d\TH:i') : '') }}" 
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
                                           {{ ((!$quiz->hasQuizFile() && $quiz->questions->count() > 0) || old('quiz_type') == 'questions') ? 'checked' : '' }}>
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
                                           {{ ($quiz->hasQuizFile() || old('quiz_type') == 'file') ? 'checked' : '' }}>
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
                        <div class="form-section" id="file-section" style="display: {{ ($quiz->hasQuizFile() || old('quiz_type') == 'file') ? 'block' : 'none' }};">
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
                        <div class="form-section" id="questions-section" style="display: {{ ((!$quiz->hasQuizFile() && $quiz->questions->count() > 0) || old('quiz_type') == 'questions') ? 'block' : 'none' }};">
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
                            <button type="submit" class="modern-btn btn-update">
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
</div>
 <footer class="main-footer">
    <strong>Copyright &copy; <span id="currentYear"></span> <a href="https://sumajkt.go.tz">Visit Our Website</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      {{-- <b>Version</b> 3.2.0 --}}
    </div>
</footer>


<!-- JavaScript to dynamically add more questions -->
<script>
    let questionCount = {{ $quiz->questions->count() }};
    document.getElementById('add-question').addEventListener('click', function () {
        const container = document.getElementById('questions-container');
        const newQuestion = `
            <div class="form-group mt-4">
                <label for="question">Question ${questionCount + 1}</label>
                <input type="text" name="questions[${questionCount}][question_text]" class="form-control" placeholder="Enter question" required>
                <input type="text" name="questions[${questionCount}][option1]" class="form-control mt-2" placeholder="Option 1" required>
                <input type="text" name="questions[${questionCount}][option2]" class="form-control mt-2" placeholder="Option 2" required>
                <input type="text" name="questions[${questionCount}][option3]" class="form-control mt-2" placeholder="Option 3" required>
                <input type="text" name="questions[${questionCount}][option4]" class="form-control mt-2" placeholder="Option 4" required>
                <input type="text" name="questions[${questionCount}][correct_option]" class="form-control mt-2" placeholder="Correct Answer (e.g., option1)" required>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', newQuestion);
        questionCount++;
    });
</script>


<script>
    document.getElementById('class_id').addEventListener('change', function() {
    const classId = this.value;
    
    // Fetch subjects based on the selected class
    fetch(`/admin/get-subjects/${classId}`)
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize quiz type detection on page load
    detectAndSetQuizType();
    
    // Add event listeners for quiz type changes
    const typeRadios = document.querySelectorAll('input[name="type"]');
    typeRadios.forEach(radio => {
        radio.addEventListener('change', handleQuizTypeChange);
    });

    // Add animation classes
    setTimeout(() => {
        const formSections = document.querySelectorAll('.form-section');
        formSections.forEach((section, index) => {
            section.style.animationDelay = `${index * 0.1}s`;
            section.classList.add('animate-in');
        });
    }, 100);

    // Initialize file upload functionality
    initializeFileUpload();
    
    // Initialize questions management
    initializeQuestionsSection();
});

// Automatically detect quiz type based on existing content
function detectAndSetQuizType() {
    const hasQuestions = {{ count($quiz->questions ?? []) }};
    const hasFile = "{{ $quiz->file_url ?? '' }}" !== "";
    
    let detectedType = 'multiple_choice'; // default
    
    if (hasFile && hasQuestions > 0) {
        // If both exist, determine based on predominant type
        detectedType = hasQuestions > 2 ? 'multiple_choice' : 'file';
    } else if (hasFile) {
        detectedType = 'file';
    } else if (hasQuestions > 0) {
        detectedType = 'multiple_choice';
    }
    
    // Set the detected type
    const typeRadio = document.querySelector(`input[name="type"][value="${detectedType}"]`);
    if (typeRadio) {
        typeRadio.checked = true;
        handleQuizTypeChange({ target: typeRadio });
        
        // Show detection notification
        showNotification(`Quiz type automatically detected as: ${detectedType.replace('_', ' ').toUpperCase()}`, 'info');
    }
}

// Handle quiz type changes
function handleQuizTypeChange(e) {
    const selectedType = e.target.value;
    
    // Update visual states
    updateQuizTypeCards(selectedType);
    
    // Show/hide relevant sections
    toggleSections(selectedType);
    
    // Update form validation
    updateValidation(selectedType);
}

// Update quiz type card appearances
function updateQuizTypeCards(selectedType) {
    const typeCards = document.querySelectorAll('.quiz-type-card');
    typeCards.forEach(card => {
        const radio = card.querySelector('input[type="radio"]');
        if (radio.value === selectedType) {
            card.classList.add('selected');
        } else {
            card.classList.remove('selected');
        }
    });
}

// Show/hide sections based on quiz type
function toggleSections(type) {
    const fileSection = document.getElementById('file-upload-section');
    const questionsSection = document.getElementById('questions-section');
    
    if (type === 'file') {
        showSection(fileSection);
        hideSection(questionsSection);
    } else if (type === 'multiple_choice') {
        hideSection(fileSection);
        showSection(questionsSection);
    }
}

function showSection(section) {
    if (section) {
        section.style.display = 'block';
        setTimeout(() => section.classList.add('fade-in'), 10);
    }
}

function hideSection(section) {
    if (section) {
        section.classList.remove('fade-in');
        setTimeout(() => section.style.display = 'none', 300);
    }
}

// Initialize file upload functionality
function initializeFileUpload() {
    const dropZone = document.getElementById('file-drop-zone');
    const fileInput = document.getElementById('quiz-file');
    
    if (!dropZone || !fileInput) return;
    
    // Drag and drop events
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, preventDefaults, false);
    });
    
    ['dragenter', 'dragover'].forEach(eventName => {
        dropZone.addEventListener(eventName, highlight, false);
    });
    
    ['dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, unhighlight, false);
    });
    
    dropZone.addEventListener('drop', handleDrop, false);
    dropZone.addEventListener('click', () => fileInput.click());
    fileInput.addEventListener('change', handleFileSelect);
    
    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }
    
    function highlight() {
        dropZone.classList.add('dragover');
    }
    
    function unhighlight() {
        dropZone.classList.remove('dragover');
    }
    
    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        handleFiles(files);
    }
    
    function handleFileSelect(e) {
        handleFiles(e.target.files);
    }
    
    function handleFiles(files) {
        if (files.length > 0) {
            const file = files[0];
            displayFileInfo(file);
            validateFile(file);
        }
    }
    
    function displayFileInfo(file) {
        const fileInfo = document.getElementById('file-info');
        if (fileInfo) {
            const sizeInMB = (file.size / (1024 * 1024)).toFixed(2);
            fileInfo.innerHTML = `
                <div class="file-details">
                    <i class="fas fa-file-alt"></i>
                    <div class="file-meta">
                        <div class="file-name">${file.name}</div>
                        <div class="file-size">${sizeInMB} MB</div>
                    </div>
                </div>
            `;
            fileInfo.style.display = 'block';
        }
    }
    
    function validateFile(file) {
        const maxSize = 50 * 1024 * 1024; // 50MB
        const allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
        
        if (file.size > maxSize) {
            showNotification('File size must be less than 50MB', 'error');
            return false;
        }
        
        if (!allowedTypes.includes(file.type)) {
            showNotification('Only PDF and Word documents are allowed', 'error');
            return false;
        }
        
        showNotification('File selected successfully', 'success');
        return true;
    }
}

// Initialize questions section
function initializeQuestionsSection() {
    // Add question button
    const addQuestionBtn = document.getElementById('add-question-btn');
    if (addQuestionBtn) {
        addQuestionBtn.addEventListener('click', addNewQuestion);
    }
    
    // Initialize existing question events
    initializeQuestionEvents();
}

function addNewQuestion() {
    const questionsContainer = document.getElementById('questions-container');
    const questionCount = questionsContainer.children.length + 1;
    
    const questionHtml = `
        <div class="question-item" data-question="${questionCount}">
            <div class="question-header">
                <h5><i class="fas fa-question-circle"></i> Question ${questionCount}</h5>
                <button type="button" class="btn btn-danger btn-sm remove-question">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
            <div class="form-group">
                <label>Question Text</label>
                <textarea name="questions[${questionCount}][question]" class="form-control" rows="3" placeholder="Enter your question..." required></textarea>
            </div>
            <div class="form-group">
                <label>Answer Options</label>
                <div class="options-container">
                    ${[1,2,3,4].map(i => `
                        <div class="option-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input type="radio" name="questions[${questionCount}][correct_answer]" value="${i}" required>
                                    </div>
                                </div>
                                <input type="text" name="questions[${questionCount}][options][]" class="form-control" placeholder="Option ${i}" required>
                            </div>
                        </div>
                    `).join('')}
                </div>
            </div>
        </div>
    `;
    
    questionsContainer.insertAdjacentHTML('beforeend', questionHtml);
    initializeQuestionEvents();
    
    // Animate new question
    const newQuestion = questionsContainer.lastElementChild;
    newQuestion.style.opacity = '0';
    newQuestion.style.transform = 'translateY(20px)';
    setTimeout(() => {
        newQuestion.style.transition = 'all 0.3s ease';
        newQuestion.style.opacity = '1';
        newQuestion.style.transform = 'translateY(0)';
    }, 10);
}

function initializeQuestionEvents() {
    // Remove question buttons
    document.querySelectorAll('.remove-question').forEach(btn => {
        btn.removeEventListener('click', removeQuestion); // Prevent duplicate listeners
        btn.addEventListener('click', removeQuestion);
    });
}

function removeQuestion(e) {
    const questionItem = e.target.closest('.question-item');
    if (confirm('Are you sure you want to remove this question?')) {
        questionItem.style.transition = 'all 0.3s ease';
        questionItem.style.opacity = '0';
        questionItem.style.transform = 'translateX(-100%)';
        setTimeout(() => {
            questionItem.remove();
            renumberQuestions();
        }, 300);
    }
}

function renumberQuestions() {
    const questions = document.querySelectorAll('.question-item');
    questions.forEach((question, index) => {
        const newNumber = index + 1;
        question.dataset.question = newNumber;
        question.querySelector('h5').innerHTML = `<i class="fas fa-question-circle"></i> Question ${newNumber}`;
        
        // Update form field names
        const textarea = question.querySelector('textarea');
        const options = question.querySelectorAll('input[type="text"]');
        const radios = question.querySelectorAll('input[type="radio"]');
        
        textarea.name = `questions[${newNumber}][question]`;
        radios.forEach(radio => {
            radio.name = `questions[${newNumber}][correct_answer]`;
        });
        options.forEach(option => {
            option.name = `questions[${newNumber}][options][]`;
        });
    });
}

// Update form validation based on quiz type
function updateValidation(type) {
    const fileInput = document.getElementById('quiz-file');
    const questionTextareas = document.querySelectorAll('textarea[name*="question"]');
    
    if (type === 'file') {
        // File type validation
        if (fileInput) fileInput.required = true;
        questionTextareas.forEach(textarea => textarea.required = false);
    } else if (type === 'multiple_choice') {
        // Multiple choice validation
        if (fileInput) fileInput.required = false;
        questionTextareas.forEach(textarea => textarea.required = true);
    }
}

// Notification system
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `alert alert-${type === 'error' ? 'danger' : type} alert-dismissible fade show notification-popup`;
    notification.innerHTML = `
        <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-triangle' : 'info-circle'}"></i>
        ${message}
        <button type="button" class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.remove();
    }, 5000);
}

// Form submission handling
document.querySelector('form').addEventListener('submit', function(e) {
    const selectedType = document.querySelector('input[name="type"]:checked')?.value;
    
    if (!selectedType) {
        e.preventDefault();
        showNotification('Please select a quiz type', 'error');
        return;
    }
    
    // Additional validation based on type
    if (selectedType === 'multiple_choice') {
        const questions = document.querySelectorAll('.question-item');
        if (questions.length === 0) {
            e.preventDefault();
            showNotification('Please add at least one question for multiple choice quiz', 'error');
            return;
        }
        
        // Validate each question has correct answer selected
        let hasErrors = false;
        questions.forEach((question, index) => {
            const correctAnswer = question.querySelector('input[name*="correct_answer"]:checked');
            if (!correctAnswer) {
                hasErrors = true;
                showNotification(`Please select the correct answer for Question ${index + 1}`, 'error');
            }
        });
        
        if (hasErrors) {
            e.preventDefault();
            return;
        }
    }
    
    showNotification('Saving quiz...', 'info');
});
</script>

<style>
.animate-in {
    animation: slideInUp 0.5s ease-out forwards;
}

@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.fade-in {
    animation: fadeIn 0.3s ease-in-out;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

.notification-popup {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 9999;
    min-width: 300px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.file-details {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px;
    background: #f8f9fa;
    border-radius: 5px;
    margin-top: 10px;
}

.file-details i {
    font-size: 24px;
    color: #007bff;
}

.file-meta {
    flex: 1;
}

.file-name {
    font-weight: 500;
    color: #333;
}

.file-size {
    font-size: 12px;
    color: #666;
}

.option-group {
    margin-bottom: 10px;
}

.question-item {
    transition: all 0.3s ease;
}

.dragover {
    border-color: #007bff !important;
    background-color: rgba(0,123,255,0.05) !important;
}
</style>

@endsection
