@extends('components.dashmaster')

@section('body')

<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- SweetAlert2 CSS and JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>

<style>
/* Enhanced Quiz Upload Styling */
.upload-container {
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

.upload-badge {
    background: linear-gradient(45deg, #e67e22, #f39c12);
    color: white;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    box-shadow: 0 4px 15px rgba(230, 126, 34, 0.3);
    position: relative;
    z-index: 1;
}

.upload-form-card {
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
    margin-bottom: 30px;
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

.file-upload-area {
    border: 3px dashed #d1d8e0;
    border-radius: 15px;
    padding: 40px 20px;
    text-align: center;
    background: #f8f9fa;
    transition: all 0.3s ease;
    position: relative;
    cursor: pointer;
}

.file-upload-area:hover {
    border-color: #667eea;
    background: #f0f3ff;
}

.file-upload-area.dragover {
    border-color: #667eea;
    background: linear-gradient(135deg, #f0f3ff 0%, #e8efff 100%);
    transform: scale(1.02);
}

.upload-icon {
    font-size: 3rem;
    color: #667eea;
    margin-bottom: 15px;
}

.upload-text {
    color: #2c3e50;
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 8px;
}

.upload-subtext {
    color: #7f8c8d;
    font-size: 0.85rem;
    line-height: 1.6;
}

.upload-subtext div {
    margin-bottom: 4px;
}

.upload-subtext strong {
    color: #2c3e50;
}

.file-upload-area {
    position: relative;
    z-index: 1;
}

.file-upload-area input[type="file"] {
    position: absolute;
    opacity: 0;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    cursor: pointer;
    z-index: 999;
}

.selected-file {
    background: linear-gradient(45deg, #27ae60, #2ecc71);
    color: white;
    padding: 12px 20px;
    border-radius: 10px;
    margin-top: 15px;
    display: inline-flex;
    align-items: center;
    font-weight: 600;
    animation: fadeInUp 0.5s ease;
}

.selected-file i {
    margin-right: 10px;
}

.time-inputs-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

.class-subject-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
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

.submit-btn.btn-clicked {
    transform: translateY(0px) scale(0.98);
    box-shadow: 0 4px 15px rgba(39, 174, 96, 0.3);
}

.btn-outline-primary {
    border: 2px solid #667eea;
    color: #667eea;
    background: transparent;
    padding: 10px 20px;
    border-radius: 20px;
    font-weight: 600;
    transition: all 0.3s ease;
    cursor: pointer;
}

.btn-outline-primary:hover {
    background: #667eea;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
}

.btn-outline-primary i {
    margin-right: 8px;
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
    .class-subject-row {
        grid-template-columns: 1fr;
        gap: 15px;
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
    <div class="upload-container">
        <div class="container-fluid">
            <!-- Back Button -->
            <a href="{{ route('admin.quizzes.index') }}" class="back-btn">
                <i class="fas fa-arrow-left"></i>
                Back to Quiz Management
            </a>

            <!-- Page Header -->
            <div class="page-header">
                <h1 class="page-title">
                    <i class="fas fa-upload"></i>
                    Upload New Quiz
                </h1>
                <p class="page-description">
                    Upload a comprehensive quiz file for your students. Fill in the quiz details, set scheduling parameters, and upload your quiz file to create an engaging learning experience.
                </p>
                <div class="upload-badge">
                    <i class="fas fa-file-upload"></i>
                    File Upload System
                </div>
            </div>

            <!-- Upload Form -->
            <div class="row justify-content-center">
                <div class="col-lg-8 col-xl-7">
                    <div class="upload-form-card">
                        <div class="form-header">
                            <i class="fas fa-edit"></i>
                            Quiz Upload Form
                        </div>
                        <div class="form-body">
                            <form action="{{ route('admin.quizzes.upload.post') }}" method="POST" enctype="multipart/form-data" id="quizUploadForm">
                                @csrf
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="csrf-token">

                                <!-- Basic Information Section -->
                                <div class="form-section">
                                    <div class="section-title">
                                        <i class="fas fa-info-circle"></i>
                                        Basic Quiz Information
                                    </div>

                                    <div class="enhanced-form-group">
                                        <label for="title" class="enhanced-label">
                                            <i class="fas fa-heading"></i>
                                            Quiz Title *
                                        </label>
                                        <input type="text" name="title" id="title" class="form-control enhanced-input" value="{{ old('title') }}" required placeholder="Enter an engaging quiz title">
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
                                        <textarea name="description" id="description" class="form-control enhanced-textarea" rows="3" required placeholder="Provide a comprehensive description of the quiz content and objectives">{{ old('description') }}</textarea>
                                        <div class="help-text">Describe what students will learn and be tested on</div>
                                        @error('description')
                                            <div class="error-message">
                                                <i class="fas fa-exclamation-circle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
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
                                            <select name="class_id" id="class_id" class="form-control enhanced-select" required>
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
                                            <select name="subject_id" id="subject_id" class="form-control enhanced-select" required>
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
                                            <input type="datetime-local" name="start_time" id="start_time" class="form-control enhanced-input" value="{{ old('start_time') }}" required>
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
                                            <input type="datetime-local" name="end_time" id="end_time" class="form-control enhanced-input" value="{{ old('end_time') }}" required>
                                            <div class="help-text">Final deadline for quiz submission</div>
                                            @error('end_time')
                                                <div class="error-message">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="enhanced-form-group">
                                        <label for="duration" class="enhanced-label">
                                            <i class="fas fa-hourglass-half"></i>
                                            Quiz Duration (minutes) *
                                        </label>
                                        <input type="number" name="duration" id="duration" class="form-control enhanced-input" value="{{ old('duration') }}" required min="1" max="300" placeholder="60">
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

                                <!-- File Upload Section -->
                                <div class="form-section">
                                    <div class="section-title">
                                        <i class="fas fa-file-upload"></i>
                                        Quiz File Upload
                                    </div>

                                    <div class="enhanced-form-group">
                                        <label for="quiz_file" class="enhanced-label">
                                            <i class="fas fa-paperclip"></i>
                                            Quiz File *
                                        </label>
                                        <!-- Hidden file input -->
                                        <input type="file" id="quiz_file" name="quiz_file" required accept=".xlsx,.csv,.json,.pdf,.docx" style="display: none;">
                                        
                                        <!-- Visual upload area -->
                                        <div class="file-upload-area" id="fileUploadArea">
                                            <div class="upload-icon">
                                                <i class="fas fa-cloud-upload-alt"></i>
                                            </div>
                                            <div class="upload-text">Click here to browse files or drag and drop</div>
                                            <div class="upload-subtext">
                                                <div>📊 <strong>Data files:</strong> Excel (.xlsx), CSV (.csv), JSON (.json)</div>
                                                <div>📄 <strong>Documents:</strong> PDF (.pdf), Word (.docx)</div>
                                                <div>📏 <strong>Max size:</strong> 10MB</div>
                                            </div>
                                        </div>
                                        
                                        <!-- Browse button -->
                                        <div style="margin-top: 15px; text-align: center;">
                                            <button type="button" class="btn btn-outline-primary" id="browseBtn">
                                                <i class="fas fa-folder-open"></i> Choose File
                                            </button>
                                        </div>
                                        <div id="selectedFile" class="selected-file" style="display: none;">
                                            <i class="fas fa-file-check"></i>
                                            <span id="fileName"></span>
                                        </div>
                                        @error('quiz_file')
                                            <div class="error-message">
                                                <i class="fas fa-exclamation-circle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Submit Section -->
                                <div class="submit-section">
                                    <button type="submit" class="submit-btn" id="submitBtn">
                                        <i class="fas fa-upload"></i>
                                        Upload Quiz
                                    </button>
                                    <br><br>
                                    <button type="button" class="btn btn-outline-secondary mt-2" id="directSubmitBtn" style="display: none;">
                                        <i class="fas fa-paper-plane"></i>
                                        Direct Submit (Fallback)
                                    </button>
                                    <br><br>
                                    <small class="text-muted">
                                        <i class="fas fa-info-circle"></i>
                                        Enhanced upload with validation and error handling
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
    console.log('Quiz Upload Form initialized');
    console.log('jQuery version:', $.fn.jquery);
    
    // Enhanced file upload handling with drag and drop
    const fileUploadArea = $('#fileUploadArea');
    const fileInput = $('#quiz_file');
    const selectedFile = $('#selectedFile');
    const fileName = $('#fileName');

    // Drag and drop functionality
    fileUploadArea.on('dragover dragenter', function(e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).addClass('dragover');
    });

    fileUploadArea.on('dragleave dragend', function(e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).removeClass('dragover');
    });

    fileUploadArea.on('drop', function(e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).removeClass('dragover');
        
        const files = e.originalEvent.dataTransfer.files;
        if (files.length > 0) {
            fileInput[0].files = files;
            handleFileSelection(files[0]);
        }
    });

    // Click handlers for file selection
    fileUploadArea.on('click', function(e) {
        console.log('Upload area clicked');
        e.preventDefault();
        e.stopPropagation();
        fileInput[0].click();
    });
    
    $('#browseBtn').on('click', function(e) {
        console.log('Browse button clicked');
        e.preventDefault();
        e.stopPropagation();
        fileInput[0].click();
    });
    
    // Test to make sure file input is accessible
    console.log('File input element:', fileInput[0]);
    if (!fileInput[0]) {
        console.error('File input not found!');
    }

    // Handle file selection
    fileInput.on('change', function() {
        console.log('File input changed, files:', this.files.length);
        if (this.files.length > 0) {
            console.log('Selected file:', this.files[0].name, 'Size:', this.files[0].size);
            handleFileSelection(this.files[0]);
        } else {
            console.log('No file selected');
            selectedFile.hide();
        }
    });

    function handleFileSelection(file) {
        const maxSize = 10 * 1024 * 1024; // 10MB
        const allowedTypes = ['.xlsx', '.csv', '.json', '.pdf', '.docx'];
        const fileExtension = '.' + file.name.split('.').pop().toLowerCase();

        if (!allowedTypes.includes(fileExtension)) {
            Swal.fire({
                title: 'Invalid File Type',
                text: 'Please select a valid file (.xlsx, .csv, .json, .pdf, .docx)',
                icon: 'error',
                confirmButtonColor: '#dc3545'
            });
            fileInput.val('');
            selectedFile.hide();
            return;
        }

        if (file.size > maxSize) {
            Swal.fire({
                title: 'File Too Large',
                text: 'File size must be less than 10MB',
                icon: 'error',
                confirmButtonColor: '#dc3545'
            });
            fileInput.val('');
            selectedFile.hide();
            return;
        }

        // Get file type icon
        const fileIcon = getFileIcon(fileExtension);
        
        fileName.html(`${fileIcon} ${file.name}`);
        selectedFile.show();
        
        // Add success animation
        selectedFile.addClass('animate__animated animate__fadeInUp');
    }

    // Function to get appropriate file icon based on file extension
    function getFileIcon(extension) {
        const iconMap = {
            '.xlsx': '<i class="fas fa-file-excel" style="color: #1D6F42;"></i>',
            '.csv': '<i class="fas fa-file-csv" style="color: #059862;"></i>',
            '.json': '<i class="fas fa-file-code" style="color: #F7931E;"></i>',
            '.pdf': '<i class="fas fa-file-pdf" style="color: #DC3545;"></i>',
            '.docx': '<i class="fas fa-file-word" style="color: #2B579A;"></i>'
        };
        return iconMap[extension] || '<i class="fas fa-file" style="color: #6c757d;"></i>';
    }

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
                    Swal.fire({
                        title: 'Error',
                        text: 'Failed to load subjects. Please try again.',
                        icon: 'error',
                        confirmButtonColor: '#dc3545'
                    });
                });
        } else {
            subjectSelect.html('<option value="">First select a class</option>');
        }
    });

    // Setup CSRF token for AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Function to refresh CSRF token
    function refreshCSRFToken() {
        return $.get('/csrf-token').done(function(data) {
            $('meta[name="csrf-token"]').attr('content', data.token);
            $('input[name="_token"]').val(data.token);
            $('#csrf-token').val(data.token);
        }).fail(function() {
            console.warn('Failed to refresh CSRF token');
        });
    }

    // Simple form submission with loading state and CSRF handling
    $('#quizUploadForm').on('submit', function(e) {
        e.preventDefault(); // Always prevent default form submission
        console.log('Form submission started...');
        
        // Check if all required fields are filled (before any state changes)
        let isValid = true;
        let missingFields = [];
        
        // Ensure all fields are enabled for validation
        $('#quizUploadForm input, #quizUploadForm select, #quizUploadForm textarea').prop('disabled', false);
        
        $('#quizUploadForm input[required], #quizUploadForm select[required], #quizUploadForm textarea[required]').each(function() {
            const $field = $(this);
            const fieldName = $field.attr('name') || $field.attr('id');
            const fieldValue = $field.val();
            
            console.log(`Checking field: ${fieldName}, Value: "${fieldValue}", Type: ${$field.prop('type')}`);
            
            // Special handling for file inputs
            if ($field.prop('type') === 'file') {
                if (!$field[0].files || $field[0].files.length === 0) {
                    $field.addClass('is-invalid');
                    missingFields.push(fieldName);
                    isValid = false;
                    console.log(`File field ${fieldName} is invalid - no file selected`);
                } else {
                    $field.removeClass('is-invalid');
                    console.log(`File field ${fieldName} is valid - file: ${$field[0].files[0].name}`);
                }
            } else {
                // Regular field validation
                if (!fieldValue || fieldValue.trim() === '') {
                    $field.addClass('is-invalid');
                    missingFields.push(fieldName);
                    isValid = false;
                    console.log(`Field ${fieldName} is invalid`);
                } else {
                    $field.removeClass('is-invalid');
                    console.log(`Field ${fieldName} is valid`);
                }
            }
        });

        if (!isValid) {
            console.log('Form validation failed:', missingFields);
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: 'Please Complete All Fields',
                    text: 'Missing: ' + missingFields.join(', '),
                    icon: 'warning',
                    confirmButtonColor: '#f39c12'
                });
            } else {
                alert('Please complete all required fields: ' + missingFields.join(', '));
            }
            return false;
        }

        console.log('Form validation passed, submitting with FormData...');
        
        // Create FormData object BEFORE disabling fields
        const formData = new FormData(this);
        
        // Debug: Log form data
        console.log('FormData contents:');
        for (let [key, value] of formData.entries()) {
            console.log(`${key}:`, value);
        }
        
        showLoadingState();
        
        // Add additional headers to ensure AJAX request is recognized
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'X-Requested-With': 'XMLHttpRequest'
            }
        });
        
        // Submit form via AJAX to handle CSRF and file upload properly
        console.log('About to submit AJAX request to:', $(this).attr('action'));
        console.log('CSRF Token being sent:', $('meta[name="csrf-token"]').attr('content'));
        
        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'X-Requested-With': 'XMLHttpRequest'
            },
            success: function(response) {
                console.log('Form submitted successfully:', response);
                hideLoadingState();
                
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        title: 'Success!',
                        text: response.message || 'Quiz uploaded successfully!',
                        icon: 'success',
                        confirmButtonColor: '#27ae60',
                        confirmButtonText: 'View Quiz List',
                        showCancelButton: true,
                        cancelButtonText: 'Stay Here'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '{{ route("admin.quizzes.index") }}';
                        } else {
                            // Reset form for new upload
                            $('#quizUploadForm')[0].reset();
                            $('#selectedFile').hide();
                            $('.enhanced-input, .enhanced-select, .enhanced-textarea').removeClass('is-invalid is-valid');
                        }
                    });
                } else {
                    // Fallback for when SweetAlert2 is not available
                    if (confirm('Quiz uploaded successfully! Click OK to go to quiz list, Cancel to stay here.')) {
                        window.location.href = '{{ route("admin.quizzes.index") }}';
                    } else {
                        // Reset form for new upload
                        $('#quizUploadForm')[0].reset();
                        $('#selectedFile').hide();
                        $('.enhanced-input, .enhanced-select, .enhanced-textarea').removeClass('is-invalid is-valid');
                    }
                }
            },
            error: function(xhr, status, error) {
                console.error('Form submission failed:', xhr.responseText);
                hideLoadingState();
                
                if (xhr.status === 419) {
                    // CSRF token mismatch - refresh and retry
                    Swal.fire({
                        title: 'Session Expired',
                        text: 'Your session has expired. Click OK to refresh the security token and try again.',
                        icon: 'warning',
                        confirmButtonColor: '#f39c12',
                        confirmButtonText: 'Refresh & Retry'
                    }).then(() => {
                        refreshCSRFToken().then(() => {
                            console.log('CSRF token refreshed, retrying...');
                            // Retry form submission with new token
                            submitFormWithRetry();
                        }).catch(() => {
                            Swal.fire({
                                title: 'Error',
                                text: 'Failed to refresh security token. Please reload the page.',
                                icon: 'error',
                                confirmButtonColor: '#dc3545'
                            });
                        });
                    });
                } else if (xhr.status === 422) {
                    // Validation errors
                    let errorMessage = 'Please fix the following errors:\n\n';
                    
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        const errors = xhr.responseJSON.errors;
                        Object.keys(errors).forEach(key => {
                            errorMessage += `• ${errors[key][0]}\n`;
                            // Highlight the field with error
                            $(`[name="${key}"], #${key}`).addClass('is-invalid');
                        });
                    } else {
                        errorMessage += 'Please check all required fields and try again.';
                    }
                    
                    Swal.fire({
                        title: 'Validation Error',
                        text: errorMessage,
                        icon: 'error',
                        confirmButtonColor: '#dc3545'
                    });
                } else {
                    // Generic error handling
                    let errorMessage = 'An unexpected error occurred while uploading the quiz.';
                    
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    } else if (xhr.responseText) {
                        errorMessage += ' Please check your internet connection and try again.';
                    }
                    
                    Swal.fire({
                        title: 'Upload Failed',
                        text: errorMessage,
                        icon: 'error',
                        confirmButtonColor: '#dc3545',
                        confirmButtonText: 'Try Again'
                    });
                }
            }
        });
        
        // Prevent any default form submission
        return false;
    });

    // Helper function to retry form submission
    function submitFormWithRetry() {
        // Re-enable form fields temporarily to capture data
        $('#quizUploadForm input, #quizUploadForm select, #quizUploadForm textarea').prop('disabled', false);
        
        const formData = new FormData($('#quizUploadForm')[0]);
        
        // Debug: Log retry form data
        console.log('Retry FormData contents:');
        for (let [key, value] of formData.entries()) {
            console.log(`${key}:`, value);
        }
        
        // Re-disable form fields for loading state
        $('#quizUploadForm input, #quizUploadForm select, #quizUploadForm textarea').prop('disabled', true);
        
        $.ajax({
            url: $('#quizUploadForm').attr('action'),
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'X-Requested-With': 'XMLHttpRequest'
            },
            success: function(response) {
                console.log('Retry successful:', response);
                hideLoadingState();
                
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        title: 'Success!',
                        text: response.message || 'Quiz uploaded successfully!',
                        icon: 'success',
                        confirmButtonColor: '#27ae60',
                        confirmButtonText: 'View Quiz List',
                        showCancelButton: true,
                        cancelButtonText: 'Stay Here'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '{{ route("admin.quizzes.index") }}';
                        } else {
                            // Reset form for new upload
                            $('#quizUploadForm')[0].reset();
                            $('#selectedFile').hide();
                            $('.enhanced-input, .enhanced-select, .enhanced-textarea').removeClass('is-invalid is-valid');
                        }
                    });
                } else {
                    // Fallback for when SweetAlert2 is not available
                    if (confirm('Quiz uploaded successfully! Click OK to go to quiz list, Cancel to stay here.')) {
                        window.location.href = '{{ route("admin.quizzes.index") }}';
                    } else {
                        // Reset form for new upload
                        $('#quizUploadForm')[0].reset();
                        $('#selectedFile').hide();
                        $('.enhanced-input, .enhanced-select, .enhanced-textarea').removeClass('is-invalid is-valid');
                    }
                }
            },
            error: function(xhr, status, error) {
                hideLoadingState();
                Swal.fire({
                    title: 'Upload Still Failed',
                    text: 'There seems to be a persistent issue. Please check your form data and try again.',
                    icon: 'error',
                    confirmButtonColor: '#dc3545'
                });
            }
        });
    }

    function showLoadingState() {
        // Show loading overlay
        $('#loadingOverlay').show();
        
        // Disable submit button
        $('#submitBtn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Uploading Quiz...');
        
        // Disable all form inputs
        $('#quizUploadForm input, #quizUploadForm select, #quizUploadForm textarea').prop('disabled', true);
    }

    function hideLoadingState() {
        // Hide loading overlay
        $('#loadingOverlay').hide();
        
        // Re-enable submit button
        $('#submitBtn').prop('disabled', false).html('<i class="fas fa-upload"></i> Upload Quiz');
        
        // Re-enable all form inputs
        $('#quizUploadForm input, #quizUploadForm select, #quizUploadForm textarea').prop('disabled', false);
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

    // Success/Error message handling
    @if(session('success'))
        Swal.fire({
            title: 'Success!',
            text: '{{ session("success") }}',
            icon: 'success',
            confirmButtonColor: '#27ae60',
            confirmButtonText: 'Great!'
        }).then(() => {
            window.location.href = '{{ route("admin.quizzes.index") }}';
        });
    @endif

    @if(session('error'))
        Swal.fire({
            title: 'Upload Failed!',
            text: '{{ session("error") }}',
            icon: 'error',
            confirmButtonColor: '#dc3545',
            confirmButtonText: 'Try Again'
        });
    @endif

    // Form field animations on focus
    $('.enhanced-input, .enhanced-select, .enhanced-textarea').on('focus', function() {
        $(this).parent().addClass('focused');
    }).on('blur', function() {
        $(this).parent().removeClass('focused');
    });

    // Additional validation feedback
    $('#submitBtn').on('click', function(e) {
        e.preventDefault(); // Prevent any default button behavior
        console.log('Submit button clicked');
        
        // Add visual feedback when button is clicked
        $(this).addClass('btn-clicked');
        setTimeout(() => {
            $(this).removeClass('btn-clicked');
        }, 200);
        
        // Trigger form submission manually
        $('#quizUploadForm').trigger('submit');
    });

    // Form field validation on blur
    $('#quizUploadForm input[required], #quizUploadForm select[required], #quizUploadForm textarea[required]').on('blur', function() {
        const $this = $(this);
        if ($this.val() && $this.val().trim() !== '') {
            $this.removeClass('is-invalid').addClass('is-valid');
        }
    });

    // Clear validation states on input
    $('#quizUploadForm input, #quizUploadForm select, #quizUploadForm textarea').on('input change', function() {
        $(this).removeClass('is-invalid is-valid');
    });

    // Initialize tooltips
    $('[data-toggle="tooltip"]').tooltip();
    
    // Direct submit button (fallback for CSRF issues)
    $('#directSubmitBtn').on('click', function(e) {
        e.preventDefault();
        console.log('Direct submit clicked');
        
        // Show fallback button after first failed attempt
        $(this).show();
        
        // Refresh CSRF token first
        refreshCSRFToken().then(() => {
            console.log('CSRF token refreshed, submitting with retry function');
            showLoadingState();
            // Use the retry function instead of direct form submission
            submitFormWithRetry();
        }).catch(() => {
            console.log('CSRF refresh failed, trying with current token');
            showLoadingState();
            submitFormWithRetry();
        });
    });

    // Show direct submit button after any CSRF error
    $(document).on('ajaxError', function(event, xhr) {
        if (xhr.status === 419) {
            $('#directSubmitBtn').show();
        }
    });

    // Test SweetAlert2 is loaded
    setTimeout(function() {
        console.log('SweetAlert2 loaded:', typeof Swal !== 'undefined');
        console.log('File input test - Element exists:', $('#quiz_file').length > 0);
        console.log('File input test - Element visible:', $('#quiz_file').is(':visible'));
        console.log('File input test - Browse button exists:', $('#browseBtn').length > 0);
        console.log('File input test - Upload area exists:', $('#fileUploadArea').length > 0);
        console.log('CSRF token:', $('meta[name="csrf-token"]').attr('content'));
        console.log('Form action:', $('#quizUploadForm').attr('action'));
        console.log('Form method:', $('#quizUploadForm').attr('method'));
        console.log('CSRF input value:', $('input[name="_token"]').val());
        
        // Test alert
        console.log('All systems ready for form submission');
        
        // Make test functions available globally
        window.testUpload = function() {
            console.log('Testing upload functionality...');
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: 'Test Success',
                    text: 'Form submission system is working correctly!',
                    icon: 'success',
                    confirmButtonColor: '#27ae60'
                });
            } else {
                alert('Form submission system is working correctly!');
            }
        };
        
        window.checkFormStatus = function() {
            console.log('=== FORM STATUS CHECK ===');
            console.log('Form exists:', $('#quizUploadForm').length > 0);
            console.log('Submit button exists:', $('#submitBtn').length > 0);
            console.log('CSRF token present:', $('meta[name="csrf-token"]').attr('content') ? 'Yes' : 'No');
            console.log('Form action URL:', $('#quizUploadForm').attr('action'));
            
            // Check all required fields
            console.log('\n=== REQUIRED FIELDS CHECK ===');
            $('#quizUploadForm input[required], #quizUploadForm select[required], #quizUploadForm textarea[required]').each(function() {
                const $field = $(this);
                const fieldName = $field.attr('name') || $field.attr('id');
                const fieldValue = $field.val();
                const isFile = $field.prop('type') === 'file';
                const fileCount = isFile ? ($field[0].files ? $field[0].files.length : 0) : 'N/A';
                
                console.log(`${fieldName}: "${fieldValue}" ${isFile ? `(File count: ${fileCount})` : ''}`);
            });
            
            // Test FormData creation
            console.log('\n=== FORMDATA TEST ===');
            const testFormData = new FormData($('#quizUploadForm')[0]);
            for (let [key, value] of testFormData.entries()) {
                console.log(`${key}:`, value);
            }
            console.log('=========================');
        };
        
        window.fillTestData = function() {
            console.log('Filling test data...');
            $('#title').val('Test Quiz Title');
            $('#description').val('Test quiz description for validation testing');
            $('#duration').val('60');
            // Set current time + 1 hour for start time
            const now = new Date();
            const startTime = new Date(now.getTime() + 60 * 60 * 1000);
            const endTime = new Date(startTime.getTime() + 2 * 60 * 60 * 1000);
            
            $('#start_time').val(startTime.toISOString().slice(0, 16));
            $('#end_time').val(endTime.toISOString().slice(0, 16));
            
            console.log('Test data filled. Please select a class, subject, and file manually.');
        };
    }, 1000);
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

