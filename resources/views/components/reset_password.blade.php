@extends('components.dashmaster')

@section('body')

<div class="content-wrapper form-page">
    <div class="container-fluid form-shell">
        <div class="form-header-panel">
            <div>
                <h1><i class="fas fa-key"></i> Reset Password</h1>
                <p>Create a new password for {{ $user->firstname }} {{ $user->lastname }}.</p>
            </div>
            <a href="/viewUser/{{ $user->id }}" class="ui-btn ui-btn-light"><i class="fas fa-arrow-left"></i> Profile</a>
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

        <div class="form-card reset-card">
            <div class="user-strip">
                <img src="{{ $user->profile_image ? asset('uploads/profile_images/' . $user->profile_image) : asset('dist/img/avatar5.png') }}" alt="User Avatar">
                <div>
                    <strong>{{ $user->firstname }} {{ $user->secondname }} {{ $user->lastname }}</strong>
                    <span>{{ $user->email }} · {{ ucfirst($user->role) }}</span>
                </div>
            </div>

            <form action="{{ route('admin.updatePassword', $user->id) }}" method="POST" id="resetForm">
                @csrf
                <div class="form-grid">
                    <div class="field">
                        <label for="password">New Password</label>
                        <div class="password-field">
                            <input type="password" name="password" id="password" minlength="8" required>
                            <button type="button" data-toggle-password="password"><i class="fas fa-eye"></i></button>
                        </div>
                    </div>
                    <div class="field">
                        <label for="password_confirmation">Confirm Password</label>
                        <div class="password-field">
                            <input type="password" name="password_confirmation" id="password_confirmation" minlength="8" required>
                            <button type="button" data-toggle-password="password_confirmation"><i class="fas fa-eye"></i></button>
                        </div>
                    </div>
                </div>

                <p class="helper-text">Use at least 8 characters. Share the new password securely with the user.</p>

                <div class="form-actions">
                    <button type="submit" class="ui-btn ui-btn-primary"><i class="fas fa-shield-alt"></i> Reset Password</button>
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
.form-header-panel p, .helper-text, .user-strip span { color: #6b7280; margin: 4px 0 0; }
.form-card { max-width: 760px; padding: 18px; }
.user-strip {
    align-items: center;
    background: #f8fafc;
    border: 1px solid #eef2f7;
    border-radius: 8px;
    display: flex;
    gap: 12px;
    margin-bottom: 16px;
    padding: 12px;
}
.user-strip img { border-radius: 50%; height: 48px; object-fit: cover; width: 48px; }
.user-strip strong { color: #172033; display: block; }
.form-grid { display: grid; gap: 14px; grid-template-columns: 1fr 1fr; }
.field label {
    color: #374151;
    display: block;
    font-size: 12px;
    font-weight: 800;
    margin-bottom: 6px;
}
.password-field { position: relative; }
.password-field input {
    border: 1px solid #d1d5db;
    border-radius: 6px;
    color: #172033;
    height: 38px;
    padding: 7px 42px 7px 10px;
    width: 100%;
}
.password-field input:focus {
    border-color: #123d35;
    box-shadow: 0 0 0 3px rgba(18, 61, 53, 0.12);
    outline: 0;
}
.password-field button {
    background: transparent;
    border: 0;
    color: #6b7280;
    height: 38px;
    position: absolute;
    right: 6px;
    top: 0;
    width: 32px;
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
    .form-header-panel { align-items: flex-start; flex-direction: column; }
    .form-grid { grid-template-columns: 1fr; }
}
</style>

<script>
document.getElementById("currentYear").textContent = new Date().getFullYear();
document.querySelectorAll('[data-toggle-password]').forEach(function(button) {
    button.addEventListener('click', function() {
        const input = document.getElementById(button.dataset.togglePassword);
        const icon = button.querySelector('i');
        input.type = input.type === 'password' ? 'text' : 'password';
        icon.classList.toggle('fa-eye');
        icon.classList.toggle('fa-eye-slash');
    });
});
</script>
@endsection
