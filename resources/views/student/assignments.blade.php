
@extends('components.dashmaster')

@section('body')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-8">
                    <h1><i class="fas fa-tasks text-primary"></i> My Assignments</h1>
                    <p class="text-muted">Complete and submit your assignments on time</p>
                </div>
                <div class="col-sm-4">
                    <div class="text-right">
                        <span class="badge badge-lg badge-success">
                            <i class="fas fa-list"></i> {{ $assignments->count() }} Assignment{{ $assignments->count() != 1 ? 's' : '' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Summary Card - At Top -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-md-3">
                                    <div class="info-box bg-light">
                                        <span class="info-box-icon bg-primary">
                                            <i class="fas fa-tasks"></i>
                                        </span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Total Assignments</span>
                                            <span class="info-box-number">{{ $assignments->count() }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box bg-light">
                                        <span class="info-box-icon bg-warning">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Pending</span>
                                            <span class="info-box-number">{{ $assignments->where('submission_deadline', '>', now())->count() }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box bg-light">
                                        <span class="info-box-icon bg-danger">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Overdue</span>
                                            <span class="info-box-number">{{ $assignments->where('submission_deadline', '<', now())->count() }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box bg-light">
                                        <span class="info-box-icon bg-success">
                                            <i class="fas fa-calendar-check"></i>
                                        </span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">This Week</span>
                                            <span class="info-box-number">{{ $assignments->where('submission_deadline', '>=', now())->where('submission_deadline', '<=', now()->addWeek())->count() }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if($assignments->isNotEmpty())
                <!-- Assignments Grid -->
                <div class="row">
                    @foreach($assignments as $index => $assignment)
                        @php
                            $isOverdue = $assignment->submission_deadline < now();
                            $isDueSoon = $assignment->submission_deadline >= now() && $assignment->submission_deadline <= now()->addDays(3);
                            $statusClass = $isOverdue ? 'danger' : ($isDueSoon ? 'warning' : 'success');
                            $statusIcon = $isOverdue ? 'exclamation-triangle' : ($isDueSoon ? 'clock' : 'check-circle');
                            $statusText = $isOverdue ? 'Overdue' : ($isDueSoon ? 'Due Soon' : 'Active');
                        @endphp
                        
                        <div class="col-lg-6 col-md-12 mb-4">
                            <div class="card h-100 border-0 shadow-sm hover-card assignment-card">
                                <div class="card-header bg-gradient-{{ $index % 3 == 0 ? 'primary' : ($index % 3 == 1 ? 'info' : 'secondary') }} text-white">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="card-title mb-0">
                                            <i class="fas fa-file-alt"></i>
                                            {{ $assignment->title }}
                                        </h5>
                                        <span class="badge badge-{{ $statusClass }}">
                                            <i class="fas fa-{{ $statusIcon }}"></i> {{ $statusText }}
                                        </span>
                                    </div>
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <div class="assignment-details mb-3">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <small class="text-muted">
                                                    <i class="fas fa-book"></i> {{ $assignment->subject->name ?? 'N/A' }}
                                                </small>
                                            </div>
                                            <div class="col-sm-6">
                                                <small class="text-muted">
                                                    <i class="fas fa-users"></i> {{ $assignment->schoolClass->name ?? 'N/A' }}
                                                </small>
                                            </div>
                                        </div>
                                        <div class="row mt-1">
                                            <div class="col-12">
                                                <small class="text-muted">
                                                    <i class="fas fa-calendar-alt"></i> 
                                                    Due: <strong class="text-{{ $statusClass }}">{{ $assignment->submission_deadline->format('M d, Y h:i A') }}</strong>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    @if($assignment->description)
                                        <p class="text-muted assignment-description">
                                            <i class="fas fa-info-circle text-primary"></i>
                                            {{ Str::limit($assignment->description, 100) }}
                                        </p>
                                    @endif
                                    
                                    <div class="mt-auto">
                                        <div class="row">
                                            <div class="col-md-4 mb-2">
                                                <a href="{{route('student.assignment.show', $assignment->id)}}" 
                                                   class="btn btn-outline-primary btn-sm btn-block">
                                                    <i class="fas fa-eye"></i> Details
                                                </a>
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <a href="{{ route('student.assignments.download', $assignment->id) }}" 
                                                   class="btn btn-outline-info btn-sm btn-block">
                                                    <i class="fas fa-download"></i> Download
                                                </a>
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <a href="{{route('student.assignment.form', $assignment->id)}}" 
                                                   class="btn btn-{{ $isOverdue ? 'danger' : 'success' }} btn-sm btn-block">
                                                    <i class="fas fa-upload"></i> Submit
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-transparent">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">
                                            <i class="fas fa-user-tie"></i> {{ $assignment->teacher->name ?? 'Teacher' }}
                                        </small>
                                        <small class="text-muted">
                                            <i class="fas fa-clock"></i> 
                                            @if($isOverdue)
                                                {{ $assignment->submission_deadline->diffForHumans() }}
                                            @else
                                                {{ $assignment->submission_deadline->diffForHumans() }}
                                            @endif
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center py-5">
                                <i class="fas fa-tasks fa-4x text-muted mb-3"></i>
                                <h4 class="text-muted">No Assignments Available</h4>
                                <p class="text-muted">There are currently no assignments available for your class. Check back later or contact your teacher.</p>
                                <button class="btn btn-primary" onclick="location.reload()">
                                    <i class="fas fa-refresh"></i> Refresh Page
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
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
    .hover-card {
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    
    .assignment-card {
        border-left: 4px solid transparent;
    }
    
    .assignment-card:hover {
        border-left-color: #007bff;
    }
    
    .content-header h1 {
        font-weight: 600;
        color: #343a40;
    }
    
    .badge-lg {
        font-size: 0.875rem;
        padding: 0.5rem 1rem;
    }
    
    .card-header h5 {
        font-weight: 600;
        font-size: 1.1rem;
    }
    
    .info-box {
        border-radius: 10px;
        border: none;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }
    
    .info-box:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }
    
    .info-box-icon {
        border-radius: 10px 0 0 10px;
    }
    
    .card {
        border-radius: 15px;
        overflow: hidden;
    }
    
    .card-header {
        border-radius: 15px 15px 0 0 !important;
    }
    
    .btn {
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .btn:hover {
        transform: translateY(-1px);
    }
    
    .bg-gradient-primary {
        background: linear-gradient(135deg, #007bff, #0056b3);
    }
    
    .bg-gradient-info {
        background: linear-gradient(135deg, #17a2b8, #117a8b);
    }
    
    .bg-gradient-secondary {
        background: linear-gradient(135deg, #6c757d, #495057);
    }
    
    .assignment-details {
        background: rgba(0,123,255,0.05);
        border-radius: 8px;
        padding: 10px;
        border-left: 3px solid #007bff;
    }
    
    .assignment-description {
        font-size: 0.9rem;
        line-height: 1.4;
    }
    
    .text-danger {
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0% { opacity: 1; }
        50% { opacity: 0.7; }
        100% { opacity: 1; }
    }
    
    .badge-success {
        background: linear-gradient(135deg, #28a745, #1e7e34);
    }
    
    .badge-warning {
        background: linear-gradient(135deg, #ffc107, #e0a800);
    }
    
    .badge-danger {
        background: linear-gradient(135deg, #dc3545, #c82333);
    }
    
    @media (max-width: 768px) {
        .content-header .col-sm-4 {
            text-align: center !important;
            margin-top: 1rem;
        }
        
        .info-box {
            margin-bottom: 1rem;
        }
        
        .card-body .row .col-md-4 {
            margin-bottom: 0.5rem;
        }
    }
    
    /* Loading animation */
    .btn.loading {
        position: relative;
        pointer-events: none;
    }
    
    .btn.loading::after {
        content: '';
        position: absolute;
        width: 16px;
        height: 16px;
        margin: auto;
        border: 2px solid transparent;
        border-top-color: #ffffff;
        border-radius: 50%;
        animation: button-loading-spinner 1s ease infinite;
    }
    
    @keyframes button-loading-spinner {
        from {
            transform: rotate(0turn);
        }
        to {
            transform: rotate(1turn);
        }
    }
</style>

<!-- Scripts -->
<script>
    // Footer js
    document.getElementById("currentYear").textContent = new Date().getFullYear();

    // Enhanced functionality
    document.addEventListener('DOMContentLoaded', function() {
        // Add click effect to assignment cards
        const cards = document.querySelectorAll('.hover-card');
        
        cards.forEach(card => {
            card.addEventListener('click', function(e) {
                if (e.target.tagName !== 'A' && e.target.tagName !== 'BUTTON' && !e.target.closest('a') && !e.target.closest('button')) {
                    const detailsLink = card.querySelector('a[href*="show"]');
                    if (detailsLink) {
                        window.location.href = detailsLink.href;
                    }
                }
            });
        });
        
        // Add loading animation to buttons
        const buttons = document.querySelectorAll('a.btn');
        buttons.forEach(button => {
            button.addEventListener('click', function() {
                this.classList.add('loading');
                const originalText = this.innerHTML;
                
                setTimeout(() => {
                    this.classList.remove('loading');
                    this.innerHTML = originalText;
                }, 2000);
            });
        });
        
        // Auto-refresh page every 5 minutes to check for new assignments
        setInterval(function() {
            const lastActivity = localStorage.getItem('lastActivity');
            const now = Date.now();
            
            // Only refresh if user has been active in the last 10 minutes
            if (!lastActivity || (now - parseInt(lastActivity)) < 600000) {
                location.reload();
            }
        }, 300000); // 5 minutes
        
        // Track user activity
        document.addEventListener('click', function() {
            localStorage.setItem('lastActivity', Date.now().toString());
        });
        
        // Add tooltips for better UX
        const tooltips = {
            'Details': 'View assignment details and instructions',
            'Download': 'Download assignment files',
            'Submit': 'Submit your completed assignment'
        };
        
        buttons.forEach(button => {
            const text = button.textContent.trim().split(' ').pop();
            if (tooltips[text]) {
                button.title = tooltips[text];
            }
        });
        
        // Highlight overdue assignments
        const overdueCards = document.querySelectorAll('.assignment-card');
        overdueCards.forEach(card => {
            const badge = card.querySelector('.badge-danger');
            if (badge && badge.textContent.includes('Overdue')) {
                card.style.borderLeftColor = '#dc3545';
                card.style.borderLeftWidth = '5px';
            }
        });
    });
</script>

@endsection

