@extends('components.dashmaster')

@section('body')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Student Promotions Management</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert" id="errorAlert">
                    <strong>Errors:</strong>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert" id="sessionErrorAlert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Quick Actions</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="{{ route('admin.promotions.form') }}" class="btn btn-primary btn-block w-100">
                                        <i class="fas fa-graduation-cap"></i> Promote Selected Students
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-info btn-block w-100" data-toggle="modal" data-target="#bulkPromoteModal">
                                        <i class="fas fa-users"></i> Bulk Promote Class
                                    </button>
                                </div>
                                <div class="col-md-4">
                                    <a href="{{ route('admin.promotions.history') }}" class="btn btn-secondary btn-block w-100">
                                        <i class="fas fa-history"></i> View History
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0">Students Eligible for Promotion (Academic Year: {{ $currentYear }})</h5>
                        </div>
                        <div class="card-body">
                            @if ($studentsToPromote->isEmpty())
                                <div class="alert alert-info">
                                    No students found eligible for promotion this year.
                                </div>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Student Name</th>
                                                <th>Email</th>
                                                <th>Current Class</th>
                                                <th>Academic Year</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($studentsToPromote as $student)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $student->name }}</td>
                                                    <td>{{ $student->email }}</td>
                                                    <td>
                                                        <span class="badge bg-secondary">
                                                            {{ $student->schoolClass->name ?? 'N/A' }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-primary">{{ $student->academic_year }}</span>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin.promotions.student-history', $student) }}"
                                                           class="btn btn-sm btn-info" title="View History">
                                                            <i class="fas fa-history"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-warning text-dark">
                            <h5 class="mb-0">Recent Promotions</h5>
                        </div>
                        <div class="card-body">
                            @if ($promotionHistory->isEmpty())
                                <div class="alert alert-info">
                                    No promotion history found.
                                </div>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Student</th>
                                                <th>From Class</th>
                                                <th>To Class</th>
                                                <th>From Year</th>
                                                <th>To Year</th>
                                                <th>Promoted At</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($promotionHistory as $promotion)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $promotion->student->name }}</td>
                                                    <td>
                                                        <span class="badge bg-secondary">
                                                            {{ $promotion->fromClass->name }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-success">
                                                            {{ $promotion->toClass->name }}
                                                        </span>
                                                    </td>
                                                    <td>{{ $promotion->from_academic_year }}</td>
                                                    <td>{{ $promotion->to_academic_year }}</td>
                                                    <td>{{ $promotion->promoted_at->format('M d, Y H:i') }}</td>
                                                    <td>
                                                        <form action="{{ route('admin.promotions.undo', $promotion) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger"
                                                                    onclick="return confirm('Are you sure you want to undo this promotion?')">
                                                                <i class="fas fa-undo"></i> Undo
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-3">
                                    {{ $promotionHistory->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
    <strong>Copyright &copy; <span id="currentYear"></span> <a href="https://sumajkt.go.tz">Visit Our Website</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      {{-- <b>Version</b> 3.2.0 --}}
    </div>
</footer>

<script>
    // footer js
    document.getElementById("currentYear").textContent = new Date().getFullYear();

    // Auto-dismiss alerts after 8 seconds (8000 milliseconds)
    document.addEventListener('DOMContentLoaded', function() {
        const successAlert = document.getElementById('successAlert');
        const errorAlert = document.getElementById('errorAlert');
        const sessionErrorAlert = document.getElementById('sessionErrorAlert');

        // Auto-dismiss success alert after 8 seconds
        if (successAlert) {
            setTimeout(function() {
                successAlert.classList.remove('show');
                setTimeout(function() {
                    successAlert.remove();
                }, 150); // Wait for fade animation to complete
            }, 8000); // 8 seconds
        }

        // Auto-dismiss error alert after 10 seconds
        if (errorAlert) {
            setTimeout(function() {
                errorAlert.classList.remove('show');
                setTimeout(function() {
                    errorAlert.remove();
                }, 150);
            }, 10000); // 10 seconds
        }

        // Auto-dismiss session error alert after 10 seconds
        if (sessionErrorAlert) {
            setTimeout(function() {
                sessionErrorAlert.classList.remove('show');
                setTimeout(function() {
                    sessionErrorAlert.remove();
                }, 150);
            }, 10000); // 10 seconds
        }
    });
</script>

<!-- Bulk Promote Modal -->
<div class="modal fade" id="bulkPromoteModal" tabindex="-1" aria-labelledby="bulkPromoteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bulkPromoteModalLabel">Bulk Promote Class</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.promotions.bulk') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="from_class_id" class="form-label">From Class *</label>
                        <select class="form-control" id="from_class_id" name="from_class_id" required>
                            <option value="">-- Select Class --</option>
                            @foreach ($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="to_class_id" class="form-label">To Class *</label>
                        <select class="form-control" id="to_class_id" name="to_class_id" required>
                            <option value="">-- Select Class --</option>
                            @foreach ($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle"></i>
                        This will promote ALL students from the selected class to the next class for the new academic year.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Promote Class</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .btn-block {
        display: block;
    }
</style>
@endsection
