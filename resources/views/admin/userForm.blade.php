@extends('components.dashmaster')

@section('body')

<style>
.user-form-container {
    background: #f8f9fa;
    min-height: calc(100vh - 60px);
    padding: 30px 0;
    display: flex;
    align-items: center;
}

.user-form-card {
    background: white;
    border-radius: 25px;
    box-shadow: 0 25px 50px rgba(0,0,0,0.15);
    overflow: hidden;
    max-width: 1000px;
    margin: 0 auto;
    transition: all 0.3s ease;
}

.user-form-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 35px 70px rgba(0,0,0,0.2);
}

.form-header {
    background: linear-gradient(135deg, #4CAF50, #45a049);
    color: white;
    padding: 40px;
    text-align: center;
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
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" fill="white" fill-opacity="0.1"><polygon points="1000,100 1000,0 0,100"/></svg>');
    background-size: cover;
}

.form-header h2 {
    margin: 0;
    font-size: 2.5rem;
    font-weight: 300;
    text-shadow: 0 2px 4px rgba(0,0,0,0.3);
    position: relative;
    z-index: 1;
}

.form-header p {
    margin: 15px 0 0 0;
    opacity: 0.9;
    font-size: 1.1rem;
    position: relative;
    z-index: 1;
}

.form-body {
    padding: 50px;
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
}

.form-section {
    margin-bottom: 35px;
}

.section-title {
    color: #333;
    font-size: 1.3rem;
    font-weight: 600;
    margin-bottom: 25px;
    padding-bottom: 10px;
    border-bottom: 2px solid #4CAF50;
    display: flex;
    align-items: center;
    gap: 12px;
}

.section-icon {
    width: 24px;
    height: 24px;
    color: #4CAF50;
}

.form-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 25px;
    margin-bottom: 25px;
}

.form-group {
    position: relative;
}

.form-control {
    width: 100%;
    padding: 20px 20px 20px 50px;
    border: 2px solid #e9ecef;
    border-radius: 15px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: white;
    color: #495057;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    height: 64px;
    display: flex;
    align-items: center;
}

.form-control::placeholder {
    color: #6c757d;
    opacity: 0.8;
    font-style: italic;
}

/* Select dropdown styling - CUSTOM APPROACH */
select.form-control {
    background: white !important;
    color: #999999 !important;
    font-size: 1rem !important;
    font-weight: 500 !important;
    font-family: inherit !important;
    font-style: italic !important;
    -webkit-appearance: none !important;
    -moz-appearance: none !important;
    appearance: none !important;
    background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%236c757d' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6,9 12,15 18,9'%3e%3c/polyline%3e%3c/svg%3e") !important;
    background-repeat: no-repeat !important;
    background-position: right 20px center !important;
    background-size: 16px !important;
    padding-right: 50px !important;
    opacity: 1 !important;
    cursor: pointer !important;
}

/* Fix for Firefox */
select.form-control {
    background-color: white !important;
}

select.form-control option {
    color: #333333 !important;
    background-color: white !important;
    background: white !important;
    padding: 10px !important;
    font-size: 1rem !important;
}

select.form-control option:checked {
    background: #4CAF50 !important;
    color: white !important;
}

select.form-control option:hover {
    background: #45a049 !important;
    color: white !important;
}

.form-control:focus {
    border-color: #4CAF50;
    box-shadow: 0 0 0 0.2rem rgba(76, 175, 80, 0.25), 0 4px 15px rgba(0,0,0,0.1);
    outline: none;
    transform: translateY(-2px);
}

.form-control:hover {
    border-color: #4CAF50;
    transform: translateY(-1px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.input-icon {
    position: absolute;
    left: 18px;
    top: 50%;
    transform: translateY(-50%);
    color: #6c757d;
    font-size: 1.1rem;
    z-index: 2;
    transition: color 0.3s ease;
    pointer-events: none;
}

.form-label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: #333;
    font-size: 0.95rem;
}

.password-toggle {
    position: absolute;
    right: 18px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: #6c757d;
    cursor: pointer;
    z-index: 2;
    padding: 5px;
    transition: color 0.3s ease;
}

.password-toggle:hover {
    color: #4CAF50;
}

.error-message {
    color: #dc3545;
    font-size: 0.85rem;
    margin-top: 8px;
    display: flex;
    align-items: center;
    gap: 5px;
}

.conditional-field {
    display: none;
    opacity: 0;
    transform: translateY(-20px);
    transition: all 0.3s ease;
}

.conditional-field.show {
    display: block;
    opacity: 1;
    transform: translateY(0);
}

.btn-submit {
    background: linear-gradient(135deg, #4CAF50, #45a049);
    color: white;
    border: none;
    padding: 18px 50px;
    border-radius: 25px;
    font-size: 1.2rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    width: 100%;
    max-width: 300px;
    margin: 20px auto;
    display: block;
    box-shadow: 0 8px 25px rgba(76, 175, 80, 0.3);
}

.btn-submit:hover {
    background: linear-gradient(135deg, #45a049, #3d8b40);
    transform: translateY(-3px);
    box-shadow: 0 15px 35px rgba(76, 175, 80, 0.4);
}

.btn-submit:active {
    transform: translateY(-1px);
}

.btn-submit:disabled {
    background: #6c757d;
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
}

.btn-cancel {
    background: linear-gradient(135deg, #6c757d, #5a6268);
    color: white;
    border: none;
    padding: 18px 50px;
    border-radius: 25px;
    font-size: 1.2rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    width: 100%;
    max-width: 300px;
    margin: 20px auto;
    display: block;
    box-shadow: 0 8px 25px rgba(108, 117, 125, 0.3);
}

.btn-cancel:hover {
    background: linear-gradient(135deg, #5a6268, #495057);
    transform: translateY(-3px);
    box-shadow: 0 15px 35px rgba(108, 117, 125, 0.4);
}

.btn-cancel:active {
    transform: translateY(-1px);
}

.button-group {
    display: flex;
    gap: 20px;
    justify-content: center;
    flex-wrap: wrap;
}

.form-progress {
    height: 4px;
    background: #e9ecef;
    border-radius: 2px;
    overflow: hidden;
    margin-bottom: 30px;
}

.form-progress-bar {
    height: 100%;
    background: linear-gradient(135deg, #4CAF50, #45a049);
    width: 0%;
    transition: width 0.3s ease;
    border-radius: 2px;
}

.required-indicator {
    color: #dc3545;
    margin-left: 4px;
}

/* Focus state for select */
select.form-control:focus {
    background-color: white !important;
    opacity: 1 !important;
    border-color: #4CAF50 !important;
}

@media (max-width: 768px) {
    .form-body {
        padding: 30px 20px;
    }

    .form-row {
        grid-template-columns: 1fr;
        gap: 20px;
    }

    .form-header h2 {
        font-size: 2rem;
    }

    .form-control {
        padding: 15px 15px 15px 45px;
        font-size: 16px; /* Prevent zoom on iOS */
    }

    .input-icon {
        left: 15px;
    }

    .password-toggle {
        right: 15px;
    }
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes slideIn {
    from { opacity: 0; transform: translateX(-20px); }
    to { opacity: 1; transform: translateX(0); }
}

.form-section {
    animation: slideIn 0.5s ease;
}
</style>

<div class="content-wrapper">
    <div class="user-form-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="user-form-card">
                        <!-- Header -->
                        <div class="form-header">
                            <h2>
                                <i class="fas fa-user-plus" style="margin-right: 15px;"></i>
                                Create New User Account
                            </h2>
                            <p>Register a new user for the e-learning platform</p>
                        </div>

                        <!-- Progress Bar -->
                        <div class="form-progress">
                            <div class="form-progress-bar" id="formProgress"></div>
                        </div>

                        <!-- Body -->
                        <div class="form-body">
                            <form method="POST" action="{{ route('admin.addUser') }}" id="userForm">
                                @csrf

                                <!-- Personal Information Section -->
                                <div class="form-section">
                                    <div class="section-title">
                                        <i class="fas fa-user section-icon"></i>
                                        Personal Information
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group">
                                            <label class="form-label">
                                                First Name <span class="required-indicator">*</span>
                                            </label>
                                            <input type="text" name="firstname" class="form-control" placeholder="Enter first name" required>
                                            <i class="fas fa-user input-icon"></i>
                                            @error('firstname')
                                                <div class="error-message">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">
                                                Second Name <span class="required-indicator">*</span>
                                            </label>
                                            <input type="text" name="secondname" class="form-control" placeholder="Enter second name" required>
                                            <i class="fas fa-user input-icon"></i>
                                            @error('secondname')
                                                <div class="error-message">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">
                                                Last Name <span class="required-indicator">*</span>
                                            </label>
                                            <input type="text" name="lastname" class="form-control" placeholder="Enter last name" required>
                                            <i class="fas fa-user input-icon"></i>
                                            @error('lastname')
                                                <div class="error-message">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Account Information Section -->
                                <div class="form-section">
                                    <div class="section-title">
                                        <i class="fas fa-envelope section-icon"></i>
                                        Account Information
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group">
                                            <label class="form-label">
                                                Email Address <span class="required-indicator">*</span>
                                            </label>
                                            <input type="email" name="email" class="form-control" placeholder="Enter email address" required>
                                            <i class="fas fa-envelope input-icon"></i>
                                            @error('email')
                                                <div class="error-message">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">
                                                Password <span class="required-indicator">*</span>
                                            </label>
                                            <div style="position: relative;">
                                                <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" required minlength="8">
                                                <i class="fas fa-lock input-icon"></i>
                                                <button type="button" class="password-toggle" onclick="togglePassword('password', 'passwordIcon')">
                                                    <i class="fas fa-eye" id="passwordIcon"></i>
                                                </button>
                                            </div>
                                            @error('password')
                                                <div class="error-message">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">
                                                Confirm Password <span class="required-indicator">*</span>
                                            </label>
                                            <div style="position: relative;">
                                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm password" required minlength="8">
                                                <i class="fas fa-lock input-icon"></i>
                                                <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation', 'confirmPasswordIcon')">
                                                    <i class="fas fa-eye" id="confirmPasswordIcon"></i>
                                                </button>
                                            </div>
                                            @error('password_confirmation')
                                                <div class="error-message">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- User Details Section -->
                                <div class="form-section">
                                    <div class="section-title">
                                        <i class="fas fa-cog section-icon"></i>
                                        User Details
                                    </div>

                                        <div class="form-row">
                                        <div class="form-group">
                                            <label class="form-label">
                                                Gender <span class="required-indicator">*</span>
                                            </label>
                                            <select name="gender" class="form-control custom-select" required>
                                                <option value="">Select Gender</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                            </select>
                                            <i class="fas fa-venus-mars input-icon"></i>
                                            @error('gender')
                                                <div class="error-message">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">
                                                School <span class="required-indicator">*</span>
                                            </label>
                                            <select name="school_id" class="form-control custom-select" required>
                                                <option value="">Select School</option>
                                                @foreach($schools as $school)
                                                    <option value="{{ $school->id }}">{{ $school->name }}</option>
                                                @endforeach
                                            </select>
                                            <i class="fas fa-school input-icon"></i>
                                            @error('school_id')
                                                <div class="error-message">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">
                                                Role <span class="required-indicator">*</span>
                                            </label>
                                            <select id="role" name="role" class="form-control custom-select" required>
                                                <option value="">Select Role</option>
                                                <option value="teacher">Teacher</option>
                                                <option value="student">Student</option>
                                            </select>
                                            <i class="fas fa-user-tag input-icon"></i>
                                            @error('role')
                                                <div class="error-message">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Class Selection (Conditional) -->
                                <div class="form-section conditional-field" id="class-container">
                                    <div class="section-title">
                                        <i class="fas fa-users section-icon"></i>
                                        Class Assignment
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group">
                                            <label class="form-label">
                                                Class <span class="required-indicator">*</span>
                                            </label>
                                            <select id="class_id" name="class_id" class="form-control">
                                                <option value="" disabled selected>Select Class</option>
                                                @foreach($school_classes as $school_class)
                                                    <option value="{{ $school_class->id }}">{{ $school_class->name }}</option>
                                                @endforeach
                                            </select>
                                            <i class="fas fa-users input-icon"></i>
                                            @error('class_id')
                                                <div class="error-message">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Button Group -->
                                <div class="form-section button-group">
                                    <button type="submit" class="btn-submit" id="submitBtn">
                                        <i class="fas fa-user-plus me-2"></i>
                                        Register User Account
                                    </button>
                                    <button type="button" class="btn-cancel" id="cancelBtn">
                                        <i class="fas fa-times-circle me-2"></i>
                                        Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="main-footer" style="margin-top: auto;">
    <strong>Copyright &copy; <span id="currentYear"></span>
        <a href="https://sumajkt.go.tz">Visit Our Website</a>.
    </strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.2.0
    </div>
</footer>

<script>
    // Password visibility toggle
    function togglePassword(fieldId, iconId) {
        const field = document.getElementById(fieldId);
        const icon = document.getElementById(iconId);

        if (field.type === 'password') {
            field.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            field.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }

    // Role change handler - simplified without role info cards
    document.getElementById('role').addEventListener('change', function () {
        const classContainer = document.getElementById('class-container');
        const classField = document.getElementById('class_id');

        if (this.value === 'student') {
            classContainer.classList.add('show');
            classField.setAttribute('required', 'required');
        } else if (this.value === 'teacher') {
            classContainer.classList.remove('show');
            classField.removeAttribute('required');
        } else if (this.value === 'teacher') {
            classContainer.classList.remove('show');
            classField.removeAttribute('required');
        } else {
            classContainer.classList.remove('show');
            classField.removeAttribute('required');
        }

        updateProgress();
    });

    // Force select visibility with CSS classes and direct styling
    function updateSelectStyle(selectElement) {
        // Get the selected option text
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const selectedText = selectedOption ? selectedOption.text : '';

        // Always force basic visibility
        selectElement.style.backgroundColor = 'white';
        selectElement.style.opacity = '1';
        selectElement.style.color = '#333333';

        // Check if a real option is selected
        const hasValue = selectElement.value && selectElement.value !== '' && selectElement.value !== null;

        if (hasValue) {
            // VALUE SELECTED - dark text, remove italic
            selectElement.style.color = '#333333';
            selectElement.style.fontStyle = 'normal';
            selectElement.style.fontWeight = '500';
        } else {
            // PLACEHOLDER - gray text, italic
            selectElement.style.color = '#999999';
            selectElement.style.fontStyle = 'italic';
            selectElement.style.fontWeight = 'normal';
        }

        console.log(`Select ${selectElement.name}: value="${selectElement.value}", text="${selectedText}", hasValue=${hasValue}`);
    }

    // Form progress tracker
    function updateProgress() {
        const form = document.getElementById('userForm');
        const requiredFields = form.querySelectorAll('[required]');
        const progressBar = document.getElementById('formProgress');

        let filledFields = 0;
        requiredFields.forEach(field => {
            if (field.value.trim() !== '') {
                filledFields++;
            }
        });

        const progress = (filledFields / requiredFields.length) * 100;
        progressBar.style.width = progress + '%';
    }

    // Form validation
    function validateForm() {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('password_confirmation').value;

        if (password.length < 8) {
            showNotification('Password must be at least 8 characters long', 'error');
            return false;
        }

        if (password !== confirmPassword) {
            showNotification('Passwords do not match', 'error');
            return false;
        }

        return true;
    }

    // Show notification
    function showNotification(message, type = 'info') {
        // Remove existing notifications
        const existingNotifications = document.querySelectorAll('.notification');
        existingNotifications.forEach(notification => notification.remove());

        const notification = document.createElement('div');
        notification.className = 'notification';
        notification.innerHTML = `
            <div style="
                position: fixed;
                top: 20px;
                right: 20px;
                background: ${type === 'success' ? '#4CAF50' : type === 'error' ? '#dc3545' : '#17a2b8'};
                color: white;
                padding: 15px 20px;
                border-radius: 10px;
                box-shadow: 0 5px 15px rgba(0,0,0,0.3);
                z-index: 10000;
                font-weight: 500;
                max-width: 300px;
                animation: slideInNotification 0.3s ease;
            ">
                <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'}"
                   style="margin-right: 8px;"></i>
                ${message}
            </div>
        `;

        document.body.appendChild(notification);

        setTimeout(() => {
            notification.style.opacity = '0';
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => notification.remove(), 300);
        }, 4000);
    }

    // Initialize page
    document.addEventListener('DOMContentLoaded', function() {
        // Set current year
        document.getElementById("currentYear").textContent = new Date().getFullYear();

        // Add event listeners to all form fields for progress tracking
        const formFields = document.querySelectorAll('input, select');
        formFields.forEach(field => {
            field.addEventListener('input', updateProgress);
            field.addEventListener('change', updateProgress);

            // Handle select styling with comprehensive events
            if (field.tagName === 'SELECT') {
                // Multiple event listeners for all interactions
                ['change', 'focus', 'blur', 'click', 'mousedown', 'keyup'].forEach(eventType => {
                    field.addEventListener(eventType, function() {
                        setTimeout(() => updateSelectStyle(this), 10);
                    });
                });

                // Force initial styling immediately
                updateSelectStyle(field);

                // AGGRESSIVE FALLBACK - re-apply styling frequently
                let attempts = 0;
                const forceStyle = setInterval(() => {
                    updateSelectStyle(field);
                    attempts++;
                    if (attempts >= 20) {
                        clearInterval(forceStyle);
                    }
                }, 500);

                // Observer to watch for value changes
                const observer = new MutationObserver(() => {
                    updateSelectStyle(field);
                });
                observer.observe(field, { attributes: true, attributeFilter: ['value'] });
            }
        });


        // Form submission handler
        const form = document.getElementById('userForm');
        const submitBtn = document.getElementById('submitBtn');

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            if (validateForm()) {
                // Show loading state
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Creating Account...';
                submitBtn.disabled = true;

                // Submit after short delay for UX
                setTimeout(() => {
                    this.submit();
                }, 500);
            }
        });

        // Cancel button handler
        document.getElementById('cancelBtn').addEventListener('click', function() {
            window.history.back();
        });

        // Auto-focus first input
        const firstInput = document.querySelector('input[name="firstname"]');
        if (firstInput) {
            firstInput.focus();
        }

        // Input animations
        const inputs = document.querySelectorAll('.form-control');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.style.transform = 'translateY(-2px)';
            });

            input.addEventListener('blur', function() {
                this.style.transform = 'translateY(0)';
            });
        });

        // Initialize progress
        updateProgress();

        // AGGRESSIVE INITIALIZATION - Force all selects to be visible
        const selectElements = document.querySelectorAll('select.form-control');
        selectElements.forEach(select => {
            // Force immediate styling
            updateSelectStyle(select);

            // Additional force styling
            select.style.color = '#6c757d';
            select.style.fontStyle = 'italic';
            select.style.backgroundColor = 'white';
            select.style.opacity = '1';

            console.log(`Initialized select: ${select.name}, value: "${select.value}"`);
        });

        // Force re-initialization after a short delay
        setTimeout(() => {
            selectElements.forEach(select => {
                updateSelectStyle(select);
            });
        }, 100);
    });



    // Add CSS for notification animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideInNotification {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
    `;
    document.head.appendChild(style);
</script>
@endsection
