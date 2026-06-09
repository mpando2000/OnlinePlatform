
@extends('components.dashmaster')

@section('body')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="page-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="page-title">
                                <i class="fas fa-users me-2"></i>
                                Users Management
                            </h1>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active">Users</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="header-actions">
                            <a href="/addUser" class="btn btn-success mr-2">
                                <i class="fas fa-user-plus"></i> Add User
                            </a>
                            <a href="{{ route('adminUsers.create') }}" class="btn btn-primary">
                                <i class="fas fa-user-shield"></i> Add Admin
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Statistics -->
        <div class="row mb-4">
            <div class="col-lg-3 col-md-6">
                <div class="info-box bg-primary">
                    <span class="info-box-icon">
                        <i class="fas fa-users"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Users</span>
                        <span class="info-box-number">{{ $users->count() }}</span>
                        <span class="progress-description">All registered users</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="info-box bg-success">
                    <span class="info-box-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Students</span>
                        <span class="info-box-number">{{ $users->where('role', 'student')->count() }}</span>
                        <span class="progress-description">Active students</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="info-box bg-info">
                    <span class="info-box-icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Teachers</span>
                        <span class="info-box-number">{{ $users->where('role', 'teacher')->count() }}</span>
                        <span class="progress-description">Teaching staff</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="info-box bg-warning">
                    <span class="info-box-icon">
                        <i class="fas fa-user-shield"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Admins</span>
                        <span class="info-box-number">{{ $users->where('role', 'admin')->count() }}</span>
                        <span class="progress-description">System administrators</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters and Search -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card filter-card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-filter me-2"></i>
                            Filters & Search
                        </h5>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="search-input">Search Users</label>
                                    <input type="text" id="search-input" class="form-control" placeholder="Search by name or email...">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="role-filter">Role</label>
                                    <select id="role-filter" class="form-control">
                                        <option value="">All Roles</option>
                                        <option value="student">Students</option>
                                        <option value="teacher">Teachers</option>
                                        <option value="admin">Admins</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="status-filter">Status</label>
                                    <select id="status-filter" class="form-control">
                                        <option value="">All Status</option>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="school-filter">School</label>
                                    <select id="school-filter" class="form-control">
                                        <option value="">All Schools</option>
                                        @foreach($schools as $school)
                                            <option value="{{ $school->name }}">{{ $school->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="view-mode">View Mode</label>
                                    <div class="btn-group d-block" role="group">
                                        <button type="button" class="btn btn-outline-primary active" id="table-view-btn">
                                            <i class="fas fa-table"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-primary" id="card-view-btn">
                                            <i class="fas fa-th-large"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <button type="button" id="clear-filters" class="btn btn-secondary d-block">
                                        <i class="fas fa-times"></i> Clear
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Users Table View -->
        <div class="row" id="table-view">
            <div class="col-12">
                <div class="card users-table-card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-list me-2"></i>
                            Users List
                        </h5>
                        <div class="card-tools">
                            <span class="badge badge-info" id="table-count">{{ $users->count() }} users</span>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table id="users-table" class="table table-hover mb-0">
                                <thead class="thead-dark">
                                    <tr>
                                        {{-- <th>
                                            <input type="checkbox" id="select-all" class="form-check-input">
                                        </th> --}}
                                        <th>User</th>
                                        <th>Contact</th>
                                        <th>School & Class</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Joined</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                    <tr data-user-id="{{ $user->id }}" 
                                        data-role="{{ $user->role }}" 
                                        data-status="{{ $user->status }}" 
                                        data-school="{{ $user->school_id ? optional($user->school_relation)->name : ucfirst($user->school ?? 'No School') }}"
                                        class="user-row">
                                        {{-- <td>
                                            <input type="checkbox" class="form-check-input user-checkbox" value="{{ $user->id }}">
                                        </td> --}}
                                        <td>
                                            <div class="user-info">
                                                <div class="user-avatar">
                                                    @if($user->profile_photo)
                                                        <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Avatar" class="avatar-img">
                                                    @else
                                                        <div class="avatar-placeholder">
                                                            {{ substr($user->firstname, 0, 1) }}{{ substr($user->lastname, 0, 1) }}
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="user-details">
                                                    <div class="user-name">{{ $user->firstname }} {{ $user->lastname }}</div>
                                                    <div class="user-id">#{{ $user->id }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="contact-info">
                                                <div class="email">
                                                    <i class="fas fa-envelope text-muted me-1"></i>
                                                    {{ $user->email }}
                                                </div>
                                                @if($user->phone)
                                                <div class="phone">
                                                    <i class="fas fa-phone text-muted me-1"></i>
                                                    {{ $user->phone }}
                                                </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div class="school-info">
                                                <div class="school">
                                                    <i class="fas fa-school text-muted me-1"></i>
                                                    {{ $user->school_id ? optional($user->school_relation)->name : ucfirst($user->school ?? 'No School') }}
                                                </div>
                                                <div class="class">
                                                    @if($user->role === 'teacher' && !optional($user->schoolClass)->name)
                                                        <a href="{{ route('adminUsers.assign-class-subject', $user->id) }}" class="btn btn-xs btn-primary">
                                                            <i class="fas fa-plus"></i> Assign Class
                                                        </a>
                                                    @else
                                                        <i class="fas fa-chalkboard text-muted me-1"></i>
                                                        {{ optional($user->schoolClass)->name ?: 'Not assigned' }}
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="role-badge role-{{ $user->role }}">
                                                @if($user->role === 'student')
                                                    <i class="fas fa-graduation-cap"></i>
                                                @elseif($user->role === 'teacher')
                                                    <i class="fas fa-chalkboard-teacher"></i>
                                                @elseif($user->role === 'admin')
                                                    <i class="fas fa-user-shield"></i>
                                                @endif
                                                {{ ucfirst($user->role) }}
                                            </span>
                                        </td>
                                        <td>
                                            @if ($user->status == 'active')
                                                <span class="badge badge-success">
                                                    <i class="fas fa-check-circle"></i> Active
                                                </span>
                                            @else
                                                <span class="badge badge-secondary">
                                                    <i class="fas fa-pause-circle"></i> Inactive
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="join-date">
                                                <div class="date">{{ $user->created_at->format('M j, Y') }}</div>
                                                <div class="time text-muted">{{ $user->created_at->diffForHumans() }}</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="action-buttons">
                                                <div class="custom-dropdown">
                                                    <button type="button" class="btn btn-sm btn-info custom-dropdown-toggle" onclick="event.preventDefault(); event.stopPropagation(); toggleDropdown({{ $user->id }}); return false;">
                                                        <i class="fas fa-cog"></i> <i class="fas fa-caret-down"></i>
                                                    </button>
                                                    <div class="custom-dropdown-menu" id="dropdown-{{ $user->id }}">
                                                        <div class="dropdown-header">
                                                            <strong>User Actions</strong>
                                                        </div>
                                                        <a class="dropdown-item" href="/viewUser/{{ $user->id }}">
                                                            <i class="fas fa-eye text-info"></i> View Details
                                                        </a>
                                                        <a class="dropdown-item" href="/editUser/{{ $user->id }}">
                                                            <i class="fas fa-edit text-warning"></i> Edit User
                                                        </a>
                                                        <div class="dropdown-divider"></div>
                                                        <div class="dropdown-header">
                                                            <strong>Status Actions</strong>
                                                        </div>
                                                        @if($user->status == 'inactive')
                                                            <a class="dropdown-item text-success" href="#" onclick="activateUser({{ $user->id }})">
                                                                <i class="fas fa-play-circle"></i> Activate
                                                            </a>
                                                        @else
                                                            <a class="dropdown-item text-warning" href="#" onclick="deactivateUser({{ $user->id }})">
                                                                <i class="fas fa-pause-circle"></i> Deactivate
                                                            </a>
                                                        @endif
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item text-danger" href="#" onclick="deleteUser({{ $user->id }})">
                                                            <i class="fas fa-trash-alt"></i> Delete User
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
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

        <!-- Users Card View -->
        <div class="row" id="card-view" style="display: none;">
            @foreach ($users as $user)
            <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-4 user-card-container" 
                 data-role="{{ $user->role }}" 
                 data-status="{{ $user->status }}" 
                 data-school="{{ $user->school_id ? optional($user->school_relation)->name : ucfirst($user->school ?? 'No School') }}">
                <div class="card user-card">
                    <div class="card-body text-center">
                        <div class="user-avatar-large mb-3">
                            @if($user->profile_photo)
                                <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Avatar" class="avatar-large">
                            @else
                                <div class="avatar-large-placeholder">
                                    {{ substr($user->firstname, 0, 1) }}{{ substr($user->lastname, 0, 1) }}
                                </div>
                            @endif
                            <div class="status-indicator {{ $user->status }}"></div>
                        </div>
                        
                        <h5 class="card-title user-name">{{ $user->firstname }} {{ $user->lastname }}</h5>
                        <span class="role-badge role-{{ $user->role }} mb-3">
                            @if($user->role === 'student')
                                <i class="fas fa-graduation-cap"></i>
                            @elseif($user->role === 'teacher')
                                <i class="fas fa-chalkboard-teacher"></i>
                            @elseif($user->role === 'admin')
                                <i class="fas fa-user-shield"></i>
                            @endif
                            {{ ucfirst($user->role) }}
                        </span>
                        
                        <div class="user-details-card">
                            <div class="detail-item">
                                <i class="fas fa-envelope text-muted"></i>
                                <span>{{ $user->email }}</span>
                            </div>
                            <div class="detail-item">
                                <i class="fas fa-school text-muted"></i>
                                <span>{{ $user->school_id ? optional($user->school_relation)->name : ucfirst($user->school ?? 'No School') }}</span>
                            </div>
                            @if(optional($user->schoolClass)->name)
                            <div class="detail-item">
                                <i class="fas fa-chalkboard text-muted"></i>
                                <span>{{ $user->schoolClass->name }}</span>
                            </div>
                            @endif
                            <div class="detail-item">
                                <i class="fas fa-calendar text-muted"></i>
                                <span>{{ $user->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group" role="group">
                                <a href="/viewUser/{{ $user->id }}" class="btn btn-info btn-sm" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="/editUser/{{ $user->id }}" class="btn btn-warning btn-sm" title="Edit User">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                            <div class="custom-dropdown">
                                <button type="button" class="btn btn-primary btn-sm custom-dropdown-toggle" onclick="event.preventDefault(); event.stopPropagation(); toggleDropdown('card-{{ $user->id }}'); return false;">
                                    <i class="fas fa-cog"></i> <i class="fas fa-caret-down"></i>
                                </button>
                                <div class="custom-dropdown-menu" id="dropdown-card-{{ $user->id }}">
                                    <div class="dropdown-header">
                                        <strong>Status Actions</strong>
                                    </div>
                                    @if($user->status == 'inactive')
                                        <a class="dropdown-item text-success" href="#" onclick="activateUser({{ $user->id }})">
                                            <i class="fas fa-play-circle"></i> Activate
                                        </a>
                                    @else
                                        <a class="dropdown-item text-warning" href="#" onclick="deactivateUser({{ $user->id }})">
                                            <i class="fas fa-pause-circle"></i> Deactivate
                                        </a>
                                    @endif
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-danger" href="#" onclick="deleteUser({{ $user->id }})">
                                        <i class="fas fa-trash-alt"></i> Delete User
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
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
        border-left: 4px solid #28a745;
    }

    .page-title {
        color: #495057;
        font-size: 1.6rem;
        font-weight: 600;
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

    .header-actions .btn {
        border-radius: 20px;
        font-weight: 500;
    }

    /* Info Boxes */
    .info-box {
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        margin-bottom: 20px;
        overflow: hidden;
    }

    .info-box-icon {
        border-radius: 10px 0 0 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    .info-box-content {
        padding: 15px;
    }

    .info-box-number {
        font-size: 2rem;
        font-weight: bold;
    }

    .progress-description {
        font-size: 0.8rem;
        color: rgba(255,255,255,0.8);
    }

    /* Filter Card */
    .filter-card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    }

    .filter-card .card-header {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-bottom: 1px solid #dee2e6;
        border-radius: 10px 10px 0 0;
    }

    /* Users Table Card */
    .users-table-card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    }

    .users-table-card .card-header {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
        border-radius: 10px 10px 0 0;
        border: none;
    }

    /* Table Styling */
    .table {
        margin-bottom: 0;
    }

    .table thead th {
        border: none;
        background: #343a40;
        color: white;
        font-weight: 600;
        padding: 15px 12px;
        vertical-align: middle;
    }

    .table tbody tr {
        border-bottom: 1px solid #f1f3f4;
        transition: all 0.3s ease;
    }

    .table tbody tr:hover {
        background: #f8f9fa;
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .table tbody td {
        padding: 15px 12px;
        vertical-align: middle;
        border: none;
    }

    /* User Info Styling */
    .user-info {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .user-avatar {
        position: relative;
    }

    .avatar-img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
    }

    .avatar-placeholder {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, #007bff, #0056b3);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 14px;
    }

    .user-details .user-name {
        font-weight: 600;
        color: #495057;
        margin-bottom: 2px;
    }

    .user-details .user-id {
        font-size: 0.8rem;
        color: #6c757d;
    }

    /* Contact Info */
    .contact-info .email,
    .contact-info .phone {
        font-size: 0.9rem;
        margin-bottom: 2px;
        color: #495057;
    }

    /* School Info */
    .school-info .school,
    .school-info .class {
        font-size: 0.9rem;
        margin-bottom: 2px;
        color: #495057;
    }

    /* Role Badges */
    .role-badge {
        padding: 6px 12px;
        border-radius: 15px;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .role-badge.role-student {
        background: #e3f2fd;
        color: #1976d2;
    }

    .role-badge.role-teacher {
        background: #f3e5f5;
        color: #7b1fa2;
    }

    .role-badge.role-admin {
        background: #fff3e0;
        color: #f57c00;
    }

    /* Status Badges */
    .badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 10px;
        font-size: 0.8rem;
    }

    /* Join Date */
    .join-date .date {
        font-weight: 500;
        color: #495057;
    }

    .join-date .time {
        font-size: 0.8rem;
    }

    /* Action Buttons */
    .action-buttons .btn {
        border-radius: 20px;
        font-size: 0.8rem;
        padding: 6px 12px;
    }

    .dropdown-menu {
        border: none;
        box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        border-radius: 8px;
        min-width: 180px;
        z-index: 1050;
    }

    .dropdown-menu.show {
        display: block;
    }

    .dropdown-item {
        padding: 8px 15px;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        border: none;
        background: transparent;
        width: 100%;
        text-align: left;
        color: #495057;
        text-decoration: none;
    }

    .dropdown-item:hover,
    .dropdown-item:focus {
        background: #f8f9fa;
        transform: translateX(5px);
        color: #495057;
        text-decoration: none;
    }

    .dropdown-item:active {
        background: #e9ecef;
    }

    .dropdown-divider {
        margin: 4px 0;
        border-top: 1px solid #e9ecef;
    }

    /* Custom Dropdown Styling */
    .custom-dropdown {
        position: relative;
        display: inline-block;
    }

    .custom-dropdown-toggle {
        border: 1px solid #17a2b8;
        background-color: #17a2b8;
        color: white;
        padding: 6px 12px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 0.8rem;
    }

    .custom-dropdown-toggle:hover,
    .custom-dropdown-toggle:focus,
    .custom-dropdown-toggle:active {
        background-color: #138496;
        border-color: #117a8b;
        color: white;
        outline: none;
    }

    .custom-dropdown-toggle:focus {
        box-shadow: 0 0 0 0.2rem rgba(23, 162, 184, 0.25);
    }

    .custom-dropdown-menu {
        position: absolute;
        top: 100%;
        right: 0;
        z-index: 1000;
        display: none;
        min-width: 180px;
        padding: 5px 0;
        margin: 2px 0 0;
        font-size: 0.875rem;
        color: #212529;
        text-align: left;
        list-style: none;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.15);
    }

    .custom-dropdown-menu.show {
        display: block;
    }

    .custom-dropdown-menu .dropdown-header {
        padding: 8px 15px;
        margin-bottom: 0;
        font-size: 0.75rem;
        color: #6c757d;
        white-space: nowrap;
        font-weight: 600;
        background-color: #f8f9fa;
        border-bottom: 1px solid #e9ecef;
    }

    .custom-dropdown-menu .dropdown-item {
        display: block;
        width: 100%;
        padding: 8px 15px;
        clear: both;
        font-weight: 400;
        color: #495057;
        text-align: inherit;
        text-decoration: none;
        white-space: nowrap;
        background-color: transparent;
        border: 0;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .custom-dropdown-menu .dropdown-item:hover,
    .custom-dropdown-menu .dropdown-item:focus {
        color: #495057;
        text-decoration: none;
        background-color: #f8f9fa;
        transform: translateX(5px);
    }

    .custom-dropdown-menu .dropdown-item:active {
        color: #fff;
        text-decoration: none;
        background-color: #007bff;
    }

    .custom-dropdown-menu .dropdown-divider {
        height: 0;
        margin: 4px 0;
        overflow: hidden;
        border-top: 1px solid #e9ecef;
    }

    /* Icon spacing in dropdown items */
    .custom-dropdown-menu .dropdown-item i {
        margin-right: 8px;
        width: 16px;
        text-align: center;
    }

    /* Card view specific styling */
    .user-card .custom-dropdown {
        position: relative;
    }

    .user-card .custom-dropdown-menu {
        position: absolute;
        top: 100%;
        right: 0;
        left: auto;
        z-index: 1050;
    }

    .user-card .card-footer {
        padding: 10px 15px;
        border-top: 1px solid rgba(0,0,0,.125);
    }

    .user-card .card-footer .btn {
        padding: 4px 8px;
        font-size: 0.8rem;
    }

    .user-card .card-footer .btn-group {
        gap: 4px;
    }

    /* Ensure dropdown works in card view */
    .user-card-container {
        position: relative;
    }

    /* Mobile responsiveness for card view */
    @media (max-width: 576px) {
        .user-card .custom-dropdown-menu {
            right: -10px;
            left: auto;
            min-width: 160px;
        }
    }

    /* Ensure proper stacking for card view dropdowns */
    .user-card-container .custom-dropdown-menu {
        z-index: 1060 !important;
    }

    /* Fix dropdown positioning in flex containers */
    .card-footer .d-flex {
        position: relative;
    }

    .card-footer .custom-dropdown {
        position: relative;
    }

    /* Card View Styling */
    .user-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .user-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }

    .user-avatar-large {
        position: relative;
        display: inline-block;
    }

    .avatar-large {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #fff;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .avatar-large-placeholder {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: linear-gradient(135deg, #007bff, #0056b3);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 24px;
        border: 4px solid #fff;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .status-indicator {
        position: absolute;
        bottom: 8px;
        right: 8px;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        border: 3px solid white;
    }

    .status-indicator.active {
        background: #28a745;
    }

    .status-indicator.inactive {
        background: #6c757d;
    }

    .user-details-card {
        text-align: left;
        margin-top: 15px;
    }

    .detail-item {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 8px;
        font-size: 0.9rem;
        color: #495057;
    }

    /* Bulk Actions */
    .bulk-actions .card {
        border-left: 4px solid #28a745;
    }

    /* Form Elements */
    .form-control {
        border-radius: 8px;
        border: 1px solid #dee2e6;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #28a745;
        box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
    }

    /* View Toggle Buttons */
    .btn-group .btn {
        border-radius: 8px;
    }

    .btn-outline-primary.active {
        background: #007bff;
        color: white;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .content-wrapper {
            padding: 15px;
        }
        
        .page-title {
            font-size: 1.3rem;
        }
        
        .header-actions {
            margin-top: 15px;
        }
        
        .header-actions .btn {
            display: block;
            width: 100%;
            margin-bottom: 5px;
        }

        .info-box {
            margin-bottom: 15px;
        }

        .user-info {
            flex-direction: column;
            text-align: center;
            gap: 5px;
        }

        .contact-info,
        .school-info {
            font-size: 0.8rem;
        }

        .table-responsive {
            font-size: 0.8rem;
        }

        .action-buttons .btn {
            padding: 4px 8px;
            font-size: 0.7rem;
        }
    }

    @media (max-width: 576px) {
        .filter-card .card-body .row > div {
            margin-bottom: 15px;
        }

        .users-table-card .table thead {
            display: none;
        }

        .users-table-card .table tr {
            display: block;
            border: 1px solid #dee2e6;
            margin-bottom: 10px;
            border-radius: 8px;
        }

        .users-table-card .table td {
            display: block;
            text-align: left;
            border: none;
            padding: 8px 15px;
        }

        .users-table-card .table td:before {
            content: attr(data-label) ": ";
            font-weight: bold;
            color: #495057;
        }
    }

    /* Loading States */
    .loading {
        opacity: 0.6;
        pointer-events: none;
    }

    /* Animations */
    .user-row, .user-card, .btn, .form-control {
        transition: all 0.3s ease;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 40px 20px;
        color: #6c757d;
    }

    .empty-state i {
        font-size: 4rem;
        margin-bottom: 20px;
        color: #dee2e6;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Update footer year
        document.getElementById("currentYear").textContent = new Date().getFullYear();

        // Elements
        const searchInput = document.getElementById('search-input');
        const roleFilter = document.getElementById('role-filter');
        const statusFilter = document.getElementById('status-filter');
        const schoolFilter = document.getElementById('school-filter');
        const clearFiltersBtn = document.getElementById('clear-filters');
        const tableViewBtn = document.getElementById('table-view-btn');
        const cardViewBtn = document.getElementById('card-view-btn');
        const tableView = document.getElementById('table-view');
        const cardView = document.getElementById('card-view');
        const selectAllCheckbox = document.getElementById('select-all');
        const userCheckboxes = document.querySelectorAll('.user-checkbox');
        const bulkActionsDiv = document.getElementById('bulk-actions');
        const selectedCountSpan = document.getElementById('selected-count');

        // View Toggle
        tableViewBtn.addEventListener('click', function() {
            tableView.style.display = 'block';
            cardView.style.display = 'none';
            this.classList.add('active');
            cardViewBtn.classList.remove('active');
        });

        cardViewBtn.addEventListener('click', function() {
            tableView.style.display = 'none';
            cardView.style.display = 'block';
            this.classList.add('active');
            tableViewBtn.classList.remove('active');
        });

        // Search and Filter Functions
        function filterUsers() {
            const searchTerm = searchInput.value.toLowerCase();
            const selectedRole = roleFilter.value;
            const selectedStatus = statusFilter.value;
            const selectedSchool = schoolFilter.value;

            // Filter table rows
            const tableRows = document.querySelectorAll('.user-row');
            const cardContainers = document.querySelectorAll('.user-card-container');
            let visibleCount = 0;

            // Filter table view
            tableRows.forEach(row => {
                const userName = row.querySelector('.user-name').textContent.toLowerCase();
                const userEmail = row.querySelector('.email').textContent.toLowerCase();
                const userRole = row.getAttribute('data-role');
                const userStatus = row.getAttribute('data-status');
                const userSchool = row.getAttribute('data-school');

                const matchesSearch = userName.includes(searchTerm) || userEmail.includes(searchTerm);
                const matchesRole = !selectedRole || userRole === selectedRole;
                const matchesStatus = !selectedStatus || userStatus === selectedStatus;
                const matchesSchool = !selectedSchool || userSchool === selectedSchool;

                if (matchesSearch && matchesRole && matchesStatus && matchesSchool) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            // Filter card view
            cardContainers.forEach(card => {
                const userName = card.querySelector('.user-name').textContent.toLowerCase();
                const userEmail = card.querySelector('.detail-item .fas.fa-envelope').nextElementSibling.textContent.toLowerCase();
                const userRole = card.getAttribute('data-role');
                const userStatus = card.getAttribute('data-status');
                const userSchool = card.getAttribute('data-school');

                const matchesSearch = userName.includes(searchTerm) || userEmail.includes(searchTerm);
                const matchesRole = !selectedRole || userRole === selectedRole;
                const matchesStatus = !selectedStatus || userStatus === selectedStatus;
                const matchesSchool = !selectedSchool || userSchool === selectedSchool;

                if (matchesSearch && matchesRole && matchesStatus && matchesSchool) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });

            // Update count
            document.getElementById('table-count').textContent = visibleCount + ' users';
        }

        // Event Listeners for Filters
        searchInput.addEventListener('input', filterUsers);
        roleFilter.addEventListener('change', filterUsers);
        statusFilter.addEventListener('change', filterUsers);
        schoolFilter.addEventListener('change', filterUsers);

        // Clear Filters
        clearFiltersBtn.addEventListener('click', function() {
            searchInput.value = '';
            roleFilter.value = '';
            statusFilter.value = '';
            schoolFilter.value = '';
            filterUsers();
        });

        // Select All Functionality
        selectAllCheckbox.addEventListener('change', function() {
            const isChecked = this.checked;
            userCheckboxes.forEach(checkbox => {
                if (checkbox.closest('.user-row').style.display !== 'none') {
                    checkbox.checked = isChecked;
                }
            });
            updateBulkActions();
        });

        // Individual Checkboxes
        userCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                updateSelectAllState();
                updateBulkActions();
            });
        });

        function updateSelectAllState() {
            const visibleCheckboxes = Array.from(userCheckboxes).filter(cb => 
                cb.closest('.user-row').style.display !== 'none'
            );
            const checkedCount = visibleCheckboxes.filter(cb => cb.checked).length;
            
            selectAllCheckbox.checked = checkedCount === visibleCheckboxes.length && visibleCheckboxes.length > 0;
            selectAllCheckbox.indeterminate = checkedCount > 0 && checkedCount < visibleCheckboxes.length;
        }

        function updateBulkActions() {
            const checkedBoxes = Array.from(userCheckboxes).filter(cb => cb.checked);
            const selectedCount = checkedBoxes.length;
            
            selectedCountSpan.textContent = selectedCount;
            
            if (selectedCount > 0) {
                bulkActionsDiv.style.display = 'block';
            } else {
                bulkActionsDiv.style.display = 'none';
            }
        }

        // Bulk Actions
        document.querySelector('.bulk-activate').addEventListener('click', function() {
            const selectedIds = Array.from(userCheckboxes)
                .filter(cb => cb.checked)
                .map(cb => cb.value);
            
            if (confirm(`Activate ${selectedIds.length} selected users?`)) {
                // Implement bulk activation logic
                console.log('Bulk activate:', selectedIds);
            }
        });

        document.querySelector('.bulk-deactivate').addEventListener('click', function() {
            const selectedIds = Array.from(userCheckboxes)
                .filter(cb => cb.checked)
                .map(cb => cb.value);
            
            if (confirm(`Deactivate ${selectedIds.length} selected users?`)) {
                // Implement bulk deactivation logic
                console.log('Bulk deactivate:', selectedIds);
            }
        });

        document.querySelector('.bulk-delete').addEventListener('click', function() {
            const selectedIds = Array.from(userCheckboxes)
                .filter(cb => cb.checked)
                .map(cb => cb.value);
            
            if (confirm(`Are you sure you want to delete ${selectedIds.length} selected users? This action cannot be undone.`)) {
                // Implement bulk deletion logic
                console.log('Bulk delete:', selectedIds);
            }
        });

        // Form Submission Loading States
        document.querySelectorAll('form button[type="submit"]').forEach(button => {
            button.addEventListener('click', function() {
                const originalText = this.innerHTML;
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
                this.disabled = true;
                
                setTimeout(() => {
                    this.innerHTML = originalText;
                    this.disabled = false;
                }, 3000);
            });
        });

        // Initialize DataTable for advanced features
        if (typeof $ !== 'undefined' && $.fn.DataTable) {
            $('#users-table').DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "searching": false, // We handle search manually
                "info": false,
                "paging": false,
                "ordering": true,
                "columnDefs": [
                    { "orderable": false, "targets": [0, -1] } // First and last columns not orderable
                ]
            });
        }

        // Auto-hide alerts
        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                if (alert.classList.contains('alert-success')) {
                    alert.style.transition = 'opacity 0.3s ease';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 300);
                }
            });
        }, 5000);

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.custom-dropdown')) {
                document.querySelectorAll('.custom-dropdown-menu.show').forEach(menu => {
                    menu.classList.remove('show');
                });
            }
        });

        // Initialize jQuery features if available
        if (typeof $ !== 'undefined') {
            // Initialize tooltips
            if ($.fn.tooltip) {
                $('[data-toggle="tooltip"]').tooltip();
            }
        }
    });

    // Custom dropdown toggle function
    function toggleDropdown(dropdownId) {
        console.log('Toggling dropdown:', dropdownId);
        const dropdown = document.getElementById('dropdown-' + dropdownId);
        const allDropdowns = document.querySelectorAll('.custom-dropdown-menu');
        
        console.log('Dropdown found:', dropdown !== null);
        
        // Close all other dropdowns
        allDropdowns.forEach(menu => {
            if (menu !== dropdown) {
                menu.classList.remove('show');
            }
        });
        
        // Toggle current dropdown
        if (dropdown) {
            dropdown.classList.toggle('show');
            console.log('Dropdown now visible:', dropdown.classList.contains('show'));
        } else {
            console.error('Dropdown not found with ID: dropdown-' + dropdownId);
        }
    }

    // User action functions
    function activateUser(userId) {
        if (confirm('Are you sure you want to activate this user?')) {
            // Create and submit form
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/admin/users/${userId}/status`;
            
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'PATCH';
            
            const statusInput = document.createElement('input');
            statusInput.type = 'hidden';
            statusInput.name = 'status';
            statusInput.value = 'active';
            
            form.appendChild(csrfToken);
            form.appendChild(methodInput);
            form.appendChild(statusInput);
            
            document.body.appendChild(form);
            form.submit();
        }
    }

    function deactivateUser(userId) {
        if (confirm('Are you sure you want to deactivate this user?')) {
            // Create and submit form
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/admin/users/${userId}/status`;
            
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'PATCH';
            
            const statusInput = document.createElement('input');
            statusInput.type = 'hidden';
            statusInput.name = 'status';
            statusInput.value = 'inactive';
            
            form.appendChild(csrfToken);
            form.appendChild(methodInput);
            form.appendChild(statusInput);
            
            document.body.appendChild(form);
            form.submit();
        }
    }

    function deleteUser(userId) {
        if (confirm('Are you sure you want to delete this user? This action cannot be undone.')) {
            // Ask whether admin wants to force-delete related sessions
            const force = confirm('If this user has online sessions, do you want to delete those sessions as well? Click OK to force delete sessions, Cancel to abort deletion.');

            if (!force) {
                // If admin opted not to force, abort to allow manual cleanup
                alert('Deletion aborted. Remove or reassign online sessions first, or choose to force delete.');
                return;
            }

            // Create and submit form with force flag
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/deleteUser/${userId}`;
            
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';

            const forceInput = document.createElement('input');
            forceInput.type = 'hidden';
            forceInput.name = 'force';
            forceInput.value = '1';
            
            form.appendChild(csrfToken);
            form.appendChild(methodInput);
            form.appendChild(forceInput);
            
            document.body.appendChild(form);
            form.submit();
        }
    }
</script>

@endsection