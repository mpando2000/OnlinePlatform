@extends('components.dashmaster')

@section('body')
<div class="content-wrapper profile-page">
    <div class="container-fluid profile-shell">
        <header class="profile-header">
            <div>
                <h1><i class="fas fa-user-circle"></i> My Profile</h1>
                <p>View your personal and account information.</p>
            </div>
            <div class="profile-actions">
                <a href="{{ route('profile.edit') }}" class="profile-btn profile-btn-primary"><i class="fas fa-edit"></i> Edit Profile</a>
                <a href="{{ route($dashboardRoute) }}" class="profile-btn profile-btn-light"><i class="fas fa-arrow-left"></i> Dashboard</a>
            </div>
        </header>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @php
            $schoolName = optional($user->schoolRelation)->name ?? ucfirst($user->school ?? 'Not assigned');
            $className = optional($user->schoolClass)->name ?? 'Not assigned';
            $accountStatus = ucfirst($user->status ?? 'inactive');
            $accessLabel = $user->role === 'admin'
                ? ($user->canManageAllSchools() ? 'All schools' : 'Assigned school')
                : ucfirst($user->role).' access';
        @endphp

        <section class="profile-hero">
            <div class="hero-pattern hero-pattern-one"></div>
            <div class="hero-pattern hero-pattern-two"></div>
            <img src="{{ $user->profile_image ? asset('uploads/profile_images/'.$user->profile_image) : asset('dist/img/avatar5.png') }}" alt="Profile image" class="profile-avatar profile-hero-avatar">
            <div class="hero-identity">
                <div class="hero-label">{{ ucfirst($user->role) }} account</div>
                <h2>{{ $user->name }}</h2>
                <p><i class="fas fa-envelope"></i> {{ $user->email }}</p>
                <div class="hero-badges">
                    <span class="hero-badge"><i class="fas fa-user-tag"></i> {{ ucfirst($user->role) }}</span>
                    <span class="hero-badge hero-badge-status {{ ($user->status ?? 'inactive') === 'active' ? '' : 'hero-badge-inactive' }}"><i class="fas fa-circle"></i> {{ $accountStatus }}</span>
                </div>
            </div>
            <a href="{{ route('profile.edit') }}" class="hero-edit"><i class="fas fa-pen"></i><span>Edit details</span></a>
        </section>

        <section class="profile-stats">
            <article class="profile-stat profile-stat-school">
                <div class="stat-icon"><i class="fas fa-school"></i></div>
                <div><span>School</span><strong>{{ $schoolName }}</strong></div>
            </article>
            <article class="profile-stat profile-stat-class">
                <div class="stat-icon"><i class="fas fa-chalkboard"></i></div>
                <div><span>Class</span><strong>{{ $className }}</strong></div>
            </article>
            <article class="profile-stat profile-stat-status">
                <div class="stat-icon"><i class="fas fa-shield-alt"></i></div>
                <div><span>Account status</span><strong>{{ $accountStatus }}</strong></div>
            </article>
            <article class="profile-stat profile-stat-member">
                <div class="stat-icon"><i class="fas fa-calendar-check"></i></div>
                <div><span>Member since</span><strong>{{ $user->created_at?->format('M j, Y') ?? 'Not available' }}</strong></div>
            </article>
        </section>

        <main class="profile-content-grid">
            <section class="profile-card profile-info-card">
                <div class="card-heading">
                    <div class="card-heading-icon"><i class="fas fa-address-card"></i></div>
                    <div><h3>Personal Information</h3><p>Your contact and identity details</p></div>
                </div>
                <div class="info-list">
                    <div class="info-line"><span>Full name</span><strong>{{ $user->name }}</strong></div>
                    <div class="info-line"><span>First name</span><strong>{{ $user->firstname }}</strong></div>
                    <div class="info-line"><span>Second name</span><strong>{{ $user->secondname ?: 'Not provided' }}</strong></div>
                    <div class="info-line"><span>Last name</span><strong>{{ $user->lastname }}</strong></div>
                    <div class="info-line"><span>Gender</span><strong>{{ ucfirst(strtolower($user->gender ?? 'Not provided')) }}</strong></div>
                </div>
            </section>

            <section class="profile-card profile-info-card">
                <div class="card-heading">
                    <div class="card-heading-icon card-icon-blue"><i class="fas fa-graduation-cap"></i></div>
                    <div><h3>School Assignment</h3><p>Your current learning environment</p></div>
                </div>
                <div class="info-list">
                    <div class="info-line"><span>School</span><strong>{{ $schoolName }}</strong></div>
                    <div class="info-line"><span>Class</span><strong>{{ $className }}</strong></div>
                    <div class="info-line"><span>Academic year</span><strong>{{ $user->academic_year ?: 'Not assigned' }}</strong></div>
                    <div class="info-line"><span>Role</span><strong>{{ ucfirst($user->role) }}</strong></div>
                </div>
            </section>

            <section class="profile-card profile-info-card">
                <div class="card-heading">
                    <div class="card-heading-icon card-icon-purple"><i class="fas fa-lock"></i></div>
                    <div><h3>Account &amp; Access</h3><p>Your sign-in and permission details</p></div>
                </div>
                <div class="info-list">
                    <div class="info-line"><span>Email address</span><strong>{{ $user->email }}</strong></div>
                    <div class="info-line"><span>Account ID</span><strong>#{{ $user->id }}</strong></div>
                    <div class="info-line"><span>Access level</span><strong>{{ $accessLabel }}</strong></div>
                    <div class="info-line"><span>Current status</span><strong class="text-status {{ ($user->status ?? 'inactive') === 'active' ? '' : 'text-status-inactive' }}"><i class="fas fa-circle"></i> {{ $accountStatus }}</strong></div>
                </div>
            </section>

            <section class="profile-card profile-info-card">
                <div class="card-heading">
                    <div class="card-heading-icon card-icon-orange"><i class="fas fa-history"></i></div>
                    <div><h3>Recent Activity</h3><p>Your latest account access</p></div>
                </div>
                <div class="activity-list">
                    <div class="activity-item">
                        <span class="activity-dot activity-dot-green"><i class="fas fa-sign-in-alt"></i></span>
                        <div><strong>Last signed in</strong><span>{{ $user->login_at ? \Carbon\Carbon::parse($user->login_at)->format('M j, Y · g:i A') : 'No login recorded' }}</span></div>
                    </div>
                    <div class="activity-item">
                        <span class="activity-dot"><i class="fas fa-sign-out-alt"></i></span>
                        <div><strong>Last signed out</strong><span>{{ $user->logout_at ? \Carbon\Carbon::parse($user->logout_at)->format('M j, Y · g:i A') : 'No logout recorded' }}</span></div>
                    </div>
                    <div class="activity-item">
                        <span class="activity-dot activity-dot-blue"><i class="fas fa-user-plus"></i></span>
                        <div><strong>Account created</strong><span>{{ $user->created_at?->format('M j, Y · g:i A') ?? 'Not available' }}</span></div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</div>

<footer class="main-footer"><strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong> All rights reserved.</footer>
@include('profile.styles')
@endsection
