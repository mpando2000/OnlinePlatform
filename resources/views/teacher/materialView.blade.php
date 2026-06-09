@extends('components.dashmaster')

@section('body')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ $material->title }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('teacher.classes') }}">My Classes</a></li>
                        @if($material->subject && $material->subject->class_id)
                        <li class="breadcrumb-item"><a href="/teacher/viewClass/{{ $material->subject->class_id }}">Class</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('teacher.subjects', ['class' => $material->subject->class_id, 'subject' => $material->subject_id]) }}">{{ $material->subject->name ?? 'Subject' }}</a></li>
                        @endif
                        <li class="breadcrumb-item active">{{ $material->title }}</li>
                    </ol>
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
                            <h3 class="card-title">
                                <i class="fas fa-{{ $material->type === 'document' ? 'file-pdf' : ($material->type === 'video' ? 'play-circle' : 'external-link-alt') }}"></i>
                                Material Details
                            </h3>
                            <div class="card-tools">
                                <span class="badge badge-{{ $material->type === 'document' ? 'danger' : ($material->type === 'video' ? 'primary' : 'success') }}">
                                    {{ ucfirst($material->type) }}
                                </span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <h4>{{ $material->title }}</h4>
                                    @if($material->description)
                                        <p class="text-muted">{{ $material->description }}</p>
                                    @endif
                                    
                                    <div class="info-box">
                                        <div class="info-box-content">
                                            <span class="info-box-text">Subject</span>
                                            <span class="info-box-number">{{ $material->subject->name ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                    
                                    <div class="info-box">
                                        <div class="info-box-content">
                                            <span class="info-box-text">Created</span>
                                            <span class="info-box-number">{{ $material->created_at->format('M d, Y \a\t H:i') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 text-center">
                                    <div class="material-preview">
                                        @if($material->type === 'document')
                                            <i class="fas fa-file-pdf fa-5x text-danger mb-3"></i>
                                            @if($material->file_path && file_exists(storage_path('app/public/' . $material->file_path)))
                                                <p><a href="{{ route('material.download', $material->id) }}" class="btn btn-danger">
                                                    <i class="fas fa-download"></i> Download Document
                                                </a></p>
                                                <p><a href="{{ asset('storage/' . $material->file_path) }}" target="_blank" class="btn btn-outline-danger">
                                                    <i class="fas fa-eye"></i> View in Browser
                                                </a></p>
                                            @else
                                                <p class="text-danger">File not found</p>
                                            @endif
                                        @elseif($material->type === 'video')
                                            <i class="fas fa-play-circle fa-5x text-primary mb-3"></i>
                                            @if($material->file_path && file_exists(storage_path('app/public/' . $material->file_path)))
                                                <p><a href="{{ asset('storage/' . $material->file_path) }}" target="_blank" class="btn btn-primary">
                                                    <i class="fas fa-play"></i> Play Video
                                                </a></p>
                                                <p><a href="{{ route('material.download', $material->id) }}" class="btn btn-outline-primary">
                                                    <i class="fas fa-download"></i> Download Video
                                                </a></p>
                                            @else
                                                <p class="text-danger">File not found</p>
                                            @endif
                                        @elseif($material->type === 'link')
                                            <i class="fas fa-external-link-alt fa-5x text-success mb-3"></i>
                                            <p><a href="{{ $material->url }}" target="_blank" class="btn btn-success">
                                                <i class="fas fa-external-link-alt"></i> Visit Link
                                            </a></p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="javascript:history.back()" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Go Back
                            </a>
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

@section('script')
<script>
$(document).ready(function() {
    // Update footer year
    document.getElementById("currentYear").textContent = new Date().getFullYear();
});
</script>
@endsection
