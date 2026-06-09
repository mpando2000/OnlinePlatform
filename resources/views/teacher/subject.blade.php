@extends('components.dashmaster')

@section('body')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ $subject->name }} - Teaching Materials</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('teacher.classes') }}">My Classes</a></li>
                        <li class="breadcrumb-item"><a href="/teacher/viewClass/{{ $class->id }}">{{ $class->name }}</a></li>
                        <li class="breadcrumb-item active">{{ $subject->name }} Materials</li>
                    </ol>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-12">
                    <a href="{{route('teacherMaterials.upload',['class' => $class->id, 'subject' => $subject->id])}}" class="btn btn-success me-2">
                        <i class="fas fa-plus"></i> Add Material
                    </a>
                    <a href="/teacher/viewClass/{{ $class->id }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Subjects
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-folder-open"></i> Teaching Materials</h3>
                            <div class="card-tools">
                                <span class="badge badge-info">{{ $materials->count() }} {{ $materials->count() === 1 ? 'Material' : 'Materials' }}</span>
                            </div>
                        </div>
                        <div class="card-body">
                            @if($materials->count() > 0)
                                <div class="row">
                                    @foreach($materials as $index => $material)
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-3">
                                        <div class="card material-card h-100">
                                            <div class="card-body text-center d-flex flex-column">
                                                <div class="mb-3">
                                                    @if($material->type === 'document')
                                                        <i class="fas fa-file-pdf fa-3x text-danger"></i>
                                                    @elseif($material->type === 'video')
                                                        <i class="fas fa-play-circle fa-3x text-primary"></i>
                                                    @elseif($material->type === 'link')
                                                        <i class="fas fa-external-link-alt fa-3x text-success"></i>
                                                    @else
                                                        <i class="fas fa-file fa-3x text-secondary"></i>
                                                    @endif
                                                </div>
                                                <h6 class="card-title font-weight-bold">{{ $material->title }}</h6>
                                                <p class="mb-2">
                                                    <span class="badge badge-{{ $material->type === 'document' ? 'danger' : ($material->type === 'video' ? 'primary' : 'success') }}">
                                                        {{ ucfirst($material->type) }}
                                                    </span>
                                                </p>
                                                @if($material->description)
                                                    <p class="card-text text-muted small flex-grow-1">{{ Str::limit($material->description, 60) }}</p>
                                                @endif
                                                <small class="text-muted mt-auto">
                                                    <i class="fas fa-calendar"></i> {{ $material->created_at->diffForHumans() }}
                                                </small>
                                            </div>
                                            <div class="card-footer text-center bg-light">
                                                @if($material->type === 'document')
                                                    @if($material->file_path && file_exists(storage_path('app/public/' . $material->file_path)))
                                                        <a href="{{ asset('storage/' . $material->file_path) }}" target="_blank" class="btn btn-sm btn-danger mb-1">
                                                            <i class="fas fa-download"></i> Download
                                                        </a>
                                                    @else
                                                        <span class="btn btn-sm btn-secondary disabled mb-1">
                                                            <i class="fas fa-exclamation-triangle"></i> File Not Found
                                                        </span>
                                                    @endif
                                                @elseif($material->type === 'video')
                                                    @if($material->file_path && file_exists(storage_path('app/public/' . $material->file_path)))
                                                        <a href="{{ asset('storage/' . $material->file_path) }}" target="_blank" class="btn btn-sm btn-primary mb-1">
                                                            <i class="fas fa-play"></i> Watch
                                                        </a>
                                                    @else
                                                        <span class="btn btn-sm btn-secondary disabled mb-1">
                                                            <i class="fas fa-exclamation-triangle"></i> File Not Found
                                                        </span>
                                                    @endif
                                                @elseif($material->type === 'link')
                                                    <a href="{{ $material->url }}" target="_blank" class="btn btn-sm btn-success mb-1">
                                                        <i class="fas fa-external-link-alt"></i> Visit Link
                                                    </a>
                                                @endif
                                                <div class="mt-2">
                                                    <div class="btn-group-vertical btn-group-sm w-100" role="group">
                                                        <a href="{{ route('material.show', $material->id) }}" class="btn btn-info mb-1">
                                                            <i class="fas fa-eye"></i> View Details
                                                        </a>
                                                        <form action="{{ route('material.delete', $material->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete \'{{ $material->title }}\'? This action cannot be undone.')"
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-outline-danger">
                                                                <i class="fas fa-trash"></i> Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-5">
                                    <div class="mb-3">
                                        <i class="fas fa-folder-open fa-4x text-muted"></i>
                                    </div>
                                    <h5 class="text-muted">No Teaching Materials</h5>
                                    <p class="text-muted">You haven't uploaded any materials for this subject yet.</p>
                                    <a href="{{route('teacherMaterials.upload',['class' => $class->id, 'subject' => $subject->id])}}" class="btn btn-success">
                                        <i class="fas fa-plus"></i> Add First Material
                                    </a>
                                </div>
                            @endif
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
        <b>Version</b> 1.0.0
    </div>
</footer>
@endsection

@section('styles')
<style>
/* Material Cards Styling */
.material-card {
    transition: all 0.3s ease;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    min-height: 350px;
}

.material-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(23, 162, 184, 0.15);
    border-color: #17a2b8;
}

/* Info Theme */
.card-info .card-header {
    background-color: #17a2b8;
    border-color: #17a2b8;
    color: white;
}

/* Ensure equal height cards */
.row {
    display: flex;
    flex-wrap: wrap;
}

.row > [class*='col-'] {
    display: flex;
    flex-direction: column;
}

/* Card body flex */
.card-body.d-flex {
    display: flex !important;
    flex-direction: column !important;
}

/* Card footer styling */
.card-footer.bg-light {
    background-color: #f8f9fa !important;
    border-top: 1px solid #dee2e6;
}

/* Button group styling */
.btn-group-vertical .btn {
    border-radius: 4px !important;
    margin-bottom: 2px;
}

/* Responsive adjustments */
@media (max-width: 576px) {
    .col-xl-3, .col-lg-4, .col-md-6 {
        margin-bottom: 1rem;
    }
    
    .material-card {
        min-height: auto;
    }
}

/* Utility classes for spacing */
.me-2 {
    margin-right: 0.5rem !important;
}

.me-1 {
    margin-right: 0.25rem !important;
}

.mt-auto {
    margin-top: auto !important;
}

.flex-grow-1 {
    flex-grow: 1 !important;
}

/* Footer positioning */
.main-footer {
    margin-top: 2rem;
}
</style>
@endsection

@section('script')
<script>
$(document).ready(function() {
    // Update footer year
    document.getElementById("currentYear").textContent = new Date().getFullYear();
    
    // Initialize tooltips if any
    $('[data-toggle="tooltip"]').tooltip();
    
    // Show success/error messages with better styling
    @if(session('success'))
        // Create success alert
        var successAlert = '<div class="alert alert-success alert-dismissible fade show" role="alert">' +
                          '<i class="fas fa-check-circle"></i> {{ session('success') }}' +
                          '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                          '<span aria-hidden="true">&times;</span></button></div>';
        $('.container-fluid').prepend(successAlert);
        
        // Auto-hide after 3 seconds
        setTimeout(function() {
            $('.alert-success').fadeOut();
        }, 3000);
    @endif
    
    @if(session('error'))
        // Create error alert
        var errorAlert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                        '<i class="fas fa-exclamation-circle"></i> {{ session('error') }}' +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                        '<span aria-hidden="true">&times;</span></button></div>';
        $('.container-fluid').prepend(errorAlert);
        
        // Auto-hide after 5 seconds
        setTimeout(function() {
            $('.alert-danger').fadeOut();
        }, 5000);
    @endif

    // Add confirmation styling to delete forms
    $('form[action*="deleteMaterial"]').on('submit', function(e) {
        var form = this;
        var submitButton = $(form).find('button[type="submit"]');
        
        // Add loading state
        setTimeout(function() {
            submitButton.html('<i class="fas fa-spinner fa-spin"></i> Deleting...');
            submitButton.prop('disabled', true);
        }, 100);
    });
});
</script>
@endsection
