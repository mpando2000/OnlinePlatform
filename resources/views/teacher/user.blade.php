@extends('components.dashmaster')

@section('body')
@php
    $fullName = $user->name;
    $initials = strtoupper(substr($user->firstname ?? 'U', 0, 1) . substr($user->lastname ?? '', 0, 1));
    $schoolName = optional($user->schoolModel ?? $user->school)->name ?? $user->school ?? 'Not assigned';
    $className = optional($user->schoolClass)->name ?? 'Not assigned';
@endphp

<div class="content-wrapper teacher-page">
    <div class="container-fluid page-shell">
        <div class="page-panel">
            <div>
                <h1><i class="fas fa-user"></i> User Profile</h1>
                <p>{{ $fullName }}</p>
            </div>
            <div class="page-actions">
                <a href="/teacher/editUser/{{ $user->id }}" class="ui-btn ui-btn-primary">
                    <i class="fas fa-edit"></i> Edit User
                </a>
                <a href="{{ route('teacher.users') }}" class="ui-btn ui-btn-soft">
                    <i class="fas fa-arrow-left"></i> Users
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success panel-alert">{{ session('success') }}</div>
        @endif

        <div class="profile-layout">
            <section class="panel-card profile-summary">
                <div class="profile-avatar">{{ $initials }}</div>
                <h2>{{ $fullName }}</h2>
                <span class="role-pill">{{ ucfirst($user->role) }}</span>
                <div class="profile-meta">
                    <span><i class="fas fa-calendar"></i> Joined {{ optional($user->created_at)->format('M d, Y') ?? 'N/A' }}</span>
                    <span><i class="fas fa-clock"></i> Updated {{ optional($user->updated_at)->diffForHumans() ?? 'N/A' }}</span>
                </div>
            </section>

            <section class="panel-card form-card">
                <div class="card-heading">
                    <h2><i class="fas fa-id-card"></i> Details</h2>
                </div>
                <div class="detail-list">
                    <div class="detail-row">
                        <span>Email</span>
                        <strong>{{ $user->email }}</strong>
                    </div>
                    <div class="detail-row">
                        <span>Gender</span>
                        <strong>{{ ucfirst($user->gender ?? 'Not provided') }}</strong>
                    </div>
                    <div class="detail-row">
                        <span>School</span>
                        <strong>{{ $schoolName }}</strong>
                    </div>
                    <div class="detail-row">
                        <span>Class</span>
                        <strong>{{ $user->role === 'student' ? $className : 'Teacher account' }}</strong>
                    </div>
                    <div class="detail-row">
                        <span>Status</span>
                        <strong>{{ ucfirst($user->status ?? 'Active') }}</strong>
                    </div>
                </div>
            </section>
        </div>

        @if($user->role === 'teacher')
            <section class="panel-card table-card profile-section">
                <div class="card-heading">
                    <h2><i class="fas fa-book"></i> Assigned Subjects</h2>
                </div>
                <div class="item-list">
                    @forelse($user->subjects as $subject)
                        <div class="list-card">
                            <i class="fas fa-graduation-cap"></i>
                            <div>
                                <strong>{{ $subject->name }}</strong>
                                <span>Class ID: {{ $subject->pivot->class_id ?? 'N/A' }}</span>
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">No subjects assigned.</div>
                    @endforelse
                </div>
            </section>
        @endif
    </div>
</div>

<footer class="main-footer clean-footer">
    <strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong> All rights reserved.
</footer>

@include('teacher.partials.clean-styles')
@endsection
