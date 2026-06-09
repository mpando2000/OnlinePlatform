{{-- @extends('components.dashmaster')

@section('body')
  <div class="content-wrapper custom-dashboard">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Assigned Subjects</h1>
          </div>
        </div> 
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <table id="subject" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Name</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($subjects as $subject)
                  <tr>
                    <td>
                      <a href="{{ route('teacher.subjects', ['class' => $school_class->id, 'subject' => $subject->id]) }}" class="btn btn-secondary">{{ $subject->name }} Materials </a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>

                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>


<script>
  $(function () {
    $("#subject").DataTable({
      "responsive": true, 
      "lengthChange": false, 
      "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#subject_wrapper .col-md-6:eq(0)');
 
  });
</script>
@endsection



 --}}

@extends('components.dashmaster')

@section('body')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Clean Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="page-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="page-title">
                                <i class="fas fa-book me-2"></i>
                                {{ $school_class->name }} - My Subjects
                            </h1>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('teacher.dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('teacher.classes') }}">My Classes</a>
                                    </li>
                                    <li class="breadcrumb-item active">{{ $school_class->name }}</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="header-actions">
                            <button class="btn btn-secondary" onclick="window.location.href='{{ route('teacher.classes') }}'">
                                <i class="fas fa-arrow-left me-1"></i>
                                Back to Classes
                            </button>
                        </div>
                    </div>
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
                            Subjects I Teach in {{ $school_class->name }}
                        </h4>
                        <div class="card-tools">
                            <span class="badge badge-info">{{ $subjects->count() }} {{ $subjects->count() === 1 ? 'Subject' : 'Subjects' }}</span>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($subjects->count() > 0)
                            <div class="subjects-grid">
                                @foreach ($subjects as $subject)
                                <div class="subject-card">
                                    <div class="subject-icon">
                                        <i class="fas fa-graduation-cap text-info"></i>
                                    </div>
                                    <div class="subject-content">
                                        <h5 class="subject-title">{{ $subject->name }}</h5>
                                        <div class="subject-info">
                                            <div class="info-item">
                                                <i class="fas fa-graduation-cap me-1"></i>
                                                <span class="text-muted">Subject</span>
                                            </div>
                                            <div class="info-item">
                                                <i class="fas fa-chalkboard-teacher me-1"></i>
                                                <span class="text-muted">Teaching</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="subject-actions">
                                        <a href="{{ route('teacher.subjects', ['class' => $school_class->id, 'subject' => $subject->id]) }}" 
                                           class="btn btn-info">
                                            <i class="fas fa-eye me-1"></i>
                                            <span class="d-none d-md-inline">View Materials</span>
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state">
                                <div class="empty-icon">
                                    <i class="fas fa-book-open"></i>
                                </div>
                                <h5>No Subjects Assigned</h5>
                                <p class="text-muted">You haven't been assigned to teach any subjects in this class yet.</p>
                                <a href="{{ route('teacher.classes') }}" class="btn btn-primary">
                                    <i class="fas fa-arrow-left me-1"></i>
                                    Back to My Classes
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
        border-left: 4px solid #17a2b8;
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
        color: #17a2b8;
        text-decoration: none;
    }

    .breadcrumb-item a:hover {
        text-decoration: underline;
    }

    .header-actions .btn {
        border-radius: 4px;
        font-weight: 500;
    }

    .main-card {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        border: none;
        overflow: hidden;
    }

    .main-card .card-header {
        background: #17a2b8;
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

    .badge-info {
        background-color: #17a2b8;
        color: white;
    }

    .main-card .card-body {
        padding: 20px;
    }

    .subjects-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
        margin-top: 10px;
    }

    .subject-card {
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
        cursor: pointer;
    }

    .subject-card:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
        border-color: #17a2b8;
    }

    .subject-icon {
        margin-bottom: 15px;
    }

    .subject-icon i {
        font-size: 3rem;
        opacity: 0.8;
    }

    .subject-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #495057;
        margin-bottom: 15px;
    }

    .subject-info {
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

    .subject-actions .btn {
        border-radius: 4px;
        font-weight: 500;
        padding: 8px 16px;
        transition: all 0.15s ease-in-out;
    }

    .btn-info {
        background-color: #17a2b8;
        border-color: #17a2b8;
        color: white;
    }

    .btn-info:hover {
        background-color: #138496;
        border-color: #138496;
        color: white;
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
    }

    .empty-state p {
        margin-bottom: 25px;
        font-size: 0.95rem;
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
        
        .header-actions {
            margin-top: 15px;
        }
        
        .header-actions .btn {
            width: 100%;
        }
        
        .subjects-grid {
            grid-template-columns: 1fr;
            gap: 15px;
        }
        
        .subject-card {
            padding: 15px;
        }

        .subject-icon i {
            font-size: 2.5rem;
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
    }

    /* Hover effects */
    .subject-card:hover .subject-icon i {
        color: #17a2b8 !important;
        transform: scale(1.1);
    }

    .subject-card:hover .subject-title {
        color: #17a2b8;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Update year in footer
        const yearEl = document.getElementById('currentYear');
        if (yearEl) {
            yearEl.textContent = new Date().getFullYear();
        }

        // Add click tracking for subject cards
        const subjectCards = document.querySelectorAll('.subject-card');
        subjectCards.forEach((card, index) => {
            // Add animation delay
            card.style.animationDelay = `${(index + 1) * 0.1}s`;

            // Add click handler for the entire card
            card.addEventListener('click', function(e) {
                // Only trigger if not clicking on the action button
                if (!e.target.closest('.subject-actions')) {
                    const link = this.querySelector('.subject-actions a');
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
                    const link = this.querySelector('.subject-actions a');
                    if (link) {
                        window.location.href = link.href;
                    }
                }
            });
        });

        // Add loading states to action buttons
        const actionButtons = document.querySelectorAll('.subject-actions .btn');
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
    });
</script>
@endsection
