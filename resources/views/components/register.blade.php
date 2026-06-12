<x-layout>
@include('components.auth_styles')

<main class="auth-page">
    <section class="auth-shell auth-shell-wide" aria-labelledby="registerTitle">
        <div class="auth-brand">
            <img class="auth-logo" src="{{ asset('images/elimu.png') }}" alt="E-Learning logo">
            <h1 id="registerTitle">Create account</h1>
            <p>Fill in your details. The admin will approve your account before access.</p>
        </div>

        <div class="auth-card">
            <form method="POST" action="{{ route('register') }}" id="registerForm">
                @csrf

                <div class="auth-grid">
                    <div class="auth-field">
                        <label for="firstname">First Name</label>
                        <input type="text" name="firstname" id="firstname" value="{{ old('firstname') }}" required autofocus>
                        @error('firstname') <span class="auth-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="auth-field">
                        <label for="secondname">Second Name</label>
                        <input type="text" name="secondname" id="secondname" value="{{ old('secondname') }}" required>
                        @error('secondname') <span class="auth-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="auth-field">
                        <label for="lastname">Last Name</label>
                        <input type="text" name="lastname" id="lastname" value="{{ old('lastname') }}" required>
                        @error('lastname') <span class="auth-error">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="auth-grid">
                    <div class="auth-field">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="name@example.com" required>
                        @error('email') <span class="auth-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="auth-field auth-password">
                        <label for="password">Password</label>
                        <div class="auth-input-wrap">
                            <input type="password" name="password" id="password" required minlength="8">
                            <button type="button" class="auth-eye" data-toggle-password="password" aria-label="Show password">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        @error('password') <span class="auth-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="auth-field auth-password">
                        <label for="password_confirmation">Confirm Password</label>
                        <div class="auth-input-wrap">
                            <input type="password" name="password_confirmation" id="password_confirmation" required minlength="8">
                            <button type="button" class="auth-eye" data-toggle-password="password_confirmation" aria-label="Show password confirmation">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        @error('password_confirmation') <span class="auth-error">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="auth-grid">
                    <div class="auth-field">
                        <label for="gender">Gender</label>
                        <select name="gender" id="gender" required>
                            <option value="" selected disabled>Select Gender</option>
                            <option value="male" @selected(old('gender') === 'male')>Male</option>
                            <option value="female" @selected(old('gender') === 'female')>Female</option>
                            <option value="other" @selected(old('gender') === 'other')>Other</option>
                        </select>
                        @error('gender') <span class="auth-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="auth-field">
                        <label for="school_id">School</label>
                        <select name="school_id" id="school_id" required>
                            <option value="" selected disabled>Select School</option>
                            @foreach($schools as $school)
                                <option value="{{ $school->id }}" @selected((string) old('school_id') === (string) $school->id)>{{ $school->name }}</option>
                            @endforeach
                        </select>
                        @error('school_id') <span class="auth-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="auth-field">
                        <label for="role">Role</label>
                        <select id="role" name="role" required>
                            <option value="" selected disabled>Select Role</option>
                            <option value="teacher" @selected(old('role') === 'teacher')>Teacher</option>
                            <option value="student" @selected(old('role') === 'student')>Student</option>
                        </select>
                        @error('role') <span class="auth-error">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="auth-field" id="classField">
                    <label for="class_id">Class</label>
                    <select id="class_id" name="class_id">
                        <option value="" selected disabled>Select Class</option>
                        @foreach($school_classes as $school_class)
                            <option value="{{ $school_class->id }}" @selected((string) old('class_id') === (string) $school_class->id)>{{ $school_class->name }}</option>
                        @endforeach
                    </select>
                    @error('class_id') <span class="auth-error">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="auth-btn">
                    <i class="fas fa-user-plus"></i> Create Account
                </button>
            </form>

            <div class="auth-footer-link">
                Already have an account?
                <a href="{{ route('loginForm') }}">Sign in</a>
            </div>
        </div>

        <div class="auth-home">
            <a class="auth-link" href="{{ route('home') }}"><i class="fas fa-arrow-left"></i> Back to home</a>
        </div>
    </section>
</main>

<script>
document.querySelectorAll('[data-toggle-password]').forEach(function(button) {
    button.addEventListener('click', function() {
        const input = document.getElementById(button.dataset.togglePassword);
        if (!input) return;

        input.type = input.type === 'password' ? 'text' : 'password';
        button.innerHTML = input.type === 'password'
            ? '<i class="fas fa-eye"></i>'
            : '<i class="fas fa-eye-slash"></i>';
    });
});

const roleSelect = document.getElementById('role');
const classField = document.getElementById('classField');
const classSelect = document.getElementById('class_id');

function toggleClassField() {
    if (!roleSelect || !classField || !classSelect) return;

    if (roleSelect.value === 'student') {
        classField.style.display = 'block';
        classSelect.setAttribute('required', 'required');
    } else {
        classField.style.display = 'none';
        classSelect.removeAttribute('required');
        classSelect.value = '';
    }
}

if (roleSelect) {
    roleSelect.addEventListener('change', toggleClassField);
    toggleClassField();
}
</script>
</x-layout>
