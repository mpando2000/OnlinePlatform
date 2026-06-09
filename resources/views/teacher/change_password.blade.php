@extends('components.dashmaster')

@section('body')
<div class="content-wrapper teacher-page">
    <div class="container-fluid page-shell form-shell">
        <div class="page-panel">
            <div>
                <h1><i class="fas fa-key"></i> Change Password</h1>
                <p>Update your account password.</p>
            </div>
            <a href="{{ route('teacher.dashboard') }}" class="ui-btn ui-btn-soft">
                <i class="fas fa-arrow-left"></i> Dashboard
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success panel-alert">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger panel-alert">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <section class="panel-card form-card">
            <form action="{{ route('teacher.change.password.submit') }}" method="POST">
                @csrf
                <div class="field password-field">
                    <label for="current_password">Current Password</label>
                    <input id="current_password" type="password" name="current_password" required>
                    <button type="button" class="icon-btn password-toggle" data-target="current_password" aria-label="Show current password">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <div class="field password-field">
                    <label for="new_password">New Password</label>
                    <input id="new_password" type="password" name="new_password" required>
                    <button type="button" class="icon-btn password-toggle" data-target="new_password" aria-label="Show new password">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <div class="field password-field">
                    <label for="new_password_confirmation">Confirm New Password</label>
                    <input id="new_password_confirmation" type="password" name="new_password_confirmation" required>
                    <button type="button" class="icon-btn password-toggle" data-target="new_password_confirmation" aria-label="Show password confirmation">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <div class="form-actions">
                    <button type="submit" class="ui-btn ui-btn-primary">
                        <i class="fas fa-save"></i> Save Password
                    </button>
                </div>
            </form>
        </section>
    </div>
</div>

<footer class="main-footer clean-footer">
    <strong>&copy; <span id="currentYear"></span> E-Learning Management System.</strong> All rights reserved.
</footer>

@include('teacher.partials.clean-styles')
<script>
document.querySelectorAll(".password-toggle").forEach((button) => {
    button.addEventListener("click", () => {
        const input = document.getElementById(button.dataset.target);
        input.type = input.type === "password" ? "text" : "password";
    });
});
</script>
@endsection
