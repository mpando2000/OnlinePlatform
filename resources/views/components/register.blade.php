
<x-layout />
@include('partials.header')

<style>
/* Modern Registration Page Styling */
#log {
  min-height: 100vh;
  background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 20px 15px;
  position: relative;
  overflow: hidden;
}

/* Animated background elements */
#log::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-image: 
    radial-gradient(circle at 20% 80%, rgba(0, 184, 148, 0.3) 0%, transparent 50%),
    radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
    radial-gradient(circle at 40% 40%, rgba(0, 160, 133, 0.2) 0%, transparent 50%);
  animation: float 20s ease-in-out infinite;
}

@keyframes float {
  0%, 100% { transform: translateY(0px) rotate(0deg); }
  50% { transform: translateY(-20px) rotate(180deg); }
}

.form-container {
  background: rgba(255, 255, 255, 0.95);
  backdrop-filter: blur(15px);
  border-radius: 24px;
  padding: 40px;
  width: 100%;
  max-width: 800px;
  max-height: 90vh;
  overflow-y: auto;
  box-shadow: 
    0 25px 50px rgba(0, 0, 0, 0.15),
    0 8px 16px rgba(0, 0, 0, 0.1),
    inset 0 1px 0 rgba(255, 255, 255, 0.8);
  position: relative;
  z-index: 1;
  animation: slideInUp 0.8s ease-out;
  border: 1px solid rgba(255, 255, 255, 0.2);
}

@keyframes slideInUp {
  from {
    opacity: 0;
    transform: translateY(30px) scale(0.95);
  }
  to {
    opacity: 1;
    transform: translateY(0) scale(1);
  }
}

.form-container::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: linear-gradient(90deg, #00b894, #00a085);
  border-radius: 24px 24px 0 0;
}

.form-container h2 {
  text-align: center;
  margin-bottom: 30px;
  color: #2d3748;
  font-size: 32px;
  font-weight: 700;
  text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  position: relative;
  background: linear-gradient(135deg, #00b894, #00a085);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

.form-container h2::after {
  content: '';
  display: block;
  width: 60px;
  height: 3px;
  background: linear-gradient(90deg, #00b894, #00a085);
  margin: 15px auto 0;
  border-radius: 2px;
}

.form-row {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 20px;
  margin-bottom: 25px;
}

.form-row > div {
  position: relative;
}

.form-row input[type="text"],
.form-row input[type="email"],
.form-row input[type="password"],
.form-row select {
  width: 100%;
  padding: 16px 20px;
  border: 2px solid #e2e8f0;
  border-radius: 12px;
  font-size: 15px;
  transition: all 0.3s ease;
  background: rgba(255, 255, 255, 0.9);
  box-sizing: border-box;
  font-family: inherit;
  height: 54px;
}

.form-row input[type="text"]:focus,
.form-row input[type="email"]:focus,
.form-row input[type="password"]:focus,
.form-row select:focus {
  outline: none;
  border-color: #00b894;
  box-shadow: 0 0 0 4px rgba(0, 184, 148, 0.15);
  transform: translateY(-2px);
  background: rgba(255, 255, 255, 1);
}

.form-row input[type="submit"] {
  width: 100%;
  padding: 16px;
  background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
  border: none;
  border-radius: 12px;
  color: white;
  font-size: 18px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
  text-transform: uppercase;
  letter-spacing: 1px;
  position: relative;
  overflow: hidden;
  box-shadow: 0 8px 15px rgba(0, 184, 148, 0.3);
  height: 54px;
}

.form-row input[type="submit"]::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
  transition: left 0.6s;
}

.form-row input[type="submit"]:hover::before {
  left: 100%;
}

.form-row input[type="submit"]:hover {
  transform: translateY(-3px);
  box-shadow: 0 15px 25px rgba(0, 184, 148, 0.4);
}

.form-row input[type="submit"]:active {
  transform: translateY(-1px);
}

.toggle-password {
  position: absolute;
  right: 18px;
  top: 50%;
  transform: translateY(-50%);
  cursor: pointer;
  color: #a0aec0;
  font-size: 16px;
  transition: all 0.3s ease;
  z-index: 5;
  padding: 4px;
  border-radius: 4px;
}

.toggle-password:hover {
  color: #00b894;
  background: rgba(0, 184, 148, 0.1);
}

.text-danger {
  color: #e53e3e;
  font-size: 13px;
  margin-top: 6px;
  display: block;
  animation: shake 0.5s ease-in-out;
  background: rgba(229, 62, 62, 0.1);
  padding: 6px 10px;
  border-radius: 6px;
  border-left: 3px solid #e53e3e;
}

@keyframes shake {
  0%, 100% { transform: translateX(0); }
  25% { transform: translateX(-3px); }
  75% { transform: translateX(3px); }
}

.login-section {
  text-align: center;
  margin-top: 25px;
  padding-top: 20px;
  border-top: 1px solid #e2e8f0;
}

.login-section p {
  color: #718096;
  margin-bottom: 10px;
  font-size: 16px;
}

.login-section a {
  color: #00b894;
  text-decoration: none;
  font-weight: 600;
  font-size: 16px;
  transition: all 0.3s ease;
  display: inline-block;
  padding: 8px 16px;
  border-radius: 8px;
}

.login-section a:hover {
  color: white;
  background: linear-gradient(135deg, #00b894, #00a085);
  transform: translateY(-2px);
  text-decoration: none;
  box-shadow: 0 8px 15px rgba(0, 184, 148, 0.3);
}

/* Input placeholders */
.form-row input::placeholder {
  color: #a0aec0;
  font-weight: 400;
}

.form-row select option {
  color: #2d3748;
  background: white;
}

/* Hidden class field styling */
#class_id {
  transition: all 0.3s ease;
}

/* Responsive Design */
@media (max-width: 768px) {
  #log {
    padding: 15px 10px;
  }
  
  .form-container {
    padding: 30px 25px;
    max-width: 100%;
    margin: 0;
  }
  
  .form-container h2 {
    font-size: 28px;
  }
  
  .form-row {
    grid-template-columns: 1fr;
    gap: 15px;
  }
}

@media (max-width: 480px) {
  .form-container {
    padding: 25px 20px;
    border-radius: 15px;
  }
  
  .form-row input[type="text"],
  .form-row input[type="email"],
  .form-row input[type="password"],
  .form-row select,
  .form-row input[type="submit"] {
    height: 48px;
    padding: 14px 18px;
    font-size: 14px;
  }
  
  .toggle-password {
    right: 15px;
    font-size: 14px;
  }
}

/* Loading state */
.loading input[type="submit"] {
  background: linear-gradient(135deg, #a0aec0, #cbd5e0);
  cursor: not-allowed;
  transform: none;
}

.loading input[type="submit"]:hover {
  transform: none;
  box-shadow: 0 8px 15px rgba(160, 174, 192, 0.3);
}

/* Focus states for accessibility */
.form-row input:focus,
.form-row select:focus {
  outline: 2px solid #00b894;
  outline-offset: 2px;
}
</style>

<div id="log">
    <div class="form-container">
    <h2>Create Account</h2>
    <form method="POST" action="{{ route('register') }}" id="registerForm">
        @csrf
        <!-- Row 1: Name Fields -->
        <div class="form-row">
            <div>
                <input type="text" name="firstname" placeholder="First Name" required>
                @error('firstname')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <input type="text" name="secondname" placeholder="Second Name" required>
                @error('secondname')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <input type="text" name="lastname" placeholder="Last Name" required>
                @error('lastname')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- Row 2: Password Fields -->
        <div class="form-row">
            <div>
                <input type="email" name="email" placeholder="Email" required>
                 @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <input type="password" name="password" id="password" placeholder="Password" required>
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" required>
                @error('password_confirmation')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- Row 3: Dropdown Fields -->
        <div class="form-row">
            <div>
                <select name="gender" required>
                    <option value="" selected disabled>Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
                @error('gender')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <select name="school_id" required>
                    <option value="" selected disabled>Select School</option>
                    @foreach($schools as $school)
                        <option value="{{ $school->id }}">{{ $school->name }}</option>
                    @endforeach
                </select>
                @error('school_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <select id="role" name="role" required>
                    <option value="" selected disabled>Select Role</option>
                    <option value="teacher">Teacher</option>
                    <option value="student">Student</option>
                </select>
                @error('role')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- Row 4: Class Field (Conditional) -->
        <div class="form-row">
            <div>
                <select id="class_id" name="class_id" style="display:none;">
                    <option value="" selected disabled>Select Class</option>
                    @foreach($school_classes as $school_class)
                        <option value="{{ $school_class->id }}">{{ $school_class->name }}</option>
                    @endforeach
                </select>
                @error('class_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- Submit Button -->
        <div class="form-row">
            <div>
                <input type="submit" value="Create Account">
            </div>
        </div>
    </form>

    <div class="login-section">
        <p>Already have an account?</p>
        <a href="{{ route('loginForm') }}">Sign In Here</a>
    </div>
</div>

</div>

@include('partials.footer')


<script>
    // Role-based class field visibility
    document.getElementById('role').addEventListener('change', function () {
        const classSelect = document.getElementById('class_id');
        const classContainer = classSelect.parentElement;
        
        if (this.value === 'student') {
            classSelect.style.display = 'block';
            classContainer.style.display = 'block';
            classSelect.setAttribute('required', 'required');
        } else {
            classSelect.style.display = 'none';
            classContainer.style.display = 'none';
            classSelect.removeAttribute('required');
            classSelect.value = '';
        }
    });

    // Form submission enhancement with loading state
    document.getElementById('registerForm').addEventListener('submit', function(e) {
        const form = this;
        const submitBtn = form.querySelector('input[type="submit"]');
        
        // Add loading state
        form.classList.add('loading');
        submitBtn.value = 'Creating Account...';
        submitBtn.disabled = true;
        
        // Remove loading state after timeout (in case of errors)
        setTimeout(function() {
            form.classList.remove('loading');
            submitBtn.value = 'Create Account';
            submitBtn.disabled = false;
        }, 5000);
    });

    // Enhanced input animations
    document.querySelectorAll('input[type="text"], input[type="email"], input[type="password"], select').forEach(function(input) {
        input.addEventListener('focus', function() {
            this.style.transform = 'translateY(-2px)';
        });
        
        input.addEventListener('blur', function() {
            this.style.transform = 'translateY(0)';
        });
    });

    // Auto-focus first name field when page loads
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('input[name="firstname"]').focus();
    });
</script>




