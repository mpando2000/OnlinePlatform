@extends('components.dashmaster')

@section('body')
@php
    $admins = $users->where('role', 'admin')->count();
    $teachers = $users->where('role', 'teacher')->count();
    $students = $users->where('role', 'student')->count();
@endphp

<div class="content-wrapper admin-report-page">
    <div class="container-fluid page-shell">
        <div class="page-panel">
            <div>
                <h1><i class="fas fa-users"></i> User Report</h1>
                <p>Review all platform users and account roles.</p>
            </div>
            <div class="page-actions">
                <a href="{{ route('admin.reportPrint') }}" target="_blank" class="ui-btn ui-btn-primary"><i class="fas fa-print"></i> Print</a>
                <a href="{{ route('admin.report') }}" class="ui-btn ui-btn-soft"><i class="fas fa-arrow-left"></i> Reports</a>
            </div>
        </div>

        <section class="stats-grid">
            <article class="stat-card"><i class="fas fa-users"></i><div><strong>{{ $users->count() }}</strong><span>Total Users</span></div></article>
            <article class="stat-card"><i class="fas fa-user-shield"></i><div><strong>{{ $admins }}</strong><span>Admins</span></div></article>
            <article class="stat-card"><i class="fas fa-chalkboard-teacher"></i><div><strong>{{ $teachers }}</strong><span>Teachers</span></div></article>
            <article class="stat-card"><i class="fas fa-user-graduate"></i><div><strong>{{ $students }}</strong><span>Students</span></div></article>
        </section>

        <section class="table-card">
            <div class="panel-title">
                <strong>Users</strong>
                <span>{{ $users->count() }} records</span>
            </div>
            <div class="table-responsive">
                <table class="clean-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Time Spent</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><strong>{{ $user->name }}</strong><span>{{ $user->firstname }} {{ $user->secondname }} {{ $user->lastname }}</span></td>
                                <td>{{ $user->email }}</td>
                                <td><span class="status-pill">{{ ucfirst($user->role) }}</span></td>
                                <td>{{ $user->time_spent ?? 'N/A' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="empty-cell">No users found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</div>

<footer class="main-footer clean-footer">
    <strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong> All rights reserved.
</footer>

@include('admin.partials.report-clean-styles')
@endsection
