@extends('components.dashmaster')

@section('body')

<div class="content-wrapper users-page">
    <div class="container-fluid users-shell">
        <div class="users-header">
            <div>
                <h1 class="users-title"><i class="fas fa-users"></i> User Management</h1>
                <p class="users-subtitle">Manage accounts, roles, status, schools, and classes.</p>
            </div>
            <div class="users-actions">
                <a href="/addUser" class="users-btn users-btn-primary"><i class="fas fa-user-plus"></i> Add User</a>
                <a href="{{ route('adminUsers.create') }}" class="users-btn users-btn-dark"><i class="fas fa-user-shield"></i> Add Admin</a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="summary-grid">
            <div class="summary-card" style="--accent:#0f766e;">
                <span>Total Users</span>
                <strong>{{ $users->count() }}</strong>
            </div>
            <div class="summary-card" style="--accent:#4f46e5;">
                <span>Students</span>
                <strong>{{ $users->where('role', 'student')->count() }}</strong>
            </div>
            <div class="summary-card" style="--accent:#b91c1c;">
                <span>Teachers</span>
                <strong>{{ $users->where('role', 'teacher')->count() }}</strong>
            </div>
            <div class="summary-card" style="--accent:#c2410c;">
                <span>Admins</span>
                <strong>{{ $users->where('role', 'admin')->count() }}</strong>
            </div>
        </div>

        <div class="filter-panel">
            <div class="filter-field filter-search">
                <label for="search-input">Search</label>
                <input type="text" id="search-input" placeholder="Name or email">
            </div>
            <div class="filter-field">
                <label for="role-filter">Role</label>
                <select id="role-filter">
                    <option value="">All Roles</option>
                    <option value="student">Students</option>
                    <option value="teacher">Teachers</option>
                    <option value="admin">Admins</option>
                </select>
            </div>
            <div class="filter-field">
                <label for="status-filter">Status</label>
                <select id="status-filter">
                    <option value="">All Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
            <div class="filter-field">
                <label for="school-filter">School</label>
                <select id="school-filter">
                    <option value="">All Schools</option>
                    @foreach($schools as $school)
                        <option value="{{ $school->name }}">{{ $school->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="button" id="clear-filters" class="users-btn users-btn-light"><i class="fas fa-times"></i> Clear</button>
        </div>

        <div class="users-table-panel">
            <div class="table-header">
                <strong>Users</strong>
                <span id="table-count">{{ $users->count() }} users</span>
            </div>

            <div class="table-responsive">
                <table class="table users-table" id="users-table">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Email</th>
                            <th>School / Class</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Joined</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            @php
                                $schoolName = $user->school_id ? optional($user->school_relation)->name : ucfirst($user->school ?? 'No School');
                                $className = optional($user->schoolClass)->name ?: 'Not assigned';
                            @endphp
                            <tr class="user-row"
                                data-role="{{ $user->role }}"
                                data-status="{{ $user->status }}"
                                data-school="{{ $schoolName }}">
                                <td data-label="User">
                                    <div class="user-cell">
                                        @if($user->profile_photo)
                                            <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Avatar" class="avatar-img">
                                        @else
                                            <span class="avatar-placeholder">{{ substr($user->firstname, 0, 1) }}{{ substr($user->lastname, 0, 1) }}</span>
                                        @endif
                                        <div>
                                            <strong class="user-name">{{ $user->firstname }} {{ $user->lastname }}</strong>
                                            <small>#{{ $user->id }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td data-label="Email" class="email">{{ $user->email }}</td>
                                <td data-label="School / Class">
                                    <div>{{ $schoolName }}</div>
                                    <small>{{ $className }}</small>
                                    @if($user->role === 'teacher' && !optional($user->schoolClass)->name)
                                        <div>
                                            <a href="{{ route('adminUsers.assign-class-subject', $user->id) }}" class="assign-link">Assign class</a>
                                        </div>
                                    @endif
                                </td>
                                <td data-label="Role">
                                    <span class="role-pill role-{{ $user->role }}">{{ ucfirst($user->role) }}</span>
                                </td>
                                <td data-label="Status">
                                    <span class="status-pill status-{{ $user->status }}">{{ ucfirst($user->status) }}</span>
                                </td>
                                <td data-label="Joined">
                                    <div>{{ $user->created_at->format('M j, Y') }}</div>
                                    <small>{{ $user->created_at->diffForHumans() }}</small>
                                </td>
                                <td data-label="Actions" class="text-right">
                                    <div class="row-actions">
                                        <a href="/viewUser/{{ $user->id }}" class="icon-action" title="View"><i class="fas fa-eye"></i></a>
                                        <a href="/editUser/{{ $user->id }}" class="icon-action" title="Edit"><i class="fas fa-edit"></i></a>
                                        @if($user->status === 'inactive')
                                            <form method="POST" action="{{ route('admin.updateStatus', $user) }}" class="inline-form">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="active">
                                                <button type="submit" class="icon-action icon-success" title="Activate"><i class="fas fa-play"></i></button>
                                            </form>
                                        @else
                                            <form method="POST" action="{{ route('admin.updateStatus', $user) }}" class="inline-form">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="inactive">
                                                <button type="submit" class="icon-action icon-warning" title="Deactivate"><i class="fas fa-pause"></i></button>
                                            </form>
                                        @endif
                                        <form method="POST" action="/deleteUser/{{ $user->id }}" class="inline-form" onsubmit="return confirm('Delete this user? This action cannot be undone.');">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="force" value="1">
                                            <button type="submit" class="icon-action icon-danger" title="Delete"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="empty-state">No users found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<footer class="main-footer">
    <strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong>
    All rights reserved.
</footer>

<style>
.users-page {
    background: #f5f7fb;
    min-height: 100vh;
}

.users-shell {
    padding: 18px;
}

.users-header,
.filter-panel,
.users-table-panel {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
}

.users-header {
    align-items: center;
    display: flex;
    justify-content: space-between;
    gap: 18px;
    margin-bottom: 14px;
    padding: 16px 18px;
}

.users-title {
    color: #172033;
    font-size: 22px;
    font-weight: 800;
    margin: 0;
}

.users-title i {
    color: #123d35;
    margin-right: 8px;
}

.users-subtitle {
    color: #6b7280;
    margin: 4px 0 0;
}

.users-actions,
.row-actions {
    align-items: center;
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}

.users-btn {
    align-items: center;
    border: 0;
    border-radius: 6px;
    display: inline-flex;
    font-weight: 800;
    gap: 7px;
    min-height: 36px;
    padding: 8px 12px;
}

.users-btn:hover {
    text-decoration: none;
}

.users-btn-primary {
    background: #123d35;
    color: #fff;
}

.users-btn-primary:hover {
    background: #1f6f5b;
    color: #fff;
}

.users-btn-dark {
    background: #172033;
    color: #fff;
}

.users-btn-dark:hover {
    background: #253044;
    color: #fff;
}

.users-btn-light {
    background: #eef2f7;
    color: #374151;
    margin-top: 22px;
}

.summary-grid {
    display: grid;
    gap: 12px;
    grid-template-columns: repeat(auto-fit, minmax(170px, 1fr));
    margin-bottom: 14px;
}

.summary-card {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-left: 4px solid var(--accent);
    border-radius: 8px;
    padding: 14px 16px;
}

.summary-card span {
    color: #6b7280;
    display: block;
    font-size: 13px;
    margin-bottom: 6px;
}

.summary-card strong {
    color: #172033;
    display: block;
    font-size: 24px;
    line-height: 1;
}

.filter-panel {
    align-items: end;
    display: grid;
    gap: 12px;
    grid-template-columns: minmax(220px, 1.4fr) repeat(3, minmax(150px, 1fr)) auto;
    margin-bottom: 14px;
    padding: 14px;
}

.filter-field label {
    color: #374151;
    display: block;
    font-size: 12px;
    font-weight: 800;
    margin-bottom: 6px;
}

.filter-field input,
.filter-field select {
    border: 1px solid #d1d5db;
    border-radius: 6px;
    color: #172033;
    height: 38px;
    padding: 7px 10px;
    width: 100%;
}

.filter-field input:focus,
.filter-field select:focus {
    border-color: #123d35;
    box-shadow: 0 0 0 3px rgba(18, 61, 53, 0.12);
    outline: 0;
}

.table-header {
    align-items: center;
    border-bottom: 1px solid #e5e7eb;
    display: flex;
    justify-content: space-between;
    padding: 13px 16px;
}

.table-header strong {
    color: #172033;
    font-size: 16px;
}

.table-header span {
    background: #eef2f7;
    border-radius: 999px;
    color: #374151;
    font-size: 12px;
    font-weight: 800;
    padding: 5px 9px;
}

.users-table {
    margin: 0;
}

.users-table thead th {
    background: #f8fafc;
    border-bottom: 1px solid #e5e7eb;
    border-top: 0;
    color: #6b7280;
    font-size: 12px;
    padding: 12px 14px;
    text-transform: uppercase;
}

.users-table tbody td {
    border-top: 1px solid #eef2f7;
    color: #374151;
    padding: 12px 14px;
    vertical-align: middle;
}

.user-cell {
    align-items: center;
    display: flex;
    gap: 10px;
}

.avatar-img,
.avatar-placeholder {
    border-radius: 50%;
    height: 36px;
    width: 36px;
}

.avatar-img {
    object-fit: cover;
}

.avatar-placeholder {
    align-items: center;
    background: #123d35;
    color: #fff;
    display: flex;
    font-size: 13px;
    font-weight: 800;
    justify-content: center;
    text-transform: uppercase;
}

.user-cell strong {
    color: #172033;
    display: block;
}

.user-cell small,
.users-table small {
    color: #6b7280;
}

.role-pill,
.status-pill {
    border-radius: 999px;
    display: inline-block;
    font-size: 12px;
    font-weight: 800;
    padding: 5px 9px;
}

.role-admin { background: #fff7ed; color: #c2410c; }
.role-teacher { background: #fef2f2; color: #b91c1c; }
.role-student { background: #eef2ff; color: #4f46e5; }
.status-active { background: #ecfdf5; color: #047857; }
.status-inactive { background: #f3f4f6; color: #4b5563; }

.assign-link {
    color: #0f766e;
    font-size: 12px;
    font-weight: 800;
}

.inline-form {
    display: inline-flex;
    margin: 0;
}

.icon-action {
    align-items: center;
    background: #eef2f7;
    border: 0;
    border-radius: 6px;
    color: #374151;
    display: inline-flex;
    height: 32px;
    justify-content: center;
    width: 32px;
}

.icon-action:hover {
    background: #123d35;
    color: #fff;
    text-decoration: none;
}

.icon-success { color: #047857; }
.icon-warning { color: #b45309; }
.icon-danger { color: #b91c1c; }
.empty-state {
    color: #6b7280;
    padding: 28px;
    text-align: center;
}

@media (max-width: 992px) {
    .filter-panel {
        grid-template-columns: 1fr 1fr;
    }
}

@media (max-width: 768px) {
    .users-header {
        align-items: flex-start;
        flex-direction: column;
    }

    .filter-panel {
        grid-template-columns: 1fr;
    }

    .users-btn-light {
        margin-top: 0;
    }

    .users-table thead {
        display: none;
    }

    .users-table tr {
        border-bottom: 1px solid #e5e7eb;
        display: block;
        padding: 10px 0;
    }

    .users-table tbody td {
        border: 0;
        display: flex;
        justify-content: space-between;
        gap: 12px;
        padding: 8px 14px;
        text-align: right;
    }

    .users-table tbody td::before {
        color: #6b7280;
        content: attr(data-label);
        font-weight: 800;
        text-align: left;
    }

    .users-table tbody td:first-child {
        display: block;
        text-align: left;
    }

    .users-table tbody td:first-child::before {
        display: none;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById("currentYear").textContent = new Date().getFullYear();

    const searchInput = document.getElementById('search-input');
    const roleFilter = document.getElementById('role-filter');
    const statusFilter = document.getElementById('status-filter');
    const schoolFilter = document.getElementById('school-filter');
    const clearFilters = document.getElementById('clear-filters');
    const countLabel = document.getElementById('table-count');

    function filterUsers() {
        const search = searchInput.value.trim().toLowerCase();
        const role = roleFilter.value;
        const status = statusFilter.value;
        const school = schoolFilter.value;
        let visible = 0;

        document.querySelectorAll('.user-row').forEach(function(row) {
            const name = row.querySelector('.user-name').textContent.toLowerCase();
            const email = row.querySelector('.email').textContent.toLowerCase();
            const matchesSearch = !search || name.includes(search) || email.includes(search);
            const matchesRole = !role || row.dataset.role === role;
            const matchesStatus = !status || row.dataset.status === status;
            const matchesSchool = !school || row.dataset.school === school;
            const show = matchesSearch && matchesRole && matchesStatus && matchesSchool;

            row.style.display = show ? '' : 'none';
            if (show) visible++;
        });

        countLabel.textContent = visible + (visible === 1 ? ' user' : ' users');
    }

    [searchInput, roleFilter, statusFilter, schoolFilter].forEach(function(control) {
        control.addEventListener('input', filterUsers);
        control.addEventListener('change', filterUsers);
    });

    clearFilters.addEventListener('click', function() {
        searchInput.value = '';
        roleFilter.value = '';
        statusFilter.value = '';
        schoolFilter.value = '';
        filterUsers();
    });
});
</script>

@endsection
