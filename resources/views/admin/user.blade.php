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

        <div class="profile-grid">
            <aside class="profile-card">
                <img src="{{ $user->profile_image ? asset('uploads/profile_images/' . $user->profile_image) : asset('dist/img/avatar5.png') }}" class="profile-image" alt="Profile Image">
                <h2>{{ $user->firstname }} {{ $user->secondname }} {{ $user->lastname }}</h2>
                <span class="role-pill role-{{ $user->role }}">{{ ucfirst($user->role) }}</span>
                <span class="status-pill status-{{ $user->status ?? 'active' }}">{{ ucfirst($user->status ?? 'active') }}</span>
                <div class="profile-meta">
                    <span>Member since</span>
                    <strong>{{ $user->created_at->format('M j, Y') }}</strong>
                </div>
            </aside>

            <main class="profile-main">
                <section class="info-panel">
                    <div class="panel-title"><i class="fas fa-address-card"></i> Account Information</div>
                    <div class="info-grid">
                        <div class="info-item">
                            <span>Email</span>
                            <strong>{{ $user->email }}</strong>
                        </div>
                        <div class="info-item">
                            <span>Phone</span>
                            <strong>{{ $user->phone ?? 'Not provided' }}</strong>
                        </div>
                        <div class="info-item">
                            <span>Gender</span>
                            <strong>{{ ucfirst($user->gender ?? 'Not specified') }}</strong>
                        </div>
                        <div class="info-item">
                            <span>School</span>
                            <strong>{{ $user->school_id ? optional($user->school_relation)->name : ucfirst($user->school ?? 'No School') }}</strong>
                        </div>
                        <div class="info-item">
                            <span>Class</span>
                            <strong>{{ optional($user->schoolClass)->name ?? 'Not assigned' }}</strong>
                        </div>
                        <div class="info-item">
                            <span>Last Updated</span>
                            <strong>{{ $user->updated_at->diffForHumans() }}</strong>
                        </div>
                    </div>
                </section>

                @if($user->role === 'teacher')
                    <section class="info-panel">
                        <div class="panel-title"><i class="fas fa-chalkboard"></i> Teaching Assignments</div>
                        @if(isset($assignedClasses) && count($assignedClasses))
                            <div class="assignment-list">
                                @foreach($assignedClasses as $className => $subjects)
                                    <div class="assignment-item">
                                        <strong>{{ $className }}</strong>
                                        <div>
                                            @foreach($subjects as $subject)
                                                <span class="subject-pill">{{ $subject->subject_name }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="muted-text">No classes assigned yet.</p>
                            <a href="{{ route('adminUsers.assign-class-subject', $user->id) }}" class="ui-btn ui-btn-primary"><i class="fas fa-plus"></i> Assign Classes</a>
                        @endif
                    </section>
                @endif

                <section class="info-panel">
                    <div class="panel-title"><i class="fas fa-cog"></i> System Information</div>
                    <div class="info-grid">
                        <div class="info-item">
                            <span>User ID</span>
                            <strong>#{{ $user->id }}</strong>
                        </div>
                        <div class="info-item">
                            <span>Created</span>
                            <strong>{{ $user->created_at->format('M j, Y g:i A') }}</strong>
                        </div>
                    </div>
                </section>

                <section class="danger-panel">
                    <div>
                        <strong>Delete User</strong>
                        <p>Remove this account and its related forced sessions if needed.</p>
                    </div>
                    <form method="POST" action="/deleteUser/{{ $user->id }}" onsubmit="return confirm('Delete this user? This action cannot be undone.');">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="force" value="1">
                        <button type="submit" class="ui-btn ui-btn-danger"><i class="fas fa-trash"></i> Delete</button>
                    </form>
                </section>
            </main>
        </div>
    </div>
</div>

<footer class="main-footer">
    <strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong>
    All rights reserved.
</footer>

<style>
.user-view-page { background: #f5f7fb; min-height: 100vh; }
.user-shell { padding: 18px; }
.user-page-header, .profile-card, .info-panel, .danger-panel {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
}
.user-page-header {
    align-items: center;
    display: flex;
    justify-content: space-between;
    gap: 18px;
    margin-bottom: 14px;
    padding: 16px 18px;
}
.user-page-header h1 { color: #172033; font-size: 22px; font-weight: 800; margin: 0; }
.user-page-header h1 i { color: #123d35; margin-right: 8px; }
.user-page-header p, .muted-text, .danger-panel p { color: #6b7280; margin: 4px 0 0; }
.page-actions { display: flex; flex-wrap: wrap; gap: 8px; }
.ui-btn {
    align-items: center;
    border: 0;
    border-radius: 6px;
    display: inline-flex;
    font-weight: 800;
    gap: 7px;
    min-height: 36px;
    padding: 8px 12px;
}
.ui-btn:hover { text-decoration: none; }
.ui-btn-primary { background: #123d35; color: #fff; }
.ui-btn-primary:hover { background: #1f6f5b; color: #fff; }
.ui-btn-dark { background: #172033; color: #fff; }
.ui-btn-dark:hover { background: #253044; color: #fff; }
.ui-btn-light { background: #eef2f7; color: #374151; }
.ui-btn-danger { background: #b91c1c; color: #fff; }
.ui-btn-danger:hover { background: #991b1b; color: #fff; }
.profile-grid { display: grid; gap: 14px; grid-template-columns: 320px minmax(0, 1fr); }
.profile-card { padding: 22px; text-align: center; }
.profile-image { border-radius: 50%; height: 112px; object-fit: cover; width: 112px; }
.profile-card h2 { color: #172033; font-size: 20px; font-weight: 800; margin: 14px 0 10px; }
.role-pill, .status-pill, .subject-pill {
    border-radius: 999px;
    display: inline-block;
    font-size: 12px;
    font-weight: 800;
    margin: 3px;
    padding: 5px 9px;
}
.role-admin { background: #fff7ed; color: #c2410c; }
.role-teacher { background: #fef2f2; color: #b91c1c; }
.role-student { background: #eef2ff; color: #4f46e5; }
.status-active { background: #ecfdf5; color: #047857; }
.status-inactive { background: #f3f4f6; color: #4b5563; }
.profile-meta { border-top: 1px solid #e5e7eb; margin-top: 18px; padding-top: 18px; }
.profile-meta span, .info-item span { color: #6b7280; display: block; font-size: 12px; font-weight: 800; text-transform: uppercase; }
.profile-meta strong, .info-item strong { color: #172033; display: block; margin-top: 4px; }
.profile-main { display: grid; gap: 14px; }
.panel-title {
    border-bottom: 1px solid #e5e7eb;
    color: #172033;
    font-size: 15px;
    font-weight: 800;
    padding: 13px 16px;
}
.panel-title i { color: #123d35; margin-right: 8px; }
.info-grid { display: grid; gap: 12px; grid-template-columns: repeat(auto-fit, minmax(210px, 1fr)); padding: 16px; }
.info-item { background: #f8fafc; border: 1px solid #eef2f7; border-radius: 8px; padding: 12px; }
.assignment-list { display: grid; gap: 10px; padding: 16px; }
.assignment-item { border: 1px solid #eef2f7; border-radius: 8px; padding: 12px; }
.subject-pill { background: #ecfdf5; color: #047857; }
.danger-panel { align-items: center; display: flex; justify-content: space-between; gap: 16px; padding: 16px; }
@media (max-width: 900px) {
    .profile-grid { grid-template-columns: 1fr; }
    .user-page-header, .danger-panel { align-items: flex-start; flex-direction: column; }
}
</style>

<script>
document.getElementById("currentYear").textContent = new Date().getFullYear();
</script>
@endsection
