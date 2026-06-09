@extends('components.dashmaster')

@section('body')

<style>
/* Enhanced Assignment Form Styling */
.assignment-form-container {
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    min-height: 100vh;
    padding: 20px 0;
}

.form-wrapper {
    max-width: 1000px;
    margin: 0 auto;
    animation: fadeInUp 0.8s ease;
}

.form-header {
    background: white;
    border-radius: 20px 20px 0 0;
    padding: 40px 30px;
    text-align: center;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    position: relative;
    overflow: hidden;
}

.form-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    opacity: 0.1;
    z-index: 0;
}

.form-header h2 {
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

.form-header h2 i {
    margin-right: 15px;
    color: #27ae60;
    background: linear-gradient(135deg, #27ae60, #2ecc71);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.form-header p {
    color: #7f8c8d;
    font-size: 1.1rem;
    margin: 0;
    position: relative;
    z-index: 1;
}

.notes-section {
    background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);
    border: 2px solid #f39c12;
    border-radius: 15px;
    padding: 25px;
    margin-bottom: 30px;
    animation: slideInLeft 0.6s ease;
}

.notes-title {
    color: #e67e22;
    font-weight: 700;
    font-size: 1.3rem;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
}

.notes-title i {
    margin-right: 10px;
    font-size: 1.5rem;
}

.notes-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.notes-list li {
    color: #d35400;
    font-weight: 600;
    margin-bottom: 8px;
    display: flex;
    align-items: flex-start;
}

.notes-list li i {
    margin-right: 10px;
    margin-top: 3px;
    color: #e67e22;
    font-size: 0.9rem;
}

.assignment-form-card {
    background: white;
    border-radius: 0 0 20px 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.form-progress {
    height: 6px;
    background: #e9ecef;
    overflow: hidden;
}

.form-progress-bar {
    height: 100%;
    background: linear-gradient(90deg, #27ae60, #2ecc71);
    transition: width 0.3s ease;
    width: 0%;
}

.form-body {
    padding: 40px 30px;
}

.form-section {
    margin-bottom: 35px;
    animation: slideIn 0.5s ease;
}

.form-section-title {
    color: #2c3e50;
    font-size: 1.4rem;
    font-weight: 600;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    border-bottom: 2px solid #ecf0f1;
    padding-bottom: 10px;
}

.form-section-title i {
    margin-right: 10px;
    color: #27ae60;
    width: 25px;
    font-size: 1.3rem;
}

.form-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 25px;
    margin-bottom: 25px;
}

.form-group {
    position: relative;
}

.form-group label {
    display: block;
    color: #34495e;
    font-weight: 600;
    margin-bottom: 8px;
    font-size: 1rem;
}

.required-asterisk {
    color: #e74c3c;
    margin-left: 4px;
}

.form-control {
    width: 100%;
    padding: 15px 20px;
    border: 2px solid #e9ecef;
    border-radius: 12px;
    font-size: 1rem;
    background: white;
    transition: all 0.3s ease;
    font-family: inherit;
    color: #495057;
}

.form-control:focus {
    outline: none;
    border-color: #27ae60;
    box-shadow: 0 0 0 4px rgba(39, 174, 96, 0.1);
    transform: translateY(-2px);
    background-color: white;
}

.form-control::placeholder {
    color: #9ca3af;
    font-style: italic;
}

/* Select styling */
select.form-control {
    background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%2327ae60' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6,9 12,15 18,9'%3e%3c/polyline%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 20px center;
    background-size: 16px;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    padding-right: 50px;
    cursor: pointer;
    background-color: white;
}

select.form-control option {
    color: #495057;
    background-color: white;
    font-style: normal;
}

select.form-control option:first-child[value=""] {
    color: #9ca3af;
    font-style: italic;
}

/* Textarea styling */
textarea.form-control {
    min-height: 120px;
    resize: vertical;
    font-family: inherit;
}

/* File upload styling */
.file-upload-wrapper {
    position: relative;
    overflow: hidden;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border: 2px dashed #27ae60;
    border-radius: 12px;
    padding: 30px 20px;
    text-align: center;
    transition: all 0.3s ease;
    cursor: pointer;
}

.file-upload-wrapper:hover {
    background: linear-gradient(135deg, #e8f5e8 0%, #d4edda 100%);
    border-color: #2ecc71;
    transform: translateY(-2px);
}

.file-upload-wrapper input[type="file"] {
    position: absolute;
    left: -9999px;
    opacity: 0;
}

.file-upload-content {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.file-upload-icon {
    font-size: 3rem;
    color: #27ae60;
    margin-bottom: 15px;
}

.file-upload-text {
    color: #2c3e50;
    font-weight: 600;
    font-size: 1.1rem;
    margin-bottom: 8px;
}

.file-upload-hint {
    color: #7f8c8d;
    font-size: 0.9rem;
}

.file-selected {
    background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
    border-color: #28a745;
}

.file-selected .file-upload-icon {
    color: #28a745;
}

.file-selected .file-upload-text {
    color: #155724;
}

/* Date/time input styling */
input[type="datetime-local"].form-control {
    position: relative;
    background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%2327ae60' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3crect x='3' y='4' width='18' height='18' rx='2' ry='2'%3e%3c/rect%3e%3cline x1='16' y1='2' x2='16' y2='6'%3e%3c/line%3e%3cline x1='8' y1='2' x2='8' y2='6'%3e%3c/line%3e%3cline x1='3' y1='10' x2='21' y2='10'%3e%3c/line%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 20px center;
    background-size: 16px;
    padding-right: 50px;
}

/* Error styling */
.error-message {
    color: #e74c3c;
    font-size: 0.9rem;
    margin-top: 8px;
    display: flex;
    align-items: center;
    animation: slideInUp 0.3s ease;
}

.error-message i {
    margin-right: 6px;
    font-size: 0.8rem;
}

/* Submit button */
.submit-btn {
    background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
    color: white;
    border: none;
    padding: 18px 50px;
    font-size: 1.2rem;
    font-weight: 600;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 1px;
    position: relative;
    overflow: hidden;
    margin-top: 30px;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
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

.submit-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(39, 174, 96, 0.4);
}

.submit-btn:disabled {
    opacity: 0.7;
    cursor: not-allowed;
    transform: none;
}

.submit-btn i {
    margin-right: 10px;
    font-size: 1.1rem;
}

/* Form validation feedback */
.form-control.is-valid {
    border-color: #28a745;
    background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%2328a745' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='20,6 9,17 4,12'%3e%3c/polyline%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 20px center;
    background-size: 16px;
}

.form-control.is-invalid {
    border-color: #e74c3c;
    background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23e74c3c' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cline x1='18' y1='6' x2='6' y2='18'%3e%3c/line%3e%3cline x1='6' y1='6' x2='18' y2='18'%3e%3c/line%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 20px center;
    background-size: 16px;
}

/* Loading overlay */
.loading-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
}

.loading-overlay.show {
    opacity: 1;
    visibility: visible;
}

.loading-content {
    background: white;
    padding: 30px;
    border-radius: 15px;
    text-align: center;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
}

.loading-spinner {
    font-size: 3rem;
    color: #27ae60;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

/* Responsive design */
@media (max-width: 768px) {
    .form-row {
        grid-template-columns: 1fr;
    }
    
    .assignment-form-container {
        padding: 10px;
    }
    
    .form-body {
        padding: 25px 15px;
    }
    
    .form-header {
        padding: 25px 15px;
    }
    
    .form-header h2 {
        font-size: 2rem;
    }
    
    .submit-btn {
        padding: 15px 30px;
        font-size: 1.1rem;
    }
}

/* Animations */
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

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateX(-20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

<div class="content-wrapper assignment-form-container">
    <div class="container-fluid">
        <div class="form-wrapper">
            <!-- Header -->
            <div class="form-header">
                <h2>
                    <i class="fas fa-plus-circle"></i>
                    Create New Assignment
                </h2>
                <p>Design and distribute assignments to enhance student learning</p>
            </div>

            <!-- Important Notes Section -->
            <div class="notes-section">
                <div class="notes-title">
                    <i class="fas fa-exclamation-triangle"></i>
                    Important Guidelines
                </div>
                <ul class="notes-list">
                    <li><i class="fas fa-check"></i>Set a realistic deadline that allows adequate time for completion</li>
                    <li><i class="fas fa-check"></i>Ensure the assignment aligns with your learning objectives</li>
                    <li><i class="fas fa-check"></i>Provide clear instructions and expectations</li>
                    <li><i class="fas fa-check"></i>Upload relevant materials and resources</li>
                </ul>
            </div>

            <!-- Form Card -->
            <div class="assignment-form-card">
                <!-- Progress Bar -->
                <div class="form-progress">
                    <div class="form-progress-bar" id="formProgress"></div>
                </div>

                <!-- Form Body -->
                <div class="form-body">
                    <form action="{{ route('assignments.store') }}" method="POST" enctype="multipart/form-data" id="assignmentForm" novalidate>
                        @csrf

                        <!-- Basic Information Section -->
                        <div class="form-section">
                            <h3 class="form-section-title">
                                <i class="fas fa-info-circle"></i>
                                Basic Information
                            </h3>

                            <div class="form-group">
                                <label for="title">Assignment Title<span class="required-asterisk">*</span></label>
                                <input type="text" name="title" id="title" class="form-control" 
                                       placeholder="Enter assignment title (e.g., Mathematics Quiz Chapter 5)" 
                                       value="{{ old('title') }}" required>
                                @error('title')
                                    <div class="error-message">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="class_id">Select Class<span class="required-asterisk">*</span></label>
                                    <select name="class_id" id="class_id" class="form-control" required>
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

                                <div class="form-group">
                                    <label for="subject_id">Select Subject<span class="required-asterisk">*</span></label>
                                    <select name="subject_id" id="subject_id" class="form-control" required>
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

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control" rows="4"
                                          placeholder="Provide detailed instructions, objectives, and any special requirements for this assignment...">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="error-message">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Files and Resources Section -->
                        <div class="form-section">
                            <h3 class="form-section-title">
                                <i class="fas fa-file-upload"></i>
                                Assignment File
                            </h3>

                            <div class="form-group">
                                <label for="file">Upload Assignment Document<span class="required-asterisk">*</span></label>
                                <div class="file-upload-wrapper" onclick="document.getElementById('file').click()">
                                    <div class="file-upload-content">
                                        <i class="fas fa-cloud-upload-alt file-upload-icon"></i>
                                        <div class="file-upload-text">Click to upload assignment file</div>
                                        <div class="file-upload-hint">Supports PDF, DOC, DOCX files (Max: 10MB)</div>
                                    </div>
                                    <input type="file" name="file" id="file" accept=".pdf,.doc,.docx" required>
                                </div>
                                @error('file')
                                    <div class="error-message">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Schedule Section -->
                        <div class="form-section">
                            <h3 class="form-section-title">
                                <i class="fas fa-calendar-alt"></i>
                                Assignment Schedule
                            </h3>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="submission_deadline">Submission Deadline<span class="required-asterisk">*</span></label>
                                    <input type="datetime-local" name="submission_deadline" id="submission_deadline" 
                                           class="form-control" value="{{ old('submission_deadline') }}" required>
                                    @error('submission_deadline')
                                        <div class="error-message">
                                            <i class="fas fa-exclamation-circle"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="submit-btn" id="submitBtn">
                            <i class="fas fa-plus-circle"></i>
                            Create Assignment
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Loading Overlay -->
<div class="loading-overlay" id="loadingOverlay">
    <div class="loading-content">
        <i class="fas fa-spinner loading-spinner"></i>
        <h4 style="margin-top: 15px; color: #2c3e50;">Creating Assignment...</h4>
        <p style="color: #7f8c8d; margin: 0;">Please wait while we process your request</p>
    </div>
</div>
 <footer class="main-footer">
    <strong>Copyright &copy; <span id="currentYear"></span> <a href="https://sumajkt.go.tz">Visit Our Website</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Teacher Portal</b> v2.0
    </div>
</footer>

<script>
    // Enhanced form functionality
    document.addEventListener('DOMContentLoaded', function() {
        // Set current year
        document.getElementById("currentYear").textContent = new Date().getFullYear();
        
        // Initialize form progress tracking
        updateFormProgress();
        
        // Add event listeners to form fields
        const formFields = document.querySelectorAll('input, select, textarea');
        formFields.forEach(field => {
            field.addEventListener('input', updateFormProgress);
            field.addEventListener('change', updateFormProgress);
            
            // Add validation styling on blur
            field.addEventListener('blur', function() {
                validateField(this);
            });
        });
        
        // Set minimum datetime to now + 1 hour
        const now = new Date();
        now.setHours(now.getHours() + 1);
        const minDateTime = now.toISOString().slice(0, 16);
        document.getElementById('submission_deadline').min = minDateTime;
        
        // Initialize select styling
        const selectElements = document.querySelectorAll('select.form-control');
        selectElements.forEach(select => {
            updateSelectStyle(select);
        });
        
        // Add animation delays to form sections
        const sections = document.querySelectorAll('.form-section');
        sections.forEach((section, index) => {
            section.style.animationDelay = `${index * 0.1}s`;
        });
    });

    // Class and subject handling
    document.getElementById('class_id').addEventListener('change', function() {
        const classId = this.value;
        const subjectSelect = document.getElementById('subject_id');
        
        // Reset subject dropdown
        subjectSelect.innerHTML = '<option value="">Loading subjects...</option>';
        subjectSelect.disabled = true;
        
        if (classId) {
            fetch(`/teacher/get-subjects/${classId}`)
                .then(response => response.json())
                .then(data => {
                    subjectSelect.innerHTML = '<option value="">Select Subject</option>';
                    
                    data.forEach(subject => {
                        const option = document.createElement('option');
                        option.value = subject.id;
                        option.textContent = subject.name;
                        subjectSelect.appendChild(option);
                    });
                    
                    subjectSelect.disabled = false;
                    updateSelectStyle(subjectSelect);
                    showNotification('Subjects loaded successfully', 'success');
                })
                .catch(error => {
                    console.error('Error fetching subjects:', error);
                    subjectSelect.innerHTML = '<option value="">Error loading subjects</option>';
                    showNotification('Error loading subjects. Please try again.', 'error');
                });
        } else {
            subjectSelect.innerHTML = '<option value="">First select a class</option>';
            subjectSelect.disabled = false;
        }
        
        updateSelectStyle(this);
        updateFormProgress();
    });

    // File upload handling
    document.getElementById('file').addEventListener('change', function() {
        const fileWrapper = document.querySelector('.file-upload-wrapper');
        const fileName = this.files[0] ? this.files[0].name : '';
        
        if (fileName) {
            fileWrapper.classList.add('file-selected');
            const textElement = fileWrapper.querySelector('.file-upload-text');
            const hintElement = fileWrapper.querySelector('.file-upload-hint');
            
            textElement.textContent = fileName;
            hintElement.textContent = `File selected: ${(this.files[0].size / 1024 / 1024).toFixed(2)} MB`;
            
            // Validate file size (10MB max)
            if (this.files[0].size > 10 * 1024 * 1024) {
                showNotification('File size must be less than 10MB', 'error');
                this.value = '';
                resetFileUpload();
                return;
            }
            
            // Validate file type
            const allowedTypes = ['.pdf', '.doc', '.docx'];
            const fileExtension = '.' + fileName.split('.').pop().toLowerCase();
            if (!allowedTypes.includes(fileExtension)) {
                showNotification('Only PDF, DOC, and DOCX files are allowed', 'error');
                this.value = '';
                resetFileUpload();
                return;
            }
            
            this.classList.add('is-valid');
            this.classList.remove('is-invalid');
        } else {
            resetFileUpload();
        }
        
        updateFormProgress();
    });

    // Reset file upload display
    function resetFileUpload() {
        const fileWrapper = document.querySelector('.file-upload-wrapper');
        const textElement = fileWrapper.querySelector('.file-upload-text');
        const hintElement = fileWrapper.querySelector('.file-upload-hint');
        
        fileWrapper.classList.remove('file-selected');
        textElement.textContent = 'Click to upload assignment file';
        hintElement.textContent = 'Supports PDF, DOC, DOCX files (Max: 10MB)';
    }

    // Form progress tracking
    function updateFormProgress() {
        const form = document.getElementById('assignmentForm');
        const requiredFields = form.querySelectorAll('[required]');
        const progressBar = document.getElementById('formProgress');
        
        let filledFields = 0;
        requiredFields.forEach(field => {
            if (field.type === 'file') {
                if (field.files && field.files.length > 0) {
                    filledFields++;
                }
            } else if (field.value && field.value.trim() !== '') {
                filledFields++;
            }
        });
        
        const progress = (filledFields / requiredFields.length) * 100;
        progressBar.style.width = progress + '%';
    }

    // Field validation
    function validateField(field) {
        const isValid = field.checkValidity();
        
        if (isValid) {
            field.classList.add('is-valid');
            field.classList.remove('is-invalid');
        } else {
            field.classList.add('is-invalid');
            field.classList.remove('is-valid');
        }
        
        return isValid;
    }

    // Update select styling
    function updateSelectStyle(selectElement) {
        if (!selectElement.value || selectElement.value === '') {
            selectElement.style.color = '#9ca3af';
            selectElement.style.fontStyle = 'italic';
        } else {
            selectElement.style.color = '#495057';
            selectElement.style.fontStyle = 'normal';
        }
        
        // Update on change
        selectElement.addEventListener('change', function() {
            updateSelectStyle(this);
        });
    }

    // Form submission handling
    document.getElementById('assignmentForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Validate all fields
        const formFields = this.querySelectorAll('[required]');
        let isFormValid = true;
        
        formFields.forEach(field => {
            if (!validateField(field)) {
                isFormValid = false;
            }
        });
        
        if (isFormValid) {
            // Show loading overlay
            document.getElementById('loadingOverlay').classList.add('show');
            
            // Update submit button
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Creating Assignment...';
            submitBtn.disabled = true;
            
            // Submit form after short delay for UX
            setTimeout(() => {
                this.submit();
            }, 1000);
        } else {
            showNotification('Please fill in all required fields correctly', 'error');
            
            // Scroll to first invalid field
            const firstInvalid = this.querySelector('.is-invalid');
            if (firstInvalid) {
                firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                firstInvalid.focus();
            }
        }
    });

    // Notification system
    function showNotification(message, type = 'info') {
        // Remove existing notifications
        const existingNotifications = document.querySelectorAll('.notification');
        existingNotifications.forEach(notification => notification.remove());
        
        const notification = document.createElement('div');
        notification.className = 'notification';
        
        const bgColor = type === 'error' ? '#e74c3c' : type === 'success' ? '#27ae60' : '#3498db';
        const icon = type === 'error' ? 'exclamation-circle' : type === 'success' ? 'check-circle' : 'info-circle';
        
        notification.innerHTML = `
            <div style="
                position: fixed;
                top: 20px;
                right: 20px;
                background: ${bgColor};
                color: white;
                padding: 15px 20px;
                border-radius: 12px;
                z-index: 10000;
                animation: slideInNotification 0.5s ease;
                box-shadow: 0 5px 20px rgba(0,0,0,0.2);
                max-width: 400px;
            ">
                <i class="fas fa-${icon}" style="margin-right: 10px;"></i>
                ${message}
            </div>
        `;
        
        document.body.appendChild(notification);
        
        // Remove after 5 seconds
        setTimeout(() => {
            notification.remove();
        }, 5000);
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

    // Handle browser back button to clear loading
    window.addEventListener('pageshow', function(event) {
        if (event.persisted) {
            document.getElementById('loadingOverlay').classList.remove('show');
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.innerHTML = '<i class="fas fa-plus-circle"></i> Create Assignment';
            submitBtn.disabled = false;
        }
    });

    // Show success message if redirected back
    @if(session('success'))
        showNotification('{{ session('success') }}', 'success');
    @endif

    @if(session('error'))
        showNotification('{{ session('error') }}', 'error');
    @endif
</script>
@endsection




