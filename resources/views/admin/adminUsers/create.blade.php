@extends('components.dashmaster')

@section('body')

<style>
/* Enhanced Admin Creation Form Styling */
.admin-form-container {
    background: #f8f9fa;
    min-height: 100vh;
    display: flex;
    align-items: center;
    padding: 20px 0;
}

.admin-form-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
    overflow: hidden;
    animation: fadeInUp 0.8s ease;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.form-header {
    background: #ffffff;
    color: #2c3e50;
    padding: 40px 30px;
    text-align: center;
    position: relative;
    border-bottom: 3px solid #e9ecef;
}

.form-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
}

.form-header h2 {
    margin: 0;
    font-size: 2.5rem;
    font-weight: 700;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    position: relative;
    z-index: 1;
}

.form-header p {
    margin: 15px 0 0 0;
    font-size: 1.1rem;
    opacity: 0.9;
    position: relative;
    z-index: 1;
}

.form-progress {
    height: 6px;
    background: rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.form-progress-bar {
    height: 100%;
    background: #28a745;
    transition: width 0.3s ease;
    width: 0%;
}

.form-body {
    padding: 40px 30px;
}

.form-section {
    margin-bottom: 30px;
    animation: slideIn 0.5s ease;
}

.form-section h4 {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    font-size: 1.2rem;
}

.form-section h4 i {
    margin-right: 10px;
    color: #28a745;
    width: 20px;
}

.form-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 20px;
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
    font-size: 0.95rem;
}

.form-control {
    width: 100%;
    padding: 15px 20px;
    border: 2px solid #e9ecef;
    border-radius: 12px;
    font-size: 1rem;
    background: white !important;
    background-color: white !important;
    transition: all 0.3s ease;
    font-family: inherit;
    color: #495057 !important;
    -webkit-text-fill-color: #495057 !important;
    height: 60px;
}

.form-control:focus {
    outline: none;
    border-color: #28a745;
    box-shadow: 0 0 0 4px rgba(40, 167, 69, 0.1);
    transform: translateY(-2px);
    background: white !important;
    background-color: white !important;
    color: #495057 !important;
    -webkit-text-fill-color: #495057 !important;
}

.form-control::placeholder {
    color: #9ca3af;
    font-style: italic;
}

/* Password field styling */
.password-field {
    position: relative;
}

.password-toggle {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: #6c757d;
    cursor: pointer;
    padding: 5px;
    border-radius: 4px;
    transition: all 0.2s ease;
}

.password-toggle:hover {
    color: #28a745;
    background: rgba(40, 167, 69, 0.1);
}

/* Select styling - Fixed visibility issues */
select.form-control {
    background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%236c757d' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6,9 12,15 18,9'%3e%3c/polyline%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 20px center;
    background-size: 16px;
    background-color: white !important;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    padding-right: 50px;
    cursor: pointer;
    color: #495057 !important;
    -webkit-text-fill-color: #495057 !important;
}

select.form-control:focus {
    background-color: rgb(255, 255, 255) !important;
    color: #495057 !important;
    -webkit-text-fill-color: #495057 !important;
}

select.form-control option {
    color: #495057 !important;
    background-color: white !important;
    font-style: normal !important;
    -webkit-text-fill-color: #495057 !important;
}

/* Placeholder styling for empty selects */
select.form-control[value=""],
select.form-control:invalid {
    color: #9ca3af !important;
    -webkit-text-fill-color: #9ca3af !important;
    font-style: italic !important;
}

/* When select has a value */
select.form-control:valid:not([value=""]) {
    color: #495057 !important;
    -webkit-text-fill-color: #495057 !important;
    font-style: normal !important;
}

/* Error styling */
.error-message {
    color: #e74c3c;
    font-size: 0.85rem;
    margin-top: 5px;
    display: flex;
    align-items: center;
}

.error-message i {
    margin-right: 5px;
}

/* Submit button */
.submit-btn {
    background: #28a745;
    color: white;
    border: none;
    padding: 18px 50px;
    font-size: 1.1rem;
    font-weight: 600;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 1px;
    position: relative;
    overflow: hidden;
    margin-top: 20px;
    width: 100%;
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
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(40, 167, 69, 0.4);
    background: #218838;
}

.submit-btn:disabled {
    opacity: 0.7;
    cursor: not-allowed;
    transform: none;
}

/* Cancel button */
.cancel-btn {
    background: #e74c3c;
    color: white;
    border: none;
    padding: 18px 50px;
    font-size: 1.1rem;
    font-weight: 600;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 1px;
    position: relative;
    overflow: hidden;
    margin-top: 20px;
    width: 100%;
}

.cancel-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: all 0.5s ease;
}

.cancel-btn:hover::before {
    left: 100%;
}

.cancel-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(231, 76, 60, 0.4);
    background: #c0392b;
}

/* Responsive design */
@media (max-width: 768px) {
    .form-row {
        grid-template-columns: 1fr;
    }

    .admin-form-container {
        padding: 10px;
    }

    .form-body {
        padding: 30px 20px;
    }

    .form-header {
        padding: 30px 20px;
    }

    .form-header h2 {
        font-size: 2rem;
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

/* Success message styling */
.success-message {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
    padding: 15px 20px;
    border-radius: 12px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    animation: slideIn 0.5s ease;
}

.success-message i {
    margin-right: 10px;
    color: #27ae60;
}
</style>

<div class="content-wrapper admin-form-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-7">
                <div class="admin-form-card">
                    <!-- Header -->
                    <div class="form-header">
                        <h2>
                            <i class="fas fa-user-shield" style="margin-right: 15px;"></i>
                            Create Admin Account
                        </h2>
                        <p>Register a new administrator for the e-learning platform</p>
                    </div>

                    <!-- Progress Bar -->
                    <div class="form-progress">
                        <div class="form-progress-bar" id="formProgress"></div>
                    </div>

                    <!-- Success Message -->
                    @if(session('success'))
                        <div class="success-message">
                            <i class="fas fa-check-circle"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Body -->
                    <div class="form-body">
                        <form method="POST" action="{{ route('adminUsers.store') }}" id="adminForm" novalidate>
                            @csrf

                            <!-- Personal Information Section -->
                            <div class="form-section">
                                <h4><i class="fas fa-user"></i>Personal Information</h4>

                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="firstname">First Name <span style="color: #e74c3c;">*</span></label>
                                        <input type="text" name="firstname" id="firstname" class="form-control"
                                               placeholder="Enter first name" value="{{ old('firstname') }}" required>
                                        @error('firstname')
                                            <div class="error-message">
                                                <i class="fas fa-exclamation-circle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="secondname">Middle Name <span style="color: #e74c3c;">*</span></label>
                                        <input type="text" name="secondname" id="secondname" class="form-control"
                                               placeholder="Enter middle name" value="{{ old('secondname') }}" required>
                                        @error('secondname')
                                            <div class="error-message">
                                                <i class="fas fa-exclamation-circle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="lastname">Last Name <span style="color: #e74c3c;">*</span></label>
                                        <input type="text" name="lastname" id="lastname" class="form-control"
                                               placeholder="Enter last name" value="{{ old('lastname') }}" required>
                                        @error('lastname')
                                            <div class="error-message">
                                                <i class="fas fa-exclamation-circle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="gender">Gender <span style="color: #e74c3c;">*</span></label>
                                        <select name="gender" id="gender" class="form-control" required>
                                            <option value="">Select Gender</option>
                                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                        </select>
                                        @error('gender')
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
                                <h4><i class="fas fa-envelope"></i>Account Information</h4>

                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="email">Email Address <span style="color: #e74c3c;">*</span></label>
                                        <input type="email" name="email" id="email" class="form-control"
                                               placeholder="Enter email address" value="{{ old('email') }}" required>
                                        @error('email')
                                            <div class="error-message">
                                                <i class="fas fa-exclamation-circle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="school_id">School Assignment <span style="color: #e74c3c;">*</span></label>
                                        <select name="school_id" id="school_id" class="form-control" required>
                                            <option value="">Select School</option>
                                            @foreach($schools as $school)
                                                <option value="{{ $school->id }}" {{ old('school_id') == $school->id ? 'selected' : '' }}>{{ $school->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('school_id')
                                            <div class="error-message">
                                                <i class="fas fa-exclamation-circle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Security Section -->
                            <div class="form-section">
                                <h4><i class="fas fa-lock"></i>Security Settings</h4>

                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="password">Password <span style="color: #e74c3c;">*</span></label>
                                        <div class="password-field">
                                            <input type="password" name="password" id="password" class="form-control"
                                                   placeholder="Enter secure password" required>
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
                                        <small style="color: #6c757d; font-size: 0.8rem;">
                                            Password must be at least 8 characters long
                                        </small>
                                    </div>

                                    <div class="form-group">
                                        <label for="password_confirmation">Confirm Password <span style="color: #e74c3c;">*</span></label>
                                        <div class="password-field">
                                            <input type="password" name="password_confirmation" id="password_confirmation"
                                                   class="form-control" placeholder="Re-enter password" required>
                                            <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation', 'confirmIcon')">
                                                <i class="fas fa-eye" id="confirmIcon"></i>
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

                            <!-- Role Section -->
                            <div class="form-section">
                                <h4><i class="fas fa-user-cog"></i>Role Assignment</h4>

                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="role">User Role</label>
                                        <select id="role" name="role" class="form-control" readonly style="background-color: #f8f9fa;">
                                            <option value="admin" selected>Administrator</option>
                                        </select>
                                        <small style="color: #6c757d; font-size: 0.8rem;">
                                            Role is automatically set to Administrator
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div style="display: flex; gap: 20px; justify-content: center;">
                                <button type="submit" class="submit-btn" id="submitBtn">
                                    <i class="fas fa-user-plus" style="margin-right: 10px;"></i>
                                    Create Admin Account
                                </button>
                                <button type="button" class="cancel-btn" id="cancelBtn">
                                    <i class="fas fa-times-circle" style="margin-right: 10px;"></i>
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

<footer class="main-footer">
    <strong>Copyright &copy; <span id="currentYear"></span> <a href="https://sumajkt.go.tz">Visit Our Website</a>.</strong>
    All rights reserved.
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

    // Update select element styling with better visibility
    function updateSelectStyle(selectElement) {
        // Force white background and remove any blue backgrounds
        selectElement.style.setProperty('background-color', 'white', 'important');
        selectElement.style.setProperty('webkit-appearance', 'none', 'important');
        selectElement.style.setProperty('moz-appearance', 'none', 'important');
        selectElement.style.setProperty('appearance', 'none', 'important');

        if (!selectElement.value || selectElement.value === '' || selectElement.selectedIndex === 0) {
            // Placeholder state - make text clearly visible
            selectElement.style.setProperty('color', '#9ca3af', 'important');
            selectElement.style.setProperty('webkit-text-fill-color', '#9ca3af', 'important');
            selectElement.style.setProperty('font-style', 'italic', 'important');
            selectElement.style.setProperty('opacity', '1', 'important');
        } else {
            // Selected state - make text clearly visible
            selectElement.style.setProperty('color', '#495057', 'important');
            selectElement.style.setProperty('webkit-text-fill-color', '#495057', 'important');
            selectElement.style.setProperty('font-style', 'normal', 'important');
            selectElement.style.setProperty('opacity', '1', 'important');
        }
    }

    // Form progress tracker
    function updateProgress() {
        const form = document.getElementById('adminForm');
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
                background: ${type === 'error' ? '#e74c3c' : '#27ae60'};
                color: white;
                padding: 15px 20px;
                border-radius: 8px;
                z-index: 1000;
                animation: slideInNotification 0.3s ease;
                box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            ">
                <i class="fas fa-${type === 'error' ? 'exclamation-circle' : 'check-circle'}" style="margin-right: 8px;"></i>
                ${message}
            </div>
        `;

        document.body.appendChild(notification);

        // Remove after 5 seconds
        setTimeout(() => {
            notification.remove();
        }, 5000);
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        // Set current year
        document.getElementById("currentYear").textContent = new Date().getFullYear();

        // Add event listeners to all form fields for progress tracking
        const formFields = document.querySelectorAll('input, select');
        formFields.forEach(field => {
            field.addEventListener('input', updateProgress);
            field.addEventListener('change', updateProgress);

            // Handle select styling
            if (field.tagName === 'SELECT') {
                field.addEventListener('change', function() {
                    updateSelectStyle(this);
                });

                // Initialize select styling
                updateSelectStyle(field);
            }
        });

        // Form submission handler
        const form = document.getElementById('adminForm');
        const submitBtn = document.getElementById('submitBtn');

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            if (validateForm()) {
                // Show loading state
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin" style="margin-right: 10px;"></i>Creating Admin Account...';
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

        // Initialize progress
        updateProgress();

        // Initialize all select elements with enhanced styling
        const selectElements = document.querySelectorAll('select.form-control');
        selectElements.forEach(select => {
            updateSelectStyle(select);

            // Add additional event listeners for better visibility
            select.addEventListener('focus', function() {
                this.style.backgroundColor = 'white';
                this.style.color = '#495057';
                this.style.webkitTextFillColor = '#495057';
            });

            select.addEventListener('blur', function() {
                updateSelectStyle(this);
            });

            // Force initial styling
            select.style.backgroundColor = 'white';
            if (select.value) {
                select.style.color = '#495057';
                select.style.webkitTextFillColor = '#495057';
            }
        });

        // Additional CSS injection for better select visibility
        const additionalStyle = document.createElement('style');
        additionalStyle.textContent = `
            select.form-control,
            select.form-control:focus,
            select.form-control:hover,
            select.form-control:active {
                background-color: white !important;
                -webkit-text-fill-color: initial !important;
            }

            select.form-control option {
                color: #495057 !important;
                background-color: white !important;
                -webkit-text-fill-color: #495057 !important;
            }

            /* Remove any blue backgrounds from select elements */
            select.form-control:focus {
                box-shadow: 0 0 0 4px rgba(40, 167, 69, 0.1) !important;
                background-color: white !important;
            }
        `;
        document.head.appendChild(additionalStyle);
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
