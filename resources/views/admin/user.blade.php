@extends('components.dashmaster')

@section('body')

<div class="content-wrapper user-view-page">
    <div class="container-fluid user-shell">
        <div class="user-page-header">
            <div>
                <h1><i class="fas fa-user-circle"></i> User Profile</h1>
                <p>{{ $user->firstname }} {{ $user->lastname }} account details</p>
            </div>
            <div class="page-actions">
                <a href="/editUser/{{ $user->id }}" class="ui-btn ui-btn-primary"><i class="fas fa-edit"></i> Edit</a>
                <a href="{{ route('admin.resetPassword', $user->id) }}" class="ui-btn ui-btn-dark"><i class="fas fa-key"></i> Reset Password</a>
                <a href="{{ route('admin.users') }}" class="ui-btn ui-btn-light"><i class="fas fa-arrow-left"></i> Users</a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @php
            $fullName = trim($user->firstname.' '.$user->secondname.' '.$user->lastname);
            $schoolName = $user->school_id ? optional($user->schoolRelation)->name : ucfirst($user->school ?? 'Not assigned');
            $className = optional($user->schoolClass)->name ?? 'Not assigned';
            $status = $user->status ?? 'inactive';
            $accessLabel = $user->role === 'admin'
                ? ($user->canManageAllSchools() ? 'All schools' : 'Assigned school')
                : ucfirst($user->role).' access';
        @endphp

        <section class="identity-card">
            <div class="identity-accent"></div>
            <img src="{{ $user->profile_image ? asset('uploads/profile_images/' . $user->profile_image) : asset('dist/img/avatar5.png') }}" class="profile-image" alt="Profile image">
            <div class="identity-copy">
                <span class="eyebrow">Managed user account</span>
                <h2>{{ $fullName }}</h2>
                <p><i class="fas fa-envelope"></i> {{ $user->email }}</p>
                <div class="identity-badges">
                    <span class="role-pill role-{{ $user->role }}"><i class="fas fa-user-tag"></i> {{ ucfirst($user->role) }}</span>
                    <span class="status-pill status-{{ $status }}"><i class="fas fa-circle"></i> {{ ucfirst($status) }}</span>
                </div>
            </div>
            <div class="identity-side">
                <span>User ID</span><strong>#{{ $user->id }}</strong>
                <small>Joined {{ $user->created_at->format('M j, Y') }}</small>
            </div>
        </section>

        <section class="summary-cards">
            <article class="summary-card">
                <span class="summary-icon icon-school"><i class="fas fa-school"></i></span>
                <div><span>School</span><strong>{{ $schoolName }}</strong></div>
            </article>
            <article class="summary-card">
                <span class="summary-icon icon-class"><i class="fas fa-chalkboard"></i></span>
                <div><span>Class</span><strong>{{ $className }}</strong></div>
            </article>
            <article class="summary-card">
                <span class="summary-icon icon-access"><i class="fas fa-shield-alt"></i></span>
                <div><span>Access</span><strong>{{ $accessLabel }}</strong></div>
            </article>
            <article class="summary-card">
                <span class="summary-icon icon-update"><i class="fas fa-clock"></i></span>
                <div><span>Last updated</span><strong>{{ $user->updated_at->diffForHumans() }}</strong></div>
            </article>
        </section>

        <main class="user-card-grid">
            <section class="detail-card">
                <div class="card-heading">
                    <span class="heading-icon"><i class="fas fa-address-card"></i></span>
                    <div><h3>Personal Information</h3><p>Identity and contact details</p></div>
                </div>
                <div class="detail-list">
                    <div><span>First name</span><strong>{{ $user->firstname }}</strong></div>
                    <div><span>Second name</span><strong>{{ $user->secondname ?: 'Not provided' }}</strong></div>
                    <div><span>Last name</span><strong>{{ $user->lastname }}</strong></div>
                    <div><span>Gender</span><strong>{{ ucfirst(strtolower($user->gender ?? 'Not specified')) }}</strong></div>
                    <div class="detail-wide"><span>Email address</span><strong>{{ $user->email }}</strong></div>
                </div>
            </section>

            <section class="detail-card">
                <div class="card-heading">
                    <span class="heading-icon heading-icon-blue"><i class="fas fa-graduation-cap"></i></span>
                    <div><h3>School &amp; Account</h3><p>Assignment and access information</p></div>
                </div>
                <div class="detail-list">
                    <div class="detail-wide"><span>School</span><strong>{{ $schoolName }}</strong></div>
                    <div><span>Class</span><strong>{{ $className }}</strong></div>
                    <div><span>Academic year</span><strong>{{ $user->academic_year ?: 'Not assigned' }}</strong></div>
                    <div><span>Role</span><strong>{{ ucfirst($user->role) }}</strong></div>
                    <div><span>Status</span><strong class="status-text status-text-{{ $status }}"><i class="fas fa-circle"></i> {{ ucfirst($status) }}</strong></div>
                </div>
            </section>

            <section class="detail-card">
                <div class="card-heading">
                    <span class="heading-icon heading-icon-purple"><i class="fas fa-history"></i></span>
                    <div><h3>Account Activity</h3><p>Important account timestamps</p></div>
                </div>
                <div class="timeline-list">
                    <div class="timeline-item"><span class="timeline-icon login-icon"><i class="fas fa-sign-in-alt"></i></span><div><strong>Last signed in</strong><small>{{ $user->login_at ? \Carbon\Carbon::parse($user->login_at)->format('M j, Y · g:i A') : 'No login recorded' }}</small></div></div>
                    <div class="timeline-item"><span class="timeline-icon"><i class="fas fa-sign-out-alt"></i></span><div><strong>Last signed out</strong><small>{{ $user->logout_at ? \Carbon\Carbon::parse($user->logout_at)->format('M j, Y · g:i A') : 'No logout recorded' }}</small></div></div>
                    <div class="timeline-item"><span class="timeline-icon created-icon"><i class="fas fa-user-plus"></i></span><div><strong>Account created</strong><small>{{ $user->created_at->format('M j, Y · g:i A') }}</small></div></div>
                </div>
            </section>

            <section class="detail-card management-card">
                <div class="card-heading">
                    <span class="heading-icon heading-icon-orange"><i class="fas fa-user-cog"></i></span>
                    <div><h3>Account Management</h3><p>Administrative actions for this account</p></div>
                </div>
                <div class="management-actions">
                    <a href="/editUser/{{ $user->id }}" class="management-action"><i class="fas fa-user-edit"></i><span><strong>Edit profile</strong><small>Update personal and school details</small></span><i class="fas fa-chevron-right"></i></a>
                    <a href="{{ route('admin.resetPassword', $user->id) }}" class="management-action"><i class="fas fa-key"></i><span><strong>Reset password</strong><small>Set a new account password</small></span><i class="fas fa-chevron-right"></i></a>
                </div>
            </section>

            @if($user->role === 'teacher')
                <section class="detail-card assignments-card">
                    <div class="card-heading assignment-heading">
                        <span class="heading-icon heading-icon-blue"><i class="fas fa-chalkboard-teacher"></i></span>
                        <div><h3>Teaching Assignments</h3><p>Classes and subjects assigned to this teacher</p></div>
                        <a href="{{ route('adminUsers.assign-class-subject', $user->id) }}" class="ui-btn ui-btn-primary"><i class="fas fa-plus"></i> Manage Assignments</a>
                    </div>
                    @if(isset($assignedClasses) && count($assignedClasses))
                        <div class="assignment-list">
                            @foreach($assignedClasses as $className => $subjects)
                                <div class="assignment-item">
                                    <strong><i class="fas fa-chalkboard"></i> {{ $className }}</strong>
                                    <div>@foreach($subjects as $subject)<span class="subject-pill">{{ $subject->subject_name }}</span>@endforeach</div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-assignment"><i class="fas fa-book-open"></i><strong>No teaching assignments</strong><span>Assign classes and subjects to this teacher.</span></div>
                    @endif
                </section>
            @endif

            <section class="danger-panel">
                <div class="danger-copy"><span class="danger-icon"><i class="fas fa-exclamation-triangle"></i></span><div><strong>Delete this user</strong><p>Permanently remove the account and its related forced sessions.</p></div></div>
                <form method="POST" action="/deleteUser/{{ $user->id }}" onsubmit="return confirm('Delete this user? This action cannot be undone.');">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="force" value="1">
                    <button type="submit" class="ui-btn ui-btn-danger"><i class="fas fa-trash"></i> Delete User</button>
                </form>
            </section>
        </main>
    </div>
</div>

<footer class="main-footer">
    <strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong>
    All rights reserved.
</footer>

<style>
.user-view-page { background: #f3f6fa; min-height: 100vh; }
.user-shell { margin: 0 auto; max-width: 1500px; padding: 20px; }
.user-page-header, .identity-card, .summary-card, .detail-card, .danger-panel { background: #fff; border: 1px solid #e4e9f0; border-radius: 14px; }
.user-page-header { align-items: center; display: flex; gap: 18px; justify-content: space-between; margin-bottom: 14px; padding: 16px 18px; }
.user-page-header h1 { color: #172033; font-size: 22px; font-weight: 900; margin: 0; }
.user-page-header h1 i { color: #165a4d; margin-right: 8px; }
.user-page-header p { color: #6b7280; margin: 4px 0 0; }
.page-actions { display: flex; flex-wrap: wrap; gap: 8px; }
.ui-btn { align-items: center; border: 0; border-radius: 7px; display: inline-flex; font-weight: 800; gap: 7px; min-height: 38px; padding: 8px 12px; }
.ui-btn:hover { text-decoration: none; }
.ui-btn-primary { background: #165a4d; color: #fff; }
.ui-btn-primary:hover { background: #1f6f5b; color: #fff; }
.ui-btn-dark { background: #172033; color: #fff; }
.ui-btn-dark:hover { background: #253044; color: #fff; }
.ui-btn-light { background: #eef2f7; color: #374151; }
.ui-btn-danger { background: #b91c1c; color: #fff; }
.ui-btn-danger:hover { background: #991b1b; color: #fff; }
.identity-card { align-items: center; display: flex; gap: 20px; margin-bottom: 14px; min-height: 190px; overflow: hidden; padding: 28px 30px; position: relative; }
.identity-accent { background: #165a4d; height: 6px; left: 0; position: absolute; right: 0; top: 0; }
.profile-image { border: 4px solid #e0ebe7; border-radius: 50%; box-shadow: 0 7px 18px rgba(23,48,51,.12); flex: 0 0 auto; height: 126px; object-fit: cover; width: 126px; }
.identity-copy { min-width: 0; }
.eyebrow { color: #16806b; display: block; font-size: 11px; font-weight: 900; letter-spacing: .1em; margin-bottom: 4px; text-transform: uppercase; }
.identity-copy h2 { color: #172033; font-size: 27px; font-weight: 900; letter-spacing: -.02em; margin: 0 0 6px; }
.identity-copy p { color: #667085; margin: 0; overflow-wrap: anywhere; }
.identity-copy p i { color: #16806b; margin-right: 6px; }
.identity-badges { display: flex; flex-wrap: wrap; gap: 7px; margin-top: 14px; }
.role-pill, .status-pill, .subject-pill {
    border-radius: 999px;
    display: inline-block;
    font-size: 12px;
    font-weight: 800;
    margin: 3px;
    padding: 5px 9px;
}
.identity-badges .role-pill, .identity-badges .status-pill { margin: 0; }
.status-pill i { font-size: 7px; margin-right: 4px; }
.role-admin { background: #fff7ed; color: #c2410c; }
.role-teacher { background: #fef2f2; color: #b91c1c; }
.role-student { background: #eef2ff; color: #4f46e5; }
.status-active { background: #ecfdf5; color: #047857; }
.status-inactive { background: #fef2f2; color: #b91c1c; }
.identity-side { border-left: 1px solid #e7ebf0; margin-left: auto; min-width: 170px; padding: 12px 0 12px 24px; text-align: right; }
.identity-side span, .identity-side small { color: #8a94a5; display: block; font-size: 11px; font-weight: 800; text-transform: uppercase; }
.identity-side strong { color: #172033; display: block; font-size: 22px; margin: 3px 0 9px; }
.identity-side small { font-weight: 700; text-transform: none; }
.summary-cards { display: grid; gap: 13px; grid-template-columns: repeat(4, minmax(0, 1fr)); margin-bottom: 14px; }
.summary-card { align-items: center; display: flex; gap: 12px; min-height: 94px; padding: 14px; }
.summary-icon { align-items: center; background: #e9f6f2; border-radius: 10px; color: #13715d; display: flex; flex: 0 0 auto; font-size: 17px; height: 46px; justify-content: center; width: 46px; }
.icon-class { background: #eaf1ff; color: #3569c8; }
.icon-access { background: #f0ecff; color: #7251c8; }
.icon-update { background: #fff2e5; color: #c66d1a; }
.summary-card div { min-width: 0; }
.summary-card div span { color: #8490a2; display: block; font-size: 10px; font-weight: 900; margin-bottom: 3px; text-transform: uppercase; }
.summary-card div strong { color: #1c2739; display: -webkit-box; font-size: 13px; font-weight: 900; line-height: 1.35; overflow: hidden; overflow-wrap: anywhere; -webkit-box-orient: vertical; -webkit-line-clamp: 2; }
.user-card-grid { display: grid; gap: 14px; grid-template-columns: repeat(2, minmax(0, 1fr)); margin: 0 !important; padding: 0 !important; }
.detail-card { min-width: 0; overflow: hidden; }
.card-heading { align-items: center; border-bottom: 1px solid #edf0f4; display: flex; gap: 12px; padding: 17px 19px; }
.heading-icon { align-items: center; background: #e9f6f2; border-radius: 9px; color: #13715d; display: flex; flex: 0 0 auto; height: 40px; justify-content: center; width: 40px; }
.heading-icon-blue { background: #eaf1ff; color: #3569c8; }
.heading-icon-purple { background: #f0ecff; color: #7251c8; }
.heading-icon-orange { background: #fff2e5; color: #c66d1a; }
.card-heading h3 { color: #172033; font-size: 15px; font-weight: 900; margin: 0; }
.card-heading p { color: #8993a3; font-size: 12px; margin: 2px 0 0; }
.detail-list { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); padding: 8px 19px 14px; }
.detail-list > div { border-bottom: 1px solid #f0f2f5; min-width: 0; padding: 11px 4px 11px 0; }
.detail-list > div:nth-last-child(-n+2) { border-bottom: 0; }
.detail-list .detail-wide { grid-column: span 2; }
.detail-list span { color: #7e899a; display: block; font-size: 10px; font-weight: 900; margin-bottom: 4px; text-transform: uppercase; }
.detail-list strong { color: #1d2939; display: block; font-size: 13px; overflow-wrap: anywhere; }
.status-text-active { color: #16815f !important; }
.status-text-inactive { color: #b91c1c !important; }
.status-text i { font-size: 7px; margin-right: 4px; }
.timeline-list { padding: 9px 19px 15px; }
.timeline-item { align-items: center; display: flex; gap: 11px; padding: 9px 0; }
.timeline-item + .timeline-item { border-top: 1px solid #f0f2f5; }
.timeline-icon { align-items: center; background: #f1f3f6; border-radius: 8px; color: #687386; display: flex; flex: 0 0 auto; height: 34px; justify-content: center; width: 34px; }
.login-icon { background: #e9f6f2; color: #16815f; }
.created-icon { background: #eaf1ff; color: #3569c8; }
.timeline-item strong, .timeline-item small { display: block; }
.timeline-item strong { color: #253044; font-size: 13px; }
.timeline-item small { color: #8993a3; margin-top: 2px; }
.management-actions { padding: 8px 19px 14px; }
.management-action { align-items: center; color: #253044; display: flex; gap: 11px; padding: 11px 0; }
.management-action + .management-action { border-top: 1px solid #f0f2f5; }
.management-action > i:first-child { align-items: center; background: #f4f6f8; border-radius: 8px; color: #165a4d; display: flex; flex: 0 0 auto; height: 34px; justify-content: center; width: 34px; }
.management-action > i:last-child { color: #a2aab7; margin-left: auto; }
.management-action span { min-width: 0; }
.management-action strong, .management-action small { display: block; }
.management-action strong { font-size: 13px; }
.management-action small { color: #8993a3; margin-top: 2px; }
.assignments-card, .danger-panel { grid-column: 1 / -1; }
.assignment-heading .ui-btn { margin-left: auto; }
.assignment-list { display: grid; gap: 10px; padding: 15px 19px; }
.assignment-item { border: 1px solid #e8edf2; border-radius: 9px; padding: 12px; }
.assignment-item > strong { color: #253044; display: block; margin-bottom: 7px; }
.assignment-item > strong i { color: #3569c8; margin-right: 5px; }
.subject-pill { background: #ecfdf5; color: #047857; }
.empty-assignment { align-items: center; color: #8a94a5; display: flex; flex-direction: column; padding: 26px; text-align: center; }
.empty-assignment > i { color: #b1bac6; font-size: 25px; margin-bottom: 7px; }
.empty-assignment strong, .empty-assignment span { display: block; }
.empty-assignment strong { color: #536074; }
.empty-assignment span { font-size: 12px; margin-top: 3px; }
.danger-panel { align-items: center; border-color: #f2cccc; display: flex; gap: 16px; justify-content: space-between; padding: 16px 18px; }
.danger-copy { align-items: center; display: flex; gap: 12px; }
.danger-icon { align-items: center; background: #fef2f2; border-radius: 9px; color: #b91c1c; display: flex; flex: 0 0 auto; height: 40px; justify-content: center; width: 40px; }
.danger-copy strong { color: #7f1d1d; }
.danger-copy p { color: #8c5555; font-size: 12px; margin: 2px 0 0; }
@media (max-width: 1100px) { .summary-cards { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
@media (max-width: 800px) { .user-page-header, .identity-card, .danger-panel { align-items: flex-start; flex-direction: column; } .identity-side { border-left: 0; border-top: 1px solid #e7ebf0; margin-left: 0; padding: 14px 0 0; text-align: left; width: 100%; } .user-card-grid { grid-template-columns: 1fr; } .assignment-heading { align-items: flex-start; flex-wrap: wrap; } .assignment-heading .ui-btn { margin-left: 0; } }
@media (max-width: 520px) { .user-shell { padding: 12px; } .summary-cards, .detail-list { grid-template-columns: 1fr; } .detail-list .detail-wide { grid-column: auto; } .profile-image { height: 105px; width: 105px; } .identity-copy h2 { font-size: 23px; } }
</style>

<script>
document.getElementById("currentYear").textContent = new Date().getFullYear();
</script>
@endsection
