@extends('components.dashmaster')

@section('body')

<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="page-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="page-title">
                                <i class="fas fa-user-circle me-2"></i>
                                User Profile
                            </h1>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('admin.users') }}">Users</a>
                                    </li>
                                    <li class="breadcrumb-item active">{{ $user->firstname }} {{ $user->lastname }}</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="header-actions">
                            <a href="/editUser/{{ $user->id }}" class="btn btn-warning mr-2">
                                <i class="fas fa-edit"></i> Edit User
                            </a>
                            <a href="{{ route('admin.resetPassword', $user->id) }}" class="btn btn-info mr-2">
                                <i class="fas fa-key"></i> Reset Password
                            </a>
                            <a href="{{ route('admin.users') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back to Users
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Profile Content -->
        <div class="row">
            <!-- Profile Information Card -->
            <div class="col-md-4">
                <div class="card profile-card">
                    <div class="card-body text-center">
                        <div class="profile-image-container mb-4">
                            <img src="{{ $user->profile_image ? asset('uploads/profile_images/' . $user->profile_image) : asset('dist/img/avatar5.png') }}" 
                                 class="profile-image" alt="Profile Image">
                            <div class="status-indicator {{ $user->status ?? 'active' }}"></div>
                        </div>
                        <h4 class="profile-name">{{ $user->firstname }} {{ $user->secondname }} {{ $user->lastname }}</h4>
                        <span class="role-badge role-{{ $user->role }}">
                            @if($user->role === 'student')
                                <i class="fas fa-graduation-cap"></i>
                            @elseif($user->role === 'teacher')
                                <i class="fas fa-chalkboard-teacher"></i>
                            @elseif($user->role === 'admin')
                                <i class="fas fa-user-shield"></i>
                            @endif
                            {{ ucfirst($user->role) }}
                        </span>
                        <div class="profile-stats mt-4">
                            <div class="stat-item">
                                <div class="stat-value">{{ $user->created_at->diffForHumans() }}</div>
                                <div class="stat-label">Member Since</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions Card -->
                <div class="card quick-actions-card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-bolt"></i> Quick Actions
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="action-buttons">
                            <a href="/editUser/{{ $user->id }}" class="btn btn-warning btn-block mb-2">
                                <i class="fas fa-edit"></i> Edit Profile
                            </a>
                            <a href="{{ route('admin.resetPassword', $user->id) }}" class="btn btn-info btn-block mb-2">
                                <i class="fas fa-key"></i> Reset Password
                            </a>
                            @if($user->role === 'teacher' && !optional($user->schoolClass)->name)
                                <a href="{{ route('adminUsers.assign-class-subject', $user->id) }}" class="btn btn-success btn-block mb-2">
                                    <i class="fas fa-plus"></i> Assign Classes
                                </a>
                            @endif
                            <button class="btn btn-danger btn-block" onclick="confirmAction('Are you sure you want to delete this user?', '/deleteUser/{{ $user->id }}', 'DELETE')">
                                <i class="fas fa-trash-alt"></i> Delete User
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detailed Information -->
            <div class="col-md-8">
                <!-- Personal Information -->
                <div class="card details-card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-user"></i> Personal Information
                        </h5>
                    </div>
                        <div class="info-grid">
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-envelope"></i> Email Address
                                </div>
                                <div class="info-value">{{ $user->email }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-phone"></i> Phone Number
                                </div>
                                <div class="info-value">{{ $user->phone ?? 'Not provided' }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-venus-mars"></i> Gender
                                </div>
                                <div class="info-value">{{ ucfirst($user->gender ?? 'Not specified') }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-school"></i> School
                                </div>
                                <div class="info-value">{{ $user->school_id ? optional($user->school_relation)->name : ucfirst($user->school ?? 'No School') }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-calendar-alt"></i> Join Date
                                </div>
                                <div class="info-value">{{ $user->created_at->format('M j, Y') }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-clock"></i> Last Updated
                                </div>
                                <div class="info-value">{{ $user->updated_at->diffForHumans() }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                @if($user->role === 'teacher' && !empty($assignedClasses))
                <!-- Teaching Assignments -->
                <div class="card assignments-card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-chalkboard"></i> Teaching Assignments
                        </h5>
                        <div class="card-tools">
                            <span class="badge badge-success">{{ count($assignedClasses) }} Classes Assigned</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="assignments-grid">
                            @foreach($assignedClasses as $className => $subjects)
                                <div class="assignment-card">
                                    <div class="assignment-header">
                                        <h6 class="class-name">
                                            <i class="fas fa-users"></i> {{ $className }}
                                        </h6>
                                        <span class="subject-count">{{ count($subjects) }} Subject{{ count($subjects) > 1 ? 's' : '' }}</span>
                                    </div>
                                    <div class="subjects-list">
                                        @foreach($subjects as $subject)
                                            <span class="subject-badge">
                                                <i class="fas fa-book"></i> {{ $subject->subject_name }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @elseif($user->role === 'teacher' && empty($assignedClasses))
                <!-- No Assignments -->
                <div class="card assignments-card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-chalkboard"></i> Teaching Assignments
                        </h5>
                    </div>
                    <div class="card-body text-center">
                        <div class="empty-state">
                            <i class="fas fa-clipboard-list"></i>
                            <h6>No Classes Assigned</h6>
                            <p class="text-muted">This teacher has not been assigned to any classes yet.</p>
                            <a href="{{ route('adminUsers.assign-class-subject', $user->id) }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Assign Classes & Subjects
                            </a>
                        </div>
                    </div>
                </div>
                @endif

                @if($user->role === 'student')
                <!-- Student Information -->
                <div class="card student-info-card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-graduation-cap"></i> Academic Information
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="info-grid">
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-chalkboard"></i> Class
                                </div>
                                <div class="info-value">
                                    {{ optional($user->schoolClass)->name ?? 'Not assigned' }}
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-user-graduate"></i> Student Status
                                </div>
                                <div class="info-value">
                                    <span class="badge badge-{{ $user->status === 'active' ? 'success' : 'secondary' }}">
                                        {{ ucfirst($user->status ?? 'active') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- System Information -->
                <div class="card system-info-card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-cogs"></i> System Information
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="info-grid">
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-id-card"></i> User ID
                                </div>
                                <div class="info-value">#{{ $user->id }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-toggle-on"></i> Account Status
                                </div>
                                <div class="info-value">
                                    <span class="badge badge-{{ ($user->status ?? 'active') === 'active' ? 'success' : 'secondary' }}">
                                        <i class="fas fa-{{ ($user->status ?? 'active') === 'active' ? 'check-circle' : 'pause-circle' }}"></i>
                                        {{ ucfirst($user->status ?? 'active') }}
                                    </span>
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-calendar-plus"></i> Account Created
                                </div>
                                <div class="info-value">
                                    {{ $user->created_at->format('F j, Y \a\t g:i A') }}
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">
                                    <i class="fas fa-edit"></i> Last Modified
                                </div>
                                <div class="info-value">
                                    {{ $user->updated_at->format('F j, Y \a\t g:i A') }}
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
        min-height: 100vh;
        background: #f8f9fa;
    }

    /* Page Header */
    .page-header {
        background: #fff;
        border-radius: 12px;
        padding: 25px;
        margin-bottom: 25px;
        border-left: 4px solid #007bff;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    }

    .page-title {
        color: #495057;
        font-size: 1.8rem;
        font-weight: 700;
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

    .header-actions .btn {
        border-radius: 20px;
        font-weight: 500;
        padding: 8px 16px;
    }

    /* Profile Card */
    .profile-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        margin-bottom: 25px;
        overflow: hidden;
    }

    .profile-image-container {
        position: relative;
        display: inline-block;
    }

    .profile-image {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #fff;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }

    .status-indicator {
        position: absolute;
        bottom: 10px;
        right: 10px;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        border: 3px solid white;
        box-shadow: 0 2px 8px rgba(0,0,0,0.2);
    }

    .status-indicator.active {
        background: #28a745;
    }

    .status-indicator.inactive {
        background: #6c757d;
    }

    .profile-name {
        color: #2c3e50;
        font-weight: 700;
        margin-bottom: 10px;
        font-size: 1.4rem;
    }

    .role-badge {
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 20px;
    }

    .role-badge.role-student {
        background: #e3f2fd;
        color: #1976d2;
    }

    .role-badge.role-teacher {
        background: #f3e5f5;
        color: #7b1fa2;
    }

    .role-badge.role-admin {
        background: #fff3e0;
        color: #f57c00;
    }

    .profile-stats {
        border-top: 1px solid #eee;
        padding-top: 20px;
    }

    .stat-item {
        text-align: center;
    }

    .stat-value {
        font-size: 1.1rem;
        font-weight: 600;
        color: #2c3e50;
    }

    .stat-label {
        font-size: 0.8rem;
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Quick Actions Card */
    .quick-actions-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        margin-bottom: 25px;
    }

    .quick-actions-card .card-header {
        background: linear-gradient(135deg, #6c757d, #495057);
        color: white;
        border-radius: 15px 15px 0 0;
        border: none;
        padding: 15px 20px;
    }

    .action-buttons .btn {
        border-radius: 25px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .action-buttons .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }

    /* Details Card */
    .details-card, .assignments-card, .student-info-card, .system-info-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        margin-bottom: 25px;
    }

    .details-card .card-header {
        background: linear-gradient(135deg, #007bff, #0056b3);
        color: white;
        border-radius: 15px 15px 0 0;
        border: none;
        padding: 15px 20px;
    }

    .assignments-card .card-header {
        background: linear-gradient(135deg, #28a745, #20c997);
        color: white;
        border-radius: 15px 15px 0 0;
        border: none;
        padding: 15px 20px;
    }

    .student-info-card .card-header {
        background: linear-gradient(135deg, #17a2b8, #138496);
        color: white;
        border-radius: 15px 15px 0 0;
        border: none;
        padding: 15px 20px;
    }

    .system-info-card .card-header {
        background: linear-gradient(135deg, #6f42c1, #563d7c);
        color: white;
        border-radius: 15px 15px 0 0;
        border: none;
        padding: 15px 20px;
    }

    /* Info Grid */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        padding: 10px 0;
    }

    .info-item {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 10px;
        border-left: 4px solid #007bff;
        transition: all 0.3s ease;
    }

    .info-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .info-label {
        font-size: 0.8rem;
        color: #6c757d;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 5px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .info-value {
        font-size: 1rem;
        color: #2c3e50;
        font-weight: 500;
    }

    /* Assignment Cards */
    .assignments-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
    }

    .assignment-card {
        background: #fff;
        border: 1px solid #e9ecef;
        border-radius: 12px;
        padding: 20px;
        transition: all 0.3s ease;
    }

    .assignment-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        border-color: #28a745;
    }

    .assignment-header {
        display: flex;
        justify-content: between;
        align-items: center;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
    }

    .class-name {
        color: #2c3e50;
        font-weight: 700;
        margin: 0;
        font-size: 1.1rem;
    }

    .subject-count {
        background: #28a745;
        color: white;
        padding: 4px 12px;
        border-radius: 15px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .subjects-list {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .subject-badge {
        background: #e3f2fd;
        color: #1976d2;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    /* Empty State */
    .empty-state {
        padding: 40px 20px;
        color: #6c757d;
    }

    .empty-state i {
        font-size: 3rem;
        margin-bottom: 15px;
        color: #dee2e6;
    }

    .empty-state h6 {
        font-size: 1.2rem;
        color: #495057;
        margin-bottom: 10px;
    }

    /* Badges */
    .badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 12px;
        font-size: 0.8rem;
        font-weight: 500;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .content-wrapper {
            padding: 15px;
        }
        
        .page-title {
            font-size: 1.4rem;
        }
        
        .header-actions {
            margin-top: 15px;
        }
        
        .header-actions .btn {
            display: block;
            width: 100%;
            margin-bottom: 8px;
        }

        .info-grid {
            grid-template-columns: 1fr;
            gap: 15px;
        }

        .assignments-grid {
            grid-template-columns: 1fr;
        }

        .assignment-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }

        .profile-image {
            width: 100px;
            height: 100px;
        }
    }

    /* Animations */
    .card {
        animation: slideIn 0.5s ease;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Loading states */
    .loading {
        opacity: 0.6;
        pointer-events: none;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Update footer year
        document.getElementById("currentYear").textContent = new Date().getFullYear();

        // Initialize tooltips
        if (typeof $ !== 'undefined' && $.fn.tooltip) {
            $('[data-toggle="tooltip"]').tooltip();
        }

        // Smooth scrolling for page sections
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Auto-hide alerts
        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                if (alert.classList.contains('alert-success')) {
                    alert.style.transition = 'opacity 0.3s ease';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 300);
                }
            });
        }, 5000);
    });

    // Confirm action function
    function confirmAction(message, url, method = 'GET') {
        if (confirm(message)) {
            if (method === 'DELETE') {
                // Create a form for DELETE request
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = url;
                
                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                
                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';
                
                form.appendChild(csrfToken);
                form.appendChild(methodInput);
                
                document.body.appendChild(form);
                form.submit();
            } else {
                window.location.href = url;
            }
        }
    }

    // Copy user ID to clipboard
    function copyUserId() {
        const userId = '{{ $user->id }}';
        if (navigator.clipboard) {
            navigator.clipboard.writeText(userId).then(() => {
                alert('User ID copied to clipboard!');
            });
        } else {
            // Fallback for older browsers
            const textArea = document.createElement('textarea');
            textArea.value = userId;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand('copy');
            document.body.removeChild(textArea);
            alert('User ID copied to clipboard!');
        }
    }

    // Print user profile
    function printProfile() {
        window.print();
    }

    // Show loading state
    function showLoading(element) {
        element.classList.add('loading');
        const originalText = element.innerHTML;
        element.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
        element.disabled = true;
        
        // Reset after 3 seconds (adjust as needed)
        setTimeout(() => {
            element.innerHTML = originalText;
            element.disabled = false;
            element.classList.remove('loading');
        }, 3000);
    }
</script>

@endsection