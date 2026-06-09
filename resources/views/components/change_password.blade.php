@extends('components.dashmaster')

@section('body')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="page-header">
                    <h1 class="page-title">
                        <i class="fas fa-key me-2"></i>
                        Change Password
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#" onclick="history.back()">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Change Password</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <!-- Security Info Card -->
                <div class="card info-card mb-4">
                    <div class="card-body text-center">
                        <div class="security-icon mb-3">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h5 class="card-title">Account Security</h5>
                        <p class="card-text text-muted">
                            Keep your account secure by using a strong password. 
                            Your password should contain at least 8 characters with a mix of letters, numbers, and symbols.
                        </p>
                    </div>
                </div>

                <!-- Change Password Form -->
                <div class="card password-form-card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">
                            <i class="fas fa-lock me-2"></i>
                            Update Your Password
                        </h4>
                    </div>

                    <div class="card-body">
                        <!-- Alert Messages -->
                        <div id="alert-container">
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show">
                                    <i class="fas fa-check-circle me-2"></i>
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif
                            
                            @if($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    <strong>Please fix the following errors:</strong>
                                    <ul class="mb-0 mt-2">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif
                        </div>

                        <form action="{{ route('change.password.submit') }}" method="POST" id="change-password-form">
                            @csrf
                            
                            <!-- Current Password -->
                            <div class="mb-4">
                                <label for="current_password" class="form-label">
                                    <i class="fas fa-user-lock me-1"></i>
                                    Current Password <span class="text-danger">*</span>
                                </label>
                                <div class="password-input-group">
                                    <input type="password" 
                                           id="current_password" 
                                           name="current_password" 
                                           class="form-control password-input" 
                                           placeholder="Enter your current password"
                                           required>
                                    <button type="button" class="password-toggle" data-target="current_password">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- New Password -->
                            <div class="mb-4">
                                <label for="new_password" class="form-label">
                                    <i class="fas fa-key me-1"></i>
                                    New Password <span class="text-danger">*</span>
                                </label>
                                <div class="password-input-group">
                                    <input type="password" 
                                           id="new_password" 
                                           name="new_password" 
                                           class="form-control password-input" 
                                           placeholder="Enter a strong new password"
                                           required>
                                    <button type="button" class="password-toggle" data-target="new_password">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                <!-- Password Strength Indicator -->
                                <div class="password-strength mt-2" id="password-strength">
                                    <div class="strength-bar">
                                        <div class="strength-fill"></div>
                                    </div>
                                    <small class="strength-text">Password strength: <span class="strength-label">Too short</span></small>
                                </div>
                                <small class="form-text text-muted">
                                    <i class="fas fa-info-circle"></i>
                                    Use at least 8 characters with a mix of letters, numbers & symbols
                                </small>
                            </div>

                            <!-- Confirm Password -->
                            <div class="mb-4">
                                <label for="new_password_confirmation" class="form-label">
                                    <i class="fas fa-check-double me-1"></i>
                                    Confirm New Password <span class="text-danger">*</span>
                                </label>
                                <div class="password-input-group">
                                    <input type="password" 
                                           id="new_password_confirmation" 
                                           name="new_password_confirmation" 
                                           class="form-control password-input" 
                                           placeholder="Re-enter your new password"
                                           required>
                                    <button type="button" class="password-toggle" data-target="new_password_confirmation">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                <div id="password-match" class="mt-2" style="display: none;">
                                    <small class="match-text">
                                        <i class="fas fa-check-circle text-success"></i>
                                        Passwords match
                                    </small>
                                </div>
                                <div id="password-mismatch" class="mt-2" style="display: none;">
                                    <small class="mismatch-text">
                                        <i class="fas fa-times-circle text-danger"></i>
                                        Passwords do not match
                                    </small>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                <button type="submit" class="btn btn-primary btn-lg me-md-2" id="submit-btn">
                                    <i class="fas fa-save me-1"></i>
                                    Change Password
                                </button>
                                <button type="button" class="btn btn-secondary btn-lg" onclick="history.back()">
                                    <i class="fas fa-times me-1"></i>
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Security Tips -->
                <div class="card security-tips-card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-lightbulb me-2"></i>
                            Security Tips
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="security-tip">
                                    <i class="fas fa-check-circle text-success"></i>
                                    <span>Use a unique password</span>
                                </div>
                                <div class="security-tip">
                                    <i class="fas fa-check-circle text-success"></i>
                                    <span>Include numbers and symbols</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="security-tip">
                                    <i class="fas fa-check-circle text-success"></i>
                                    <span>At least 8 characters long</span>
                                </div>
                                <div class="security-tip">
                                    <i class="fas fa-check-circle text-success"></i>
                                    <span>Mix uppercase and lowercase</span>
                                </div>
                            </div>
                        </div>
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
        border-left: 4px solid #007bff;
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
        color: #007bff;
        text-decoration: none;
    }

    .breadcrumb-item a:hover {
        text-decoration: underline;
    }

    /* Info Card Styling */
    .info-card {
        border: none;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 123, 255, 0.1);
        background: linear-gradient(135deg, #e3f2fd 0%, #f8f9fa 100%);
    }

    .security-icon {
        font-size: 3rem;
        color: #007bff;
    }

    /* Password Form Card */
    .password-form-card {
        border: none;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .password-form-card .card-header {
        background: #007bff;
        color: white;
        border-radius: 8px 8px 0 0;
        padding: 15px 20px;
        border: none;
    }

    .password-form-card .card-title {
        font-weight: 500;
        font-size: 1.1rem;
    }

    .password-form-card .card-body {
        padding: 25px;
    }

    /* Form Elements */
    .form-label {
        font-weight: 500;
        color: #495057;
        margin-bottom: 6px;
    }

    .password-input-group {
        position: relative;
    }

    .password-input {
        border: 1px solid #ced4da;
        border-radius: 4px;
        padding: 10px 40px 10px 12px;
        font-size: 0.95rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .password-input:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .password-toggle {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #6c757d;
        cursor: pointer;
        padding: 5px;
    }

    .password-toggle:hover {
        color: #007bff;
    }

    /* Password Strength Indicator */
    .password-strength {
        display: none;
    }

    .strength-bar {
        width: 100%;
        height: 4px;
        background: #e9ecef;
        border-radius: 2px;
        overflow: hidden;
        margin-bottom: 5px;
    }

    .strength-fill {
        height: 100%;
        width: 0%;
        transition: width 0.3s ease, background-color 0.3s ease;
        border-radius: 2px;
    }

    .strength-fill.weak {
        width: 25%;
        background: #dc3545;
    }

    .strength-fill.fair {
        width: 50%;
        background: #fd7e14;
    }

    .strength-fill.good {
        width: 75%;
        background: #ffc107;
    }

    .strength-fill.strong {
        width: 100%;
        background: #28a745;
    }

    .strength-text {
        font-size: 0.85rem;
        color: #6c757d;
    }

    /* Password Match Indicators */
    .match-text {
        color: #28a745 !important;
    }

    .mismatch-text {
        color: #dc3545 !important;
    }

    /* Buttons */
    .btn {
        border-radius: 4px;
        font-weight: 500;
        padding: 8px 16px;
        transition: all 0.15s ease-in-out;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
        border-color: #5a6268;
    }

    /* Security Tips Card */
    .security-tips-card {
        border: none;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        background: #f8f9fa;
    }

    .security-tips-card .card-header {
        background: #e9ecef;
        border-bottom: 1px solid #dee2e6;
        border-radius: 8px 8px 0 0;
    }

    .security-tip {
        display: flex;
        align-items: center;
        margin-bottom: 8px;
        font-size: 0.9rem;
    }

    .security-tip i {
        margin-right: 8px;
        font-size: 0.8rem;
    }

    /* Alert Styling */
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

    .form-text {
        color: #6c757d;
        font-size: 0.85rem;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .content-wrapper {
            padding: 15px;
        }
        
        .page-title {
            font-size: 1.3rem;
        }
        
        .password-form-card .card-body {
            padding: 20px;
        }
        
        .btn {
            width: 100%;
            margin-bottom: 8px;
        }

        .security-icon {
            font-size: 2.5rem;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Update footer year
        document.getElementById("currentYear").textContent = new Date().getFullYear();

        // Password toggle functionality
        const passwordToggles = document.querySelectorAll('.password-toggle');
        passwordToggles.forEach(toggle => {
            toggle.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const passwordInput = document.getElementById(targetId);
                const icon = this.querySelector('i');
                
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });

        // Password strength checker
        const newPasswordInput = document.getElementById('new_password');
        const strengthIndicator = document.getElementById('password-strength');
        const strengthFill = document.querySelector('.strength-fill');
        const strengthLabel = document.querySelector('.strength-label');

        newPasswordInput.addEventListener('input', function() {
            const password = this.value;
            const strength = checkPasswordStrength(password);
            
            if (password.length > 0) {
                strengthIndicator.style.display = 'block';
                updateStrengthIndicator(strength);
            } else {
                strengthIndicator.style.display = 'none';
            }
        });

        // Password match checker
        const confirmPasswordInput = document.getElementById('new_password_confirmation');
        const passwordMatch = document.getElementById('password-match');
        const passwordMismatch = document.getElementById('password-mismatch');

        function checkPasswordMatch() {
            const newPassword = newPasswordInput.value;
            const confirmPassword = confirmPasswordInput.value;

            if (confirmPassword.length > 0) {
                if (newPassword === confirmPassword) {
                    passwordMatch.style.display = 'block';
                    passwordMismatch.style.display = 'none';
                } else {
                    passwordMatch.style.display = 'none';
                    passwordMismatch.style.display = 'block';
                }
            } else {
                passwordMatch.style.display = 'none';
                passwordMismatch.style.display = 'none';
            }
        }

        newPasswordInput.addEventListener('input', checkPasswordMatch);
        confirmPasswordInput.addEventListener('input', checkPasswordMatch);

        // Form submission with loading state
        const form = document.getElementById('change-password-form');
        const submitBtn = document.getElementById('submit-btn');

        form.addEventListener('submit', function() {
            const originalContent = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Changing Password...';
            submitBtn.disabled = true;

            // Re-enable button after 5 seconds (in case of server issues)
            setTimeout(() => {
                submitBtn.innerHTML = originalContent;
                submitBtn.disabled = false;
            }, 5000);
        });

        // Helper functions
        function checkPasswordStrength(password) {
            let strength = 0;
            
            if (password.length >= 8) strength += 1;
            if (password.match(/[a-z]/)) strength += 1;
            if (password.match(/[A-Z]/)) strength += 1;
            if (password.match(/[0-9]/)) strength += 1;
            if (password.match(/[^a-zA-Z0-9]/)) strength += 1;
            
            return strength;
        }

        function updateStrengthIndicator(strength) {
            strengthFill.className = 'strength-fill';
            
            switch (strength) {
                case 0:
                case 1:
                    strengthFill.classList.add('weak');
                    strengthLabel.textContent = 'Weak';
                    break;
                case 2:
                    strengthFill.classList.add('fair');
                    strengthLabel.textContent = 'Fair';
                    break;
                case 3:
                case 4:
                    strengthFill.classList.add('good');
                    strengthLabel.textContent = 'Good';
                    break;
                case 5:
                    strengthFill.classList.add('strong');
                    strengthLabel.textContent = 'Strong';
                    break;
            }
        }
    });
</script>

@endsection


