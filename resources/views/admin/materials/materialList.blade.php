@php
use Illuminate\Support\Facades\Storage;
@endphp

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
                                <i class="fas fa-file-alt me-2"></i>
                                {{ $subject->name }} - Learning Materials
                            </h1>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('admin.classes') }}">Classes</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('admin.class', $class->id) }}">{{ $class->name }}</a>
                                    </li>
                                    <li class="breadcrumb-item active">{{ $subject->name }} Materials</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="header-actions">
                            <button class="btn btn-success me-2" onclick="window.location.href='{{route('adminMaterials.upload',['class' => $class->id, 'subject' => $subject->id])}}'">
                                <i class="fas fa-plus me-1"></i>
                                Add Material
                            </button>
                            <button class="btn btn-secondary" onclick="window.location.href='{{ route('admin.class', $class->id) }}'">
                                <i class="fas fa-arrow-left me-1"></i>
                                Back to Subjects
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
                            <i class="fas fa-folder-open me-2"></i>
                            Learning Materials
                        </h4>
                        <div class="card-tools">
                            <span class="badge badge-info">{{ $materials->count() }} {{ $materials->count() === 1 ? 'Material' : 'Materials' }}</span>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($materials->count() > 0)
                            <div class="materials-grid">
                                @foreach($materials as $material)
                                <div class="material-card">
                                    <div class="material-icon">
                                        @if($material->type === 'document')
                                            <i class="fas fa-file-pdf text-danger"></i>
                                        @elseif($material->type === 'video')
                                            <i class="fas fa-play-circle text-primary"></i>
                                        @elseif($material->type === 'link')
                                            <i class="fas fa-external-link-alt text-success"></i>
                                        @else
                                            <i class="fas fa-file text-secondary"></i>
                                        @endif
                                    </div>
                                    <div class="material-content">
                                        <h5 class="material-title">{{ $material->title }}</h5>
                                        <div class="material-type">
                                            <span class="badge badge-{{ $material->type === 'document' ? 'danger' : ($material->type === 'video' ? 'primary' : 'success') }}">
                                                {{ ucfirst($material->type) }}
                                            </span>
                                        </div>
                                        @if($material->description)
                                            <p class="material-description">{{ Str::limit($material->description, 100) }}</p>
                                        @endif
                                        <div class="material-meta">
                                            <small class="text-muted">
                                                <i class="fas fa-calendar me-1"></i>
                                                Added {{ $material->created_at->diffForHumans() }}
                                            </small>
                                        </div>
                                    </div>
                                    <div class="material-actions">
                                        @if($material->type === 'document')
                                            @if($material->file_path && Storage::disk('public')->exists($material->file_path))
                                                <a href="{{ asset('storage/' . $material->file_path) }}" target="_blank" class="btn btn-sm btn-outline-danger">
                                                    <i class="fas fa-download me-1"></i>
                                                    Download
                                                </a>
                                            @else
                                                <span class="btn btn-sm btn-outline-secondary disabled">
                                                    <i class="fas fa-exclamation-triangle me-1"></i>
                                                    File Not Found
                                                </span>
                                            @endif
                                        @elseif($material->type === 'video')
                                            @if($material->file_path && Storage::disk('public')->exists($material->file_path))
                                                <a href="{{ asset('storage/' . $material->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-play me-1"></i>
                                                    Watch
                                                </a>
                                            @else
                                                <span class="btn btn-sm btn-outline-secondary disabled">
                                                    <i class="fas fa-exclamation-triangle me-1"></i>
                                                    File Not Found
                                                </span>
                                            @endif
                                        @elseif($material->type === 'link')
                                            <a href="{{ $material->url }}" target="_blank" class="btn btn-sm btn-outline-success">
                                                <i class="fas fa-external-link-alt me-1"></i>
                                                Visit Link
                                            </a>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state">
                                <div class="empty-icon">
                                    <i class="fas fa-folder-open"></i>
                                </div>
                                <h5>No Learning Materials</h5>
                                <p class="text-muted">This subject doesn't have any learning materials yet.</p>
                                <a href="{{route('adminMaterials.upload',['class' => $class->id, 'subject' => $subject->id])}}" class="btn btn-success">
                                    <i class="fas fa-plus me-1"></i>
                                    Add First Material
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

    .main-card .card-body {
        padding: 20px;
    }

    .materials-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
        margin-top: 10px;
    }

    .material-card {
        background: #fff;
        border: 1px solid #e9ecef;
        border-radius: 8px;
        padding: 20px;
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .material-card:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
    }

    .material-icon {
        text-align: center;
        margin-bottom: 15px;
    }

    .material-icon i {
        font-size: 3rem;
        opacity: 0.8;
    }

    .material-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #495057;
        margin-bottom: 8px;
        text-align: center;
    }

    .material-type {
        text-align: center;
        margin-bottom: 10px;
    }

    .material-description {
        color: #6c757d;
        font-size: 0.9rem;
        line-height: 1.4;
        margin-bottom: 10px;
        text-align: center;
    }

    .material-meta {
        text-align: center;
        margin-bottom: 15px;
    }

    .material-actions {
        text-align: center;
    }

    .material-actions .btn {
        border-radius: 4px;
        font-weight: 500;
        padding: 6px 16px;
    }

    .material-actions .btn.disabled {
        opacity: 0.6;
        cursor: not-allowed;
        pointer-events: none;
    }

    .btn-outline-secondary.disabled {
        color: #6c757d;
        border-color: #6c757d;
    }

    .badge-info {
        background-color: #17a2b8;
        color: white;
    }

    .badge-danger {
        background-color: #dc3545;
        color: white;
    }

    .badge-primary {
        background-color: #007bff;
        color: white;
    }

    .badge-success {
        background-color: #28a745;
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
            margin-bottom: 8px;
            margin-right: 0 !important;
        }
        
        .materials-grid {
            grid-template-columns: 1fr;
            gap: 15px;
        }
        
        .material-card {
            padding: 15px;
        }

        .material-icon i {
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
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Update year in footer
        const yearEl = document.getElementById('currentYear');
        if (yearEl) {
            yearEl.textContent = new Date().getFullYear();
        }

        // Add click tracking for material interactions
        const materialCards = document.querySelectorAll('.material-card');
        materialCards.forEach(card => {
            card.addEventListener('click', function(e) {
                // Only track if not clicking on action buttons
                if (!e.target.closest('.material-actions')) {
                    console.log('Material card clicked');
                }
            });
        });

        // Add loading states to action buttons
        const actionButtons = document.querySelectorAll('.material-actions .btn');
        actionButtons.forEach(btn => {
            btn.addEventListener('click', function(e) {
                const originalText = this.innerHTML;
                this.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Loading...';
                this.disabled = true;

                // Re-enable after a short delay (in case the link doesn't navigate away)
                setTimeout(() => {
                    this.innerHTML = originalText;
                    this.disabled = false;
                }, 2000);
            });
        });
    });
</script>
@endsection
