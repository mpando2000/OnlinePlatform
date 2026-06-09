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
                                {{ $school_class->name }} - Subjects
                            </h1>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('admin.classes') }}">Classes</a>
                                    </li>
                                    <li class="breadcrumb-item active">{{ $school_class->name }}</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="header-actions">
                            <button class="btn btn-primary me-2" onclick="window.location.href='{{ route('subjectForm', $school_class->id) }}'">
                                <i class="fas fa-plus me-1"></i>
                                Add Subject
                            </button>
                            <button class="btn btn-secondary" onclick="window.location.href='{{ route('admin.classes') }}'">
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
                            Subjects in {{ $school_class->name }}
                        </h4>
                    </div>
                    <div class="card-body">
                        @if($subjects->count() > 0)
                            <div class="table-responsive">
                                <table class="table subjects-table">
                                    <thead>
                                        <tr>
                                            <th class="subject-name-col">
                                                <i class="fas fa-book-open me-1"></i>
                                                Subject Name
                                            </th>
                                            <th class="actions-col">
                                                <i class="fas fa-cogs me-1"></i>
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($subjects as $subject)
                                        <tr>
                                            <td class="subject-name">
                                                <div class="subject-info">
                                                    <i class="fas fa-graduation-cap subject-icon"></i>
                                                    <span class="subject-title">{{ $subject->name }}</span>
                                                </div>
                                            </td>
                                            <td class="actions">
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('admin.subjects', ['class' => $school_class->id, 'subject' => $subject->id]) }}" 
                                                       class="btn btn-view">
                                                        <i class="fas fa-eye me-1"></i>
                                                        <span class="d-none d-md-inline">View Materials</span>
                                                    </a>
                                                    <button type="button" 
                                                            class="btn btn-edit"
                                                            onclick="editSubject({{ $subject->id }})">
                                                        <i class="fas fa-edit me-1"></i>
                                                        <span class="d-none d-md-inline">Edit</span>
                                                    </button>
                                                    <button type="button" 
                                                            class="btn btn-delete"
                                                            onclick="deleteSubject({{ $subject->id }}, '{{ $subject->name }}')">
                                                        <i class="fas fa-trash me-1"></i>
                                                        <span class="d-none d-md-inline">Delete</span>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="empty-state">
                                <div class="empty-icon">
                                    <i class="fas fa-book-open"></i>
                                </div>
                                <h5>No Subjects Found</h5>
                                <p class="text-muted">This class doesn't have any subjects yet.</p>
                                <a href="{{ route('subjectForm', $school_class->id) }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-1"></i>
                                    Add First Subject
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
        background: #28a745;
        color: white;
        padding: 15px 20px;
        border: none;
    }

    .main-card .card-title {
        font-weight: 500;
        font-size: 1.1rem;
        margin: 0;
    }

    .main-card .card-body {
        padding: 0;
    }

    .subjects-table {
        margin: 0;
        border: none;
    }

    .subjects-table thead {
        background: #f8f9fa;
    }

    .subjects-table th {
        border: none;
        padding: 15px 20px;
        font-weight: 500;
        color: #495057;
        font-size: 0.95rem;
    }

    .subjects-table td {
        border: none;
        padding: 15px 20px;
        border-bottom: 1px solid #e9ecef;
        vertical-align: middle;
    }

    .subjects-table tbody tr:hover {
        background: #f8f9fa;
    }

    .subject-info {
        display: flex;
        align-items: center;
    }

    .subject-icon {
        color: #28a745;
        margin-right: 10px;
        font-size: 1.1rem;
    }

    .subject-title {
        font-weight: 500;
        color: #495057;
    }

    .btn-group .btn {
        border-radius: 4px !important;
        margin-right: 5px;
        font-size: 0.875rem;
        padding: 6px 12px;
        font-weight: 500;
    }

    .btn-view {
        background-color: #17a2b8;
        border-color: #17a2b8;
        color: white;
    }

    .btn-view:hover {
        background-color: #138496;
        border-color: #138496;
        color: white;
    }

    .btn-edit {
        background-color: #ffc107;
        border-color: #ffc107;
        color: #212529;
    }

    .btn-edit:hover {
        background-color: #e0a800;
        border-color: #e0a800;
        color: #212529;
    }

    .btn-delete {
        background-color: #dc3545;
        border-color: #dc3545;
        color: white;
    }

    .btn-delete:hover {
        background-color: #c82333;
        border-color: #c82333;
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
        
        .subjects-table th,
        .subjects-table td {
            padding: 12px 15px;
        }
        
        .btn-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        
        .btn-group .btn {
            margin-right: 0 !important;
        }
    }

    @media (max-width: 576px) {
        .subjects-table th.actions-col,
        .subjects-table td.actions {
            text-align: center;
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
    });

    // Edit subject function - redirect to edit page
    function editSubject(subjectId) {
        if (confirm('Do you want to edit this subject?')) {
            window.location.href = '/editSubjectForm/' + subjectId;
        }
    }

    // Delete subject function
    function deleteSubject(subjectId, subjectName) {
        if (confirm('Are you sure you want to delete the subject "' + subjectName + '"? This action cannot be undone and will remove all related materials.')) {
            // Show loading state
            const deleteBtn = event.target.closest('button');
            const originalContent = deleteBtn.innerHTML;
            deleteBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Deleting...';
            deleteBtn.disabled = true;

            // Create a form to submit the delete request
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/deleteSubject/' + subjectId;
            form.style.display = 'none';

            // Add CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]');
            if (csrfToken) {
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = csrfToken.getAttribute('content');
                form.appendChild(csrfInput);
            } else {
                alert('CSRF token not found. Please refresh the page and try again.');
                // Reset button state
                deleteBtn.innerHTML = originalContent;
                deleteBtn.disabled = false;
                return;
            }

            // Add method spoofing for DELETE
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';
            form.appendChild(methodInput);

            // Append form to body and submit
            document.body.appendChild(form);
            form.submit();
        }
    }
</script>
@endsection
