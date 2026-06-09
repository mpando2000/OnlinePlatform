<x-layout />
@include('partials.header')

<style>
/* Modern Login Page Styling */
#log {
  min-height: 100vh;
  background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 15px;
  position: relative;
  z-index: 2;
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

.login-container {
  background: rgba(255, 255, 255, 0.95);
  backdrop-filter: blur(15px);
  border-radius: 20px;
  padding: 30px;
  width: 100%;
  max-width: 400px;
  max-height: 90vh;
  overflow-y: auto;
  box-shadow: 
    0 20px 40px rgba(0, 0, 0, 0.15),
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

.login-container::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: linear-gradient(90deg, #00b894, #00a085);
  border-radius: 24px 24px 0 0;
}

.login-container h1 {
  text-align: center;
  margin-bottom: 25px;
  color: #2d3748;
  font-size: 28px;
  font-weight: 700;
  text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  position: relative;
  background: linear-gradient(135deg, #00b894, #00a085);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

.login-container h1::after {
  content: '';
  display: block;
  width: 50px;
  height: 3px;
  background: linear-gradient(90deg, #00b894, #00a085);
  margin: 12px auto 0;
  border-radius: 2px;
}

.form-group {
  margin-bottom: 20px;
  position: relative;
}

.form-group label {
  display: block;
  margin-bottom: 6px;
  color: #4a5568;
  font-weight: 600;
  font-size: 13px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.input-wrapper {
  position: relative;
}

.form-group input[type="email"],
.form-group input[type="password"] {
  width: 100%;
  padding: 14px 20px;
  border: 2px solid #e2e8f0;
  border-radius: 10px;
  font-size: 15px;
  transition: all 0.3s ease;
  background: rgba(255, 255, 255, 0.9);
  box-sizing: border-box;
  font-family: inherit;
  height: 50px;
}

.form-group input[type="email"]:focus,
.form-group input[type="password"]:focus {
  outline: none;
  border-color: #00b894;
  box-shadow: 0 0 0 4px rgba(0, 184, 148, 0.15);
  transform: translateY(-2px);
  background: rgba(255, 255, 255, 1);
}



.remember-section {
  display: flex;
  align-items: center;
  margin-bottom: 25px;
}

.checkbox-wrapper {
  position: relative;
  display: inline-block;
}

.checkbox-wrapper input[type="checkbox"] {
  opacity: 0;
  position: absolute;
  cursor: pointer;
  width: 20px;
  height: 20px;
}

.checkmark {
  display: inline-block;
  width: 20px;
  height: 20px;
  border: 2px solid #e2e8f0;
  border-radius: 4px;
  margin-right: 12px;
  position: relative;
  transition: all 0.3s ease;
  cursor: pointer;
}

.checkbox-wrapper:hover .checkmark {
  border-color: #00b894;
}

.checkbox-wrapper input[type="checkbox"]:checked + .checkmark {
  background: linear-gradient(45deg, #00b894, #00a085);
  border-color: #00b894;
}

.checkbox-wrapper input[type="checkbox"]:checked + .checkmark::after {
  content: '✓';
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  color: white;
  font-size: 14px;
  font-weight: bold;
}

.remember-label {
  color: #4a5568;
  font-weight: 500;
  cursor: pointer;
  user-select: none;
  font-size: 14px;
}

.submit-btn {
  width: 100%;
  padding: 14px;
  background: linear-gradient(135deg, #00b894 0%, #00a085 100%);
  border: none;
  border-radius: 10px;
  color: white;
  font-size: 16px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
  text-transform: uppercase;
  letter-spacing: 1px;
  position: relative;
  overflow: hidden;
  box-shadow: 0 6px 12px rgba(0, 184, 148, 0.3);
  height: 50px;
}

.submit-btn::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
  transition: left 0.6s;
}

.submit-btn:hover::before {
  left: 100%;
}

.submit-btn:hover {
  transform: translateY(-3px);
  box-shadow: 0 15px 25px rgba(0, 184, 148, 0.4);
}

.submit-btn:active {
  transform: translateY(-1px);
}

.register-section {
  text-align: center;
  margin-top: 20px;
  padding-top: 20px;
  border-top: 1px solid #e2e8f0;
}

.register-section p {
  color: #718096;
  margin-bottom: 10px;
  font-size: 16px;
}

.register-link {
  color: #00b894;
  text-decoration: none;
  font-weight: 600;
  font-size: 16px;
  transition: all 0.3s ease;
  display: inline-block;
  padding: 8px 16px;
  border-radius: 8px;
}

.register-link:hover {
  color: white;
  background: linear-gradient(135deg, #00b894, #00a085);
  transform: translateY(-2px);
  text-decoration: none;
  box-shadow: 0 8px 15px rgba(0, 184, 148, 0.3);
}

.error-message {
  color: #e53e3e;
  font-size: 14px;
  margin-top: 8px;
  animation: shake 0.5s ease-in-out;
  background: rgba(229, 62, 62, 0.1);
  padding: 8px 12px;
  border-radius: 8px;
  border-left: 4px solid #e53e3e;
}

@keyframes shake {
  0%, 100% { transform: translateX(0); }
  25% { transform: translateX(-5px); }
  75% { transform: translateX(5px); }
}

/* Responsive Design */
@media (max-width: 768px) {
  #log {
    padding: 10px;
  }
  
  .login-container {
    padding: 25px 20px;
    max-width: 100%;
    margin: 0;
  }
  
  .login-container h1 {
    font-size: 26px;
    margin-bottom: 25px;
  }
}

@media (max-width: 480px) {
  .login-container {
    padding: 20px 15px;
    margin: 0;
    border-radius: 15px;
  }
  
  .form-group input[type="email"],
  .form-group input[type="password"] {
    padding: 12px 18px;
    font-size: 15px;
    height: 45px;
  }
  
  .submit-btn {
    height: 45px;
    font-size: 15px;
  }
}

/* Loading state */
.loading .submit-btn {
  background: linear-gradient(135deg, #a0aec0, #cbd5e0);
  cursor: not-allowed;
  transform: none;
}

.loading .submit-btn:hover {
  transform: none;
  box-shadow: 0 8px 15px rgba(160, 174, 192, 0.3);
}

/* Focus states for accessibility */
.form-group input:focus,
.checkbox-wrapper input:focus + .checkmark,
.submit-btn:focus,
.register-link:focus {
  outline: 2px solid #00b894;
  outline-offset: 2px;
}

/* Page layout for proper footer positioning */
body {
  margin: 0;
  padding: 0;
}

.login-page-wrapper {
  position: relative;
  min-height: 100vh;
}
</style>

<div class="login-page-wrapper">
<div id="log">
  <div class="login-container">
    <h1>Welcome Back</h1>
    
    <form method="POST" action="{{ route('login') }}" id="loginForm">
      @csrf
      
      <div class="form-group">
        <label for="email">Email Address</label>
        <div class="input-wrapper">
          <input 
            type="email" 
            name="email" 
            id="email"
            placeholder="Enter your email address" 
            value="{{ old('email') }}"
            required
          >
        </div>
        @error('email')
          <div class="error-message">
            {{ $message }}
          </div>
        @enderror
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <div class="input-wrapper">
          <input 
            type="password" 
            name="password" 
            id="password"
            placeholder="Enter your password" 
            required
          >
        </div>
        @error('password')
          <div class="error-message">
            {{ $message }}
          </div>
        @enderror
      </div>
      
      <div class="remember-section">
        <div class="checkbox-wrapper">
          <input type="checkbox" id="remember" name="remember">
          <span class="checkmark"></span>
        </div>
        <label for="remember" class="remember-label">Remember me for 30 days</label>
      </div>
      
      <button type="submit" class="submit-btn">
        Sign In
      </button>
    </form>
    
    <div class="register-section">
      <p>Don't have an account yet?</p>
      <a href="{{ route('regForm') }}" class="register-link">Create New Account</a>
    </div>
  </div>
</div>

<!-- Footer positioned at bottom -->
<div style="position: relative; z-index: 1;">
  @include('partials.footer')
</div>
</div>

<script>


  // Form submission enhancement with loading state
  document.getElementById('loginForm').addEventListener('submit', function(e) {
    const form = this;
    const submitBtn = form.querySelector('.submit-btn');
    
    // Add loading state
    form.classList.add('loading');
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Signing In...';
    submitBtn.disabled = true;
    
    // Remove loading state after timeout (in case of errors)
    setTimeout(function() {
      form.classList.remove('loading');
      submitBtn.innerHTML = 'Sign In';
      submitBtn.disabled = false;
    }, 5000);
  });

  // Enhanced input animations
  document.querySelectorAll('input[type="email"], input[type="password"]').forEach(function(input) {
    input.addEventListener('focus', function() {
      this.parentElement.style.transform = 'scale(1.02)';
    });
    
    input.addEventListener('blur', function() {
      this.parentElement.style.transform = 'scale(1)';
    });
  });

  // Keyboard navigation enhancement
  document.getElementById('remember').addEventListener('keypress', function(e) {
    if (e.key === 'Enter' || e.key === ' ') {
      e.preventDefault();
      this.checked = !this.checked;
    }
  });

  // Auto-focus email field when page loads
  document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('email').focus();
  });
</script>



                

