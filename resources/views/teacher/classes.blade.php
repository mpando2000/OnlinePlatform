@extends('components.dashmaster')

@section('body')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Clean Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="page-header">
                    <h1 class="page-title">
                        <i class="fas fa-chalkboard-teacher me-2"></i>
                        My Assigned Classes
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('teacher.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">My Classes</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="row">
            <div class="col-12">
                <div class="main-card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">
                            <i class="fas fa-list me-2"></i>
                            Classes Assigned to You
                        </h4>
                        <div class="card-tools">
                            <span class="badge badge-primary">{{ $schoolClasses->count() }} {{ $schoolClasses->count() === 1 ? 'Class' : 'Classes' }}</span>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($schoolClasses->count() > 0)
                            <div class="classes-grid">
                                @foreach ($schoolClasses as $schoolClass)
                                <div class="class-card">
                                    <div class="class-icon">
                                        <i class="fas fa-graduation-cap text-primary"></i>
                                    </div>
                                    <div class="class-content">
                                        <h5 class="class-title">{{ $schoolClass->name }}</h5>
                                        <div class="class-info">
                                            <div class="info-item">
                                                <i class="fas fa-chalkboard me-1"></i>
                                                <span class="text-muted">Class</span>
                                            </div>
                                            <div class="info-item">
                                                <i class="fas fa-user-tie me-1"></i>
                                                <span class="text-muted">Assigned to Me</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="class-actions">
                                        <a href="/teacher/viewClass/{{ $schoolClass->id }}" class="btn btn-primary">
                                            <i class="fas fa-eye me-1"></i>
                                            <span class="d-none d-md-inline">View Class</span>
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state">
                                <div class="empty-icon">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                </div>
                                <h5>No Classes Assigned</h5>
                                <p class="text-muted">You haven't been assigned to any classes yet. Please contact the administrator to get class assignments.</p>
                                <a href="{{ route('teacher.dashboard') }}" class="btn btn-primary">
                                    <i class="fas fa-arrow-left me-1"></i>
                                    Back to Dashboard
                                </a>
                            </div>
                        @endif
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
        padding: 20px;
        margin-bottom: 25px;
        border-left: 4px solid #007bff;
    }

    .page-title {
        color: #495057;
        font-size: 1.6rem;
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

    .main-card {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        border: none;
        overflow: hidden;
    }

    .main-card .card-header {
        background: #007bff;
        color: white;
        padding: 15px 20px;
        border: none;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .main-card .card-title {
        font-weight: 500;
        font-size: 1.1rem;
        margin: 0;
    }

    .card-tools .badge {
        font-size: 0.8rem;
        padding: 4px 8px;
    }

    .badge-primary {
        background-color: #007bff;
        color: white;
    }

    .main-card .card-body {
        padding: 20px;
    }

    .classes-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 20px;
        margin-top: 10px;
    }

    .class-card {
        background: #fff;
        border: 1px solid #e9ecef;
        border-radius: 8px;
        padding: 20px;
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .class-card:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
        border-color: #007bff;
    }

    .class-icon {
        margin-bottom: 15px;
    }

    .class-icon i {
        font-size: 3rem;
        opacity: 0.8;
    }

    .class-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: #495057;
        margin-bottom: 15px;
    }

    .class-info {
        display: flex;
        flex-direction: column;
        gap: 8px;
        margin-bottom: 20px;
    }

    .info-item {
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
    }

    .info-item i {
        color: #6c757d;
        width: 16px;
    }

    .class-actions .btn {
        border-radius: 4px;
        font-weight: 500;
        padding: 8px 20px;
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

    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }

    .empty-icon {
        font-size: 4rem;
        color: #dee2e6;
        margin-bottom: 20px;
    }

    .empty-state h5 {
        color: #495057;
        margin-bottom: 10px;
        font-size: 1.3rem;
    }

    .empty-state p {
        margin-bottom: 25px;
        font-size: 0.95rem;
        max-width: 400px;
        margin-left: auto;
        margin-right: auto;
    }

    @media (max-width: 768px) {
        .content-wrapper {
            padding: 15px;
        }
        
        .page-header {
            padding: 15px;
        }
        
        .page-title {
            font-size: 1.4rem;
        }
        
        .classes-grid {
            grid-template-columns: 1fr;
            gap: 15px;
        }
        
        .class-card {
            padding: 15px;
        }

        .class-icon i {
            font-size: 2.5rem;
        }

        .class-title {
            font-size: 1.1rem;
        }

        .info-item {
            font-size: 0.85rem;
        }
    }

    @media (max-width: 576px) {
        .main-card .card-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }
        
        .card-tools {
            align-self: flex-end;
        }

        .class-info {
            gap: 6px;
        }

        .empty-state {
            padding: 40px 15px;
        }

        .empty-icon {
            font-size: 3rem;
        }

        .empty-state h5 {
            font-size: 1.1rem;
        }
    }

    /* Additional hover effects */
    .class-card:hover .class-icon i {
        color: #007bff !important;
        transform: scale(1.1);
    }

    .class-card:hover .class-title {
        color: #007bff;
    }

    /* Card loading animation */
    .class-card {
        animation: fadeInUp 0.5s ease-out;
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

    /* Stagger animation for cards */
    .class-card:nth-child(1) { animation-delay: 0.1s; }
    .class-card:nth-child(2) { animation-delay: 0.2s; }
    .class-card:nth-child(3) { animation-delay: 0.3s; }
    .class-card:nth-child(4) { animation-delay: 0.4s; }
    .class-card:nth-child(5) { animation-delay: 0.5s; }
    .class-card:nth-child(6) { animation-delay: 0.6s; }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Update year in footer
        const yearEl = document.getElementById('currentYear');
        if (yearEl) {
            yearEl.textContent = new Date().getFullYear();
        }

        // Add click tracking for class cards
        const classCards = document.querySelectorAll('.class-card');
        classCards.forEach((card, index) => {
            // Add staggered animation delay
            card.style.animationDelay = `${(index + 1) * 0.1}s`;

            // Add click handler for the entire card
            card.addEventListener('click', function(e) {
                // Only trigger if not clicking on the action button
                if (!e.target.closest('.class-actions')) {
                    const link = this.querySelector('.class-actions a');
                    if (link) {
                        window.location.href = link.href;
                    }
                }
            });

            // Add keyboard navigation
            card.setAttribute('tabindex', '0');
            card.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    const link = this.querySelector('.class-actions a');
                    if (link) {
                        window.location.href = link.href;
                    }
                }
            });
        });

        // Add loading states to action buttons
        const actionButtons = document.querySelectorAll('.class-actions .btn');
        actionButtons.forEach(btn => {
            btn.addEventListener('click', function(e) {
                const originalText = this.innerHTML;
                this.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Loading...';
                this.disabled = true;

                // Re-enable after a short delay (in case navigation fails)
                setTimeout(() => {
                    this.innerHTML = originalText;
                    this.disabled = false;
                }, 3000);
            });
        });

        // Add smooth scrolling for any internal links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });
    });
</script>
@endsection



