@extends('components.dashmaster')

@section('body')
<div class="content-wrapper teacher-page">
    <div class="container-fluid page-shell">
        <div class="page-panel">
            <div>
                <h1><i class="fas fa-users"></i> User Management</h1>
                <p>Students and teachers visible to you.</p>
            </div>
        </div>
        <div class="stats-grid">
            <div class="stat-card"><i class="fas fa-user-graduate"></i><div><strong>{{ $stats['total_students'] ?? 0 }}</strong><span>Students</span></div></div>
            <div class="stat-card"><i class="fas fa-chalkboard-teacher"></i><div><strong>{{ $stats['total_teachers'] ?? 0 }}</strong><span>Teachers</span></div></div>
            <div class="stat-card"><i class="fas fa-school"></i><div><strong>{{ $stats['classes_count'] ?? 0 }}</strong><span>Classes</span></div></div>
            <div class="stat-card"><i class="fas fa-clock"></i><div><strong>{{ $stats['recent_registrations'] ?? 0 }}</strong><span>Recent</span></div></div>
        </div>
        <section class="panel-card">
            <div class="panel-title"><strong>Users</strong><span>{{ $users->count() }} records</span></div>
            <div class="table-responsive">
                <table class="clean-table">
                    <thead><tr><th>User</th><th>Role</th><th>School</th><th>Class</th><th class="text-right">Actions</th></tr></thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td><strong>{{ $user->name ?: trim($user->firstname . ' ' . $user->lastname) }}</strong><span>{{ $user->email }}</span></td>
                                <td><span class="role-pill">{{ ucfirst($user->role) }}</span></td>
                                <td>{{ ucfirst($user->school ?? optional($user->schoolModel)->name ?? 'N/A') }}</td>
                                <td>{{ optional($user->schoolClass)->name ?? 'N/A' }}</td>
                                <td>
                                    <div class="row-actions">
                                        <a href="/teacher/viewUser/{{ $user->id }}" class="icon-btn"><i class="fas fa-eye"></i></a>
                                        <a href="/teacher/editUser/{{ $user->id }}" class="icon-btn"><i class="fas fa-edit"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="empty-state">No users found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</div>
<footer class="main-footer"><strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong> All rights reserved.</footer>
@include('teacher.partials.clean-styles')
@endsection
