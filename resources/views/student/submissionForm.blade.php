@extends('components.dashmaster')

@section('body')
@php
    $isOverdue = $assignment->submission_deadline < now();
    $isDueSoon = $assignment->submission_deadline >= now() && $assignment->submission_deadline <= now()->addDays(1);
    $statusClass = $isOverdue ? 'danger' : ($isDueSoon ? 'warning' : 'success');
    $statusIcon = $isOverdue ? 'exclamation-triangle' : ($isDueSoon ? 'clock' : 'check-circle');
    $statusText = $isOverdue ? 'Overdue' : ($isDueSoon ? 'Due Soon' : 'Active');
    $timeRemaining = $assignment->submission_deadline->diffForHumans();
@endphp

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-8">
                    <h1><i class="fas fa-upload text-primary"></i> Submit Assignment</h1>
                    <p class="text-muted">Upload your completed work for review</p>
                </div>
                <div class="col-sm-4">
                    <div class="text-right">
                        <a href="{{ route('student.assignments') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Assignments
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Assignment Info Card -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card border-0 shadow-lg">
                        <div class="card-header bg-gradient-{{ $statusClass == 'danger' ? 'danger' : ($statusClass == 'warning' ? 'warning' : 'primary') }} text-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="card-title mb-0">
                                    <i class="fas fa-file-alt mr-2"></i>{{ $assignment->title }}
                                </h3>
                                <div>
                                    <span class="badge badge-light badge-lg">
                                        <i class="fas fa-{{ $statusIcon }}"></i> {{ $statusText }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    @if($assignment->description)
                                        <div class="assignment-description">
                                            <h5><i class="fas fa-info-circle text-primary"></i> Assignment Description</h5>
                                            <p class="text-muted">{!! nl2br(e($assignment->description)) !!}</p>
                                        </div>
                                    @endif
                                    <div class="assignment-meta mt-3">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="info-item">
                                                    <i class="fas fa-book text-primary"></i>
                                                    <strong>Subject:</strong> {{ $assignment->subject->name ?? 'N/A' }}
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="info-item">
                                                    <i class="fas fa-users text-info"></i>
                                                    <strong>Class:</strong> {{ $assignment->schoolClass->name ?? 'N/A' }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="deadline-card bg-{{ $statusClass == 'danger' ? 'danger' : ($statusClass == 'warning' ? 'warning' : 'success') }} text-white rounded p-3 text-center">
                                        <i class="fas fa-calendar-alt fa-2x mb-2"></i>
                                        <h5>Submission Deadline</h5>
                                        <h4 class="mb-1">{{ $assignment->submission_deadline->format('M d, Y') }}</h4>
                                        <p class="mb-1">{{ $assignment->submission_deadline->format('h:i A') }}</p>
                                        <small>{{ $timeRemaining }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alert Messages -->
            @if(session('success'))
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                            <i class="fas fa-check-circle mr-2"></i>
                            <strong>Success!</strong> {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            <strong>Error!</strong> {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Submission Form -->
            <div class="row">
                <div class="col-12">
                    @if(!$isOverdue)
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-light">
                                <h4 class="card-title mb-0">
                                    <i class="fas fa-cloud-upload-alt text-success"></i> Upload Your Assignment
                                </h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('student.assignments.submit', $assignment->id) }}" 
                                      method="POST" 
                                      enctype="multipart/form-data" 
                                      id="submissionForm"
                                      class="submission-form">
                                    @csrf
                                    
                                    <!-- File Upload Area -->
                                    <div class="upload-area" id="uploadArea">
                                        <div class="upload-content">
                                            <i class="fas fa-cloud-upload-alt fa-4x text-primary mb-3"></i>
                                            <h4>Drag and drop your file here</h4>
                                            <p class="text-muted mb-3">or click to browse files</p>
                                            <div class="file-requirements">
                                                <small class="text-muted">
                                                    <i class="fas fa-info-circle"></i>
                                                    Supported formats: PDF, DOC, DOCX | Max size: 10MB
                                                </small>
                                            </div>
                                            <input type="file" 
                                                   name="file" 
                                                   id="fileInput"
                                                   accept=".pdf,.doc,.docx" 
                                                   required 
                                                   style="display: none;">
                                            <button type="button" class="btn btn-primary mt-3" id="browseBtn">
                                                <i class="fas fa-folder-open"></i> Browse Files
                                            </button>
                                        </div>
                                    </div>

                                    <!-- File Preview -->
                                    <div class="file-preview" id="filePreview" style="display: none;">
                                        <div class="file-info">
                                            <div class="d-flex align-items-center">
                                                <div class="file-icon mr-3">
                                                    <i class="fas fa-file-alt fa-2x text-primary"></i>
                                                </div>
                                                <div class="file-details">
                                                    <h6 class="mb-1" id="fileName"></h6>
                                                    <small class="text-muted" id="fileSize"></small>
                                                </div>
                                                <div class="ml-auto">
                                                    <button type="button" class="btn btn-sm btn-outline-danger" id="removeFile">
                                                        <i class="fas fa-trash"></i> Remove
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="progress mt-2" id="uploadProgress" style="display: none;">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: 0%"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="text-center mt-4">
                                        <button type="submit" 
                                                class="btn btn-{{ $isDueSoon ? 'warning' : 'success' }} btn-lg" 
                                                id="submitBtn" 
                                                disabled>
                                            <i class="fas fa-upload"></i> Submit Assignment
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Instructions Card -->
                        <div class="card border-0 shadow-sm mt-4">
                            <div class="card-header bg-info text-white">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-lightbulb"></i> Submission Guidelines
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="guideline-item">
                                            <i class="fas fa-check-circle text-success"></i>
                                            <strong>Review your work</strong> carefully before submitting
                                        </div>
                                        <div class="guideline-item">
                                            <i class="fas fa-file-check text-success"></i>
                                            <strong>Ensure file format</strong> is PDF, DOC, or DOCX
                                        </div>
                                        <div class="guideline-item">
                                            <i class="fas fa-compress text-success"></i>
                                            <strong>File size limit</strong> is 10MB maximum
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="guideline-item">
                                            <i class="fas fa-signature text-success"></i>
                                            <strong>Include your name</strong> in the document
                                        </div>
                                        <div class="guideline-item">
                                            <i class="fas fa-clock text-success"></i>
                                            <strong>Submit before deadline</strong> to avoid penalties
                                        </div>
                                        <div class="guideline-item">
                                            <i class="fas fa-shield-alt text-success"></i>
                                            <strong>Original work only</strong> - avoid plagiarism
                                        </div>
                                    </div>
                                </div>
                                <div class="alert alert-warning mt-3" role="alert">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <strong>Important:</strong> Once submitted, you cannot modify your assignment. Make sure your work is complete!
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- Overdue Message -->
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center py-5">
                                <i class="fas fa-exclamation-triangle fa-4x text-danger mb-3"></i>
                                <h3 class="text-danger">Submission Deadline Passed</h3>
                                <p class="text-muted mb-4">
                                    The deadline for this assignment was <strong>{{ $assignment->submission_deadline->format('M d, Y h:i A') }}</strong><br>
                                    That was <strong>{{ $assignment->submission_deadline->diffForHumans() }}</strong>
                                </p>
                                <p class="text-muted">
                                    Please contact your teacher if you need to submit late work or discuss alternative arrangements.
                                </p>
                                <div class="mt-4">
                                    <a href="{{ route('student.assignments') }}" class="btn btn-secondary mr-2">
                                        <i class="fas fa-arrow-left"></i> Back to Assignments
                                    </a>
                                    <button class="btn btn-outline-primary" onclick="window.print()">
                                        <i class="fas fa-print"></i> Print Assignment Details
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Footer -->
<footer class="main-footer">
    <strong>Copyright &copy; <span id="currentYear"></span> <a href="https://sumajkt.go.tz">Visit Our Website</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      {{-- <b>Version</b> 3.2.0 --}}
    </div>
</footer>

<!-- Custom Styles -->
<style>
    .content-header h1 {
        font-weight: 600;
        color: #343a40;
    }
    
    .card {
        border-radius: 15px;
        overflow: hidden;
        animation: fadeInUp 0.6s ease-out;
    }
    
    .card-header {
        border-radius: 15px 15px 0 0 !important;
        font-weight: 600;
    }
    
    .btn {
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }
    
    .badge-lg {
        font-size: 0.95rem;
        padding: 0.6rem 1.2rem;
        border-radius: 25px;
    }
    
    .bg-gradient-primary {
        background: linear-gradient(135deg, #007bff, #0056b3);
    }
    
    .bg-gradient-warning {
        background: linear-gradient(135deg, #ffc107, #e0a800);
    }
    
    .bg-gradient-danger {
        background: linear-gradient(135deg, #dc3545, #c82333);
    }
    
    .bg-gradient-success {
        background: linear-gradient(135deg, #28a745, #1e7e34);
    }
    
    .info-item {
        padding: 0.5rem;
        margin-bottom: 0.5rem;
        background: rgba(0,123,255,0.05);
        border-radius: 6px;
        border-left: 3px solid #007bff;
    }
    
    .info-item i {
        margin-right: 0.5rem;
        width: 20px;
    }
    
    .deadline-card {
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        animation: pulse-glow 3s infinite;
    }
    
    @keyframes pulse-glow {
        0%, 100% { box-shadow: 0 4px 15px rgba(0,0,0,0.2); }
        50% { box-shadow: 0 8px 25px rgba(0,0,0,0.3); }
    }
    
    .assignment-description {
        background: #f8f9fa;
        padding: 1rem;
        border-radius: 10px;
        border-left: 5px solid #007bff;
        margin-bottom: 1rem;
    }
    
    /* Upload Area Styling */
    .upload-area {
        border: 2px dashed #007bff;
        border-radius: 15px;
        padding: 3rem 2rem;
        text-align: center;
        background: #f8f9ff;
        transition: all 0.3s ease;
        cursor: pointer;
        min-height: 250px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .upload-area:hover {
        border-color: #0056b3;
        background: #e6f3ff;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0,123,255,0.1);
    }
    
    .upload-area.dragover {
        border-color: #28a745;
        background: #e6fff0;
        animation: pulse 0.5s ease-in-out;
    }
    
    .upload-area.error {
        border-color: #dc3545;
        background: #ffe6e6;
        animation: shake 0.5s ease-in-out;
    }
    
    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.02); }
    }
    
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        75% { transform: translateX(5px); }
    }
    
    .file-preview {
        border: 2px solid #28a745;
        border-radius: 15px;
        padding: 1.5rem;
        background: #f8fff8;
        animation: slideInUp 0.3s ease-out;
    }
    
    @keyframes slideInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .file-info {
        background: white;
        padding: 1rem;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    
    .file-icon {
        min-width: 50px;
    }
    
    .guideline-item {
        display: flex;
        align-items: center;
        padding: 0.5rem 0;
        border-bottom: 1px solid #f0f0f0;
    }
    
    .guideline-item:last-child {
        border-bottom: none;
    }
    
    .guideline-item i {
        margin-right: 0.75rem;
        min-width: 20px;
    }
    
    /* Progress Bar Animation */
    .progress-bar {
        transition: width 0.3s ease;
    }
    
    /* Button Loading State */
    .btn.loading {
        pointer-events: none;
        position: relative;
    }
    
    .btn.loading::after {
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        margin: auto;
        border: 2px solid transparent;
        border-top-color: #ffffff;
        border-radius: 50%;
        animation: button-loading-spinner 1s ease infinite;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    
    @keyframes button-loading-spinner {
        from { transform: translate(-50%, -50%) rotate(0turn); }
        to { transform: translate(-50%, -50%) rotate(1turn); }
    }
    
    /* Fade animations */
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
    
    .card:nth-child(1) { animation-delay: 0.1s; }
    .card:nth-child(2) { animation-delay: 0.2s; }
    .card:nth-child(3) { animation-delay: 0.3s; }
    
    /* Mobile responsiveness */
    @media (max-width: 768px) {
        .content-header .col-sm-4 {
            text-align: center !important;
            margin-top: 1rem;
        }
        
        .upload-area {
            padding: 2rem 1rem;
            min-height: 200px;
        }
        
        .deadline-card {
            margin-top: 1rem;
        }
        
        .btn-lg {
            width: 100%;
        }
    }
    
    /* Toast notifications */
    .toast-notification {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        min-width: 300px;
        animation: slideInRight 0.3s ease-out;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    
    @keyframes slideInRight {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    
    @keyframes slideOutRight {
        from { transform: translateX(0); opacity: 1; }
        to { transform: translateX(100%); opacity: 0; }
    }
</style>

<!-- Scripts -->
<script>
    // Footer js
    document.getElementById("currentYear").textContent = new Date().getFullYear();

    // Enhanced submission form functionality
    document.addEventListener('DOMContentLoaded', function() {
        const uploadArea = document.getElementById('uploadArea');
        const fileInput = document.getElementById('fileInput');
        const browseBtn = document.getElementById('browseBtn');
        const filePreview = document.getElementById('filePreview');
        const submitBtn = document.getElementById('submitBtn');
        const submissionForm = document.getElementById('submissionForm');
        const removeFileBtn = document.getElementById('removeFile');
        
        if (!uploadArea || !fileInput) return; // Exit if elements don't exist
        
        // File size limit (10MB)
        const maxFileSize = 10 * 1024 * 1024;
        
        // Allowed file types
        const allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
        
        // Browse button click
        browseBtn.addEventListener('click', () => fileInput.click());
        
        // Upload area click
        uploadArea.addEventListener('click', () => fileInput.click());
        
        // Drag and drop functionality
        uploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadArea.classList.add('dragover');
        });
        
        uploadArea.addEventListener('dragleave', (e) => {
            e.preventDefault();
            uploadArea.classList.remove('dragover');
        });
        
        uploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadArea.classList.remove('dragover');
            
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                handleFile(files[0]);
            }
        });
        
        // File input change
        fileInput.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                handleFile(e.target.files[0]);
            }
        });
        
        // Remove file button
        removeFileBtn.addEventListener('click', () => {
            fileInput.value = '';
            uploadArea.style.display = 'block';
            filePreview.style.display = 'none';
            submitBtn.disabled = true;
            uploadArea.classList.remove('error');
        });
        
        // Handle file selection
        function handleFile(file) {
            // Validate file type
            if (!allowedTypes.includes(file.type)) {
                showError('Invalid file type. Please select a PDF, DOC, or DOCX file.');
                uploadArea.classList.add('error');
                setTimeout(() => uploadArea.classList.remove('error'), 3000);
                return;
            }
            
            // Validate file size
            if (file.size > maxFileSize) {
                showError('File size too large. Maximum allowed size is 10MB.');
                uploadArea.classList.add('error');
                setTimeout(() => uploadArea.classList.remove('error'), 3000);
                return;
            }
            
            // Display file info
            displayFileInfo(file);
            uploadArea.style.display = 'none';
            filePreview.style.display = 'block';
            submitBtn.disabled = false;
            
            showSuccess('File selected successfully!');
        }
        
        // Display file information
        function displayFileInfo(file) {
            const fileName = document.getElementById('fileName');
            const fileSize = document.getElementById('fileSize');
            
            fileName.textContent = file.name;
            fileSize.textContent = formatFileSize(file.size);
        }
        
        // Format file size
        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }
        
        // Form submission
        submissionForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (!fileInput.files.length) {
                showError('Please select a file to submit.');
                return;
            }
            
            // Show loading state
            submitBtn.classList.add('loading');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Submitting...';
            submitBtn.disabled = true;
            
            // Simulate upload progress
            showUploadProgress();
            
            // Submit form after a delay (to show progress)
            setTimeout(() => {
                this.submit();
            }, 2000);
        });
        
        // Show upload progress
        function showUploadProgress() {
            const progressContainer = document.getElementById('uploadProgress');
            const progressBar = progressContainer.querySelector('.progress-bar');
            
            progressContainer.style.display = 'block';
            
            let progress = 0;
            const interval = setInterval(() => {
                progress += Math.random() * 15;
                if (progress >= 100) {
                    progress = 100;
                    clearInterval(interval);
                }
                progressBar.style.width = progress + '%';
            }, 100);
        }
        
        // Show success message
        function showSuccess(message) {
            showToast(message, 'success');
        }
        
        // Show error message
        function showError(message) {
            showToast(message, 'danger');
        }
        
        // Toast notification function
        function showToast(message, type) {
            const toast = document.createElement('div');
            toast.className = `alert alert-${type} toast-notification`;
            toast.innerHTML = `
                <i class="fas fa-${type === 'success' ? 'check' : 'exclamation'}-circle mr-2"></i>
                ${message}
                <button type="button" class="close" onclick="this.parentElement.remove()">
                    <span>&times;</span>
                </button>
            `;
            
            document.body.appendChild(toast);
            
            // Auto remove after 5 seconds
            setTimeout(() => {
                if (toast.parentElement) {
                    toast.style.animation = 'slideOutRight 0.3s ease-in';
                    setTimeout(() => {
                        if (toast.parentElement) {
                            toast.remove();
                        }
                    }, 300);
                }
            }, 5000);
        }
        
        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl/Cmd + U = Upload file
            if ((e.ctrlKey || e.metaKey) && e.key === 'u') {
                e.preventDefault();
                if (!submitBtn.disabled) {
                    fileInput.click();
                }
            }
            
            // Ctrl/Cmd + Enter = Submit form
            if ((e.ctrlKey || e.metaKey) && e.key === 'Enter') {
                e.preventDefault();
                if (!submitBtn.disabled) {
                    submissionForm.dispatchEvent(new Event('submit'));
                }
            }
        });
        
        // Add tooltip for keyboard shortcuts
        browseBtn.title = 'Browse files (Ctrl+U)';
        submitBtn.title = 'Submit assignment (Ctrl+Enter)';
        
        // Auto-save draft (localStorage)
        if (fileInput.files.length > 0) {
            localStorage.setItem('draftSubmission_{{ $assignment->id }}', 'true');
        }
        
        // Check for draft on page load
        if (localStorage.getItem('draftSubmission_{{ $assignment->id }}')) {
            showToast('You have an unsaved draft. Please select your file again.', 'info');
        }
        
        // Prevent accidental page leave
        window.addEventListener('beforeunload', function(e) {
            if (fileInput.files.length > 0 && !submitBtn.classList.contains('loading')) {
                e.preventDefault();
                e.returnValue = 'You have an unsaved file. Are you sure you want to leave?';
                return e.returnValue;
            }
        });
        
        // Clear draft after successful submission
        submissionForm.addEventListener('submit', function() {
            localStorage.removeItem('draftSubmission_{{ $assignment->id }}');
        });
    });
</script>
@endsection
