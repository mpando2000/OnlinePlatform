@extends('components.dashmaster')

@section('body')
<div class="content-wrapper teacher-page">
    <div class="container-fluid page-shell form-shell">
        <div class="page-panel">
            <div>
                <h1><i class="fas fa-user-edit"></i> Edit User</h1>
                <p>{{ $user->name }}</p>
            </div>
            <a href="/teacher/viewUser/{{ $user->id }}" class="ui-btn ui-btn-soft">
                <i class="fas fa-arrow-left"></i> Profile
            </a>
        </div>

        @if($errors->any())
            <div class="alert alert-danger panel-alert">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <section class="panel-card form-card">
            <form action="/teacher/editedUser/{{ $user->id }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-grid">
                    <div class="field">
                        <label for="firstname">First Name</label>
                        <input id="firstname" type="text" name="firstname" value="{{ old('firstname', $user->firstname) }}" required>
                    </div>
                    <div class="field">
                        <label for="secondname">Second Name</label>
                        <input id="secondname" type="text" name="secondname" value="{{ old('secondname', $user->secondname) }}">
                    </div>
                    <div class="field">
                        <label for="lastname">Last Name</label>
                        <input id="lastname" type="text" name="lastname" value="{{ old('lastname', $user->lastname) }}" required>
                    </div>
                    <div class="field">
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" required>
                    </div>
                    <div class="field">
                        <label for="gender">Gender</label>
                        <select id="gender" name="gender" required>
                            <option value="">Select gender</option>
                            @foreach(['male' => 'Male', 'female' => 'Female'] as $value => $label)
                                <option value="{{ $value }}" {{ old('gender', strtolower($user->gender ?? '')) === $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="field">
                        <label for="role">Role</label>
                        <select id="role" name="role" required>
                            <option value="teacher" {{ old('role', $user->role) === 'teacher' ? 'selected' : '' }}>Teacher</option>
                            <option value="student" {{ old('role', $user->role) === 'student' ? 'selected' : '' }}>Student</option>
                        </select>
                    </div>
                    <div class="field">
                        <label for="school_id">School</label>
                        <select id="school_id" name="school_id">
                            <option value="">Not assigned</option>
                            @foreach($schools as $school)
                                <option value="{{ $school->id }}" {{ (string) old('school_id', $user->school_id) === (string) $school->id ? 'selected' : '' }}>{{ $school->name }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="school" value="{{ old('school', $user->school) }}">
                    </div>
                    <div class="field" id="classField">
                        <label for="class_id">Class</label>
                        <select id="class_id" name="class_id">
                            <option value="">Not assigned</option>
                            @foreach($school_classes as $school_class)
                                <option value="{{ $school_class->id }}" {{ (string) old('class_id', $user->class_id) === (string) $school_class->id ? 'selected' : '' }}>{{ $school_class->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="ui-btn ui-btn-primary">
                        <i class="fas fa-save"></i> Save Changes
                    </button>
                    <a href="/teacher/viewUser/{{ $user->id }}" class="ui-btn ui-btn-soft">
                        <i class="fas fa-times"></i> Cancel
                    </a>
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
(function () {
    const role = document.getElementById("role");
    const classField = document.getElementById("classField");
    const classInput = document.getElementById("class_id");

    function syncClassField() {
        const isStudent = role.value === "student";
        classField.hidden = !isStudent;
        classInput.required = isStudent;
        if (!isStudent) classInput.value = "";
    }

    role.addEventListener("change", syncClassField);
    syncClassField();
})();
</script>
@endsection
