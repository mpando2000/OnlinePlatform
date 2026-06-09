@extends('components.dashmaster')

@section('body')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-8">
                    <h1><i class="fas fa-question-circle text-primary"></i> Available Quizzes</h1>
                    <p class="text-muted">Test your knowledge and track your progress</p>
                </div>
                <div class="col-sm-4">
                    <div class="text-right">
                        <span class="badge badge-lg badge-primary">
                            <i class="fas fa-list"></i> {{ $quizzes->count() }} Quiz{{ $quizzes->count() != 1 ? 'zes' : '' }} Available
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Alert Messages -->
    @if (session('error'))
        <section class="content">
            <div class="container-fluid">
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            <strong>Error!</strong> {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @if($quizzes->count() > 0)
                <!-- Quiz Statistics -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <div class="row text-center">
                                    <div class="col-md-3">
                                        <div class="info-box bg-light">
                                            <span class="info-box-icon bg-primary">
                                                <i class="fas fa-question-circle"></i>
                                            </span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Total Quizzes</span>
                                                <span class="info-box-number">{{ $quizzes->count() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="info-box bg-light">
                                            <span class="info-box-icon bg-success">
                                                <i class="fas fa-play-circle"></i>
                                            </span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Available Now</span>
                                                <span class="info-box-number">{{ $quizzes->where('start_time', '<=', now())->where('end_time', '>=', now())->count() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="info-box bg-light">
                                            <span class="info-box-icon bg-warning">
                                                <i class="fas fa-clock"></i>
                                            </span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Coming Soon</span>
                                                <span class="info-box-number">{{ $quizzes->where('start_time', '>', now())->count() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="info-box bg-light">
                                            <span class="info-box-icon bg-danger">
                                                <i class="fas fa-times-circle"></i>
                                            </span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Expired</span>
                                                <span class="info-box-number">{{ $quizzes->where('end_time', '<', now())->count() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quizzes Grid -->
                <div class="row">
                    @foreach ($quizzes as $index => $quiz)
                        @php
                            $now = now();
                            $isActive = $quiz->start_time <= $now && $quiz->end_time >= $now;
                            $isUpcoming = $quiz->start_time > $now;
                            $isExpired = $quiz->end_time < $now;
                            
                            if ($isActive) {
                                $statusClass = 'success';
                                $statusIcon = 'play-circle';
                                $statusText = 'Available Now';
                            } elseif ($isUpcoming) {
                                $statusClass = 'warning';
                                $statusIcon = 'clock';
                                $statusText = 'Starts ' . $quiz->start_time->diffForHumans();
                            } else {
                                $statusClass = 'danger';
                                $statusIcon = 'times-circle';
                                $statusText = 'Expired';
                            }
                        @endphp
                        
                        <div class="col-lg-6 col-md-12 mb-4">
                            <div class="card h-100 border-0 shadow-sm hover-card quiz-card {{ $isActive ? 'quiz-active' : ($isExpired ? 'quiz-expired' : 'quiz-upcoming') }}">
                                <div class="card-header bg-gradient-{{ $index % 3 == 0 ? 'primary' : ($index % 3 == 1 ? 'info' : 'secondary') }} text-white">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="card-title mb-0">
                                            <i class="fas fa-graduation-cap"></i>
                                            {{ Str::limit($quiz->title, 40) }}
                                        </h5>
                                        <span class="badge badge-{{ $statusClass }}">
                                            <i class="fas fa-{{ $statusIcon }}"></i> {{ $statusText }}
                                        </span>
                                    </div>
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <!-- Quiz Description -->
                                    <div class="quiz-description mb-3">
                                        @if($quiz->description)
                                            <p class="text-muted">
                                                <i class="fas fa-info-circle text-primary"></i>
                                                {{ Str::limit($quiz->description, 100) }}
                                            </p>
                                        @else
                                            <p class="text-muted">
                                                <i class="fas fa-info-circle text-primary"></i>
                                                No description provided for this quiz.
                                            </p>
                                        @endif
                                    </div>

                                    <!-- Quiz Details -->
                                    <div class="quiz-details mb-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="detail-item">
                                                    <i class="fas fa-calendar-alt text-success"></i>
                                                    <small class="text-muted">
                                                        <strong>Start:</strong><br>
                                                        {{ $quiz->start_time->format('M d, Y') }}<br>
                                                        {{ $quiz->start_time->format('H:i') }}
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="detail-item">
                                                    <i class="fas fa-calendar-times text-danger"></i>
                                                    <small class="text-muted">
                                                        <strong>End:</strong><br>
                                                        {{ $quiz->end_time->format('M d, Y') }}<br>
                                                        {{ $quiz->end_time->format('H:i') }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-12">
                                                <div class="detail-item text-center">
                                                    <i class="fas fa-stopwatch text-primary"></i>
                                                    <small class="text-muted">
                                                        <strong>Duration:</strong> {{ $quiz->duration }} minutes
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Action Button -->
                                    <div class="mt-auto">
                                        @if($isActive)
                                            <a href="{{ route('quizzes.start', $quiz->id) }}" 
                                               class="btn btn-success btn-lg btn-block start-quiz">
                                                <i class="fas fa-play"></i> Start Quiz Now
                                            </a>
                                        @elseif($isUpcoming)
                                            <button class="btn btn-warning btn-lg btn-block" disabled>
                                                <i class="fas fa-clock"></i> Quiz Not Started Yet
                                            </button>
                                        @else
                                            <button class="btn btn-danger btn-lg btn-block" disabled>
                                                <i class="fas fa-times"></i> Quiz Expired
                                            </button>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-footer bg-transparent">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">
                                            @if($isActive)
                                                <i class="fas fa-hourglass-half text-warning"></i>
                                                Ends {{ $quiz->end_time->diffForHumans() }}
                                            @elseif($isUpcoming)
                                                <i class="fas fa-clock text-info"></i>
                                                Starts {{ $quiz->start_time->diffForHumans() }}
                                            @else
                                                <i class="fas fa-history text-muted"></i>
                                                Ended {{ $quiz->end_time->diffForHumans() }}
                                            @endif
                                        </small>
                                        <small class="text-muted">
                                            <i class="fas fa-stopwatch"></i> {{ $quiz->duration }}min
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Quick Actions -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-light">
                                <h4 class="card-title mb-0">
                                    <i class="fas fa-tools text-primary"></i> Quick Actions
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 mb-2">
                                        <button class="btn btn-outline-primary btn-block refresh-quizzes">
                                            <i class="fas fa-sync-alt"></i> Refresh Quizzes
                                        </button>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <button class="btn btn-outline-info btn-block" onclick="window.print()">
                                            <i class="fas fa-print"></i> Print Quiz List
                                        </button>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <button class="btn btn-outline-success btn-block show-available">
                                            <i class="fas fa-filter"></i> Show Available Only
                                        </button>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <button class="btn btn-outline-secondary btn-block show-all">
                                            <i class="fas fa-eye"></i> Show All Quizzes
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- Empty State -->
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center py-5">
                                <i class="fas fa-question-circle fa-4x text-muted mb-3"></i>
                                <h4 class="text-muted">No Quizzes Available</h4>
                                <p class="text-muted">
                                    There are currently no quizzes available for you. 
                                    Check back later or contact your teacher for more information.
                                </p>
                                <div class="mt-4">
                                    <button class="btn btn-primary refresh-quizzes">
                                        <i class="fas fa-refresh"></i> Refresh Page
                                    </button>
                                </div>
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
    
    .quiz-card {
        border-left: 4px solid transparent;
        transition: all 0.3s ease;
    }
    
    .quiz-active {
        border-left-color: #28a745 !important;
        animation: pulse-success 3s infinite;
    }
    
    .quiz-upcoming {
        border-left-color: #ffc107 !important;
    }
    
    .quiz-expired {
        border-left-color: #dc3545 !important;
        opacity: 0.8;
    }
    
    @keyframes pulse-success {
        0%, 100% { 
            border-left-color: #28a745;
            box-shadow: 0 0 0 rgba(40, 167, 69, 0.4);
        }
        50% { 
            border-left-color: #34ce57;
            box-shadow: 0 0 20px rgba(40, 167, 69, 0.6);
        }
    }
    
    .card {
        border-radius: 15px;
        overflow: hidden;
        animation: fadeInUp 0.6s ease-out;
    }
    
    .card-header {
        border-radius: 15px 15px 0 0 !important;
        font-weight: 600;
    }
    
    .card-header h5 {
        font-weight: 600;
        font-size: 1.1rem;
    }
    
    .badge-lg {
        font-size: 0.875rem;
        padding: 0.5rem 1rem;
        border-radius: 20px;
    }
    
    .btn {
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .btn:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }
    
    .btn-lg {
        padding: 0.75rem 1.5rem;
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
    
    .bg-gradient-primary {
        background: linear-gradient(135deg, #007bff, #0056b3);
    }
    
    .bg-gradient-info {
        background: linear-gradient(135deg, #17a2b8, #117a8b);
    }
    
    .bg-gradient-secondary {
        background: linear-gradient(135deg, #6c757d, #495057);
    }
    
    .quiz-description {
        background: rgba(0,123,255,0.05);
        border-radius: 8px;
        padding: 0.75rem;
        border-left: 3px solid #007bff;
    }
    
    .quiz-details {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 1rem;
    }
    
    .detail-item {
        text-align: center;
        padding: 0.5rem;
        background: white;
        border-radius: 6px;
        margin-bottom: 0.5rem;
        border: 1px solid #e9ecef;
    }
    
    .detail-item i {
        display: block;
        margin-bottom: 0.25rem;
        font-size: 1.2em;
    }
    
    /* Status-specific animations */
    .quiz-active .btn-success {
        animation: btn-pulse-success 2s ease-in-out infinite;
    }
    
    @keyframes btn-pulse-success {
        0%, 100% { background-color: #28a745; }
        50% { background-color: #34ce57; }
    }
    
    .quiz-upcoming .btn-warning {
        animation: btn-tick 1s ease-in-out infinite;
    }
    
    @keyframes btn-tick {
        0%, 50% { transform: scale(1); }
        25% { transform: scale(1.02); }
        75% { transform: scale(0.98); }
    }
    
    /* Loading animation for buttons */
    .btn.loading {
        pointer-events: none;
        position: relative;
        opacity: 0.8;
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
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    
    @keyframes button-loading-spinner {
        from { transform: translate(-50%, -50%) rotate(0turn); }
        to { transform: translate(-50%, -50%) rotate(1turn); }
    }
    
    /* Fade in animation */
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
    
    /* Staggered animation for cards */
    .card:nth-child(1) { animation-delay: 0.1s; }
    .card:nth-child(2) { animation-delay: 0.2s; }
    .card:nth-child(3) { animation-delay: 0.3s; }
    .card:nth-child(4) { animation-delay: 0.4s; }
    
    /* Filter animations */
    .quiz-card.filtered-out {
        opacity: 0.3;
        transform: scale(0.95);
        pointer-events: none;
        transition: all 0.3s ease;
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
        
        .hover-card:hover {
            transform: none;
        }
        
        .btn-lg {
            padding: 0.5rem 1rem;
            font-size: 1rem;
        }
    }
    
    /* Toast notification styles */
    .toast-notification {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        min-width: 300px;
        animation: slideInRight 0.3s ease-out;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    
    @keyframes slideInRight {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    
    @keyframes slideOutRight {
        from { transform: translateX(0); opacity: 1; }
        to { transform: translateX(100%); opacity: 0; }
    }
</style>

<!-- Scripts -->
<script>
    // Footer js
    document.getElementById("currentYear").textContent = new Date().getFullYear();

    // Enhanced quiz page functionality
    document.addEventListener('DOMContentLoaded', function() {
        
        // Refresh quizzes functionality
        const refreshButtons = document.querySelectorAll('.refresh-quizzes');
        refreshButtons.forEach(button => {
            button.addEventListener('click', function() {
                this.classList.add('loading');
                const originalText = this.innerHTML;
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Refreshing...';
                
                setTimeout(() => {
                    location.reload();
                }, 1000);
            });
        });
        
        // Quiz filtering functionality
        const showAvailableBtn = document.querySelector('.show-available');
        const showAllBtn = document.querySelector('.show-all');
        const quizCards = document.querySelectorAll('.quiz-card');
        
        if (showAvailableBtn) {
            showAvailableBtn.addEventListener('click', function() {
                quizCards.forEach(card => {
                    if (!card.classList.contains('quiz-active')) {
                        card.classList.add('filtered-out');
                    } else {
                        card.classList.remove('filtered-out');
                    }
                });
                
                this.classList.add('active');
                if (showAllBtn) showAllBtn.classList.remove('active');
                showToast('Showing only available quizzes', 'info');
            });
        }
        
        if (showAllBtn) {
            showAllBtn.addEventListener('click', function() {
                quizCards.forEach(card => {
                    card.classList.remove('filtered-out');
                });
                
                this.classList.add('active');
                if (showAvailableBtn) showAvailableBtn.classList.remove('active');
                showToast('Showing all quizzes', 'info');
            });
        }
        
        // Start quiz button enhancement
        const startQuizButtons = document.querySelectorAll('.start-quiz');
        startQuizButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                // Show confirmation dialog
                const quizTitle = this.closest('.quiz-card').querySelector('.card-title').textContent.trim();
                const confirmed = confirm(`Are you ready to start "${quizTitle}"?\n\nOnce you start, the timer will begin immediately.`);
                
                if (!confirmed) {
                    e.preventDefault();
                    return false;
                }
                
                // Show loading state
                this.classList.add('loading');
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Starting Quiz...';
                
                // Allow the navigation to proceed
                return true;
            });
        });
        
        // Auto-refresh page every 5 minutes to check for new quizzes
        setInterval(() => {
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
        
        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // F5 or Ctrl/Cmd + R = Refresh
            if (e.key === 'F5' || ((e.ctrlKey || e.metaKey) && e.key === 'r')) {
                e.preventDefault();
                const refreshBtn = document.querySelector('.refresh-quizzes');
                if (refreshBtn) {
                    refreshBtn.click();
                }
            }
        });
        
        // Track quiz access for analytics
        startQuizButtons.forEach(button => {
            button.addEventListener('click', function() {
                const quizTitle = this.closest('.quiz-card').querySelector('.card-title').textContent.trim();
                
                // Store in localStorage for analytics
                const accessed = JSON.parse(localStorage.getItem('accessedQuizzes') || '{}');
                accessed[quizTitle] = {
                    title: quizTitle,
                    timestamp: new Date().toISOString(),
                    action: 'started'
                };
                localStorage.setItem('accessedQuizzes', JSON.stringify(accessed));
            });
        });
    });
    
    // Toast notification function
    function showToast(message, type = 'info') {
        const toast = document.createElement('div');
        toast.className = `alert alert-${type} toast-notification`;
        
        const iconMap = {
            'success': 'check-circle',
            'error': 'exclamation-triangle',
            'warning': 'exclamation-circle',
            'info': 'info-circle'
        };
        
        toast.innerHTML = `
            <i class="fas fa-${iconMap[type] || 'info-circle'} mr-2"></i>
            ${message}
            <button type="button" class="close" onclick="this.parentElement.remove()">
                <span>&times;</span>
            </button>
        `;
        
        document.body.appendChild(toast);
        
        // Auto remove after 4 seconds
        setTimeout(() => {
            if (toast.parentElement) {
                toast.style.animation = 'slideOutRight 0.3s ease-in';
                setTimeout(() => {
                    if (toast.parentElement) {
                        toast.remove();
                    }
                }, 300);
            }
        }, 4000);
    }
</script>

@endsection