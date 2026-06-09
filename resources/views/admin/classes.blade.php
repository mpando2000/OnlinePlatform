@extends('components.dashmaster')

@section('body')
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="content-wrapper">
    <div class="container-fluid p-4">
        <!-- Page Header -->
        <div class="row mb-4">
            <div class="col-md-8">
                <h2>
                    <i class="fas fa-school mr-2"></i>
                    Classes Management
                </h2>
            </div>
            <div class="col-md-4 text-right">
                <a href="/addClass" class="btn btn-primary">
                    <i class="fas fa-plus mr-1"></i>
                    Add New Class
                </a>
            </div>
        </div>

        <!-- Classes List -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">All Classes</h5>
                    </div>
                    <div class="card-body">
                        @if(count($schoolClasses) > 0)
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Class Name</th>
                                            <th>Created Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($schoolClasses as $schoolClass)
                                            <tr>
                                                <td>
                                                    <strong>{{ $schoolClass->name }}</strong>
                                                </td>
                                                <td>
                                                    {{ $schoolClass->created_at ? $schoolClass->created_at->format('M d, Y') : 'N/A' }}
                                                </td>
                                                <td>
                                                    <a href="/viewClass/{{ $schoolClass->id }}" class="btn btn-primary btn-sm mr-1">
                                                        <i class="fas fa-eye"></i> View
                                                    </a>
                                                    <button class="btn btn-warning btn-sm mr-1" onclick="editClass({{ $schoolClass->id }})">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </button>
                                                    <button class="btn btn-danger btn-sm" onclick="deleteClass({{ $schoolClass->id }}, '{{ $schoolClass->name }}')">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-school fa-3x text-muted mb-3"></i>
                                <h4>No Classes Found</h4>
                                <p class="text-muted">Start by creating your first class.</p>
                                <a href="/addClass" class="btn btn-primary">
                                    <i class="fas fa-plus mr-1"></i>Create First Class
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>

<!-- Footer -->
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
    
    h2 {
        color: #495057;
        font-weight: 500;
        margin-bottom: 20px;
    }
    
    .card {
        border: none;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }
    
    .card-header {
        background: #007bff;
        color: white;
        border-radius: 8px 8px 0 0;
        padding: 15px 20px;
    }
    
    .table th {
        border-top: none;
        font-weight: 500;
        color: #495057;
    }
    
    .btn {
        border-radius: 4px;
        font-weight: 500;
        padding: 6px 12px;
        transition: all 0.15s ease-in-out;
    }
    
    .btn-sm {
        padding: 4px 8px;
        font-size: 0.875rem;
    }
    
    @media (max-width: 768px) {
        .content-wrapper {
            padding: 15px;
        }
        
        h2 {
            font-size: 1.5rem;
        }
    }
</style>

<script>
    // Set current year in footer
    document.addEventListener('DOMContentLoaded', function() {
        const yearEl = document.getElementById('currentYear');
        if (yearEl) {
            yearEl.textContent = new Date().getFullYear();
        }
    });

    // Edit class function - redirect to edit page
    function editClass(classId) {
        if (confirm('Do you want to edit this class?')) {
            window.location.href = '/editClassForm/' + classId;
        }
    }

    // Delete class function
    function deleteClass(classId, className) {
        if (confirm('Are you sure you want to delete the class "' + className + '"? This action cannot be undone.')) {
            // Show loading state
            const deleteBtn = event.target.closest('button');
            const originalContent = deleteBtn.innerHTML;
            deleteBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Deleting...';
            deleteBtn.disabled = true;

            // Create a form to submit the delete request
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/deleteClass/' + classId;
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