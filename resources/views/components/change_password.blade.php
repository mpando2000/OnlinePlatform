@extends('components.dashmaster')

@section('body')
<div class="content-wrapper student-page">
    <div class="container-fluid page-shell form-shell">
        <div class="page-panel">
            <div>
                <h1><i class="fas fa-key"></i> Change Password</h1>
                <p>Update your account password.</p>
            </div>
            <button type="button" class="ui-btn ui-btn-light" onclick="history.back()"><i class="fas fa-arrow-left"></i> Back</button>
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

        <section class="panel-card form-card">
            <form action="{{ route('change.password.submit') }}" method="POST">
                @csrf
                <div class="field password-field">
                    <label>Current Password</label>
                    <input type="password" name="current_password" id="current_password" required>
                    <button type="button" data-toggle-password="current_password"><i class="fas fa-eye"></i></button>
                </div>
                <div class="field password-field">
                    <label>New Password</label>
                    <input type="password" name="new_password" id="new_password" minlength="8" required>
                    <button type="button" data-toggle-password="new_password"><i class="fas fa-eye"></i></button>
                </div>
                <div class="field password-field">
                    <label>Confirm New Password</label>
                    <input type="password" name="new_password_confirmation" id="new_password_confirmation" minlength="8" required>
                    <button type="button" data-toggle-password="new_password_confirmation"><i class="fas fa-eye"></i></button>
                </div>
                <div class="form-actions">
                    <button type="submit" class="ui-btn ui-btn-primary"><i class="fas fa-save"></i> Change Password</button>
                    <button type="button" class="ui-btn ui-btn-light" onclick="history.back()"><i class="fas fa-times"></i> Cancel</button>
                </div>
            </form>
        </section>
    </div>
</div>

<footer class="main-footer"><strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong> All rights reserved.</footer>
@include('student.partials.clean-styles')
<script>
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
