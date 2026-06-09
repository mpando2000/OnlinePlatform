@extends('components.dashmaster')

@section('body')
<style>
    .schools-container {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
        padding: 20px 0;
    }
    
    .page-header {
        background: white;
        border-radius: 20px;
        padding: 30px;
        margin-bottom: 30px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        animation: fadeInUp 0.6s ease;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
    }
    
    .page-title {
        color: #2c3e50;
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 10px;
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .page-description {
        color: #7f8c8d;
        font-size: 1.1rem;
        margin-bottom: 0;
    }
    
    .breadcrumb-custom {
        background: transparent;
        margin-bottom: 0;
        padding: 0;
    }
    
    .schools-card {
        background: white;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        animation: fadeInUp 0.8s ease;
    }
    
    .add-school-btn {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
        padding: 15px 30px;
        border-radius: 25px;
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s ease;
        border: none;
        margin-bottom: 30px;
    }
    
    .add-school-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(40, 167, 69, 0.4);
        color: white;
        text-decoration: none;
    }
    
    .add-school-btn i {
        margin-right: 8px;
    }
    
    .schools-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    
    .schools-table th {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
        padding: 15px;
        text-align: left;
        font-weight: 600;
    }
    
    .schools-table th:first-child {
        border-radius: 15px 0 0 0;
    }
    
    .schools-table th:last-child {
        border-radius: 0 15px 0 0;
    }
    
    .schools-table td {
        padding: 15px;
        border-bottom: 1px solid #e9ecef;
        vertical-align: middle;
    }
    
    .schools-table tr:hover {
        background: #f8f9fa;
    }
    
    .status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
    }
    
    .status-active {
        background: rgba(40, 167, 69, 0.1);
        color: #28a745;
    }
    
    .status-inactive {
        background: rgba(220, 53, 69, 0.1);
        color: #dc3545;
    }
    
    .action-buttons {
        display: flex;
        gap: 10px;
    }
    
    .btn-action {
        padding: 8px 15px;
        border-radius: 15px;
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }
    
    .btn-view {
        background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
        color: white;
    }
    
    .btn-edit {
        background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);
        color: white;
    }
    
    .btn-delete {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        color: white;
    }
    
    .btn-action:hover {
        transform: translateY(-2px);
        color: white;
        text-decoration: none;
    }
    
    .alert {
        padding: 15px 20px;
        border-radius: 15px;
        margin-bottom: 20px;
        border: none;
        font-weight: 600;
    }
    
    .alert-success {
        background: rgba(40, 167, 69, 0.1);
        color: #28a745;
        border-left: 4px solid #28a745;
    }
    
    .alert-danger {
        background: rgba(220, 53, 69, 0.1);
        color: #dc3545;
        border-left: 4px solid #dc3545;
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<div class="content-wrapper schools-container">
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h1 class="page-title">
                    <i class="fas fa-school me-2"></i>
                    Schools Management
                </h1>
                <p class="page-description" style="margin:0;">Manage all schools in the system. Add, edit, or remove schools as needed.</p>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-custom">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Schools</li>
                </ol>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="row justify-content-center">
            <div class="col-xl-11">
                <div class="schools-card">
                    @if(session('success'))
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle mr-2"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="mb-0">All Schools</h3>
                        <a href="{{ route('admin.schools.create') }}" class="add-school-btn">
                            <i class="fas fa-plus"></i>
                            Add New School
                        </a>
                    </div>

                    @if($schools->count() > 0)
                        <div class="table-responsive">
                            <table class="schools-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>School Name</th>
                                        <th>Code</th>
                                        <th>Address</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Users</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($schools as $school)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <strong>{{ $school->name }}</strong>
                                                @if($school->description)
                                                    <br><small class="text-muted">{{ Str::limit($school->description, 50) }}</small>
                                                @endif
                                            </td>
                                            <td>
                                                <code>{{ $school->code }}</code>
                                            </td>
                                            <td>{{ $school->address ?? 'N/A' }}</td>
                                            <td>{{ $school->phone ?? 'N/A' }}</td>
                                            <td>{{ $school->email ?? 'N/A' }}</td>
                                            <td>
                                                <span class="status-badge status-{{ $school->status }}">
                                                    {{ $school->status }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge badge-info">
                                                    {{ $school->users()->count() }} users
                                                </span>
                                            </td>
                                            <td>
                                                <div class="action-buttons">
                                                    <a href="{{ route('admin.schools.show', $school) }}" class="btn-action btn-view" title="View Details">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.schools.edit', $school) }}" class="btn-action btn-edit" title="Edit School">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    @if($school->users()->count() == 0)
                                                        <form action="{{ route('admin.schools.destroy', $school) }}" method="POST" style="display: inline;" 
                                                              onsubmit="return confirm('Are you sure you want to delete this school?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn-action btn-delete" title="Delete School">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @if($schools->hasPages())
                            <div class="mt-4 d-flex justify-content-center">
                                {{ $schools->links() }}
                            </div>
                        @endif
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-school" style="font-size: 4rem; color: #dee2e6; margin-bottom: 20px;"></i>
                            <h4 class="text-muted">No Schools Found</h4>
                            <p class="text-muted">Start by adding your first school to the system.</p>
                            <a href="{{ route('admin.schools.create') }}" class="add-school-btn">
                                <i class="fas fa-plus"></i>
                                Add First School
                            </a>
                        </div>
                    @endif
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

<script>
    document.getElementById("currentYear").textContent = new Date().getFullYear();
</script>

@endsection
