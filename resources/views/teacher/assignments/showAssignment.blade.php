@extends('components.dashmaster')

@section('body')

<style>
/* Enhanced Assignment Detail Styling */
.assignment-detail-container {
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    min-height: 100vh;
    padding: 20px 0;
}

.back-navigation {
    margin-bottom: 20px;
    animation: slideInLeft 0.6s ease;
}

.back-btn {
    background: white;
    color: #2c3e50;
    padding: 12px 20px;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    border: 2px solid #e9ecef;
}

.back-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    color: #27ae60;
    text-decoration: none;
    border-color: #27ae60;
}

.back-btn i {
    margin-right: 8px;
}

.assignment-header {
    background: white;
    border-radius: 20px 20px 0 0;
    padding: 40px 30px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    position: relative;
    overflow: hidden;
    animation: fadeInDown 0.8s ease;
}

.assignment-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    opacity: 0.05;
    z-index: 0;
}

.assignment-title {
    color: #2c3e50;
    font-size: 2.5rem;
    font-weight: 700;
    margin: 0 0 15px 0;
    position: relative;
    z-index: 1;
    line-height: 1.2;
}

.assignment-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    position: relative;
    z-index: 1;
    margin-top: 20px;
}

.meta-item {
    background: rgba(39, 174, 96, 0.1);
    color: #27ae60;
    padding: 8px 16px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    border: 1px solid rgba(39, 174, 96, 0.2);
}

.meta-item i {
    margin-right: 8px;
    font-size: 1rem;
}

.assignment-body {
    background: white;
    border-radius: 0 0 20px 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    animation: fadeInUp 0.8s ease;
}

.assignment-content {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 0;
}

.main-content {
    padding: 40px;
    border-right: 1px solid #e9ecef;
}

.sidebar-content {
    padding: 40px 30px;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}

.section-title {
    color: #2c3e50;
    font-size: 1.4rem;
    font-weight: 600;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    border-bottom: 2px solid #e9ecef;
    padding-bottom: 10px;
}

.section-title i {
    margin-right: 10px;
    color: #27ae60;
    width: 25px;
}

.description-content {
    color: #5a6c7d;
    font-size: 1.1rem;
    line-height: 1.7;
    margin-bottom: 30px;
    padding: 25px;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 15px;
    border-left: 5px solid #27ae60;
}

.info-card {
    background: white;
    border-radius: 15px;
    padding: 25px;
    margin-bottom: 25px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    border: 1px solid #e9ecef;
    transition: all 0.3s ease;
}

.info-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
}

.info-item {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
    padding: 12px 0;
    border-bottom: 1px solid #f1f3f4;
}

.info-item:last-child {
    margin-bottom: 0;
    border-bottom: none;
}

.info-icon {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
    color: white;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    font-size: 1.1rem;
}

.info-content {
    flex: 1;
}

.info-label {
    color: #7f8c8d;
    font-size: 0.9rem;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 4px;
}

.info-value {
    color: #2c3e50;
    font-size: 1.1rem;
    font-weight: 600;
}

.deadline-status {
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    display: inline-flex;
    align-items: center;
    margin-top: 8px;
}

.deadline-status i {
    margin-right: 6px;
    font-size: 0.8rem;
}

.status-active {
    background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
    color: #155724;
    border: 1px solid #c3e6cb;
}

.status-overdue {
    background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.status-urgent {
    background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);
    color: #856404;
    border: 1px solid #ffeaa7;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

.action-buttons {
    display: flex;
    flex-direction: column;
    gap: 15px;
    margin-top: 30px;
}

.action-btn {
    background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
    color: white;
    padding: 15px 25px;
    border: none;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 600;
    font-size: 1.1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    cursor: pointer;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.action-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(39, 174, 96, 0.4);
    color: white;
    text-decoration: none;
}

.action-btn i {
    margin-right: 10px;
    font-size: 1.2rem;
}

.action-btn.secondary {
    background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
}

.action-btn.secondary:hover {
    box-shadow: 0 10px 25px rgba(52, 152, 219, 0.4);
}

.action-btn.danger {
    background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
}

.action-btn.danger:hover {
    box-shadow: 0 10px 25px rgba(231, 76, 60, 0.4);
}

.statistics-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 15px;
    margin-top: 30px;
}

.stat-card {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 20px;
    border-radius: 15px;
    text-align: center;
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
}

.stat-number {
    font-size: 2rem;
    font-weight: 700;
    display: block;
    margin-bottom: 5px;
}

.stat-label {
    font-size: 0.9rem;
    opacity: 0.9;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Responsive Design */
@media (max-width: 768px) {
    .assignment-content {
        grid-template-columns: 1fr;
    }
    
    .main-content, .sidebar-content {
        border-right: none;
    }
    
    .assignment-title {
        font-size: 2rem;
    }
    
    .assignment-meta {
        flex-direction: column;
        gap: 10px;
    }
    
    .meta-item {
        justify-content: center;
    }
    
    .statistics-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

/* Animations */
@keyframes fadeInDown {
    from {
        opacity: 0;
        transform: translateY(-30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
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

@keyframes slideInLeft {
    from {
        opacity: 0;
        transform: translateX(-30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

/* Assignment file preview */
.file-preview {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border: 2px dashed #27ae60;
    border-radius: 15px;
    padding: 30px;
    text-align: center;
    margin: 20px 0;
    transition: all 0.3s ease;
}

.file-preview:hover {
    background: linear-gradient(135deg, #e8f5e8 0%, #d4edda 100%);
    border-color: #2ecc71;
}

.file-icon {
    font-size: 4rem;
    color: #27ae60;
    margin-bottom: 15px;
}

.file-name {
    color: #2c3e50;
    font-weight: 600;
    font-size: 1.2rem;
    margin-bottom: 10px;
}

.file-size {
    color: #7f8c8d;
    font-size: 0.9rem;
}
</style>

<div class="content-wrapper assignment-detail-container">
    <div class="container-fluid">
        <!-- Back Navigation -->
        <div class="back-navigation">
            <a href="{{ route('teacher.assignments') }}" class="back-btn">
                <i class="fas fa-arrow-left"></i>
                Back to Assignments
            </a>
        </div>

        <!-- Assignment Header -->
        <div class="assignment-header">
            <h1 class="assignment-title">{{ $assignment->title }}</h1>
            
            <div class="assignment-meta">
                <div class="meta-item">
                    <i class="fas fa-book"></i>
                    {{ $assignment->subject->name ?? 'Subject not found' }}
                </div>
                <div class="meta-item">
                    <i class="fas fa-users"></i>
                    {{ $assignment->schoolClass ? $assignment->schoolClass->name : 'Class not found' }}
                </div>
                <div class="meta-item">
                    <i class="fas fa-user-tie"></i>
                    {{ $assignment->teacher->name ?? 'Teacher not found' }}
                </div>
                <div class="meta-item">
                    <i class="fas fa-calendar-plus"></i>
                    Created {{ $assignment->created_at->format('M d, Y') }}
                </div>
            </div>
        </div>

        <!-- Assignment Body -->
        <div class="assignment-body">
            <div class="assignment-content">
                <!-- Main Content -->
                <div class="main-content">
                    <!-- Description Section -->
                    <div class="section-title">
                        <i class="fas fa-align-left"></i>
                        Assignment Description
                    </div>
                    
                    @if($assignment->description)
                        <div class="description-content">
                            {{ $assignment->description }}
                        </div>
                    @else
                        <div class="description-content" style="color: #7f8c8d; font-style: italic;">
                            <i class="fas fa-info-circle"></i>
                            No description provided for this assignment.
                        </div>
                    @endif

                    <!-- Assignment File Section -->
                    <div class="section-title">
                        <i class="fas fa-file-alt"></i>
                        Assignment Document
                    </div>

                    @if($assignment->file_path)
                        <div class="file-preview">
                            <i class="fas fa-file-pdf file-icon"></i>
                            <div class="file-name">Assignment Document</div>
                            <div class="file-size">Click to view or download</div>
                            <div style="margin-top: 20px;">
                                <a href="{{ route('teacher.assignment.open', $assignment->id) }}" class="action-btn">
                                    <i class="fas fa-eye"></i>
                                    View Assignment File
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="file-preview" style="border-color: #e74c3c; background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);">
                            <i class="fas fa-exclamation-triangle file-icon" style="color: #e74c3c;"></i>
                            <div class="file-name" style="color: #721c24;">No file attached</div>
                            <div class="file-size" style="color: #721c24;">This assignment has no associated document.</div>
                        </div>
                    @endif

                    <!-- Statistics Section -->
                    <div class="section-title">
                        <i class="fas fa-chart-bar"></i>
                        Assignment Statistics
                    </div>

                    <div class="statistics-grid">
                        <div class="stat-card">
                            <span class="stat-number">{{ $assignment->submissions_count ?? 0 }}</span>
                            <span class="stat-label">Submissions</span>
                        </div>
                        <div class="stat-card" style="background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);">
                            <span class="stat-number">{{ $assignment->pending_count ?? 0 }}</span>
                            <span class="stat-label">Pending</span>
                        </div>
                        <div class="stat-card" style="background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);">
                            <span class="stat-number">{{ $assignment->graded_count ?? 0 }}</span>
                            <span class="stat-label">Graded</span>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Content -->
                <div class="sidebar-content">
                    <!-- Assignment Details -->
                    <div class="info-card">
                        <div class="section-title" style="border-bottom: none; margin-bottom: 15px; padding-bottom: 0;">
                            <i class="fas fa-info-circle"></i>
                            Assignment Details
                        </div>

                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                            <div class="info-content">
                                <div class="info-label">Created Date</div>
                                <div class="info-value">{{ $assignment->created_at->format('M d, Y') }}</div>
                                <small style="color: #7f8c8d;">{{ $assignment->created_at->diffForHumans() }}</small>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="info-content">
                                <div class="info-label">Submission Deadline</div>
                                @if($assignment->submission_deadline)
                                    <div class="info-value">{{ $assignment->submission_deadline->format('M d, Y H:i') }}</div>
                                    <small style="color: #7f8c8d;">{{ $assignment->submission_deadline->diffForHumans() }}</small>
                                    
                                    @php
                                        $now = now();
                                        $deadline = $assignment->submission_deadline;
                                        $isOverdue = $deadline < $now;
                                        $isUrgent = !$isOverdue && $deadline->diffInHours($now) <= 24;
                                    @endphp

                                    @if($isOverdue)
                                        <div class="deadline-status status-overdue">
                                            <i class="fas fa-times-circle"></i>
                                            Overdue
                                        </div>
                                    @elseif($isUrgent)
                                        <div class="deadline-status status-urgent">
                                            <i class="fas fa-exclamation-triangle"></i>
                                            Urgent
                                        </div>
                                    @else
                                        <div class="deadline-status status-active">
                                            <i class="fas fa-check-circle"></i>
                                            Active
                                        </div>
                                    @endif
                                @else
                                    <div class="info-value" style="color: #7f8c8d; font-style: italic;">No deadline set</div>
                                @endif
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-edit"></i>
                            </div>
                            <div class="info-content">
                                <div class="info-label">Last Modified</div>
                                <div class="info-value">{{ $assignment->updated_at->format('M d, Y H:i') }}</div>
                                <small style="color: #7f8c8d;">{{ $assignment->updated_at->diffForHumans() }}</small>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="info-card">
                        <div class="section-title" style="border-bottom: none; margin-bottom: 15px; padding-bottom: 0;">
                            <i class="fas fa-cogs"></i>
                            Quick Actions
                        </div>

                        <div class="action-buttons">
                            @if($assignment->file_path)
                                <a href="{{ route('teacher.assignment.open', $assignment->id) }}" class="action-btn">
                                    <i class="fas fa-download"></i>
                                    Download File
                                </a>
                            @endif

                            <a href="/addAssignment" class="action-btn secondary">
                                <i class="fas fa-plus"></i>
                                Create New Assignment
                            </a>

                            <a href="{{ route('teacher.assignments.submissions') }}" class="action-btn" style="background: linear-gradient(135deg, #9b59b6 0%, #8e44ad 100%);">
                                <i class="fas fa-paper-plane"></i>
                                View All Submissions
                            </a>

                            <button onclick="confirmDelete()" class="action-btn danger">
                                <i class="fas fa-trash-alt"></i>
                                Delete Assignment
                            </button>
                        </div>
                    </div>

                    <!-- Share Assignment -->
                    <div class="info-card">
                        <div class="section-title" style="border-bottom: none; margin-bottom: 15px; padding-bottom: 0;">
                            <i class="fas fa-share-alt"></i>
                            Share Assignment
                        </div>

                        <div class="action-buttons">
                            <button onclick="copyAssignmentLink()" class="action-btn" style="background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);">
                                <i class="fas fa-copy"></i>
                                Copy Link
                            </button>

                            <button onclick="emailAssignment()" class="action-btn" style="background: linear-gradient(135deg, #fd7e14 0%, #e8590c 100%);">
                                <i class="fas fa-envelope"></i>
                                Email to Students
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" style="display: none;">
    <form method="POST" action="/deleteAssignment/{{ $assignment->id }}" id="deleteForm">
        @csrf
        @method('DELETE')
    </form>
</div>
 <footer class="main-footer">
    <strong>Copyright &copy; <span id="currentYear"></span> <a href="https://sumajkt.go.tz">Visit Our Website</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Teacher Portal</b> v2.0
    </div>
</footer>

<script>
    // Enhanced assignment detail functionality
    document.addEventListener('DOMContentLoaded', function() {
        // Set current year
        document.getElementById("currentYear").textContent = new Date().getFullYear();
        
        // Add animation delays to cards
        const cards = document.querySelectorAll('.info-card');
        cards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
            card.style.animation = 'fadeInUp 0.6s ease forwards';
        });
        
        // Add hover effects to action buttons
        const actionBtns = document.querySelectorAll('.action-btn');
        actionBtns.forEach(btn => {
            btn.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-3px) scale(1.02)';
            });
            
            btn.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(-3px)';
            });
        });

        // Initialize tooltips
        initializeTooltips();
        
        // Check for session messages
        showSessionMessages();
    });

    // Delete confirmation
    function confirmDelete() {
        const title = "{{ $assignment->title }}";
        const confirmation = confirm(`Are you sure you want to delete the assignment "${title}"?\n\nThis action cannot be undone and will remove all associated submissions and grades.`);
        
        if (confirmation) {
            // Show loading state
            const deleteBtn = event.target;
            const originalText = deleteBtn.innerHTML;
            deleteBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Deleting...';
            deleteBtn.disabled = true;
            
            // Submit delete form after short delay
            setTimeout(() => {
                document.getElementById('deleteForm').submit();
            }, 1000);
        }
    }

    // Copy assignment link
    function copyAssignmentLink() {
        const link = window.location.href;
        
        if (navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard.writeText(link).then(() => {
                showNotification('Assignment link copied to clipboard!', 'success');
            }).catch(() => {
                fallbackCopyToClipboard(link);
            });
        } else {
            fallbackCopyToClipboard(link);
        }
    }

    // Fallback copy method
    function fallbackCopyToClipboard(text) {
        const textArea = document.createElement('textarea');
        textArea.value = text;
        textArea.style.position = 'fixed';
        textArea.style.left = '-999999px';
        textArea.style.top = '-999999px';
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();
        
        try {
            document.execCommand('copy');
            showNotification('Assignment link copied to clipboard!', 'success');
        } catch (err) {
            showNotification('Failed to copy link. Please copy manually.', 'error');
        }
        
        document.body.removeChild(textArea);
    }

    // Email assignment to students
    function emailAssignment() {
        const assignmentTitle = "{{ $assignment->title }}";
        const className = "{{ $assignment->schoolClass ? $assignment->schoolClass->name : 'Class' }}";
        const deadline = "{{ $assignment->submission_deadline ? $assignment->submission_deadline->format('M d, Y H:i') : 'No deadline' }}";
        
        const subject = encodeURIComponent(`New Assignment: ${assignmentTitle}`);
        const body = encodeURIComponent(`Dear Students,

A new assignment has been posted for ${className}:

Assignment: ${assignmentTitle}
Deadline: ${deadline}
Link: ${window.location.href}

Please complete and submit your work before the deadline.

Best regards,
{{ $assignment->teacher->name ?? 'Your Teacher' }}`);

        window.open(`mailto:?subject=${subject}&body=${body}`, '_blank');
        showNotification('Email client opened with assignment details', 'info');
    }

    // Print assignment details
    function printAssignment() {
        window.print();
    }

    // Show notification system
    function showNotification(message, type = 'info') {
        // Remove existing notifications
        const existingNotifications = document.querySelectorAll('.notification');
        existingNotifications.forEach(notification => notification.remove());
        
        const notification = document.createElement('div');
        notification.className = 'notification';
        
        const colors = {
            'success': '#27ae60',
            'error': '#e74c3c', 
            'warning': '#f39c12',
            'info': '#3498db'
        };
        
        const icons = {
            'success': 'check-circle',
            'error': 'exclamation-circle',
            'warning': 'exclamation-triangle', 
            'info': 'info-circle'
        };
        
        const bgColor = colors[type] || colors.info;
        const icon = icons[type] || icons.info;
        
        notification.innerHTML = `
            <div style="
                position: fixed;
                top: 20px;
                right: 20px;
                background: ${bgColor};
                color: white;
                padding: 15px 20px;
                border-radius: 12px;
                z-index: 10000;
                animation: slideInRight 0.5s ease;
                box-shadow: 0 5px 20px rgba(0,0,0,0.2);
                max-width: 400px;
                display: flex;
                align-items: center;
            ">
                <i class="fas fa-${icon}" style="margin-right: 10px; font-size: 1.2rem;"></i>
                <span>${message}</span>
            </div>
        `;
        
        document.body.appendChild(notification);
        
        // Remove after 4 seconds
        setTimeout(() => {
            notification.remove();
        }, 4000);
    }

    // Initialize tooltips
    function initializeTooltips() {
        const tooltipElements = document.querySelectorAll('[data-tooltip]');
        tooltipElements.forEach(element => {
            element.addEventListener('mouseenter', showTooltip);
            element.addEventListener('mouseleave', hideTooltip);
        });
    }

    // Show session messages
    function showSessionMessages() {
        @if(session('success'))
            showNotification('{{ session('success') }}', 'success');
        @endif

        @if(session('error'))
            showNotification('{{ session('error') }}', 'error');
        @endif

        @if(session('warning'))
            showNotification('{{ session('warning') }}', 'warning');
        @endif

        @if(session('info'))
            showNotification('{{ session('info') }}', 'info');
        @endif
    }

    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // Ctrl/Cmd + B - Back to assignments
        if ((e.ctrlKey || e.metaKey) && e.key === 'b') {
            e.preventDefault();
            window.location.href = "{{ route('teacher.assignments') }}";
        }
        
        // Ctrl/Cmd + E - Create new assignment
        if ((e.ctrlKey || e.metaKey) && e.key === 'e') {
            e.preventDefault();
            window.location.href = "/addAssignment";
        }
        
        // Ctrl/Cmd + D - Download file (if exists)
        @if($assignment->file_path)
        if ((e.ctrlKey || e.metaKey) && e.key === 'd') {
            e.preventDefault();
            window.open("{{ route('teacher.assignment.open', $assignment->id) }}", '_blank');
        }
        @endif
    });

    // Add CSS animations
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideInRight {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        
        @keyframes fadeInUp {
            from { 
                opacity: 0; 
                transform: translateY(20px); 
            }
            to { 
                opacity: 1; 
                transform: translateY(0); 
            }
        }
        
        .info-card {
            animation-fill-mode: both;
        }

        /* Print styles */
        @media print {
            .back-navigation,
            .action-buttons,
            footer {
                display: none !important;
            }
            
            .assignment-detail-container {
                background: white !important;
            }
            
            .assignment-content {
                grid-template-columns: 1fr !important;
            }
        }

        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }
    `;
    document.head.appendChild(style);

    // Update statistics periodically (every 30 seconds)
    setInterval(function() {
        // In a real application, you might want to fetch updated statistics
        console.log('Statistics updated');
    }, 30000);

    // Add context menu for additional options
    document.addEventListener('contextmenu', function(e) {
        // Custom context menu could be added here
    });
</script>

@endsection

