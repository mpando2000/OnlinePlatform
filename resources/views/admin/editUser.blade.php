@extends('components.dashmaster')

@section('body')

<div class="content-wrapper form-page">
    <div class="container-fluid form-shell">
        <div class="form-header-panel">
            <div>
                <h1><i class="fas fa-user-edit"></i> Edit User</h1>
                <p>{{ $user->firstname }} {{ $user->lastname }}</p>
            </div>
            <a href="{{ route('admin.users') }}" class="ui-btn ui-btn-light"><i class="fas fa-arrow-left"></i> Users</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <div class="form-card">
            <form action="{{ url('/editedUser/' . $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="profile-edit-row">
                    <img src="{{ $user->profile_image ? asset('uploads/profile_images/' . $user->profile_image) : asset('dist/img/avatar5.png') }}" class="profile-preview" alt="Profile Image" id="profilePreview">
                    <div>
                        <label for="profile_image" class="field-label">Profile Image</label>
                        <input type="file" name="profile_image" id="profile_image" class="form-control" accept="image/*">
                        <small>JPG, PNG, GIF. Maximum 2MB.</small>
                    </div>
                </div>

                <div class="form-grid">
                    <div class="field">
                        <label for="firstname">First Name</label>
                        <input type="text" name="firstname" id="firstname" value="{{ old('firstname', $user->firstname) }}" required>
                    </div>
                    <div class="field">
                        <label for="secondname">Second Name</label>
                        <input type="text" name="secondname" id="secondname" value="{{ old('secondname', $user->secondname) }}" required>
                    </div>
                    <div class="field">
                        <label for="lastname">Last Name</label>
                        <input type="text" name="lastname" id="lastname" value="{{ old('lastname', $user->lastname) }}" required>
                    </div>
                    <div class="field field-wide">
                        <label for="email">Email Address</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="ui-btn ui-btn-primary"><i class="fas fa-save"></i> Save Changes</button>
                    <a href="/viewUser/{{ $user->id }}" class="ui-btn ui-btn-light"><i class="fas fa-times"></i> Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<footer class="main-footer">
    <strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong>
    All rights reserved.
</footer>

<style>
.form-page { background: #f5f7fb; min-height: 100vh; }
.form-shell { padding: 18px; }
.form-header-panel, .form-card {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
}
.form-header-panel {
    align-items: center;
    display: flex;
    justify-content: space-between;
    gap: 18px;
    margin-bottom: 14px;
    padding: 16px 18px;
}
.form-header-panel h1 { color: #172033; font-size: 22px; font-weight: 800; margin: 0; }
.form-header-panel h1 i { color: #123d35; margin-right: 8px; }
.form-header-panel p, .profile-edit-row small { color: #6b7280; margin: 4px 0 0; }
.form-card { max-width: 980px; padding: 18px; }
.profile-edit-row {
    align-items: center;
    border-bottom: 1px solid #e5e7eb;
    display: flex;
    gap: 16px;
    margin-bottom: 18px;
    padding-bottom: 18px;
}
.profile-preview { border-radius: 50%; height: 88px; object-fit: cover; width: 88px; }
.form-grid { display: grid; gap: 14px; grid-template-columns: repeat(3, minmax(0, 1fr)); }
.field-wide { grid-column: span 3; }
.field label, .field-label {
    color: #374151;
    display: block;
    font-size: 12px;
    font-weight: 800;
    margin-bottom: 6px;
}
.field input, .form-control {
    border: 1px solid #d1d5db;
    border-radius: 6px;
    color: #172033;
    height: 38px;
    padding: 7px 10px;
    width: 100%;
}
.field input:focus, .form-control:focus {
    border-color: #123d35;
    box-shadow: 0 0 0 3px rgba(18, 61, 53, 0.12);
    outline: 0;
}
.form-actions { display: flex; gap: 8px; margin-top: 18px; }
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
.ui-btn-light { background: #eef2f7; color: #374151; }
@media (max-width: 768px) {
    .form-header-panel, .profile-edit-row { align-items: flex-start; flex-direction: column; }
    .form-grid { grid-template-columns: 1fr; }
    .field-wide { grid-column: auto; }
}
</style>

<script>
document.getElementById("currentYear").textContent = new Date().getFullYear();
document.getElementById('profile_image').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        document.getElementById('profilePreview').src = URL.createObjectURL(file);
    }
});
</script>
@endsection
