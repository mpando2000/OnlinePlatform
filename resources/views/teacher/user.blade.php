@extends('components.dashmaster')

@section('body')

<style>
/* Enhanced User Profile Styling */
.profile-container {
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
    padding: 12px 25px;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    border: none;
}

.back-btn:hover {
    background: white;
    color: #495057;
    text-decoration: none;
    transform: translateY(-2px);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
}

.profile-card {
    background: white;
    border-radius: 25px;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    position: relative;
}

.profile-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 40px 30px;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.profile-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="25" r="1" fill="white" opacity="0.05"/><circle cx="50" cy="50" r="1" fill="white" opacity="0.1"/><circle cx="25" cy="75" r="1" fill="white" opacity="0.05"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    opacity: 0.3;
}

.profile-avatar {
    position: relative;
    z-index: 2;
    margin-bottom: 25px;
}

.avatar-container {
    position: relative;
    display: inline-block;
}

.avatar-image {
    width: 140px;
    height: 140px;
    border-radius: 50%;
    border: 6px solid rgba(255, 255, 255, 0.3);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease;
    object-fit: cover;
}

.avatar-image:hover {
    transform: scale(1.05);
    border-color: white;
}

.online-indicator {
    position: absolute;
    bottom: 10px;
    right: 10px;
    width: 25px;
    height: 25px;
    background: #28a745;
    border: 3px solid white;
    border-radius: 50%;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
}

.profile-name {
    font-size: 2.2rem;
    font-weight: 700;
    margin: 0 0 10px 0;
    position: relative;
    z-index: 2;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.profile-subtitle {
    font-size: 1.1rem;
    opacity: 0.9;
    position: relative;
    z-index: 2;
    font-weight: 400;
}

.role-badge {
    background: rgba(255, 255, 255, 0.2);
    color: white;
    padding: 8px 20px;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-top: 15px;
    display: inline-block;
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.profile-body {
    padding: 40px;
}

.info-sections {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    margin-bottom: 40px;
}

.info-section {
    background: #f8f9fa;
    border-radius: 20px;
    padding: 30px;
    position: relative;
    transition: all 0.3s ease;
}

.info-section:hover {
    background: #e9ecef;
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

.section-title {
    color: #495057;
    font-size: 1.3rem;
    font-weight: 600;
    margin-bottom: 25px;
    display: flex;
    align-items: center;
    padding-bottom: 15px;
    border-bottom: 2px solid #dee2e6;
}

.section-title i {
    margin-right: 12px;
    width: 30px;
    height: 30px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.9rem;
}

.info-item {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
    padding: 15px;
    background: white;
    border-radius: 12px;
    transition: all 0.3s ease;
    border-left: 4px solid transparent;
}

.info-item:hover {
    background: #f0f2ff;
    border-left-color: #667eea;
    transform: translateX(5px);
}

.info-icon {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    font-size: 1.1rem;
    color: white;
    flex-shrink: 0;
}

.info-icon.email {
    background: linear-gradient(135deg, #3498db, #2980b9);
}

.info-icon.gender {
    background: linear-gradient(135deg, #e74c3c, #c0392b);
}

.info-icon.school {
    background: linear-gradient(135deg, #2ecc71, #27ae60);
}

.info-icon.class {
    background: linear-gradient(135deg, #f39c12, #e67e22);
}

.info-icon.subjects {
    background: linear-gradient(135deg, #9b59b6, #8e44ad);
}

.info-icon.calendar {
    background: linear-gradient(135deg, #1abc9c, #16a085);
}

.info-content {
    flex: 1;
}

.info-label {
    color: #6c757d;
    font-size: 0.85rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin: 0 0 5px 0;
}

.info-value {
    color: #2c3e50;
    font-size: 1rem;
    font-weight: 500;
    margin: 0;
    word-break: break-all;
}

.subjects-list {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-top: 10px;
}

.subject-tag {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    padding: 6px 12px;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 500;
}

.stats-section {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    border-radius: 20px;
    padding: 30px;
    margin-bottom: 30px;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
}

.stat-item {
    background: white;
    padding: 25px;
    border-radius: 15px;
    text-align: center;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
}

.stat-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 700;
    color: #667eea;
    margin: 0 0 8px 0;
    line-height: 1;
}

.stat-label {
    color: #6c757d;
    font-size: 0.9rem;
    font-weight: 500;
    margin: 0;
}

.action-buttons {
    display: flex;
    justify-content: center;
    gap: 15px;
    flex-wrap: wrap;
}

.btn-action {
    padding: 15px 30px;
    border-radius: 25px;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    transition: all 0.3s ease;
    border: none;
    font-size: 1rem;
    cursor: pointer;
    position: relative;
    overflow: hidden;
}

.btn-action::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.btn-action:hover::before {
    left: 100%;
}

.btn-primary {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
}

.btn-primary:hover {
    color: white;
    text-decoration: none;
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.5);
}

.btn-contact {
    background: linear-gradient(135deg, #2ecc71, #27ae60);
    color: white;
    box-shadow: 0 4px 15px rgba(46, 204, 113, 0.4);
}

.btn-contact:hover {
    color: white;
    text-decoration: none;
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(46, 204, 113, 0.5);
}

.btn-secondary {
    background: linear-gradient(135deg, #6c757d, #5a6268);
    color: white;
    box-shadow: 0 4px 15px rgba(108, 117, 125, 0.4);
}

.btn-secondary:hover {
    color: white;
    text-decoration: none;
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(108, 117, 125, 0.5);
}

.btn-action i {
    margin-right: 8px;
    font-size: 1rem;
}

.activity-timeline {
    position: relative;
    padding-left: 30px;
}

.activity-timeline::before {
    content: '';
    position: absolute;
    left: 15px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: linear-gradient(to bottom, #667eea, #764ba2);
}

.timeline-item {
    position: relative;
    margin-bottom: 25px;
    background: white;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

.timeline-item::before {
    content: '';
    position: absolute;
    left: -37px;
    top: 25px;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: #667eea;
    border: 3px solid white;
    box-shadow: 0 0 0 3px #f8f9fa;
}

.timeline-date {
    color: #6c757d;
    font-size: 0.85rem;
    font-weight: 600;
    margin-bottom: 8px;
}

.timeline-content {
    color: #495057;
    line-height: 1.6;
}

@media (max-width: 768px) {
    .info-sections {
        grid-template-columns: 1fr;
    }
    
    .profile-header {
        padding: 30px 20px;
    }
    
    .profile-body {
        padding: 30px 20px;
    }
    
    .action-buttons {
        flex-direction: column;
        align-items: center;
    }
    
    .btn-action {
        width: 100%;
        max-width: 280px;
        justify-content: center;
    }
}

.loading-shimmer {
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200% 100%;
    animation: loading 1.5s infinite;
}

@keyframes loading {
    0% { background-position: 200% 0; }
    100% { background-position: -200% 0; }
}

.fade-in {
    animation: fadeIn 0.8s ease-in;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>

<div class="content-wrapper profile-container">
    <div class="container-fluid">
        <!-- Back Navigation -->
        <div class="back-navigation">
            <button class="back-btn" onclick="window.history.back()">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Users
            </button>
        </div>

        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12">
                <!-- Profile Card -->
                <div class="profile-card fade-in">
                    <!-- Profile Header -->
                    <div class="profile-header">
                        <div class="profile-avatar">
                            <div class="avatar-container">
                                <img src="{{ $user->profile_image ? asset('uploads/profile_images/' . $user->profile_image) : asset('dist/img/avatar5.png') }}" 
                                     class="avatar-image" 
                                     alt="Profile Image"
                                     onerror="this.src='{{ asset('dist/img/avatar5.png') }}'">
                                <div class="online-indicator" title="User Profile"></div>
                            </div>
                        </div>
                        
                        <h1 class="profile-name">
                            {{ $user->firstname }} {{ $user->secondname }} {{ $user->lastname }}
                        </h1>
                        
                        <p class="profile-subtitle">
                            {{ $user->email }}
                        </p>
                        
                        <span class="role-badge">
                            <i class="fas fa-{{ $user->role === 'student' ? 'user-graduate' : ($user->role === 'teacher' ? 'chalkboard-teacher' : 'user-shield') }}"></i>
                            {{ ucfirst($user->role) }}
                        </span>
                    </div>

                    <!-- Profile Body -->
                    <div class="profile-body">
                        <!-- Statistics Section -->
                        @if($user->role === 'student' || $user->role === 'teacher')
                            <div class="stats-section">
                                <div class="stats-grid">
                                    <div class="stat-item">
                                        <h3 class="stat-number">{{ $user->created_at->diffInDays() }}</h3>
                                        <p class="stat-label">Days Since Joined</p>
                                    </div>
                                    <div class="stat-item">
                                        <h3 class="stat-number">{{ $user->role === 'student' ? ($user->schoolClass ? '1' : '0') : ($user->subjects->count() ?? 0) }}</h3>
                                        <p class="stat-label">{{ $user->role === 'student' ? 'Assigned Classes' : 'Subjects Teaching' }}</p>
                                    </div>
                                    <div class="stat-item">
                                        <h3 class="stat-number">{{ $user->status === 'active' ? 'Active' : 'Inactive' }}</h3>
                                        <p class="stat-label">Account Status</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Information Sections -->
                        <div class="info-sections">
                            <!-- Personal Information -->
                            <div class="info-section">
                                <h3 class="section-title">
                                    <i class="fas fa-user"></i>
                                    Personal Information
                                </h3>
                                
                                <div class="info-item">
                                    <div class="info-icon email">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div class="info-content">
                                        <p class="info-label">Email Address</p>
                                        <p class="info-value">{{ $user->email }}</p>
                                    </div>
                                </div>

                                @if($user->gender)
                                    <div class="info-item">
                                        <div class="info-icon gender">
                                            <i class="fas fa-venus-mars"></i>
                                        </div>
                                        <div class="info-content">
                                            <p class="info-label">Gender</p>
                                            <p class="info-value">{{ ucfirst($user->gender) }}</p>
                                        </div>
                                    </div>
                                @endif

                                <div class="info-item">
                                    <div class="info-icon calendar">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                    <div class="info-content">
                                        <p class="info-label">Joined Date</p>
                                        <p class="info-value">{{ $user->created_at->format('F d, Y') }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Academic Information -->
                            <div class="info-section">
                                <h3 class="section-title">
                                    <i class="fas fa-graduation-cap"></i>
                                    Academic Information
                                </h3>
                                
                                @php
                                    $schoolName = null;
                                    
                                    // Try to get school from manually loaded school model first
                                    if(isset($user->schoolModel) && $user->schoolModel) {
                                        $schoolName = $user->schoolModel->name;
                                    } 
                                    // Fallback to old school field (for legacy users)
                                    else {
                                        $legacySchool = $user->getAttributes()['school'] ?? null;
                                        if(!empty($legacySchool) && is_string($legacySchool)) {
                                            $schoolName = ucfirst($legacySchool);
                                        }
                                    }
                                @endphp
                                
                                @if($schoolName)
                                    <div class="info-item">
                                        <div class="info-icon school">
                                            <i class="fas fa-school"></i>
                                        </div>
                                        <div class="info-content">
                                            <p class="info-label">School</p>
                                            <p class="info-value">{{ $schoolName }}</p>
                                        </div>
                                    </div>
                                @endif

                                @if($user->role === 'student' && $user->schoolClass)
                                    <div class="info-item">
                                        <div class="info-icon class">
                                            <i class="fas fa-door-open"></i>
                                        </div>
                                        <div class="info-content">
                                            <p class="info-label">Class</p>
                                            <p class="info-value">{{ $user->schoolClass->name }}</p>
                                        </div>
                                    </div>
                                @endif

                                @if($user->role === 'teacher' && $user->subjects->count() > 0)
                                    <div class="info-item">
                                        <div class="info-icon subjects">
                                            <i class="fas fa-book"></i>
                                        </div>
                                        <div class="info-content">
                                            <p class="info-label">Teaching Subjects</p>
                                            <div class="subjects-list">
                                                @foreach($user->subjects as $subject)
                                                    <span class="subject-tag">{{ $subject->name }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Activity Timeline -->
                        @if($user->role === 'student' || $user->role === 'teacher')
                            <div class="info-section">
                                <h3 class="section-title">
                                    <i class="fas fa-clock"></i>
                                    Recent Activity
                                </h3>
                                
                                <div class="activity-timeline">
                                    <div class="timeline-item">
                                        <div class="timeline-date">{{ $user->created_at->format('M d, Y') }}</div>
                                        <div class="timeline-content">
                                            <strong>Account Created</strong><br>
                                            User registered and joined the e-learning platform
                                        </div>
                                    </div>
                                    
                                    @if($user->updated_at != $user->created_at)
                                        <div class="timeline-item">
                                            <div class="timeline-date">{{ $user->updated_at->format('M d, Y') }}</div>
                                            <div class="timeline-content">
                                                <strong>Profile Updated</strong><br>
                                                User information was last modified
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif

                        <!-- Action Buttons -->
                        <div class="action-buttons">
                            <button class="btn-action btn-secondary" onclick="window.history.back()">
                                <i class="fas fa-arrow-left"></i>
                                Go Back
                            </button>
                            
                            @if($user->role === 'student' || $user->role === 'teacher')
                                <a href="mailto:{{ $user->email }}" class="btn-action btn-contact">
                                    <i class="fas fa-envelope"></i>
                                    Send Email
                                </a>
                            @endif
                            
                            <a href="{{ route('teacher.users') }}" class="btn-action btn-primary">
                                <i class="fas fa-users"></i>
                                View All Users
                            </a>
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

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Update footer year
    document.getElementById("currentYear").textContent = new Date().getFullYear();
    
    // Animate profile elements on load
    const profileCard = document.querySelector('.profile-card');
    const infoSections = document.querySelectorAll('.info-section');
    const statItems = document.querySelectorAll('.stat-item');
    
    // Add staggered animation to info sections
    infoSections.forEach((section, index) => {
        section.style.opacity = '0';
        section.style.transform = 'translateY(30px)';
        
        setTimeout(() => {
            section.style.transition = 'all 0.6s ease';
            section.style.opacity = '1';
            section.style.transform = 'translateY(0)';
        }, index * 200);
    });
    
    // Add animation to stat items
    statItems.forEach((item, index) => {
        item.style.opacity = '0';
        item.style.transform = 'scale(0.8)';
        
        setTimeout(() => {
            item.style.transition = 'all 0.5s ease';
            item.style.opacity = '1';
            item.style.transform = 'scale(1)';
        }, index * 100 + 300);
    });
    
    // Enhanced profile image loading
    const profileImage = document.querySelector('.avatar-image');
    if (profileImage) {
        profileImage.addEventListener('load', function() {
            this.style.opacity = '0';
            this.style.transform = 'scale(1.1)';
            
            setTimeout(() => {
                this.style.transition = 'all 0.5s ease';
                this.style.opacity = '1';
                this.style.transform = 'scale(1)';
            }, 100);
        });
    }
    
    // Interactive elements
    const actionButtons = document.querySelectorAll('.btn-action');
    actionButtons.forEach(button => {
        button.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-3px) scale(1.02)';
        });
        
        button.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });
    
    // Info items hover effect
    const infoItems = document.querySelectorAll('.info-item');
    infoItems.forEach(item => {
        item.addEventListener('mouseenter', function() {
            const icon = this.querySelector('.info-icon');
            if (icon) {
                icon.style.transform = 'scale(1.1) rotate(5deg)';
            }
        });
        
        item.addEventListener('mouseleave', function() {
            const icon = this.querySelector('.info-icon');
            if (icon) {
                icon.style.transform = 'scale(1) rotate(0deg)';
            }
        });
    });
    
    // Copy email functionality
    const emailElement = document.querySelector('.info-value');
    if (emailElement && emailElement.textContent.includes('@')) {
        emailElement.style.cursor = 'pointer';
        emailElement.title = 'Click to copy email';
        
        emailElement.addEventListener('click', function() {
            navigator.clipboard.writeText(this.textContent).then(function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Email Copied!',
                    text: 'Email address has been copied to clipboard.',
                    timer: 2000,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end'
                });
            });
        });
    }
    
    // Role-based enhancements
    const roleElement = document.querySelector('.role-badge');
    if (roleElement) {
        const role = roleElement.textContent.trim().toLowerCase();
        
        // Add role-specific animations
        if (role.includes('student')) {
            roleElement.style.background = 'linear-gradient(135deg, #3498db, #2980b9)';
        } else if (role.includes('teacher')) {
            roleElement.style.background = 'linear-gradient(135deg, #2ecc71, #27ae60)';
        } else if (role.includes('admin')) {
            roleElement.style.background = 'linear-gradient(135deg, #e74c3c, #c0392b)';
        }
    }
    
    // Enhanced back button functionality
    const backButtons = document.querySelectorAll('.back-btn, .btn-secondary');
    backButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            if (this.textContent.includes('Go Back') || this.textContent.includes('Back')) {
                e.preventDefault();
                
                // Add loading state
                const originalText = this.innerHTML;
                this.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Going Back...';
                this.disabled = true;
                
                setTimeout(() => {
                    if (window.history.length > 1) {
                        window.history.back();
                    } else {
                        window.location.href = '{{ route("teacher.users") }}';
                    }
                }, 500);
            }
        });
    });
    
    // Responsive image handling
    const images = document.querySelectorAll('img');
    images.forEach(img => {
        img.addEventListener('error', function() {
            this.style.opacity = '0.7';
            this.style.filter = 'grayscale(100%)';
        });
    });
    
    // Timeline animation
    const timelineItems = document.querySelectorAll('.timeline-item');
    timelineItems.forEach((item, index) => {
        item.style.opacity = '0';
        item.style.transform = 'translateX(-30px)';
        
        setTimeout(() => {
            item.style.transition = 'all 0.6s ease';
            item.style.opacity = '1';
            item.style.transform = 'translateX(0)';
        }, index * 300 + 800);
    });
    
    // Subject tags interaction
    const subjectTags = document.querySelectorAll('.subject-tag');
    subjectTags.forEach(tag => {
        tag.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.05)';
            this.style.boxShadow = '0 4px 15px rgba(102, 126, 234, 0.3)';
        });
        
        tag.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
            this.style.boxShadow = 'none';
        });
    });
    
    // Performance optimization - lazy load animations
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('fade-in');
            }
        });
    });
    
    document.querySelectorAll('.info-section, .stat-item').forEach(el => {
        observer.observe(el);
    });
    
    // Welcome message
    setTimeout(() => {
        const userName = '{{ $user->firstname }} {{ $user->lastname }}';
        const userRole = '{{ $user->role }}';
        
        console.log(`✅ Enhanced User Profile loaded successfully!`);
        console.log(`👤 Viewing profile: ${userName} (${userRole})`);
    }, 1000);
    
    console.log('✨ Enhanced User Profile Interface initialized!');
});
</script>
@endsection