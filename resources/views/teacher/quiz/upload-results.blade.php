@extends('components.dashmaster')

@section('body')

<style>
/* Enhanced Upload Results Styling */
.upload-container {
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    min-height: 100vh;
    padding: 20px 0;
}

.back-navigation {
    margin-bottom: 20px;
}

.back-btn {
    background: rgba(255, 255, 255, 0.9);
    color: #6c757d;
    padding: 10px 20px;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.back-btn:hover {
    background: white;
    color: #495057;
    text-decoration: none;
    transform: translateY(-2px);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
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
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
    color: #9b59b6;
    background: linear-gradient(135deg, #9b59b6, #8e44ad);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.quiz-info {
    position: relative;
    z-index: 1;
    color: #6c757d;
    font-size: 1.1rem;
}

.quiz-meta {
    display: flex;
    gap: 25px;
    flex-wrap: wrap;
    margin-top: 15px;
}

.meta-item {
    display: flex;
    align-items: center;
    font-size: 0.95rem;
}

.meta-item i {
    margin-right: 8px;
    color: #667eea;
}

.upload-sections {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 30px;
    margin-bottom: 30px;
}

.section-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: all 0.3s ease;
}

.section-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

.section-header {
    padding: 25px 30px;
    font-weight: 600;
    font-size: 1.3rem;
    display: flex;
    align-items: center;
    color: white;
    position: relative;
}

.template-section .section-header {
    background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
}

.upload-section .section-header {
    background: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%);
}

.section-header i {
    margin-right: 12px;
    font-size: 1.4rem;
}

.section-body {
    padding: 30px;
}

.template-info {
    color: #6c757d;
    margin-bottom: 25px;
    line-height: 1.6;
}

.template-features {
    margin-bottom: 25px;
}

.feature-item {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
    color: #495057;
}

.feature-item i {
    color: #28a745;
    margin-right: 12px;
    width: 20px;
}

.download-btn {
    background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
    color: white;
    border: none;
    padding: 15px 30px;
    border-radius: 25px;
    font-weight: 600;
    font-size: 1rem;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    transition: all 0.3s ease;
    box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
}

.download-btn:hover {
    color: white;
    text-decoration: none;
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(52, 152, 219, 0.4);
}

.download-btn i {
    margin-right: 10px;
    font-size: 1.1rem;
}

.upload-form {
    position: relative;
}

.form-group {
    margin-bottom: 25px;
}

.form-label {
    color: #495057;
    font-weight: 600;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
}

.form-label i {
    margin-right: 8px;
    color: #667eea;
}

.file-upload-area {
    border: 3px dashed #dee2e6;
    border-radius: 15px;
    padding: 40px 20px;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    background: #f8f9fa;
}

.file-upload-area:hover {
    border-color: #667eea;
    background: #f0f2ff;
}

.file-upload-area.drag-over {
    border-color: #2ecc71;
    background: #f0fff4;
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

.upload-content {
    pointer-events: none;
}

.upload-icon {
    font-size: 3rem;
    color: #dee2e6;
    margin-bottom: 15px;
    transition: all 0.3s ease;
}

.file-upload-area:hover .upload-icon {
    color: #667eea;
    transform: scale(1.1);
}

.upload-text {
    font-size: 1.2rem;
    font-weight: 600;
    color: #495057;
    margin-bottom: 10px;
}

.upload-hint {
    color: #6c757d;
    font-size: 0.9rem;
    line-height: 1.5;
}

.file-selected {
    background: #d4edda;
    color: #155724;
    padding: 15px 20px;
    border-radius: 10px;
    margin-top: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    font-weight: 600;
}

.error-message {
    color: #dc3545;
    font-size: 0.9rem;
    margin-top: 8px;
    display: flex;
    align-items: center;
}

.error-message i {
    margin-right: 6px;
}

.submit-btn {
    background: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%);
    color: white;
    border: none;
    padding: 15px 40px;
    border-radius: 25px;
    font-weight: 600;
    font-size: 1.1rem;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    box-shadow: 0 5px 15px rgba(46, 204, 113, 0.3);
    width: 100%;
    justify-content: center;
}

.submit-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(46, 204, 113, 0.4);
}

.submit-btn:disabled {
    background: #6c757d;
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
}

.submit-btn i {
    margin-right: 10px;
    font-size: 1.1rem;
}

.instructions-section {
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    padding: 30px;
    margin-top: 30px;
}

.instructions-title {
    color: #495057;
    font-weight: 600;
    font-size: 1.3rem;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
}

.instructions-title i {
    margin-right: 10px;
    color: #ffc107;
}

.instruction-steps {
    counter-reset: step-counter;
}

.instruction-step {
    counter-increment: step-counter;
    margin-bottom: 20px;
    padding-left: 50px;
    position: relative;
    color: #495057;
    line-height: 1.6;
}

.instruction-step::before {
    content: counter(step-counter);
    position: absolute;
    left: 0;
    top: 0;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 0.9rem;
}

@media (max-width: 768px) {
    .upload-sections {
        grid-template-columns: 1fr;
    }
    
    .quiz-meta {
        justify-content: center;
    }
}

.loading-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 9999;
}

.loading-content {
    background: white;
    padding: 30px;
    border-radius: 15px;
    text-align: center;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
}

.loading-spinner {
    border: 4px solid #f3f3f3;
    border-top: 4px solid #667eea;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    animation: spin 1s linear infinite;
    margin: 0 auto 15px;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>

<div class="content-wrapper upload-container">
    <div class="container-fluid">
        <!-- Back Navigation -->
        <div class="back-navigation">
            <a href="{{ route('view.quizzes.results', $quiz->id) }}" class="back-btn">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Quiz Results
            </a>
        </div>

        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">
                <i class="fas fa-cloud-upload-alt"></i>
                Upload Quiz Results
            </h1>
            
            <div class="quiz-info">
                Upload results for: <strong>{{ $quiz->title }}</strong>
            </div>
            
            <div class="quiz-meta">
                <div class="meta-item">
                    <i class="fas fa-graduation-cap"></i>
                    {{ $quiz->class->name ?? 'N/A' }}
                </div>
                <div class="meta-item">
                    <i class="fas fa-book"></i>
                    {{ $quiz->subject->name ?? 'N/A' }}
                </div>
                <div class="meta-item">
                    <i class="fas fa-clock"></i>
                    {{ $quiz->duration }} minutes
                </div>
                <div class="meta-item">
                    <i class="fas fa-calendar"></i>
                    {{ $quiz->created_at->format('M d, Y') }}
                </div>
            </div>
        </div>

        <!-- Main Upload Sections -->
        <div class="upload-sections">
            <!-- Template Download Section -->
            <div class="section-card template-section">
                <div class="section-header">
                    <i class="fas fa-download"></i>
                    Download Template
                </div>
                <div class="section-body">
                    <div class="template-info">
                        Download the Excel template to ensure proper formatting for your quiz results upload.
                    </div>
                    
                    <div class="template-features">
                        <div class="feature-item">
                            <i class="fas fa-check"></i>
                            Pre-formatted student list
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check"></i>
                            Proper column headers
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check"></i>
                            Score validation rules
                        </div>
                        <div class="feature-item">
                            <i class="fas fa-check"></i>
                            Easy data entry format
                        </div>
                    </div>
                    
                    <a href="{{ route('quizzes.downloadTemplate', $quiz->id) }}" 
                       class="download-btn"
                       onclick="trackDownload()">
                        <i class="fas fa-file-excel"></i>
                        Download Excel Template
                    </a>
                </div>
            </div>

            <!-- Upload Section -->
            <div class="section-card upload-section">
                <div class="section-header">
                    <i class="fas fa-cloud-upload-alt"></i>
                    Upload Results File
                </div>
                <div class="section-body">
                    <form id="uploadForm" action="{{ route('quizzes.uploadResults', $quiz->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="form-group">
                            <label class="form-label" for="results_file">
                                <i class="fas fa-file-upload"></i>
                                Select Results File<span style="color: #dc3545;">*</span>
                            </label>
                            <div class="file-upload-area" id="fileUploadArea">
                                <input type="file" 
                                       class="file-upload-input" 
                                       id="results_file" 
                                       name="results_file" 
                                       accept=".csv,.xlsx,.xls" 
                                       required>
                                <div class="upload-content">
                                    <i class="fas fa-cloud-upload-alt upload-icon"></i>
                                    <div class="upload-text">Click to select or drag & drop</div>
                                    <div class="upload-hint">
                                        Supported formats: Excel (.xlsx, .xls), CSV (.csv)<br>
                                        Maximum file size: 10MB
                                    </div>
                                    <div class="file-selected" id="fileSelected" style="display: none;">
                                        <i class="fas fa-check-circle"></i>
                                        <span id="fileName">No file selected</span>
                                    </div>
                                </div>
                            </div>
                            @error('results_file')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="submit-btn" id="submitBtn" disabled>
                            <i class="fas fa-upload"></i>
                            Upload Results
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Instructions Section -->
        <div class="instructions-section">
            <h3 class="instructions-title">
                <i class="fas fa-info-circle"></i>
                Upload Instructions
            </h3>
            
            <div class="instruction-steps">
                <div class="instruction-step">
                    <strong>Download the template</strong> using the button above to get the correctly formatted Excel file with student information.
                </div>
                <div class="instruction-step">
                    <strong>Fill in the scores</strong> for each student in the template. Make sure to use numerical values (0-100) for percentages.
                </div>
                <div class="instruction-step">
                    <strong>Save the file</strong> as Excel (.xlsx) or CSV format. Do not change the column headers or student names.
                </div>
                <div class="instruction-step">
                    <strong>Upload the file</strong> using the upload area above. The system will validate and import the results automatically.
                </div>
                <div class="instruction-step">
                    <strong>Review the results</strong> after upload to ensure all data was imported correctly. You can always re-upload if needed.
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Loading Overlay -->
<div class="loading-overlay" id="loadingOverlay">
    <div class="loading-content">
        <div class="loading-spinner"></div>
        <h5>Processing Upload...</h5>
        <p class="text-muted mb-0">Please wait while we process your results file.</p>
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
    const fileInput = document.getElementById('results_file');
    const fileUploadArea = document.getElementById('fileUploadArea');
    const fileSelected = document.getElementById('fileSelected');
    const fileName = document.getElementById('fileName');
    const submitBtn = document.getElementById('submitBtn');
    const uploadForm = document.getElementById('uploadForm');
    const loadingOverlay = document.getElementById('loadingOverlay');
    
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
            
            // Validate file type
            const allowedTypes = ['.csv', '.xlsx', '.xls'];
            const fileExtension = '.' + file.name.split('.').pop().toLowerCase();
            
            if (!allowedTypes.includes(fileExtension)) {
                showNotification('error', 'Invalid File Type', 'Please select a CSV or Excel file.');
                fileInput.value = '';
                return;
            }
            
            // Validate file size (10MB)
            if (file.size > 10 * 1024 * 1024) {
                showNotification('error', 'File Too Large', 'Please select a file smaller than 10MB.');
                fileInput.value = '';
                return;
            }
            
            fileName.textContent = file.name;
            fileSelected.style.display = 'flex';
            submitBtn.disabled = false;
            fileUploadArea.style.background = '#f0fff4';
            fileUploadArea.style.borderColor = '#28a745';
        }
    }
    
    // Click to select file
    fileUploadArea.addEventListener('click', function() {
        fileInput.click();
    });
    
    // Form submission
    uploadForm.addEventListener('submit', function(e) {
        if (!fileInput.files.length) {
            e.preventDefault();
            showNotification('warning', 'No File Selected', 'Please select a results file before uploading.');
            return;
        }
        
        // Show loading overlay
        loadingOverlay.style.display = 'flex';
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
    });
    
    // Download tracking
    window.trackDownload = function() {
        showNotification('info', 'Template Downloaded', 'Excel template has been downloaded successfully!');
    };
    
    // Notification function
    function showNotification(type, title, message) {
        const config = {
            title: title,
            text: message,
            showConfirmButton: true,
            timer: 5000,
            timerProgressBar: true,
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
        loadingOverlay.style.display = 'none';
    @endif

    @if(session('error'))
        showNotification('error', 'Error!', '{{ session('error') }}');
        loadingOverlay.style.display = 'none';
    @endif

    @if($errors->any())
        let errorMessages = '';
        @foreach($errors->all() as $error)
            errorMessages += '{{ $error }}\n';
        @endforeach
        showNotification('error', 'Upload Errors', errorMessages);
        loadingOverlay.style.display = 'none';
    @endif
    
    // Footer year
    document.getElementById("currentYear").textContent = new Date().getFullYear();
    
    console.log('✅ Enhanced Upload Results page loaded successfully!');
});
</script>

@endsection
