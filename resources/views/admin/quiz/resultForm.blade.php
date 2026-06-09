@extends('components.dashmaster')

@section('body')

<style>
/* Enhanced Quiz Result Upload Styling */
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
    padding: 30px;
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
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    opacity: 0.05;
    z-index: 0;
}

.page-title {
    color: #2c3e50;
    font-size: 2.2rem;
    font-weight: 700;
    margin: 0 0 15px 0;
    position: relative;
    z-index: 1;
    display: flex;
    align-items: center;
}

.page-title i {
    margin-right: 15px;
    color: #28a745;
}

.page-subtitle {
    color: #6c757d;
    font-size: 1.1rem;
    position: relative;
    z-index: 1;
    margin-bottom: 20px;
}

.quiz-info-card {
    background: rgba(255, 255, 255, 0.9);
    border-radius: 15px;
    padding: 20px;
    margin-bottom: 20px;
    border-left: 4px solid #28a745;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.quiz-title {
    font-size: 1.3rem;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 8px;
}

.quiz-description {
    color: #6c757d;
    font-size: 1rem;
    margin: 0;
}

.upload-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    margin-bottom: 30px;
    position: relative;
}

.card-header-custom {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
    padding: 25px 30px;
    border-radius: 0;
    border: none;
}

.card-header-custom h2 {
    margin: 0;
    font-size: 1.5rem;
    font-weight: 600;
    display: flex;
    align-items: center;
}

.card-header-custom i {
    margin-right: 10px;
}

.upload-form-body {
    padding: 40px;
}

.upload-zone {
    border: 3px dashed #28a745;
    border-radius: 15px;
    background: #f8fffe;
    padding: 40px 20px;
    text-align: center;
    transition: all 0.3s ease;
    position: relative;
    margin-bottom: 30px;
    cursor: pointer;
}

.upload-zone:hover {
    border-color: #20c997;
    background: #f0fff4;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(40, 167, 69, 0.15);
}

.upload-zone.dragover {
    border-color: #17a2b8;
    background: #e6f9ff;
    transform: scale(1.02);
}

.upload-icon {
    font-size: 4rem;
    color: #28a745;
    margin-bottom: 20px;
    display: block;
}

.upload-text {
    font-size: 1.2rem;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 10px;
}

.upload-hint {
    color: #6c757d;
    font-size: 0.95rem;
    margin-bottom: 20px;
}

.file-input {
    opacity: 0;
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    cursor: pointer;
}

.file-info {
    background: #e8f5e8;
    border: 1px solid #28a745;
    border-radius: 10px;
    padding: 15px;
    margin-top: 20px;
    display: none;
}

.file-info.show {
    display: block;
}

.file-details {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.file-name {
    font-weight: 600;
    color: #2c3e50;
    display: flex;
    align-items: center;
}

.file-name i {
    margin-right: 8px;
    color: #28a745;
}

.file-size {
    color: #6c757d;
    font-size: 0.9rem;
}

.remove-file {
    background: none;
    border: none;
    color: #dc3545;
    cursor: pointer;
    font-size: 1.1rem;
    padding: 5px;
}

.remove-file:hover {
    color: #c82333;
}

.upload-instructions {
    background: #fff3cd;
    border: 1px solid #ffeaa7;
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 30px;
}

.instructions-title {
    font-weight: 600;
    color: #856404;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
}

.instructions-title i {
    margin-right: 10px;
}

.instructions-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.instructions-list li {
    padding: 5px 0;
    color: #856404;
    position: relative;
    padding-left: 25px;
}

.instructions-list li::before {
    content: '✓';
    position: absolute;
    left: 0;
    color: #28a745;
    font-weight: bold;
}

.submit-section {
    text-align: center;
    padding-top: 20px;
    border-top: 1px solid #e9ecef;
}

.submit-btn {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
    border: none;
    padding: 15px 40px;
    font-size: 1.1rem;
    font-weight: 600;
    border-radius: 25px;
    cursor: pointer;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 1px;
    position: relative;
    overflow: hidden;
    min-width: 200px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.submit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(40, 167, 69, 0.4);
}

.submit-btn:disabled {
    opacity: 0.7;
    cursor: not-allowed;
    transform: none;
}

.submit-btn i {
    margin-right: 10px;
}

.submit-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: all 0.5s ease;
}

.submit-btn:hover::before {
    left: 100%;
}

.cancel-btn {
    background: #6c757d;
    color: white;
    border: none;
    padding: 15px 30px;
    font-size: 1rem;
    border-radius: 25px;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-right: 15px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
}

.cancel-btn:hover {
    background: #5a6268;
    color: white;
    text-decoration: none;
    transform: translateY(-2px);
}

.cancel-btn i {
    margin-right: 8px;
}

.progress-container {
    margin: 20px 0;
    display: none;
}

.progress-container.show {
    display: block;
}

.progress-bar-custom {
    background: #e9ecef;
    border-radius: 25px;
    height: 12px;
    overflow: hidden;
    margin-bottom: 10px;
}

.progress-fill {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    height: 100%;
    width: 0%;
    transition: width 0.3s ease;
    border-radius: 25px;
}

.progress-text {
    text-align: center;
    font-size: 0.9rem;
    color: #6c757d;
}

/* Error and Success Messages */
.alert-custom {
    border-radius: 15px;
    padding: 15px 20px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
}

.alert-custom i {
    margin-right: 10px;
    font-size: 1.2rem;
}

.alert-success-custom {
    background: #d4edda;
    border: 1px solid #c3e6cb;
    color: #155724;
}

.alert-error-custom {
    background: #f8d7da;
    border: 1px solid #f5c6cb;
    color: #721c24;
}

/* Responsive design */
@media (max-width: 768px) {
    .upload-form-body {
        padding: 20px;
    }
    
    .page-title {
        font-size: 1.8rem;
    }
    
    .upload-zone {
        padding: 30px 15px;
    }
    
    .submit-btn, .cancel-btn {
        width: 100%;
        margin-bottom: 10px;
        margin-right: 0;
    }
}

/* Animation for file upload success */
@keyframes uploadSuccess {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

.upload-success {
    animation: uploadSuccess 0.6s ease;
}
</style>

<div class="content-wrapper upload-container">
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">
                <i class="fas fa-upload"></i>
                Upload Quiz Results
            </h1>
            <p class="page-subtitle">Upload student quiz results from Excel or CSV file</p>
            
            <!-- Quiz Information Card -->
            <div class="quiz-info-card">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="quiz-title">{{ $quiz->title ?? 'Quiz Upload' }}</h4>
                        <p class="quiz-description">{{ $quiz->description ?? 'Upload results for this quiz assessment' }}</p>
                    </div>
                    <div class="col-md-4 text-md-right">
                        <a href="{{ route('admin.quizzes.results', $quiz->id) }}" class="btn btn-outline-success">
                            <i class="fas fa-chart-bar"></i>
                            View Results
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-7">
                <!-- Success/Error Messages -->
                @if(session('success'))
                    <div class="alert-custom alert-success-custom">
                        <i class="fas fa-check-circle"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert-custom alert-error-custom">
                        <i class="fas fa-exclamation-triangle"></i>
                        {{ session('error') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert-custom alert-error-custom">
                        <i class="fas fa-exclamation-triangle"></i>
                        <div>
                            <strong>Please fix the following errors:</strong>
                            <ul style="margin: 10px 0 0 0; padding-left: 20px;">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <!-- Upload Instructions -->
                <div class="upload-instructions">
                    <h5 class="instructions-title">
                        <i class="fas fa-info-circle"></i>
                        Upload Instructions
                    </h5>
                    <ul class="instructions-list">
                        <li>File must be in Excel (.xlsx, .xls) or CSV (.csv) format</li>
                        <li>Maximum file size: 10MB</li>
                        <li>File should contain columns: student_id, firstname, secondname, lastname, percentage</li>
                        <li>Percentage values should be between 0 and 100</li>
                        <li>Ensure all student IDs exist in the system</li>
                    </ul>
                </div>

                <!-- Upload Form Card -->
                <div class="upload-card">
                    <div class="card-header-custom">
                        <h2>
                            <i class="fas fa-file-upload"></i>
                            Select Results File
                        </h2>
                    </div>

                    <div class="upload-form-body">
                        <form action="{{ route('admin.quizzes.uploadResults', $quiz->id) }}" method="post" enctype="multipart/form-data" id="uploadForm">
                            @csrf
                            
                            <!-- Upload Zone -->
                            <div class="upload-zone" id="uploadZone">
                                <i class="fas fa-cloud-upload-alt upload-icon"></i>
                                <div class="upload-text">Drop your file here or click to browse</div>
                                <div class="upload-hint">Supports Excel (.xlsx, .xls) and CSV (.csv) files</div>
                                <input type="file" name="results" id="fileInput" class="file-input" required accept=".xlsx,.xls,.csv">
                            </div>

                            <!-- File Information -->
                            <div class="file-info" id="fileInfo">
                                <div class="file-details">
                                    <div class="file-name" id="fileName">
                                        <i class="fas fa-file-excel"></i>
                                        <span></span>
                                    </div>
                                    <div class="file-size" id="fileSize"></div>
                                    <button type="button" class="remove-file" id="removeFile">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Progress Bar -->
                            <div class="progress-container" id="progressContainer">
                                <div class="progress-bar-custom">
                                    <div class="progress-fill" id="progressFill"></div>
                                </div>
                                <div class="progress-text" id="progressText">Uploading... 0%</div>
                            </div>

                            <!-- Submit Section -->
                            <div class="submit-section">
                                <a href="{{ route('admin.quizzes.results', $quiz->id) }}" class="cancel-btn">
                                    <i class="fas fa-arrow-left"></i>
                                    Back to Results
                                </a>
                                <button type="submit" class="submit-btn" id="submitBtn" disabled>
                                    <i class="fas fa-upload"></i>
                                    Upload Results
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
        <b>Quiz Results</b> Upload System
    </div>
</footer>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Set current year
    document.getElementById("currentYear").textContent = new Date().getFullYear();

    // File upload functionality
    const uploadZone = document.getElementById('uploadZone');
    const fileInput = document.getElementById('fileInput');
    const fileInfo = document.getElementById('fileInfo');
    const fileName = document.getElementById('fileName').querySelector('span');
    const fileSize = document.getElementById('fileSize');
    const removeFile = document.getElementById('removeFile');
    const submitBtn = document.getElementById('submitBtn');
    const uploadForm = document.getElementById('uploadForm');
    const progressContainer = document.getElementById('progressContainer');
    const progressFill = document.getElementById('progressFill');
    const progressText = document.getElementById('progressText');

    // Handle drag and drop events
    uploadZone.addEventListener('dragover', function(e) {
        e.preventDefault();
        uploadZone.classList.add('dragover');
    });

    uploadZone.addEventListener('dragleave', function(e) {
        e.preventDefault();
        uploadZone.classList.remove('dragover');
    });

    uploadZone.addEventListener('drop', function(e) {
        e.preventDefault();
        uploadZone.classList.remove('dragover');
        
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            handleFileSelection(files[0]);
        }
    });

    // Handle file input change
    fileInput.addEventListener('change', function(e) {
        if (e.target.files.length > 0) {
            handleFileSelection(e.target.files[0]);
        }
    });

    // Handle file selection
    function handleFileSelection(file) {
        // Validate file type
        const allowedTypes = [
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', // .xlsx
            'application/vnd.ms-excel', // .xls
            'text/csv' // .csv
        ];

        if (!allowedTypes.includes(file.type) && !file.name.match(/\.(xlsx|xls|csv)$/i)) {
            showNotification('Please select a valid Excel (.xlsx, .xls) or CSV (.csv) file.', 'error');
            return;
        }

        // Validate file size (10MB limit)
        const maxSize = 10 * 1024 * 1024; // 10MB in bytes
        if (file.size > maxSize) {
            showNotification('File size exceeds 10MB limit. Please select a smaller file.', 'error');
            return;
        }

        // Update file information
        fileName.textContent = file.name;
        fileSize.textContent = formatFileSize(file.size);
        
        // Show file info and enable submit button
        fileInfo.classList.add('show');
        submitBtn.disabled = false;

        // Update file input
        const dt = new DataTransfer();
        dt.items.add(file);
        fileInput.files = dt.files;

        // Update upload zone appearance
        uploadZone.style.border = '3px solid #28a745';
        uploadZone.style.background = '#f0fff4';

        showNotification('File selected successfully!', 'success');
    }

    // Remove file
    removeFile.addEventListener('click', function() {
        fileInput.value = '';
        fileInfo.classList.remove('show');
        submitBtn.disabled = true;
        uploadZone.style.border = '3px dashed #28a745';
        uploadZone.style.background = '#f8fffe';
    });

    // Handle form submission
    uploadForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (!fileInput.files.length) {
            showNotification('Please select a file to upload.', 'error');
            return;
        }

        // Show loading state
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Uploading...';
        submitBtn.disabled = true;
        progressContainer.classList.add('show');

        // Simulate progress (replace with actual AJAX upload if needed)
        simulateProgress();

        // Submit form after delay
        setTimeout(() => {
            this.submit();
        }, 1500);
    });

    // Format file size
    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    // Simulate upload progress
    function simulateProgress() {
        let progress = 0;
        const interval = setInterval(() => {
            progress += Math.random() * 20;
            if (progress >= 100) {
                progress = 100;
                clearInterval(interval);
                progressText.textContent = 'Processing file...';
            }
            
            progressFill.style.width = progress + '%';
            progressText.textContent = `Uploading... ${Math.round(progress)}%`;
        }, 200);
    }

    // Show notification
    function showNotification(message, type = 'info') {
        // Remove existing notifications
        const existingNotifications = document.querySelectorAll('.notification-toast');
        existingNotifications.forEach(notification => notification.remove());

        const notification = document.createElement('div');
        notification.className = 'notification-toast';
        notification.innerHTML = `
            <div style="
                position: fixed;
                top: 20px;
                right: 20px;
                background: ${type === 'error' ? '#dc3545' : type === 'success' ? '#28a745' : '#17a2b8'};
                color: white;
                padding: 15px 20px;
                border-radius: 10px;
                z-index: 1000;
                animation: slideInNotification 0.3s ease;
                box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                max-width: 300px;
            ">
                <i class="fas fa-${type === 'error' ? 'exclamation-circle' : type === 'success' ? 'check-circle' : 'info-circle'}" style="margin-right: 8px;"></i>
                ${message}
            </div>
        `;

        document.body.appendChild(notification);

        // Remove after 4 seconds
        setTimeout(() => {
            notification.remove();
        }, 4000);
    }

    // Add CSS for notification animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideInNotification {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
    `;
    document.head.appendChild(style);

    // Add file type icon based on file extension
    fileInput.addEventListener('change', function() {
        if (this.files.length > 0) {
            const file = this.files[0];
            const fileIcon = document.getElementById('fileName').querySelector('i');
            
            if (file.name.match(/\.xlsx$/i)) {
                fileIcon.className = 'fas fa-file-excel';
                fileIcon.style.color = '#207245';
            } else if (file.name.match(/\.xls$/i)) {
                fileIcon.className = 'fas fa-file-excel';
                fileIcon.style.color = '#207245';
            } else if (file.name.match(/\.csv$/i)) {
                fileIcon.className = 'fas fa-file-csv';
                fileIcon.style.color = '#28a745';
            }
        }
    });

    // Add hover effects to buttons
    const buttons = document.querySelectorAll('.submit-btn, .cancel-btn');
    buttons.forEach(button => {
        button.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
        });
        
        button.addEventListener('mouseleave', function() {
            if (!this.disabled) {
                this.style.transform = 'translateY(0)';
            }
        });
    });
});
</script>

@endsection