@extends('components.dashmaster')

@section('body')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-8">
                    <h1><i class="fas fa-book-open text-primary"></i> My Subjects</h1>
                    <p class="text-muted">Access your learning materials and assignments</p>
                </div>
                <div class="col-sm-4">
                    <div class="text-right">
                        @if($student->schoolClass)
                            <span class="badge badge-lg badge-info">
                                <i class="fas fa-users"></i> {{ $student->schoolClass->name }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @if($student->schoolClass)
                <!-- Summary Card - Moved to Top -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <div class="row text-center">
                                    <div class="col-md-4">
                                        <div class="info-box bg-light">
                                            <span class="info-box-icon bg-primary">
                                                <i class="fas fa-book"></i>
                                            </span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Total Subjects</span>
                                                <span class="info-box-number">{{ $subjects->count() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="info-box bg-light">
                                            <span class="info-box-icon bg-success">
                                                <i class="fas fa-graduation-cap"></i>
                                            </span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Class</span>
                                                <span class="info-box-number">{{ $student->schoolClass->name }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="info-box bg-light">
                                            <span class="info-box-icon bg-warning">
                                                <i class="fas fa-user-graduate"></i>
                                            </span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Student</span>
                                                <span class="info-box-number">{{ $student->name }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if($subjects->isEmpty())
                    <!-- Empty State -->
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body text-center py-5">
                                    <i class="fas fa-book-open fa-4x text-muted mb-3"></i>
                                    <h4 class="text-muted">No Subjects Available</h4>
                                    <p class="text-muted">No subjects have been assigned to your class yet. Please contact your teacher or administrator.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Subjects Grid -->
                    <div class="row">
                        @foreach($subjects as $index => $subject)
                            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                                <div class="card h-100 border-0 shadow-sm hover-card">
                                    <div class="card-header bg-gradient-{{ $index % 2 == 0 ? 'primary' : 'info' }} text-white">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h5 class="card-title mb-0">
                                                <i class="fas fa-{{ $index % 4 == 0 ? 'calculator' : ($index % 4 == 1 ? 'atom' : ($index % 4 == 2 ? 'language' : 'history')) }}"></i>
                                                {{ $subject->name }}
                                            </h5>
                                            <span class="badge badge-light">
                                                <i class="fas fa-book"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="card-body d-flex flex-column">
                                        <p class="text-muted flex-grow-1">
                                            <i class="fas fa-info-circle text-primary"></i>
                                            Click to access learning materials, assignments, and resources for this subject.
                                        </p>
                                        <div class="mt-auto">
                                            <a href="{{ route('student.subject.materials', $subject->id) }}" 
                                               class="btn btn-{{ $index % 2 == 0 ? 'primary' : 'info' }} btn-block">
                                                <i class="fas fa-arrow-right"></i> Access Materials
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-footer bg-transparent">
                                        <small class="text-muted">
                                            <i class="fas fa-clock"></i> Last updated: Today
                                        </small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            @else
                <!-- Not Enrolled State -->
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center py-5">
                                <i class="fas fa-exclamation-triangle fa-4x text-warning mb-3"></i>
                                <h4 class="text-warning">Not Enrolled</h4>
                                <p class="text-muted">You are not enrolled in any class. Please contact the administration to get enrolled.</p>
                                <button class="btn btn-primary">
                                    <i class="fas fa-envelope"></i> Contact Administration
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
    }
    
    .bg-gradient-primary {
        background: linear-gradient(135deg, #007bff, #0056b3);
    }
    
    .bg-gradient-info {
        background: linear-gradient(135deg, #17a2b8, #117a8b);
    }
    
    @media (max-width: 768px) {
        .content-header .col-sm-4 {
            text-align: center !important;
            margin-top: 1rem;
        }
        
        .info-box {
            margin-bottom: 1rem;
        }
    }
</style>

<!-- Scripts -->
<script>
    // Footer js
    document.getElementById("currentYear").textContent = new Date().getFullYear();

    // Add click effect to subject cards
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.hover-card');
        
        cards.forEach(card => {
            card.addEventListener('click', function(e) {
                if (e.target.tagName !== 'A' && e.target.tagName !== 'BUTTON') {
                    const link = card.querySelector('a[href]');
                    if (link) {
                        window.location.href = link.href;
                    }
                }
            });
        });
        
        // Add loading animation to buttons
        const buttons = document.querySelectorAll('a.btn');
        buttons.forEach(button => {
            button.addEventListener('click', function() {
                const icon = this.querySelector('i');
                const originalClass = icon.className;
                icon.className = 'fas fa-spinner fa-spin';
                
                setTimeout(() => {
                    icon.className = originalClass;
                }, 1000);
            });
        });
    });
</script>

@endsection





