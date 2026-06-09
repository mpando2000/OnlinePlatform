@extends('components.dashmaster')

@section('body')

<div class="content-wrapper form-page">
    <div class="container-fluid form-shell">
        <div class="form-header-panel">
            <div>
                <h1><i class="fas fa-user-plus"></i> Add User</h1>
                <p>Create a teacher or student account.</p>
            </div>
            <a href="{{ route('admin.users') }}" class="ui-btn ui-btn-light"><i class="fas fa-arrow-left"></i> Users</a>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <div class="form-card">
            <form method="POST" action="{{ route('admin.addUser') }}" id="userForm">
                @csrf
                <div class="form-grid">
                    <div class="field">
                        <label>First Name</label>
                        <input type="text" name="firstname" value="{{ old('firstname') }}" required>
                    </div>
                    <div class="field">
                        <label>Second Name</label>
                        <input type="text" name="secondname" value="{{ old('secondname') }}" required>
                    </div>
                    <div class="field">
                        <label>Last Name</label>
                        <input type="text" name="lastname" value="{{ old('lastname') }}" required>
                    </div>
                    <div class="field">
                        <label>Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required>
                    </div>
                    <div class="field">
                        <label>Gender</label>
                        <select name="gender" required>
                            <option value="">Select Gender</option>
                            <option value="male" @selected(old('gender') === 'male')>Male</option>
                            <option value="female" @selected(old('gender') === 'female')>Female</option>
                            <option value="other" @selected(old('gender') === 'other')>Other</option>
                        </select>
                    </div>
                    <div class="field">
                        <label>School</label>
                        <select name="school_id" required>
                            <option value="">Select School</option>
                            @foreach($schools as $school)
                                <option value="{{ $school->id }}" @selected((string) old('school_id') === (string) $school->id)>{{ $school->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="field">
                        <label>Role</label>
                        <select id="role" name="role" required>
                            <option value="">Select Role</option>
                            <option value="teacher" @selected(old('role') === 'teacher')>Teacher</option>
                            <option value="student" @selected(old('role') === 'student')>Student</option>
                        </select>
                    </div>
                    <div class="field" id="classField">
                        <label>Class</label>
                        <select id="class_id" name="class_id">
                            <option value="">Select Class</option>
                            @foreach($school_classes as $school_class)
                                <option value="{{ $school_class->id }}" @selected((string) old('class_id') === (string) $school_class->id)>{{ $school_class->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="field">
                        <label>Password</label>
                        <div class="password-field">
                            <input type="password" name="password" id="password" minlength="8" required>
                            <button type="button" data-toggle-password="password"><i class="fas fa-eye"></i></button>
                        </div>
                    </div>
                    <div class="field">
                        <label>Confirm Password</label>
                        <div class="password-field">
                            <input type="password" name="password_confirmation" id="password_confirmation" minlength="8" required>
                            <button type="button" data-toggle-password="password_confirmation"><i class="fas fa-eye"></i></button>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="ui-btn ui-btn-primary"><i class="fas fa-user-plus"></i> Create User</button>
                    <a href="{{ route('admin.users') }}" class="ui-btn ui-btn-light"><i class="fas fa-times"></i> Cancel</a>
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
.form-header-panel, .form-card { background: #fff; border: 1px solid #e5e7eb; border-radius: 8px; }
.form-header-panel { align-items: center; display: flex; justify-content: space-between; gap: 18px; margin-bottom: 14px; padding: 16px 18px; }
.form-header-panel h1 { color: #172033; font-size: 22px; font-weight: 800; margin: 0; }
.form-header-panel h1 i { color: #123d35; margin-right: 8px; }
.form-header-panel p { color: #6b7280; margin: 4px 0 0; }
.form-card { max-width: 1050px; padding: 18px; }
.form-grid { display: grid; gap: 14px; grid-template-columns: repeat(3, minmax(0, 1fr)); }
.field label { color: #374151; display: block; font-size: 12px; font-weight: 800; margin-bottom: 6px; }
.field input, .field select {
    border: 1px solid #d1d5db;
    border-radius: 6px;
    color: #172033;
    height: 38px;
    padding: 7px 10px;
    width: 100%;
}
.field input:focus, .field select:focus {
    border-color: #123d35;
    box-shadow: 0 0 0 3px rgba(18, 61, 53, 0.12);
    outline: 0;
}
.password-field { position: relative; }
.password-field input { padding-right: 42px; }
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
.ui-btn { align-items: center; border: 0; border-radius: 6px; display: inline-flex; font-weight: 800; gap: 7px; min-height: 36px; padding: 8px 12px; }
.ui-btn:hover { text-decoration: none; }
.ui-btn-primary { background: #123d35; color: #fff; }
.ui-btn-primary:hover { background: #1f6f5b; color: #fff; }
.ui-btn-light { background: #eef2f7; color: #374151; }
@media (max-width: 900px) { .form-grid { grid-template-columns: 1fr; } .form-header-panel { align-items: flex-start; flex-direction: column; } }
</style>

<script>
document.getElementById("currentYear").textContent = new Date().getFullYear();
const role = document.getElementById('role');
const classField = document.getElementById('classField');
const classSelect = document.getElementById('class_id');
function toggleClassField() {
    if (role.value === 'student') {
        classField.style.display = 'block';
        classSelect.setAttribute('required', 'required');
    } else {
        classField.style.display = 'none';
        classSelect.removeAttribute('required');
        classSelect.value = '';
    }
}
role.addEventListener('change', toggleClassField);
toggleClassField();
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
