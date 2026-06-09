@extends('components.dashmaster')

@section('body')

<style>
/* Enhanced Quiz Upload Form Styling */
.quiz-upload-container {
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
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    color: #9b59b6;
    text-decoration: none;
    border-color: #9b59b6;
}

.back-btn i {
    margin-right: 8px;
}

.page-header {
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    margin-bottom: 30px;
    padding: 40px;
    animation: fadeInDown 0.8s ease;
    position: relative;
    overflow: hidden;
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
}

.page-title i {
    margin-right: 15px;
    color: #9b59b6;
    background: linear-gradient(135deg, #9b59b6, #8e44ad);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.page-description {
    color: #7f8c8d;
    font-size: 1.2rem;
    margin: 0;
    position: relative;
    z-index: 1;
    line-height: 1.6;
}

.form-container {
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    animation: fadeInUp 0.8s ease;
}

.form-header {
    background: linear-gradient(135deg, #9b59b6 0%, #8e44ad 100%);
    color: white;
    padding: 30px 40px;
    position: relative;
}

.form-title {
    margin: 0;
    font-size: 1.8rem;
    font-weight: 600;
    display: flex;
    align-items: center;
}

.form-title i {
    margin-right: 12px;
    color: #f8c291;
}

.form-body {
    padding: 40px;
    background: white;
}

.form-section {
    margin-bottom: 35px;
    position: relative;
}

.section-title {
    color: #2c3e50;
    font-size: 1.3rem;
    font-weight: 600;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid #ecf0f1;
    display: flex;
    align-items: center;
}

.section-title i {
    margin-right: 10px;
    color: #9b59b6;
    font-size: 1.2rem;
}

.form-group {
    margin-bottom: 25px;
    position: relative;
}

.form-label {
    display: block;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 8px;
    font-size: 1rem;
    position: relative;
}

.form-label i {
    margin-right: 8px;
    color: #9b59b6;
    width: 16px;
    text-align: center;
}

.form-label .required {
    color: #e74c3c;
    margin-left: 3px;
}

.form-control {
    width: 100%;
    padding: 15px 20px;
    border: 2px solid #e9ecef;
    border-radius: 15px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: #f8f9fa;
    color: #2c3e50;
}

.form-control:focus {
    outline: none;
    border-color: #9b59b6;
    background: white;
    box-shadow: 0 0 20px rgba(155, 89, 182, 0.1);
    transform: translateY(-1px);
}

.form-control::placeholder {
    color: #7f8c8d;
    font-style: italic;
}

.form-control.is-invalid {
    border-color: #e74c3c;
    background: #fdf2f2;
}

.form-control.is-valid {
    border-color: #27ae60;
    background: #f2f8f4;
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

.success-message {
    color: #27ae60;
    font-size: 0.9rem;
    margin-top: 5px;
    display: flex;
    align-items: center;
    font-weight: 500;
}

.success-message i {
    margin-right: 5px;
    font-size: 0.8rem;
}

.file-upload-area {
    border: 3px dashed #9b59b6;
    border-radius: 20px;
    padding: 40px 20px;
    text-align: center;
    background: linear-gradient(135deg, #f8f4fd 0%, #f0e6ff 100%);
    transition: all 0.3s ease;
    cursor: pointer;
    position: relative;
    overflow: hidden;
}

.file-upload-area:hover {
    border-color: #8e44ad;
    background: linear-gradient(135deg, #f4f0fc 0%, #ebe0ff 100%);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(155, 89, 182, 0.2);
}

.file-upload-area.dragover {
    border-color: #27ae60;
    background: linear-gradient(135deg, #f0f8f4 0%, #e6f7ed 100%);
}

.file-upload-icon {
    font-size: 3rem;
    color: #9b59b6;
    margin-bottom: 15px;
    display: block;
}

.file-upload-text {
    font-size: 1.2rem;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 10px;
}

.file-upload-hint {
    color: #7f8c8d;
    font-size: 0.95rem;
    line-height: 1.5;
}

.file-upload-input {
    position: absolute;
    opacity: 0;
    width: 100%;
    height: 100%;
    cursor: pointer;
}

.file-selected {
    display: none;
    margin-top: 15px;
    padding: 10px 15px;
    background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
    border: 1px solid #27ae60;
    border-radius: 10px;
    color: #155724;
    font-weight: 500;
}

.file-selected i {
    margin-right: 8px;
    color: #27ae60;
}

.duration-helper {
    background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);
    border: 1px solid #f39c12;
    border-radius: 10px;
    padding: 15px;
    margin-top: 10px;
    color: #856404;
    font-size: 0.9rem;
    line-height: 1.5;
}

.duration-helper i {
    margin-right: 8px;
    color: #f39c12;
}

.form-actions {
    margin-top: 40px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
    flex-wrap: wrap;
}

.submit-btn {
    background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
    color: white;
    padding: 15px 40px;
    border: none;
    border-radius: 25px;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    text-transform: uppercase;
    letter-spacing: 1px;
    box-shadow: 0 5px 15px rgba(39, 174, 96, 0.3);
    min-width: 200px;
    justify-content: center;
}

.submit-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(39, 174, 96, 0.4);
}

.submit-btn:disabled {
    background: #bdc3c7;
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
}

.submit-btn i {
    margin-right: 10px;
    font-size: 1.2rem;
}

.submit-btn.loading {
    pointer-events: none;
}

.submit-btn.loading i {
    animation: spin 1s linear infinite;
}

.draft-btn {
    background: linear-gradient(135deg, #95a5a6 0%, #7f8c8d 100%);
    color: white;
    padding: 15px 30px;
    border: none;
    border-radius: 25px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    text-transform: uppercase;
    letter-spacing: 1px;
    box-shadow: 0 5px 15px rgba(149, 165, 166, 0.3);
}

.draft-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(149, 165, 166, 0.4);
}

.draft-btn i {
    margin-right: 8px;
}

.progress-indicator {
    display: none;
    margin-top: 20px;
    background: white;
    border-radius: 10px;
    padding: 15px;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
}

.progress-bar-container {
    background: #ecf0f1;
    border-radius: 10px;
    height: 8px;
    overflow: hidden;
    margin-bottom: 10px;
}

.progress-bar {
    background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
    height: 100%;
    border-radius: 10px;
    transition: width 0.3s ease;
    width: 0%;
}

.progress-text {
    font-size: 0.9rem;
    color: #7f8c8d;
    text-align: center;
}

/* Responsive Design */
@media (max-width: 768px) {
    .page-title {
        font-size: 2rem;
        text-align: center;
        flex-direction: column;
        gap: 10px;
    }
    
    .form-body {
        padding: 20px;
    }
    
    .form-actions {
        flex-direction: column;
        align-items: stretch;
    }
    
    .submit-btn, .draft-btn {
        width: 100%;
        justify-content: center;
    }
    
    .file-upload-area {
        padding: 30px 15px;
    }
}

/* Animations */
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

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Form validation states */
.was-validated .form-control:valid {
    border-color: #27ae60;
    background-color: #f2f8f4;
}

.was-validated .form-control:invalid {
    border-color: #e74c3c;
    background-color: #fdf2f2;
}

/* Print styles */
@media print {
    .back-navigation,
    .form-actions,
    footer {
        display: none !important;
    }
    
    .quiz-upload-container {
        background: white !important;
    }
    
    .page-header,
    .form-container {
        box-shadow: none !important;
        border: 1px solid #ddd;
    }
}
</style>

<div class="content-wrapper quiz-upload-container">
    <div class="container-fluid">
        <!-- Back Navigation -->
        <div class="back-navigation">
            <a href="{{ route('quizzes.index') }}" class="back-btn">
                <i class="fas fa-arrow-left"></i>
                Back to Quiz Management
            </a>
        </div>

        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">
                <i class="fas fa-cloud-upload-alt"></i>
                Upload New Quiz
            </h1>
            <p class="page-description">
                Upload a quiz file and configure the quiz settings. Supported formats include CSV, JSON, and Excel files with quiz questions and answers.
            </p>
        </div>

        <!-- Form Container -->
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-8">
                <div class="form-container">
                    <div class="form-header">
                        <h2 class="form-title">
                            <i class="fas fa-file-upload"></i>
                            Quiz Upload Form
                        </h2>
                    </div>
                    
                    <div class="form-body">
                        <form id="quizUploadForm" action="{{ route('quizzes.upload.post') }}" method="POST" enctype="multipart/form-data" novalidate>
                            @csrf
                            
                            <!-- Quiz Basic Information Section -->
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
                                                   placeholder="Enter a descriptive quiz title..."
                                                   required>
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
                                            <label class="form-label" for="description">
                                                <i class="fas fa-align-left"></i>
                                                Quiz Description<span class="required">*</span>
                                            </label>
                                            <input type="text" 
                                                   name="description" 
                                                   id="description" 
                                                   class="form-control @error('description') is-invalid @enderror" 
                                                   value="{{ old('description') }}" 
                                                   placeholder="Brief description of the quiz content..."
                                                   required>
                                            @error('description')
                                                <div class="error-message">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Class and Subject Section -->
                            <div class="form-section">
                                <div class="section-title">
                                    <i class="fas fa-users"></i>
                                    Assignment Details
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="class_id">
                                                <i class="fas fa-chalkboard"></i>
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
                                    <div class="col-md-4">
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
                                    <div class="col-md-4">
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
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label" for="duration">
                                                <i class="fas fa-stopwatch"></i>
                                                Duration (minutes)<span class="required">*</span>
                                            </label>
                                            <input type="number" 
                                                   name="duration" 
                                                   id="duration" 
                                                   class="form-control @error('duration') is-invalid @enderror" 
                                                   value="{{ old('duration') }}" 
                                                   min="1" 
                                                   max="300"
                                                   placeholder="e.g., 60"
                                                   required>
                                            @error('duration')
                                                <div class="error-message">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="duration-helper">
                                                <i class="fas fa-lightbulb"></i>
                                                Recommended: 1-2 minutes per question. For a 20-question quiz, consider 30-45 minutes.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- File Upload Section -->
                            <div class="form-section">
                                <div class="section-title">
                                    <i class="fas fa-file-import"></i>
                                    Quiz File Upload
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label" for="quiz_file">
                                        <i class="fas fa-file-upload"></i>
                                        Quiz File<span class="required">*</span>
                                    </label>
                                    <div class="file-upload-area" id="fileUploadArea">
                                        <input type="file" 
                                               class="file-upload-input" 
                                               id="quiz_file" 
                                               name="quiz_file" 
                                               accept=".csv,.xlsx,.xls,.json,.pdf,.docx,.doc"
                                               required>
                                        <i class="fas fa-cloud-upload-alt file-upload-icon"></i>
                                        <div class="file-upload-text">Click to select or drag & drop your quiz file</div>
                                        <div class="file-upload-hint">
                                            <strong>Supported formats:</strong><br>
                                            • <strong>CSV/Excel (.csv, .xlsx, .xls):</strong> Structured question data<br>
                                            • <strong>JSON (.json):</strong> Question objects with answers<br>
                                            • <strong>PDF (.pdf):</strong> Question sets with answer keys<br>
                                            • <strong>Word (.docx, .doc):</strong> Formatted quiz documents<br>
                                            <em>Maximum file size: 10MB</em>
                                        </div>
                                        <div class="file-selected" id="fileSelected">
                                            <i class="fas fa-check-circle"></i>
                                            <span id="fileName">No file selected</span>
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

                            <!-- Progress Indicator -->
                            <div class="progress-indicator" id="progressIndicator">
                                <div class="progress-bar-container">
                                    <div class="progress-bar" id="progressBar"></div>
                                </div>
                                <div class="progress-text" id="progressText">Uploading...</div>
                            </div>

                            <!-- Form Actions -->
                            <div class="form-actions">
                                <button type="button" class="draft-btn" id="saveDraftBtn">
                                    <i class="fas fa-save"></i>
                                    Save as Draft
                                </button>
                                <button type="submit" class="submit-btn" id="submitBtn">
                                    <i class="fas fa-upload"></i>
                                    Upload Quiz
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="main-footer">
    <strong>Copyright &copy; <span id="currentYear"></span> <a href="https://sumajkt.go.tz">Visit Our Website</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        {{-- <b>Version</b> 3.2.0 --}}
    </div>
</footer>

<!-- Enhanced Page Scripts -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    // Setup CSRF token for all AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Enhanced notification system
    function showNotification(type, title, message) {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        Toast.fire({
            icon: type,
            title: title,
            text: message
        });
    }

    // Class and Subject dropdown handling
    $('#class_id').on('change', function() {
        const classId = this.value;
        const subjectSelect = $('#subject_id');
        
        if (classId) {
            // Show loading state
            subjectSelect.html('<option value="">Loading subjects...</option>').prop('disabled', true);
            
            // Fetch subjects based on the selected class
            $.get(`/teacher/get-subjects/${classId}`)
                .done(function(data) {
                    subjectSelect.html('<option value="">Select Subject</option>').prop('disabled', false);
                    
                    // Populate the subjects dropdown
                    data.forEach(subject => {
                        subjectSelect.append(`<option value="${subject.id}">${subject.name}</option>`);
                    });
                    
                    // Restore old selection if exists
                    const oldSubject = '{{ old('subject_id') }}';
                    if (oldSubject) {
                        subjectSelect.val(oldSubject);
                    }
                })
                .fail(function() {
                    subjectSelect.html('<option value="">Error loading subjects</option>').prop('disabled', false);
                    showNotification('error', 'Error', 'Failed to load subjects. Please try again.');
                });
        } else {
            subjectSelect.html('<option value="">First select a class...</option>').prop('disabled', false);
        }
    });

    // Trigger class change on page load if value exists
    if ($('#class_id').val()) {
        $('#class_id').trigger('change');
    }

    // Enhanced file upload handling
    const fileInput = $('#quiz_file');
    const fileUploadArea = $('#fileUploadArea');
    const fileSelected = $('#fileSelected');
    const fileName = $('#fileName');

    // File input change handler
    fileInput.on('change', function() {
        const file = this.files[0];
        if (file) {
            // Validate file size (10MB limit)
            if (file.size > 10 * 1024 * 1024) {
                showNotification('error', 'File Too Large', 'Please select a file smaller than 10MB.');
                this.value = '';
                return;
            }

            // Validate file type
            const allowedTypes = ['.csv', '.xlsx', '.xls', '.json', '.pdf', '.docx', '.doc'];
            const fileExtension = '.' + file.name.split('.').pop().toLowerCase();
            
            if (!allowedTypes.includes(fileExtension)) {
                showNotification('error', 'Invalid File Type', 'Please select a CSV, Excel, JSON, PDF, or Word document file.');
                this.value = '';
                return;
            }

            // Get file type icon
            let fileIcon = 'fas fa-file';
            let fileTypeText = 'Document';
            
            switch(fileExtension) {
                case '.csv':
                    fileIcon = 'fas fa-file-csv';
                    fileTypeText = 'CSV Spreadsheet';
                    break;
                case '.xlsx':
                case '.xls':
                    fileIcon = 'fas fa-file-excel';
                    fileTypeText = 'Excel Spreadsheet';
                    break;
                case '.json':
                    fileIcon = 'fas fa-file-code';
                    fileTypeText = 'JSON Data';
                    break;
                case '.pdf':
                    fileIcon = 'fas fa-file-pdf';
                    fileTypeText = 'PDF Document';
                    break;
                case '.docx':
                case '.doc':
                    fileIcon = 'fas fa-file-word';
                    fileTypeText = 'Word Document';
                    break;
            }

            // Show selected file with appropriate icon
            fileSelected.find('i').removeClass().addClass(fileIcon);
            fileName.html(`${file.name} <small style="color: #7f8c8d;">(${fileTypeText})</small>`);
            fileSelected.show();
            fileUploadArea.addClass('file-selected-state');
            
            // Show appropriate success message with format guidance
            let formatGuidance = '';
            switch(fileExtension) {
                case '.csv':
                case '.xlsx':
                case '.xls':
                    formatGuidance = 'Ensure your spreadsheet has columns for questions, options, and correct answers.';
                    break;
                case '.json':
                    formatGuidance = 'Make sure your JSON follows the quiz structure format.';
                    break;
                case '.pdf':
                    formatGuidance = 'PDF will be processed for quiz questions and answers.';
                    break;
                case '.docx':
                case '.doc':
                    formatGuidance = 'Word document will be parsed for quiz content.';
                    break;
            }
            
            showNotification('success', 'File Selected', `${file.name} selected successfully. ${formatGuidance}`);
        } else {
            fileSelected.hide();
            fileUploadArea.removeClass('file-selected-state');
        }
    });

    // Drag and drop functionality
    fileUploadArea.on('dragover', function(e) {
        e.preventDefault();
        $(this).addClass('dragover');
    });

    fileUploadArea.on('dragleave', function(e) {
        e.preventDefault();
        $(this).removeClass('dragover');
    });

    fileUploadArea.on('drop', function(e) {
        e.preventDefault();
        $(this).removeClass('dragover');
        
        const files = e.originalEvent.dataTransfer.files;
        if (files.length > 0) {
            fileInput[0].files = files;
            fileInput.trigger('change');
        }
    });

    // Click area to open file dialog
    fileUploadArea.on('click', function() {
        fileInput.click();
    });

    // Time validation
    $('#start_time, #end_time').on('change', function() {
        const startTime = new Date($('#start_time').val());
        const endTime = new Date($('#end_time').val());
        const now = new Date();

        if (startTime && startTime < now) {
            showNotification('warning', 'Past Date Selected', 'Start time should be in the future.');
        }

        if (startTime && endTime) {
            if (endTime <= startTime) {
                showNotification('error', 'Invalid Time Range', 'End time must be after start time.');
                $('#end_time')[0].setCustomValidity('End time must be after start time');
            } else {
                $('#end_time')[0].setCustomValidity('');
                
                // Calculate and suggest duration
                const diffMinutes = Math.round((endTime - startTime) / (1000 * 60));
                if (diffMinutes > 0 && !$('#duration').val()) {
                    $('#duration').val(diffMinutes);
                    showNotification('info', 'Duration Suggested', `Suggested duration: ${diffMinutes} minutes based on your schedule.`);
                }
            }
        }
    });

    // Duration validation and hints
    $('#duration').on('input', function() {
        const duration = parseInt(this.value);
        
        if (duration > 0) {
            let message = '';
            let type = 'info';
            
            if (duration < 10) {
                message = 'Very short quiz - suitable for quick assessments';
                type = 'info';
            } else if (duration <= 30) {
                message = 'Short quiz - good for regular assessments';
                type = 'success';
            } else if (duration <= 60) {
                message = 'Medium quiz - standard length for most subjects';
                type = 'success';
            } else if (duration <= 120) {
                message = 'Long quiz - ensure students have adequate time';
                type = 'warning';
            } else {
                message = 'Very long quiz - consider breaking into multiple sessions';
                type = 'warning';
            }
        }
    });

    // Form validation enhancement
    const form = $('#quizUploadForm');
    
    // Real-time validation
    form.find('.form-control').on('blur', function() {
        validateField($(this));
    });

    function validateField(field) {
        const value = field.val().trim();
        const isRequired = field.prop('required');
        
        field.removeClass('is-valid is-invalid');
        field.next('.error-message, .success-message').remove();
        
        if (isRequired && !value) {
            field.addClass('is-invalid');
            field.after('<div class="error-message"><i class="fas fa-exclamation-triangle"></i> This field is required</div>');
            return false;
        }
        
        // Specific validations
        if (field.attr('id') === 'title' && value.length < 3) {
            field.addClass('is-invalid');
            field.after('<div class="error-message"><i class="fas fa-exclamation-triangle"></i> Title must be at least 3 characters long</div>');
            return false;
        }
        
        if (field.attr('id') === 'duration') {
            const duration = parseInt(value);
            if (duration < 1 || duration > 300) {
                field.addClass('is-invalid');
                field.after('<div class="error-message"><i class="fas fa-exclamation-triangle"></i> Duration must be between 1 and 300 minutes</div>');
                return false;
            }
        }
        
        if (value) {
            field.addClass('is-valid');
            field.after('<div class="success-message"><i class="fas fa-check"></i> Looks good!</div>');
        }
        
        return true;
    }

    // Enhanced form submission
    form.on('submit', function(e) {
        e.preventDefault();
        
        // Validate all fields
        let isValid = true;
        form.find('.form-control[required]').each(function() {
            if (!validateField($(this))) {
                isValid = false;
            }
        });

        if (!isValid) {
            showNotification('error', 'Validation Error', 'Please correct the errors in the form.');
            return;
        }

        // Show confirmation dialog
        Swal.fire({
            title: 'Upload Quiz?',
            html: `
                <div style="text-align: left; margin: 20px 0;">
                    <p><strong>Quiz Title:</strong> ${$('#title').val()}</p>
                    <p><strong>Class:</strong> ${$('#class_id option:selected').text()}</p>
                    <p><strong>Subject:</strong> ${$('#subject_id option:selected').text()}</p>
                    <p><strong>Duration:</strong> ${$('#duration').val()} minutes</p>
                    <p><strong>File:</strong> ${$('#quiz_file')[0].files[0]?.name || 'No file selected'}</p>
                </div>
                <p style="color: #7f8c8d; font-size: 0.9rem;">Make sure all information is correct before uploading.</p>
            `,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#27ae60',
            cancelButtonColor: '#95a5a6',
            confirmButtonText: 'Yes, Upload Quiz',
            cancelButtonText: 'Review Again'
        }).then((result) => {
            if (result.isConfirmed) {
                submitForm();
            }
        });
    });

    function submitForm() {
        const submitBtn = $('#submitBtn');
        const progressIndicator = $('#progressIndicator');
        const progressBar = $('#progressBar');
        const progressText = $('#progressText');

        // Disable form and show loading
        submitBtn.addClass('loading').prop('disabled', true);
        submitBtn.find('i').removeClass('fa-upload').addClass('fa-spinner');
        progressIndicator.show();

        // Simulate progress (in real implementation, you'd track actual upload progress)
        let progress = 0;
        const progressInterval = setInterval(() => {
            progress += Math.random() * 30;
            if (progress > 90) progress = 90;
            
            progressBar.css('width', progress + '%');
            progressText.text(`Uploading... ${Math.round(progress)}%`);
        }, 500);

        // Submit form
        const formData = new FormData(form[0]);
        
        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                clearInterval(progressInterval);
                progressBar.css('width', '100%');
                progressText.text('Upload complete!');
                
                setTimeout(() => {
                    showNotification('success', 'Quiz Uploaded!', 'Your quiz has been uploaded successfully.');
                    window.location.href = "{{ route('quizzes.index') }}";
                }, 1000);
            },
            error: function(xhr) {
                clearInterval(progressInterval);
                progressIndicator.hide();
                
                // Re-enable form
                submitBtn.removeClass('loading').prop('disabled', false);
                submitBtn.find('i').removeClass('fa-spinner').addClass('fa-upload');
                
                let errorMessage = 'Failed to upload quiz. Please try again.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                    // Handle validation errors
                    const errors = xhr.responseJSON.errors;
                    Object.keys(errors).forEach(field => {
                        const fieldElement = $(`#${field}`);
                        fieldElement.addClass('is-invalid');
                        fieldElement.after(`<div class="error-message"><i class="fas fa-exclamation-triangle"></i> ${errors[field][0]}</div>`);
                    });
                }
                
                showNotification('error', 'Upload Failed', errorMessage);
            }
        });
    }

    // Save as draft functionality
    $('#saveDraftBtn').on('click', function() {
        showNotification('info', 'Draft Feature', 'Draft saving functionality will be implemented soon.');
    });

    // Keyboard shortcuts
    $(document).keydown(function(e) {
        // Ctrl/Cmd + S to save
        if ((e.ctrlKey || e.metaKey) && e.which === 83) {
            e.preventDefault();
            $('#saveDraftBtn').click();
        }
        
        // Ctrl/Cmd + Enter to submit
        if ((e.ctrlKey || e.metaKey) && e.which === 13) {
            e.preventDefault();
            form.submit();
        }
    });

    // Initialize tooltips
    $('[title]').tooltip({
        placement: 'top',
        trigger: 'hover'
    });

    // Footer year
    document.getElementById("currentYear").textContent = new Date().getFullYear();

    console.log('✅ Enhanced Quiz Upload form loaded successfully!');
    console.log('⌨️  Keyboard shortcuts: Ctrl+S (Save Draft), Ctrl+Enter (Submit)');
});

// Success/Error message handling from server
@if(session('success'))
    $(document).ready(function() {
        showNotification('success', 'Success!', '{{ session('success') }}');
    });
@endif

@if(session('error'))
    $(document).ready(function() {
        showNotification('error', 'Error!', '{{ session('error') }}');
    });
@endif
</script>
    
@endsection

