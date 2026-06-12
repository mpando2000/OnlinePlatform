<x-layout>
@include('components.auth_styles')

<main class="auth-page">
    <section class="auth-shell" aria-labelledby="resetTitle">
        <div class="auth-brand">
            <img class="auth-logo" src="{{ asset('images/elimu.png') }}" alt="E-Learning logo">
            <h1 id="resetTitle">Create new password</h1>
            <p>Use a strong password with at least 8 characters.</p>
        </div>

        <div class="auth-card">
            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="auth-field">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $email) }}" required autofocus>
                    @error('email')
                        <span class="auth-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="auth-field auth-password">
                    <label for="password">New Password</label>
                    <div class="auth-input-wrap">
                        <input type="password" name="password" id="password" required minlength="8">
                        <button type="button" class="auth-eye" data-toggle-password="password" aria-label="Show password">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <span class="auth-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="auth-field auth-password">
                    <label for="password_confirmation">Confirm New Password</label>
                    <div class="auth-input-wrap">
                        <input type="password" name="password_confirmation" id="password_confirmation" required minlength="8">
                        <button type="button" class="auth-eye" data-toggle-password="password_confirmation" aria-label="Show password confirmation">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password_confirmation')
                        <span class="auth-error">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="auth-btn">
                    <i class="fas fa-key"></i> Reset Password
                </button>
            </form>

            <div class="auth-footer-link">
                Back to
                <a href="{{ route('loginForm') }}">sign in</a>
            </div>
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
</script>
</x-layout>
