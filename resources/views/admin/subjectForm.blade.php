{{-- <x-layout />
@include('partials.header')
<div class="background"></div> --}}
@extends('components.dashmaster')
@section('body')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Simple Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="page-header">
                    <h1 class="page-title">
                        <i class="fas fa-plus me-2"></i>
                        Add New Subject
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
                                <a href="{{ route('admin.class', $school_class->id) }}">{{ $school_class->name }}</a>
                            </li>
                            <li class="breadcrumb-item active">Add Subject</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <!-- Main Form Section -->
            <div class="col-md-8 col-lg-6">
                <div class="card form-card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">
                            <i class="fas fa-book-open me-2"></i>
                            Add Subject to {{ $school_class->name }}
                        </h4>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('storeSubject', $school_class->id) }}" method="POST" id="addSubjectForm">
                            @csrf
                            
                            <div class="mb-3">
                                <label for="subject_name" class="form-label">
                                    <i class="fas fa-graduation-cap me-1"></i>
                                    Subject Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       id="subject_name" 
                                       name="name" 
                                       class="form-control" 
                                       placeholder="Enter subject name (e.g., Mathematics, English, Science)"
                                       value="{{ old('name') }}"
                                       required>
                                <div class="form-text">
                                    Choose a clear, descriptive name for the subject
                                </div>
                            </div>

                            <input type="hidden" name="school_class_id" value="{{ $school_class->id }}">

                            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                <button type="submit" class="btn btn-success me-md-2" id="submitBtn">
                                    <i class="fas fa-plus me-1"></i>
                                    Add Subject
                                </button>
                                <a href="{{ route('admin.class', $school_class->id) }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-1"></i>
                                    Back to Subjects
                                </a>
                            </div>
                        </form>
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
        padding: 15px 20px;
        margin-bottom: 25px;
        border-left: 4px solid #28a745;
    }

    .page-title {
        color: #495057;
        font-size: 1.5rem;
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
        color: #28a745;
        text-decoration: none;
    }

    .breadcrumb-item a:hover {
        text-decoration: underline;
    }

    .form-card {
        border: none;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .form-card .card-header {
        background: #28a745;
        color: white;
        border-radius: 8px 8px 0 0;
        padding: 15px 20px;
        border: none;
    }

    .form-card .card-title {
        font-weight: 500;
        font-size: 1.1rem;
    }

    .form-card .card-body {
        padding: 25px;
    }

    .form-label {
        font-weight: 500;
        color: #495057;
        margin-bottom: 6px;
    }

    .form-control {
        border: 1px solid #ced4da;
        border-radius: 4px;
        padding: 10px 12px;
        font-size: 0.95rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .form-control:focus {
        border-color: #28a745;
        box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
    }

    .form-text {
        color: #6c757d;
        font-size: 0.85rem;
    }

    .btn {
        border-radius: 4px;
        font-weight: 500;
        padding: 8px 16px;
        transition: all 0.15s ease-in-out;
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }

    .btn-success:hover {
        background-color: #218838;
        border-color: #218838;
    }

    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
        border-color: #5a6268;
    }

    @media (max-width: 768px) {
        .content-wrapper {
            padding: 15px;
        }
        
        .page-title {
            font-size: 1.3rem;
        }
        
        .form-card .card-body {
            padding: 20px;
        }
        
        .btn {
            width: 100%;
            margin-bottom: 8px;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Focus on subject name input
        document.getElementById('subject_name').focus();
        
        // Update year in footer
        const yearEl = document.getElementById('currentYear');
        if (yearEl) {
            yearEl.textContent = new Date().getFullYear();
        }
        
        // Form validation
        const form = document.getElementById('addSubjectForm');
        const submitBtn = document.getElementById('submitBtn');
        const subjectNameInput = document.getElementById('subject_name');
        
        form.addEventListener('submit', function(e) {
            const subjectName = subjectNameInput.value.trim();
            
            if (subjectName === '') {
                e.preventDefault();
                alert('Please enter a subject name');
                subjectNameInput.focus();
                return;
            }
            
            if (subjectName.length < 2) {
                e.preventDefault();
                alert('Subject name must be at least 2 characters long');
                subjectNameInput.focus();
                return;
            }
            
            // Show loading state
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Adding Subject...';
            submitBtn.disabled = true;
        });
    });
</script>


@endsection