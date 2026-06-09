@extends('components.dashmaster')

@section('body')
@php
    $isOverdue = $assignment->submission_deadline < now();
    $isDueSoon = $assignment->submission_deadline >= now() && $assignment->submission_deadline <= now()->addDays(3);
    $statusClass = $isOverdue ? 'danger' : ($isDueSoon ? 'warning' : 'success');
    $statusIcon = $isOverdue ? 'exclamation-triangle' : ($isDueSoon ? 'clock' : 'check-circle');
    $statusText = $isOverdue ? 'Overdue' : ($isDueSoon ? 'Due Soon' : 'Active');
    $timeRemaining = $assignment->submission_deadline->diffForHumans();
@endphp

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-8">
                    <h1><i class="fas fa-file-alt text-primary"></i> Assignment Details</h1>
                    <p class="text-muted">Review assignment requirements and submit your work</p>
                </div>
                <div class="col-sm-4">
                    <div class="text-right">
                        <a href="{{ route('student.assignments') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Assignments
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Assignment Status Card -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card border-0 shadow-lg">
                        <div class="card-header bg-gradient-{{ $statusClass == 'danger' ? 'danger' : ($statusClass == 'warning' ? 'warning' : 'primary') }} text-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="card-title mb-0">
                                    <i class="fas fa-file-alt mr-2"></i>{{ $assignment->title }}
                                </h3>
                                <div>
                                    <span class="badge badge-light badge-lg">
                                        <i class="fas fa-{{ $statusIcon }}"></i> {{ $statusText }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="assignment-meta">
                                        <div class="row">
                                            <div class="col-sm-6 mb-3">
                                                <div class="info-item">
                                                    <i class="fas fa-book text-primary"></i>
                                                    <strong>Subject:</strong>
                                                    <span class="badge badge-primary ml-2">{{ $assignment->subject->name ?? 'N/A' }}</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 mb-3">
                                                <div class="info-item">
                                                    <i class="fas fa-users text-info"></i>
                                                    <strong>Class:</strong>
                                                    <span class="badge badge-info ml-2">{{ $assignment->schoolClass ? $assignment->schoolClass->name : 'N/A' }}</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 mb-3">
                                                <div class="info-item">
                                                    <i class="fas fa-user-tie text-success"></i>
                                                    <strong>Teacher:</strong>
                                                    <span class="text-success">{{ $assignment->teacher->name ?? 'N/A' }}</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 mb-3">
                                                <div class="info-item">
                                                    <i class="fas fa-calendar-plus text-secondary"></i>
                                                    <strong>Created:</strong>
                                                    <span class="text-muted">{{ $assignment->created_at->format('M d, Y') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="deadline-card bg-{{ $statusClass == 'danger' ? 'danger' : ($statusClass == 'warning' ? 'warning' : 'success') }} text-white rounded p-3 text-center">
                                        <i class="fas fa-calendar-alt fa-2x mb-2"></i>
                                        <h5>Submission Deadline</h5>
                                        <h4 class="mb-1">{{ $assignment->submission_deadline->format('M d, Y') }}</h4>
                                        <p class="mb-1">{{ $assignment->submission_deadline->format('h:i A') }}</p>
                                        <small class="{{ $isOverdue ? 'text-light' : '' }}">
                                            {{ $timeRemaining }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Assignment Description -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-light">
                            <h4 class="card-title mb-0">
                                <i class="fas fa-info-circle text-primary"></i> Assignment Description
                            </h4>
                        </div>
                        <div class="card-body">
                            @if($assignment->description)
                                <div class="description-content">
                                    {!! nl2br(e($assignment->description)) !!}
                                </div>
                            @else
                                <p class="text-muted italic">No description provided for this assignment.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Cards -->
            <div class="row mb-4">
                <div class="col-md-4 mb-3">
                    <div class="card border-0 shadow-sm h-100 hover-card action-card">
                        <div class="card-body text-center">
                            <i class="fas fa-eye fa-3x text-primary mb-3"></i>
                            <h5>View Assignment</h5>
                            <p class="text-muted">Open and view the assignment file</p>
                            <a href="{{ route('student.assignment.open', $assignment->id) }}" 
                               class="btn btn-primary btn-lg">
                                <i class="fas fa-eye"></i> View File
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card border-0 shadow-sm h-100 hover-card action-card">
                        <div class="card-body text-center">
                            <i class="fas fa-download fa-3x text-info mb-3"></i>
                            <h5>Download Assignment</h5>
                            <p class="text-muted">Download the assignment to your device</p>
                            <a href="{{ route('student.assignments.download', $assignment->id) }}" 
                               class="btn btn-info btn-lg">
                                <i class="fas fa-download"></i> Download
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card border-0 shadow-sm h-100 hover-card action-card">
                        <div class="card-body text-center">
                            <i class="fas fa-upload fa-3x text-{{ $isOverdue ? 'danger' : 'success' }} mb-3"></i>
                            <h5>Submit Assignment</h5>
                            <p class="text-muted">Upload your completed assignment</p>
                            <a href="{{ route('student.assignment.form', $assignment->id) }}" 
                               class="btn btn-{{ $isOverdue ? 'danger' : 'success' }} btn-lg">
                                <i class="fas fa-upload"></i> Submit Work
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Assignment Statistics -->
            <div class="row">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-light">
                            <h4 class="card-title mb-0">
                                <i class="fas fa-chart-bar text-primary"></i> Assignment Information
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-md-3">
                                    <div class="info-box bg-gradient-primary text-white rounded p-3">
                                        <i class="fas fa-clock fa-2x mb-2"></i>
                                        <h6>Time Remaining</h6>
                                        <span class="h5">
                                            @if($isOverdue)
                                                Overdue
                                            @else
                                                {{ $assignment->submission_deadline->diffInDays(now()) }} days
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box bg-gradient-info text-white rounded p-3">
                                        <i class="fas fa-file-alt fa-2x mb-2"></i>
                                        <h6>Assignment Type</h6>
                                        <span class="h5">Document</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box bg-gradient-success text-white rounded p-3">
                                        <i class="fas fa-check-circle fa-2x mb-2"></i>
                                        <h6>Status</h6>
                                        <span class="h5">{{ $statusText }}</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box bg-gradient-warning text-white rounded p-3">
                                        <i class="fas fa-calendar-alt fa-2x mb-2"></i>
                                        <h6>Due Date</h6>
                                        <span class="h6">{{ $assignment->submission_deadline->format('M d') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Footer -->
<footer class="main-footer">
    <strong>Copyright &copy; <span id="currentYear"></span> <a href="https://sumajkt.go.tz">Visit Our Website</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      {{-- <b>Version</b> 3.2.0 --}}
    </div>
</footer>

<!-- Custom Styles -->
<style>
    .content-header h1 {
        font-weight: 600;
        color: #343a40;
    }
    
    .hover-card {
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.15) !important;
    }
    
    .action-card {
        border: 2px solid transparent;
        transition: all 0.3s ease;
    }
    
    .action-card:hover {
        border-color: #007bff;
    }
    
    .card {
        border-radius: 15px;
        overflow: hidden;
    }
    
    .card-header {
        border-radius: 15px 15px 0 0 !important;
        font-weight: 600;
    }
    
    .btn {
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }
    
    .btn-lg {
        padding: 0.75rem 2rem;
        font-size: 1.1rem;
    }
    
    .badge-lg {
        font-size: 0.95rem;
        padding: 0.6rem 1.2rem;
        border-radius: 25px;
    }
    
    .bg-gradient-primary {
        background: linear-gradient(135deg, #007bff, #0056b3);
    }
    
    .bg-gradient-info {
        background: linear-gradient(135deg, #17a2b8, #117a8b);
    }
    
    .bg-gradient-success {
        background: linear-gradient(135deg, #28a745, #1e7e34);
    }
    
    .bg-gradient-warning {
        background: linear-gradient(135deg, #ffc107, #e0a800);
    }
    
    .bg-gradient-danger {
        background: linear-gradient(135deg, #dc3545, #c82333);
    }
    
    .info-item {
        padding: 0.75rem;
        background: rgba(0,123,255,0.05);
        border-radius: 8px;
        border-left: 4px solid #007bff;
        margin-bottom: 0.5rem;
    }
    
    .info-item i {
        margin-right: 0.5rem;
        width: 20px;
    }
    
    .deadline-card {
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        animation: pulse-glow 3s infinite;
    }
    
    @keyframes pulse-glow {
        0%, 100% { 
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        50% { 
            box-shadow: 0 8px 25px rgba(0,0,0,0.3);
        }
    }
    
    .description-content {
        font-size: 1.1rem;
        line-height: 1.6;
        padding: 1rem;
        background: #f8f9fa;
        border-radius: 10px;
        border-left: 5px solid #007bff;
    }
    
    .info-box {
        transition: all 0.3s ease;
        border-radius: 15px !important;
    }
    
    .info-box:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    }
    
    /* Overdue animation */
    .bg-gradient-danger {
        animation: urgent-pulse 2s infinite;
    }
    
    @keyframes urgent-pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.8; }
    }
    
    /* Due soon animation */
    .bg-gradient-warning .fa-clock {
        animation: tick-tock 1s infinite;
    }
    
    @keyframes tick-tock {
        0%, 50% { transform: rotate(0deg); }
        25% { transform: rotate(5deg); }
        75% { transform: rotate(-5deg); }
        100% { transform: rotate(0deg); }
    }
    
    /* Success state */
    .bg-gradient-success .fa-check-circle {
        animation: check-bounce 2s ease-in-out infinite;
    }
    
    @keyframes check-bounce {
        0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
        40% { transform: translateY(-5px); }
        60% { transform: translateY(-3px); }
    }
    
    /* Mobile responsiveness */
    @media (max-width: 768px) {
        .content-header .col-sm-4 {
            text-align: center !important;
            margin-top: 1rem;
        }
        
        .info-box {
            margin-bottom: 1rem;
        }
        
        .btn-lg {
            width: 100%;
            margin-bottom: 0.5rem;
        }
        
        .deadline-card {
            margin-top: 1rem;
        }
    }
    
    /* Loading states */
    .btn.loading {
        position: relative;
        pointer-events: none;
        opacity: 0.8;
    }
    
    .btn.loading::after {
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        margin: auto;
        border: 2px solid transparent;
        border-top-color: #ffffff;
        border-radius: 50%;
        animation: button-loading-spinner 1s ease infinite;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    
    @keyframes button-loading-spinner {
        from { transform: translate(-50%, -50%) rotate(0turn); }
        to { transform: translate(-50%, -50%) rotate(1turn); }
    }
    
    /* Fade in animation */
    .card {
        animation: fadeInUp 0.6s ease-out;
    }
    
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
    
    /* Stagger animation for cards */
    .card:nth-child(1) { animation-delay: 0.1s; }
    .card:nth-child(2) { animation-delay: 0.2s; }
    .card:nth-child(3) { animation-delay: 0.3s; }
    .card:nth-child(4) { animation-delay: 0.4s; }
</style>

<!-- Scripts -->
<script>
    // Footer js
    document.getElementById("currentYear").textContent = new Date().getFullYear();

    // Enhanced functionality
    document.addEventListener('DOMContentLoaded', function() {
        
        // Add loading animation to action buttons
        const actionButtons = document.querySelectorAll('.btn');
        actionButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                // Don't add loading to back button
                if (!this.href || this.href.includes('assignments')) {
                    return;
                }
                
                this.classList.add('loading');
                const originalText = this.innerHTML;
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';
                
                // Reset after 3 seconds if page doesn't change
                setTimeout(() => {
                    if (this.classList.contains('loading')) {
                        this.classList.remove('loading');
                        this.innerHTML = originalText;
                    }
                }, 3000);
            });
        });
        
        // Add click-to-copy functionality for assignment title
        const assignmentTitle = document.querySelector('.card-title');
        if (assignmentTitle) {
            assignmentTitle.style.cursor = 'pointer';
            assignmentTitle.title = 'Click to copy assignment title';
            
            assignmentTitle.addEventListener('click', function() {
                const text = this.textContent.trim();
                navigator.clipboard.writeText(text).then(() => {
                    // Show toast notification
                    showToast('Assignment title copied to clipboard!', 'success');
                });
            });
        }
        
        // Add countdown timer for deadline
        updateCountdown();
        setInterval(updateCountdown, 60000); // Update every minute
        
        // Auto-refresh page if deadline passes
        const deadline = new Date('{{ $assignment->submission_deadline->toISOString() }}');
        const now = new Date();
        
        if (deadline > now) {
            const timeUntilDeadline = deadline.getTime() - now.getTime();
            setTimeout(() => {
                location.reload();
            }, timeUntilDeadline);
        }
        
        // Add keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Alt + V = View assignment
            if (e.altKey && e.key === 'v') {
                e.preventDefault();
                document.querySelector('a[href*="open"]')?.click();
            }
            
            // Alt + D = Download assignment
            if (e.altKey && e.key === 'd') {
                e.preventDefault();
                document.querySelector('a[href*="download"]')?.click();
            }
            
            // Alt + S = Submit assignment
            if (e.altKey && e.key === 's') {
                e.preventDefault();
                document.querySelector('a[href*="form"]')?.click();
            }
            
            // Alt + B = Back to assignments
            if (e.altKey && e.key === 'b') {
                e.preventDefault();
                document.querySelector('a[href*="assignments"]:not([href*="form"]):not([href*="download"]):not([href*="open"])').click();
            }
        });
        
        // Add tooltips for keyboard shortcuts
        const tooltips = {
            'View File': 'View assignment file (Alt+V)',
            'Download': 'Download assignment (Alt+D)', 
            'Submit Work': 'Submit assignment (Alt+S)',
            'Back to Assignments': 'Back to assignments list (Alt+B)'
        };
        
        actionButtons.forEach(button => {
            const text = button.textContent.trim();
            Object.keys(tooltips).forEach(key => {
                if (text.includes(key)) {
                    button.title = tooltips[key];
                }
            });
        });
    });
    
    function updateCountdown() {
        const deadline = new Date('{{ $assignment->submission_deadline->toISOString() }}');
        const now = new Date();
        const timeDiff = deadline.getTime() - now.getTime();
        
        if (timeDiff <= 0) {
            // Deadline passed
            const deadlineCard = document.querySelector('.deadline-card');
            if (deadlineCard && !deadlineCard.classList.contains('bg-danger')) {
                deadlineCard.className = deadlineCard.className.replace(/bg-\w+/, 'bg-danger');
                deadlineCard.querySelector('small').textContent = 'Overdue';
            }
        }
    }
    
    function showToast(message, type = 'info') {
        // Create toast element
        const toast = document.createElement('div');
        toast.className = `alert alert-${type} toast-notification`;
        toast.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            min-width: 300px;
            animation: slideInRight 0.3s ease-out;
        `;
        toast.innerHTML = `
            <i class="fas fa-${type === 'success' ? 'check' : 'info'}-circle mr-2"></i>
            ${message}
        `;
        
        document.body.appendChild(toast);
        
        // Remove toast after 3 seconds
        setTimeout(() => {
            toast.style.animation = 'slideOutRight 0.3s ease-in';
            setTimeout(() => {
                document.body.removeChild(toast);
            }, 300);
        }, 3000);
    }
    
    // Add CSS for toast animations
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideInRight {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        
        @keyframes slideOutRight {
            from { transform: translateX(0); opacity: 1; }
            to { transform: translateX(100%); opacity: 0; }
        }
        
        .toast-notification {
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
    `;
    document.head.appendChild(style);
</script>

@endsection


