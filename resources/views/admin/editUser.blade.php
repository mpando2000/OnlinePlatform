@extends('components.dashmaster')

@section('body')

<style>
.edit-user-container {
    background: #f8f9fa;
    min-height: calc(100vh - 60px);
    padding: 20px 0 60px 0;
}

.edit-form-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    overflow: hidden;
    transition: all 0.3s ease;
}

.edit-form-header {
    background: linear-gradient(135deg, #4CAF50, #45a049);
    color: white;
    padding: 30px;
    text-align: center;
    position: relative;
}

.edit-form-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" fill="white" fill-opacity="0.1"><polygon points="1000,100 1000,0 0,100"/></svg>');
    background-size: cover;
}

.edit-form-header h2 {
    margin: 0;
    font-size: 2rem;
    font-weight: 300;
    text-shadow: 0 2px 4px rgba(0,0,0,0.3);
    position: relative;
    z-index: 1;
}

.edit-form-body {
    padding: 40px;
}

.profile-section {
    text-align: center;
    margin-bottom: 40px;
    padding: 30px;
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    border-radius: 15px;
    border: 1px solid rgba(0,0,0,0.05);
}

.profile-image-container {
    position: relative;
    display: inline-block;
    margin-bottom: 20px;
}

.current-profile-image {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    object-fit: cover;
    border: 5px solid white;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    transition: all 0.3s ease;
}

.current-profile-image:hover {
    transform: scale(1.05);
    box-shadow: 0 15px 40px rgba(0,0,0,0.3);
}

.image-upload-options {
    display: flex;
    flex-direction: column;
    gap: 15px;
    align-items: center;
}

.upload-option {
    padding: 15px 25px;
    border-radius: 25px;
    border: 2px dashed #4CAF50;
    background: white;
    color: #4CAF50;
    cursor: pointer;
    transition: all 0.3s ease;
    width: 250px;
    text-align: center;
}

.upload-option:hover {
    background: #4CAF50;
    color: white;
    border-style: solid;
}

.camera-section {
    margin-top: 20px;
    padding: 20px;
    background: white;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.webcam-video {
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

.form-section {
    margin-bottom: 30px;
}

.section-title {
    color: #333;
    font-size: 1.4rem;
    font-weight: 600;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid #4CAF50;
    display: flex;
    align-items: center;
    gap: 10px;
}

.section-icon {
    width: 24px;
    height: 24px;
    fill: #4CAF50;
}

.form-group {
    margin-bottom: 25px;
}

.form-label {
    font-weight: 600;
    color: #333;
    margin-bottom: 8px;
    display: block;
    font-size: 0.95rem;
}

.form-control {
    border: 2px solid #e9ecef;
    border-radius: 10px;
    padding: 12px 15px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: #fafafa;
}

.form-control:focus {
    border-color: #4CAF50;
    box-shadow: 0 0 0 0.2rem rgba(76, 175, 80, 0.25);
    background: white;
    outline: none;
}

.form-control:hover {
    border-color: #4CAF50;
    background: white;
}

.form-actions {
    display: flex;
    gap: 15px;
    justify-content: center;
    margin-top: 40px;
    padding-top: 30px;
    border-top: 1px solid #e9ecef;
}

.btn-enhanced {
    padding: 12px 30px;
    border-radius: 25px;
    font-weight: 600;
    font-size: 1rem;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    min-width: 140px;
    justify-content: center;
}

.btn-save {
    background: linear-gradient(135deg, #4CAF50, #45a049);
    color: white;
}

.btn-save:hover {
    background: linear-gradient(135deg, #45a049, #3d8b40);
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(76, 175, 80, 0.3);
    color: white;
}

.btn-back {
    background: linear-gradient(135deg, #6c757d, #5a6268);
    color: white;
}

.btn-back:hover {
    background: linear-gradient(135deg, #5a6268, #495057);
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(108, 117, 125, 0.3);
    color: white;
}

.btn-camera {
    background: linear-gradient(135deg, #007bff, #0056b3);
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 20px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-camera:hover {
    background: linear-gradient(135deg, #0056b3, #004085);
    transform: translateY(-2px);
}

.btn-capture {
    background: linear-gradient(135deg, #28a745, #1e7e34);
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 15px;
    margin-top: 10px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-capture:hover {
    background: linear-gradient(135deg, #1e7e34, #155724);
    transform: translateY(-2px);
}

.role-badge {
    display: inline-block;
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-left: 10px;
}

.role-admin { background: #dc3545; color: white; }
.role-teacher { background: #17a2b8; color: white; }
.role-student { background: #ffc107; color: #333; }

@media (max-width: 768px) {
    .edit-form-body {
        padding: 20px;
    }
    
    .form-actions {
        flex-direction: column;
        align-items: center;
    }
    
    .btn-enhanced {
        width: 100%;
        max-width: 250px;
    }
    
    .current-profile-image {
        width: 120px;
        height: 120px;
    }
    
    .upload-option {
        width: 100%;
        max-width: 250px;
    }
}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="min-height: auto;">
    <div class="edit-user-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <div class="edit-form-card">
                        <!-- Header -->
                        <div class="edit-form-header">
                            <h2>
                                <i class="fas fa-user-edit" style="margin-right: 10px;"></i>
                                Edit User Profile
                            </h2>
                            <p style="margin: 10px 0 0 0; opacity: 0.9;">
                                {{ $user->firstname }} {{ $user->secondname }} {{ $user->lastname }}
                                <span class="role-badge role-{{ $user->role }}">{{ ucfirst($user->role) }}</span>
                            </p>
                        </div>

                        <!-- Form Body -->
                        <div class="edit-form-body">
                            <form action="{{ url('/editedUser/' . $user->id) }}" method="POST" enctype="multipart/form-data" id="editUserForm">
                                @csrf
                                @method('PUT')

                                <!-- Profile Image Section -->
                                <div class="profile-section">
                                    <div class="section-title">
                                        <svg class="section-icon" viewBox="0 0 24 24">
                                            <path d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z"/>
                                        </svg>
                                        Profile Image
                                    </div>
                                    
                                    <div class="profile-image-container">
                                        <img src="{{ $user->profile_image ? asset('uploads/profile_images/' . $user->profile_image) : asset('dist/img/avatar5.png') }}"
                                            class="current-profile-image" alt="Profile Image" id="currentProfileImage">
                                    </div>

                                    <div class="image-upload-options">
                                        <label for="profile_image" class="upload-option">
                                            <i class="fas fa-upload" style="margin-right: 8px;"></i>
                                            Choose New Image
                                        </label>
                                        <input type="file" name="profile_image" id="profile_image" class="d-none" accept="image/*">
                                        
                                        <div style="margin: 15px 0; color: #666; font-weight: 500;">OR</div>
                                        
                                        <button type="button" class="btn-camera" onclick="toggleCamera()">
                                            <i class="fas fa-camera" style="margin-right: 8px;"></i>
                                            Capture from Camera
                                        </button>
                                    </div>

                                    <!-- Camera Section -->
                                    <div class="camera-section" id="cameraSection" style="display: none;">
                                        <video id="webcam" autoplay playsinline width="300" height="225" class="webcam-video"></video>
                                        <br>
                                        <button type="button" class="btn-capture" onclick="capturePhoto()">
                                            <i class="fas fa-camera-retro" style="margin-right: 5px;"></i>
                                            Capture Photo
                                        </button>
                                        <button type="button" class="btn-capture" onclick="stopCamera()" style="background: #dc3545; margin-left: 10px;">
                                            <i class="fas fa-times" style="margin-right: 5px;"></i>
                                            Stop Camera
                                        </button>
                                    </div>

                                    <canvas id="canvas" width="300" height="225" style="display:none;"></canvas>
                                    <input type="hidden" name="captured_image" id="captured_image">
                                </div>

                                <!-- Personal Information Section -->
                                <div class="form-section">
                                    <div class="section-title">
                                        <svg class="section-icon" viewBox="0 0 24 24">
                                            <path d="M12,4A4,4 0 0,1 16,8A4,4 0 0,1 12,12A4,4 0 0,1 8,8A4,4 0 0,1 12,4M12,14C16.42,14 20,15.79 20,18V20H4V18C4,15.79 7.58,14 12,14Z"/>
                                        </svg>
                                        Personal Information
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="firstname" class="form-label">
                                                    <i class="fas fa-user" style="margin-right: 5px; color: #4CAF50;"></i>
                                                    First Name
                                                </label>
                                                <input type="text" name="firstname" id="firstname" class="form-control" 
                                                    value="{{ $user->firstname }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="secondname" class="form-label">
                                                    <i class="fas fa-user" style="margin-right: 5px; color: #4CAF50;"></i>
                                                    Second Name
                                                </label>
                                                <input type="text" name="secondname" id="secondname" class="form-control" 
                                                    value="{{ $user->secondname }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="lastname" class="form-label">
                                                    <i class="fas fa-user" style="margin-right: 5px; color: #4CAF50;"></i>
                                                    Last Name
                                                </label>
                                                <input type="text" name="lastname" id="lastname" class="form-control" 
                                                    value="{{ $user->lastname }}" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Account Information Section -->
                                <div class="form-section">
                                    <div class="section-title">
                                        <svg class="section-icon" viewBox="0 0 24 24">
                                            <path d="M12,15C12.81,15 13.5,14.7 14.11,14.11C14.7,13.5 15,12.81 15,12C15,11.19 14.7,10.5 14.11,9.89C13.5,9.3 12.81,9 12,9C11.19,9 10.5,9.3 9.89,9.89C9.3,10.5 9,11.19 9,12C9,12.81 9.3,13.5 9.89,14.11C10.5,14.7 11.19,15 12,15M12,2C14.75,2 17.1,3 19.05,4.95C21,6.9 22,9.25 22,12V13.45C22,14.45 21.65,15.3 21,16C20.3,16.67 19.5,17 18.5,17C17.3,17 16.31,16.5 15.56,15.5C14.56,16.5 13.38,17 12,17C10.63,17 9.45,16.5 8.46,15.54C7.5,14.55 7,13.38 7,12C7,10.63 7.5,9.45 8.46,8.46C9.45,7.5 10.63,7 12,7C13.38,7 14.55,7.5 15.54,8.46C16.5,9.45 17,10.63 17,12V13.45C17,13.86 17.16,14.22 17.46,14.53C17.76,14.83 18.1,15 18.5,15C18.9,15 19.24,14.83 19.54,14.53C19.84,14.22 20,13.86 20,13.45V12C20,9.81 19.23,7.93 17.65,6.35C16.07,4.77 14.19,4 12,4C9.81,4 7.93,4.77 6.35,6.35C4.77,7.93 4,9.81 4,12C4,14.19 4.77,16.07 6.35,17.65C7.93,19.23 9.81,20 12,20H16V22H12C9.25,22 6.9,21 4.95,19.05C3,17.1 2,14.75 2,12C2,9.25 3,6.9 4.95,4.95C6.9,3 9.25,2 12,2Z"/>
                                        </svg>
                                        Account Information
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="email" class="form-label">
                                                    <i class="fas fa-envelope" style="margin-right: 5px; color: #4CAF50;"></i>
                                                    Email Address
                                                </label>
                                                <input type="email" name="email" id="email" class="form-control" 
                                                    value="{{ $user->email }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="role" class="form-label">
                                                    <i class="fas fa-user-tag" style="margin-right: 5px; color: #4CAF50;"></i>
                                                    Role
                                                </label>
                                                <select name="role" id="role" class="form-control" required>
                                                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>
                                                        <i class="fas fa-user-shield"></i> Administrator
                                                    </option>
                                                    <option value="teacher" {{ $user->role === 'teacher' ? 'selected' : '' }}>
                                                        <i class="fas fa-chalkboard-teacher"></i> Teacher
                                                    </option>
                                                    <option value="student" {{ $user->role === 'student' ? 'selected' : '' }}>
                                                        <i class="fas fa-graduation-cap"></i> Student
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Form Actions -->
                                <div class="form-actions">
                                    <button type="submit" class="btn-enhanced btn-save">
                                        <i class="fas fa-save"></i>
                                        Save Changes
                                    </button>
                                    <button type="button" class="btn-enhanced btn-back" onclick="history.back()">
                                        <i class="fas fa-arrow-left"></i>
                                        Go Back
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
    <strong>Copyright &copy; <span id="currentYear"></span> <a href="https://sumajkt.go.tz">Visit Our Website</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.2.0
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    let webcamStream;
    let cameraActive = false;

    // Toggle camera section
    function toggleCamera() {
        const cameraSection = document.getElementById('cameraSection');
        if (cameraActive) {
            stopCamera();
        } else {
            startCamera();
        }
    }

    // Start webcam
    function startCamera() {
        const videoElement = document.getElementById('webcam');
        const cameraSection = document.getElementById('cameraSection');
        
        navigator.mediaDevices.getUserMedia({ 
            video: { 
                width: 300, 
                height: 225,
                facingMode: 'user' 
            } 
        })
        .then(stream => {
            webcamStream = stream;
            videoElement.srcObject = stream;
            videoElement.play();
            cameraSection.style.display = 'block';
            cameraActive = true;
            
            // Scroll to camera section
            cameraSection.scrollIntoView({ behavior: 'smooth', block: 'center' });
        })
        .catch(err => {
            console.error('Camera error:', err);
            showNotification('Could not access webcam: ' + err.message, 'error');
        });
    }

    // Stop webcam
    function stopCamera() {
        const cameraSection = document.getElementById('cameraSection');
        
        if (webcamStream) {
            webcamStream.getTracks().forEach(track => track.stop());
            webcamStream = null;
        }
        
        cameraSection.style.display = 'none';
        cameraActive = false;
    }

    // Capture photo from webcam
    function capturePhoto() {
        const canvas = document.getElementById('canvas');
        const videoElement = document.getElementById('webcam');
        const context = canvas.getContext('2d');
        const profileImage = document.getElementById('currentProfileImage');

        if (!videoElement.srcObject) {
            showNotification('Camera not started', 'error');
            return;
        }

        // Draw the video feed frame to canvas
        context.drawImage(videoElement, 0, 0, canvas.width, canvas.height);

        // Convert canvas image to Base64 string
        const imageData = canvas.toDataURL('image/png');
        document.getElementById('captured_image').value = imageData;

        // Update preview image
        profileImage.src = imageData;

        showNotification('Photo captured successfully!', 'success');
        
        // Stop camera after capture
        setTimeout(() => {
            stopCamera();
        }, 1000);
    }

    // File upload preview
    document.getElementById('profile_image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            // Validate file type
            if (!file.type.match('image.*')) {
                showNotification('Please select a valid image file', 'error');
                return;
            }
            
            // Validate file size (max 5MB)
            if (file.size > 5 * 1024 * 1024) {
                showNotification('File size must be less than 5MB', 'error');
                return;
            }
            
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('currentProfileImage').src = e.target.result;
                showNotification('Image selected successfully', 'success');
            };
            reader.readAsDataURL(file);
        }
    });

    // Form validation and submission
    document.getElementById('editUserForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Basic validation
        const firstName = document.getElementById('firstname').value.trim();
        const lastName = document.getElementById('lastname').value.trim();
        const email = document.getElementById('email').value.trim();
        
        if (!firstName || !lastName || !email) {
            showNotification('Please fill in all required fields', 'error');
            return;
        }
        
        // Email validation
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            showNotification('Please enter a valid email address', 'error');
            return;
        }
        
        // Show loading state
        const submitBtn = document.querySelector('.btn-save');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
        submitBtn.disabled = true;
        
        // Submit form
        setTimeout(() => {
            this.submit();
        }, 500);
    });

    // Notification system
    function showNotification(message, type = 'info') {
        // Remove existing notifications
        const existingNotifications = document.querySelectorAll('.notification');
        existingNotifications.forEach(notification => notification.remove());
        
        // Create notification element
        const notification = document.createElement('div');
        notification.className = `notification notification-${type}`;
        notification.innerHTML = `
            <div style="
                position: fixed;
                top: 20px;
                right: 20px;
                background: ${type === 'success' ? '#4CAF50' : type === 'error' ? '#f44336' : '#2196F3'};
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
        
        // Auto remove after 3 seconds
        setTimeout(() => {
            notification.style.opacity = '0';
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    }

    // Add CSS for notification animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
    `;
    document.head.appendChild(style);

    // Clean up camera when page is unloaded
    window.addEventListener('beforeunload', function() {
        if (webcamStream) {
            webcamStream.getTracks().forEach(track => track.stop());
        }
    });

    // Initialize page
    document.addEventListener('DOMContentLoaded', function() {
        // Add smooth scrolling behavior
        document.documentElement.style.scrollBehavior = 'smooth';
        
        // Auto-focus first input
        const firstInput = document.getElementById('firstname');
        if (firstInput) {
            firstInput.focus();
        }
        
        // Add input animations
        const inputs = document.querySelectorAll('.form-control');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.style.transform = 'scale(1.02)';
            });
            
            input.addEventListener('blur', function() {
                this.style.transform = 'scale(1)';
            });
        });
        
        // Set current year in footer
        document.getElementById("currentYear").textContent = new Date().getFullYear();
    });
</script>


@endsection

