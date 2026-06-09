@extends('components.dashmaster')
@section('body')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Clean Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="page-header">
                    <h1 class="page-title">
                        <i class="fas fa-upload me-2"></i>
                        Add Teaching Material
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('teacher.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('teacher.classes') }}">My Classes</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="/teacher/viewClass/{{ $class->id }}">{{ $class->name }}</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('teacher.subjects', [$class, $subject]) }}">{{ $subject->name }}</a>
                            </li>
                            <li class="breadcrumb-item active">Add Material</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <!-- Main Form Section -->
            <div class="col-md-10 col-lg-8">
                <div class="card form-card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">
                            <i class="fas fa-plus-circle me-2"></i>
                            Upload Material for {{ $subject->name }}
                        </h4>
                    </div>

                    <div class="card-body">
                        <!-- Alert Messages -->
                        <div id="alert-container"></div>

                        <form action="{{ route('teacherMaterials.store', ['class' => $class->id, 'subject' => $subject->id]) }}" 
                              method="POST" 
                              id="material-form" 
                              enctype="multipart/form-data">
                            @csrf
                            
                            <!-- Material Title -->
                            <div class="mb-4">
                                <label for="title" class="form-label">
                                    <i class="fas fa-heading me-1"></i>
                                    Material Title <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       id="title" 
                                       name="title" 
                                       class="form-control" 
                                       placeholder="Enter a descriptive title for the material"
                                       value="{{ old('title') }}"
                                       required>
                                <div class="form-text">
                                    Choose a clear, descriptive title that helps students understand the content
                                </div>
                            </div>

                            <!-- Material Type -->
                            <div class="mb-4">
                                <label for="type" class="form-label">
                                    <i class="fas fa-layer-group me-1"></i>
                                    Material Type <span class="text-danger">*</span>
                                </label>
                                <select name="type" id="type" class="form-select" required>
                                    <option value="" selected disabled>Select material type...</option>
                                    <option value="document" {{ old('type') == 'document' ? 'selected' : '' }}>
                                        📄 Document (PDF, DOC, etc.)
                                    </option>
                                    <option value="video" {{ old('type') == 'video' ? 'selected' : '' }}>
                                        🎥 Video (MP4, AVI, etc.)
                                    </option>
                                    <option value="link" {{ old('type') == 'link' ? 'selected' : '' }}>
                                        🔗 External Link
                                    </option>
                                </select>
                                <div class="form-text">
                                    Select the type of material you want to upload
                                </div>
                            </div>

                            <!-- File Upload Section -->
                            <div id="file-input" class="mb-4" style="display: none;">
                                <label for="file" class="form-label">
                                    <i class="fas fa-cloud-upload-alt me-1"></i>
                                    Upload File <span class="text-danger">*</span>
                                </label>
                                <div class="upload-area">
                                    <input type="file" name="file" id="file" class="form-control file-input">
                                    <div class="upload-placeholder">
                                        <i class="fas fa-cloud-upload-alt upload-icon"></i>
                                        <p class="upload-text">Click to browse or drag and drop your file here</p>
                                        <div class="file-info">
                                            <small class="text-muted">
                                                <strong>Documents:</strong> PDF, DOC, DOCX, ZIP (Max: 90MB)<br>
                                                <strong>Videos:</strong> MP4, AVI, MOV (Max: 90MB)
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                <div class="selected-file" id="selected-file" style="display: none;">
                                    <i class="fas fa-file me-2"></i>
                                    <span class="file-name"></span>
                                    <button type="button" class="btn-remove-file">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- URL Input Section -->
                            <div id="url-input" class="mb-4" style="display: none;">
                                <label for="url" class="form-label">
                                    <i class="fas fa-external-link-alt me-1"></i>
                                    External Link URL <span class="text-danger">*</span>
                                </label>
                                <input type="url" 
                                       name="url" 
                                       id="url" 
                                       class="form-control"
                                       placeholder="https://example.com/resource"
                                       value="{{ old('url') }}">
                                <div class="form-text">
                                    Enter the complete URL (including https://) of the external resource
                                </div>
                            </div>

                            <!-- Hidden Fields -->
                            <input type="hidden" name="class_id" value="{{ $class->id }}">
                            <input type="hidden" name="subject_id" value="{{ $subject->id }}">

                            <!-- Action Buttons -->
                            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                <button type="submit" class="btn btn-info me-md-2" id="submitBtn">
                                    <i class="fas fa-upload me-1"></i>
                                    Upload Material
                                </button>
                                <a href="{{ route('teacher.subjects', [$class, $subject]) }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-1"></i>
                                    Back to Materials
                                </a>
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

<style>
    .content-wrapper {
        padding: 20px;
    }
    
    .page-header {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 15px 20px;
        margin-bottom: 25px;
        border-left: 4px solid #17a2b8;
    }

    .page-title {
        color: #495057;
        font-size: 1.5rem;
        font-weight: 500;
        margin-bottom: 8px;
    }

    .breadcrumb {
        background: transparent;
        padding: 0;
        margin: 0;
        font-size: 0.9rem;
    }

    .breadcrumb-item a {
        color: #17a2b8;
        text-decoration: none;
    }

    .breadcrumb-item a:hover {
        text-decoration: underline;
    }

    .form-card {
        border: none;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .form-card .card-header {
        background: #17a2b8;
        color: white;
        border-radius: 8px 8px 0 0;
        padding: 15px 20px;
        border: none;
    }

    .form-card .card-title {
        font-weight: 500;
        font-size: 1.1rem;
    }

    .form-card .card-body {
        padding: 25px;
    }

    .form-label {
        font-weight: 500;
        color: #495057;
        margin-bottom: 6px;
    }

    .form-control, .form-select {
        border: 1px solid #ced4da;
        border-radius: 4px;
        padding: 10px 12px;
        font-size: 0.95rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .form-control:focus, .form-select:focus {
        border-color: #17a2b8;
        box-shadow: 0 0 0 0.2rem rgba(23, 162, 184, 0.25);
    }

    .form-text {
        color: #6c757d;
        font-size: 0.85rem;
    }

    .upload-area {
        position: relative;
        border: 2px dashed #17a2b8;
        border-radius: 8px;
        padding: 40px 20px;
        text-align: center;
        transition: all 0.3s ease;
        background: #f8f9fa;
        cursor: pointer;
    }

    .upload-area:hover {
        border-color: #117a8b;
        background: #e5f9fd;
    }

    .upload-area.dragover {
        border-color: #117a8b;
        background: #d1ecf1;
    }

    .file-input {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }

    .upload-placeholder {
        pointer-events: none;
    }

    .upload-icon {
        font-size: 3rem;
        color: #17a2b8;
        margin-bottom: 15px;
    }

    .upload-text {
        font-size: 1.1rem;
        color: #495057;
        margin-bottom: 15px;
        font-weight: 500;
    }

    .file-info {
        margin-top: 10px;
    }

    .selected-file {
        display: flex;
        align-items: center;
        padding: 12px;
        background: #d1ecf1;
        border: 1px solid #bee5eb;
        border-radius: 4px;
        margin-top: 10px;
    }

    .selected-file .file-name {
        flex-grow: 1;
        color: #0c5460;
        font-weight: 500;
    }

    .btn-remove-file {
        background: none;
        border: none;
        color: #721c24;
        cursor: pointer;
        padding: 2px 6px;
        margin-left: 10px;
    }

    .btn-remove-file:hover {
        color: #dc3545;
    }

    .btn {
        border-radius: 4px;
        font-weight: 500;
        padding: 8px 16px;
        transition: all 0.15s ease-in-out;
    }

    .btn-info {
        background-color: #17a2b8;
        border-color: #17a2b8;
    }

    .btn-info:hover {
        background-color: #138496;
        border-color: #117a8b;
    }

    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
        border-color: #5a6268;
    }

    .alert {
        border-radius: 4px;
        padding: 12px 16px;
        margin-bottom: 20px;
        border: 1px solid transparent;
    }

    .alert-success {
        background-color: #d4edda;
        border-color: #c3e6cb;
        color: #155724;
    }

    .alert-danger {
        background-color: #f8d7da;
        border-color: #f5c6cb;
        color: #721c24;
    }

    .progress {
        height: 6px;
        border-radius: 3px;
        background-color: #e9ecef;
        margin-top: 10px;
    }

    .progress-bar {
        background-color: #17a2b8;
        border-radius: 3px;
        transition: width 0.3s ease;
    }

    @media (max-width: 768px) {
        .content-wrapper {
            padding: 15px;
        }
        
        .page-title {
            font-size: 1.3rem;
        }
        
        .form-card .card-body {
            padding: 20px;
        }
        
        .btn {
            width: 100%;
            margin-bottom: 8px;
        }

        .upload-area {
            padding: 30px 15px;
        }

        .upload-icon {
            font-size: 2.5rem;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Update year in footer
        const yearEl = document.getElementById('currentYear');
        if (yearEl) {
            yearEl.textContent = new Date().getFullYear();
        }

        // Focus on title input
        document.getElementById('title').focus();

        // Material type change handler
        const typeSelect = document.getElementById('type');
        const fileInput = document.getElementById('file-input');
        const urlInput = document.getElementById('url-input');
        const fileField = document.getElementById('file');
        const urlField = document.getElementById('url');

        typeSelect.addEventListener('change', function() {
            const type = this.value;
            
            if (type === 'document' || type === 'video') {
                fileInput.style.display = 'block';
                urlInput.style.display = 'none';
                fileField.required = true;
                urlField.required = false;
                urlField.value = '';
            } else if (type === 'link') {
                fileInput.style.display = 'none';
                urlInput.style.display = 'block';
                fileField.required = false;
                urlField.required = true;
                fileField.value = '';
                document.getElementById('selected-file').style.display = 'none';
            } else {
                fileInput.style.display = 'none';
                urlInput.style.display = 'none';
                fileField.required = false;
                urlField.required = false;
            }
        });

        // File upload handling
        const uploadArea = document.querySelector('.upload-area');
        const selectedFileDiv = document.getElementById('selected-file');
        const fileNameSpan = selectedFileDiv.querySelector('.file-name');
        const removeFileBtn = selectedFileDiv.querySelector('.btn-remove-file');

        // File selection
        fileField.addEventListener('change', function(e) {
            if (this.files.length > 0) {
                const file = this.files[0];
                fileNameSpan.textContent = file.name + ' (' + formatFileSize(file.size) + ')';
                selectedFileDiv.style.display = 'flex';
                uploadArea.style.display = 'none';
            }
        });

        // Remove file
        removeFileBtn.addEventListener('click', function() {
            fileField.value = '';
            selectedFileDiv.style.display = 'none';
            uploadArea.style.display = 'block';
        });

        // Drag and drop
        uploadArea.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.classList.add('dragover');
        });

        uploadArea.addEventListener('dragleave', function(e) {
            e.preventDefault();
            this.classList.remove('dragover');
        });

        uploadArea.addEventListener('drop', function(e) {
            e.preventDefault();
            this.classList.remove('dragover');
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                fileField.files = files;
                fileField.dispatchEvent(new Event('change'));
            }
        });

        // Form submission
        const form = document.getElementById('material-form');
        const submitBtn = document.getElementById('submitBtn');
        const alertContainer = document.getElementById('alert-container');

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Validate form
            if (!validateForm()) {
                return;
            }

            // Show loading state
            const originalContent = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Uploading...';
            submitBtn.disabled = true;

            // Clear previous alerts
            alertContainer.innerHTML = '';

            // Submit form with fetch API
            const formData = new FormData(form);
            
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (response.ok) {
                    return response.text();
                }
                throw new Error('Upload failed');
            })
            .then(data => {
                showAlert('Material uploaded successfully!', 'success');
                form.reset();
                selectedFileDiv.style.display = 'none';
                uploadArea.style.display = 'block';
                fileInput.style.display = 'none';
                urlInput.style.display = 'none';
                
                // Redirect after a brief delay
                setTimeout(() => {
                    window.location.href = '{{ route("teacher.subjects", [$class, $subject]) }}';
                }, 2000);
            })
            .catch(error => {
                showAlert('Error uploading material. Please try again.', 'danger');
            })
            .finally(() => {
                // Reset button state
                submitBtn.innerHTML = originalContent;
                submitBtn.disabled = false;
            });
        });

        // Helper functions
        function validateForm() {
            const title = document.getElementById('title').value.trim();
            const type = document.getElementById('type').value;
            
            if (!title) {
                showAlert('Please enter a material title.', 'danger');
                return false;
            }
            
            if (!type) {
                showAlert('Please select a material type.', 'danger');
                return false;
            }
            
            if (type === 'document' || type === 'video') {
                if (!fileField.files.length) {
                    showAlert('Please select a file to upload.', 'danger');
                    return false;
                }
            }
            
            if (type === 'link') {
                const url = document.getElementById('url').value.trim();
                if (!url) {
                    showAlert('Please enter a valid URL.', 'danger');
                    return false;
                }
            }
            
            return true;
        }

        function showAlert(message, type) {
            const alert = document.createElement('div');
            alert.className = `alert alert-${type}`;
            alert.innerHTML = `
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-triangle'} me-2"></i>
                ${message}
            `;
            alertContainer.appendChild(alert);
            
            // Auto-remove after 5 seconds
            setTimeout(() => {
                alert.remove();
            }, 5000);
        }

        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }
    });
</script>

@endsection
