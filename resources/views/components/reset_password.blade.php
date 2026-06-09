@extends('components.dashmaster')

@section('body')

<style>
.reset-password-container {
    background: #f8f9fa;
    min-height: calc(100vh - 60px);
    padding: 30px 0;
    display: flex;
    align-items: center;
}

.reset-password-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    overflow: hidden;
    max-width: 600px;
    margin: 0 auto;
    transition: all 0.3s ease;
}

.reset-password-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 30px 60px rgba(0,0,0,0.15);
}

.reset-header {
    background: linear-gradient(135deg, #28a745, #1e7e34);
    color: white;
    padding: 40px 30px;
    text-align: center;
    position: relative;
}

.reset-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" fill="white" fill-opacity="0.1"><polygon points="1000,100 1000,0 0,100"/></svg>');
    background-size: cover;
}

.reset-header h2 {
    margin: 0;
    font-size: 2.2rem;
    font-weight: 300;
    text-shadow: 0 2px 4px rgba(0,0,0,0.3);
    position: relative;
    z-index: 1;
}

.reset-header p {
    margin: 15px 0 0 0;
    opacity: 0.9;
    font-size: 1.1rem;
    position: relative;
    z-index: 1;
}

.reset-body {
    padding: 40px;
}

.user-info-card {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    border-radius: 15px;
    padding: 25px;
    margin-bottom: 30px;
    border-left: 5px solid #28a745;
    display: flex;
    align-items: center;
    gap: 20px;
}

.user-avatar {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid white;
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

.user-details h4 {
    margin: 0 0 5px 0;
    color: #333;
    font-size: 1.3rem;
}

.user-details p {
    margin: 0;
    color: #6c757d;
    font-size: 0.95rem;
}

.user-role {
    background: #28a745;
    color: white;
    padding: 4px 12px;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.form-group {
    margin-bottom: 25px;
    position: relative;
}

.form-label {
    font-weight: 600;
    color: #333;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 1rem;
}

.form-control {
    border: 2px solid #e9ecef;
    border-radius: 10px;
    padding: 15px 20px 15px 50px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: #fafafa;
    position: relative;
}

.password-input-container {
    position: relative;
}

.password-input-container .input-icon {
    position: absolute;
    left: 18px;
    top: 50%;
    transform: translateY(-50%);
    color: #6c757d;
    z-index: 2;
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
    color: #28a745;
}

.form-control:focus {
    border-color: #28a745;
    box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
    background: white;
    outline: none;
}

.form-control:hover {
    border-color: #28a745;
    background: white;
}

.password-strength {
    margin-top: 10px;
    height: 4px;
    background: #e9ecef;
    border-radius: 2px;
    overflow: hidden;
    transition: all 0.3s ease;
}

.password-strength-bar {
    height: 100%;
    width: 0;
    transition: all 0.3s ease;
    border-radius: 2px;
}

.password-strength-text {
    margin-top: 8px;
    font-size: 0.85rem;
    font-weight: 500;
}

.strength-weak { background: #28a745; }
.strength-fair { background: #ffc107; }
.strength-good { background: #28a745; }
.strength-strong { background: #17a2b8; }

.btn-reset {
    background: linear-gradient(135deg, #28a745, #1e7e34);
    color: white;
    border: none;
    padding: 15px 40px;
    border-radius: 25px;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    text-decoration: none;
}

.btn-reset:hover {
    background: linear-gradient(135deg, #1e7e34, #155724);
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(40, 167, 69, 0.3);
    color: white;
}

.btn-reset:disabled {
    background: #6c757d;
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
}

.security-tips {
    background: #f8f9fa;
    border-radius: 10px;
    padding: 20px;
    margin-top: 25px;
    border-left: 4px solid #17a2b8;
}

.security-tips h5 {
    color: #17a2b8;
    margin-bottom: 15px;
    font-size: 1.1rem;
    font-weight: 600;
}

.security-tips ul {
    margin: 0;
    padding-left: 20px;
    color: #6c757d;
}

.security-tips li {
    margin-bottom: 8px;
    font-size: 0.9rem;
}

.alert-enhanced {
    border-radius: 10px;
    padding: 15px 20px;
    margin-bottom: 25px;
    border: none;
    font-weight: 500;
}

.alert-success {
    background: linear-gradient(135deg, #d4edda, #c3e6cb);
    color: #155724;
    border-left: 4px solid #28a745;
}

.alert-danger {
    background: linear-gradient(135deg, #d1e7dd, #badbcc);
    color: #0a3622;
    border-left: 4px solid #28a745;
}

.alert-enhanced ul {
    margin: 0;
    padding-left: 20px;
}

.loading-state {
    display: none;
}

@media (max-width: 768px) {
    .reset-body {
        padding: 30px 20px;
    }
    
    .user-info-card {
        flex-direction: column;
        text-align: center;
        gap: 15px;
    }
    
    .reset-header h2 {
        font-size: 1.8rem;
    }
    
    .form-control {
        padding: 12px 15px 12px 45px;
    }
}

.fade-in {
    animation: fadeIn 0.5s ease-in;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="reset-password-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <div class="reset-password-card fade-in">
                        <!-- Header -->
                        <div class="reset-header">
                            <h2>
                                <i class="fas fa-key" style="margin-right: 15px;"></i>
                                Reset Password
                            </h2>
                            <p>Create a new secure password for the user account</p>
                        </div>

                        <!-- Body -->
                        <div class="reset-body">
                            <!-- User Information Card -->
                            <div class="user-info-card">
                                <img src="{{ $user->profile_image ? asset('uploads/profile_images/' . $user->profile_image) : asset('dist/img/avatar5.png') }}"
                                     class="user-avatar" alt="User Avatar">
                                <div class="user-details">
                                    <h4>{{ $user->firstname }} {{ $user->secondname }} {{ $user->lastname }}</h4>
                                    <p>
                                        <i class="fas fa-envelope me-2"></i>{{ $user->email }}
                                        <span class="user-role ms-3">{{ ucfirst($user->role) }}</span>
                                    </p>
                                </div>
                            </div>

                            <!-- Alerts -->
                            @if(session('success'))
                                <div class="alert alert-success alert-enhanced">
                                    <i class="fas fa-check-circle me-2"></i>
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if($errors->any())
                                <div class="alert alert-danger alert-enhanced">
                                    <i class="fas fa-exclamation-circle me-2"></i>
                                    <strong>Please correct the following errors:</strong>
                                    <ul class="mt-2">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- Reset Form -->
                            <form action="{{ route('admin.updatePassword', $user->id) }}" method="POST" id="resetForm">
                                @csrf
                                
                                <!-- New Password -->
                                <div class="form-group">
                                    <label for="password" class="form-label">
                                        <i class="fas fa-lock text-danger"></i>
                                        New Password
                                    </label>
                                    <div class="password-input-container">
                                        <i class="fas fa-key input-icon"></i>
                                        <input type="password" name="password" id="password" required class="form-control" 
                                               placeholder="Enter new password" minlength="8">
                                        <button type="button" class="password-toggle" onclick="togglePassword('password')">
                                            <i class="fas fa-eye" id="passwordToggleIcon"></i>
                                        </button>
                                    </div>
                                    <div class="password-strength" id="passwordStrength">
                                        <div class="password-strength-bar" id="passwordStrengthBar"></div>
                                    </div>
                                    <div class="password-strength-text" id="passwordStrengthText"></div>
                                </div>

                                <!-- Confirm Password -->
                                <div class="form-group">
                                    <label for="password_confirmation" class="form-label">
                                        <i class="fas fa-lock text-danger"></i>
                                        Confirm Password
                                    </label>
                                    <div class="password-input-container">
                                        <i class="fas fa-key input-icon"></i>
                                        <input type="password" name="password_confirmation" id="password_confirmation" required class="form-control" 
                                               placeholder="Confirm new password" minlength="8">
                                        <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation')">
                                            <i class="fas fa-eye" id="passwordConfirmToggleIcon"></i>
                                        </button>
                                    </div>
                                    <div id="passwordMatch" class="mt-2"></div>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="btn-reset" id="resetButton">
                                    <span class="normal-state">
                                        <i class="fas fa-shield-alt"></i>
                                        Reset Password
                                    </span>
                                    <span class="loading-state">
                                        <i class="fas fa-spinner fa-spin"></i>
                                        Updating Password...
                                    </span>
                                </button>
                            </form>

                            <!-- Security Tips -->
                            <div class="security-tips">
                                <h5>
                                    <i class="fas fa-info-circle me-2"></i>
                                    Password Security Tips
                                </h5>
                                <ul>
                                    <li>Use at least 8 characters with a mix of letters, numbers, and symbols</li>
                                    <li>Avoid using personal information or common words</li>
                                    <li>Don't reuse passwords from other accounts</li>
                                    <li>Consider using a password manager</li>
                                    <li>Change passwords regularly for better security</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer -->
<footer class="main-footer" style="margin-top: auto;">
    <strong>Copyright &copy; <span id="currentYear"></span> <a href="https://sumajkt.go.tz">Visit Our Website</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.2.0
    </div>
</footer>

<script>
    // Password visibility toggle
    function togglePassword(fieldId) {
        const field = document.getElementById(fieldId);
        const icon = document.getElementById(fieldId + 'ToggleIcon');
        
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

    // Password strength checker
    function checkPasswordStrength(password) {
        let strength = 0;
        let feedback = [];

        if (password.length >= 8) strength++;
        else feedback.push('At least 8 characters');

        if (/[a-z]/.test(password)) strength++;
        else feedback.push('Lowercase letters');

        if (/[A-Z]/.test(password)) strength++;
        else feedback.push('Uppercase letters');

        if (/[0-9]/.test(password)) strength++;
        else feedback.push('Numbers');

        if (/[^A-Za-z0-9]/.test(password)) strength++;
        else feedback.push('Special characters');

        return { strength, feedback };
    }

    // Update password strength indicator
    function updatePasswordStrength() {
        const password = document.getElementById('password').value;
        const strengthBar = document.getElementById('passwordStrengthBar');
        const strengthText = document.getElementById('passwordStrengthText');
        
        if (password.length === 0) {
            strengthBar.style.width = '0%';
            strengthText.textContent = '';
            return;
        }

        const { strength, feedback } = checkPasswordStrength(password);
        const percentage = (strength / 5) * 100;
        
        strengthBar.style.width = percentage + '%';
        
        // Remove all strength classes
        strengthBar.className = 'password-strength-bar';
        
        let strengthClass = '';
        let strengthLabel = '';
        
        if (strength <= 2) {
            strengthClass = 'strength-weak';
            strengthLabel = 'Weak';
        } else if (strength === 3) {
            strengthClass = 'strength-fair';
            strengthLabel = 'Fair';
        } else if (strength === 4) {
            strengthClass = 'strength-good';
            strengthLabel = 'Good';
        } else {
            strengthClass = 'strength-strong';
            strengthLabel = 'Strong';
        }
        
        strengthBar.classList.add(strengthClass);
        strengthText.textContent = `Password Strength: ${strengthLabel}`;
        strengthText.className = 'password-strength-text ' + strengthClass;
        
        if (feedback.length > 0 && strength < 5) {
            strengthText.textContent += ` (Add: ${feedback.join(', ')})`;
        }
    }

    // Check password match
    function checkPasswordMatch() {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('password_confirmation').value;
        const matchDiv = document.getElementById('passwordMatch');
        
        if (confirmPassword.length === 0) {
            matchDiv.textContent = '';
            return;
        }
        
        if (password === confirmPassword) {
            matchDiv.innerHTML = '<i class="fas fa-check-circle text-success me-1"></i><span class="text-success">Passwords match</span>';
        } else {
            matchDiv.innerHTML = '<i class="fas fa-times-circle text-danger me-1"></i><span class="text-danger">Passwords do not match</span>';
        }
    }

    // Form validation
    function validateForm() {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('password_confirmation').value;
        const { strength } = checkPasswordStrength(password);
        
        if (password.length < 8) {
            showNotification('Password must be at least 8 characters long', 'error');
            return false;
        }
        
        if (strength < 3) {
            showNotification('Please choose a stronger password', 'error');
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
                background: ${type === 'success' ? '#28a745' : type === 'error' ? '#dc3545' : '#17a2b8'};
                color: white;
                padding: 15px 20px;
                border-radius: 10px;
                box-shadow: 0 5px 15px rgba(0,0,0,0.3);
                z-index: 10000;
                font-weight: 500;
                max-width: 300px;
                animation: slideIn 0.3s ease;
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
        
        // Add event listeners
        const passwordField = document.getElementById('password');
        const confirmPasswordField = document.getElementById('password_confirmation');
        const resetForm = document.getElementById('resetForm');
        
        passwordField.addEventListener('input', function() {
            updatePasswordStrength();
            checkPasswordMatch();
        });
        
        confirmPasswordField.addEventListener('input', checkPasswordMatch);
        
        // Form submission
        resetForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (validateForm()) {
                const resetButton = document.getElementById('resetButton');
                const normalState = resetButton.querySelector('.normal-state');
                const loadingState = resetButton.querySelector('.loading-state');
                
                // Show loading state
                normalState.style.display = 'none';
                loadingState.style.display = 'inline-flex';
                resetButton.disabled = true;
                
                // Submit after short delay for UX
                setTimeout(() => {
                    this.submit();
                }, 500);
            }
        });
        
        // Auto-focus password field
        passwordField.focus();
        
        // Add input animations
        const inputs = document.querySelectorAll('.form-control');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentNode.style.transform = 'scale(1.02)';
            });
            
            input.addEventListener('blur', function() {
                this.parentNode.style.transform = 'scale(1)';
            });
        });
    });

    // Add CSS for notification animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
    `;
    document.head.appendChild(style);
</script>

@endsection