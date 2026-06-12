<x-layout>
@include('components.auth_styles')

<main class="auth-page">
    <section class="auth-shell" aria-labelledby="forgotTitle">
        <div class="auth-brand">
            <img class="auth-logo" src="{{ asset('images/elimu.png') }}" alt="E-Learning logo">
            <h1 id="forgotTitle">Reset password</h1>
            <p>Enter your email and we will send a password reset link.</p>
        </div>

        <div class="auth-card">
            @if(session('status'))
                <div class="auth-alert auth-alert-success">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="auth-field">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="name@example.com" value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <span class="auth-error">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="auth-btn">
                    <i class="fas fa-envelope"></i> Send Reset Link
                </button>
            </form>

            <div class="auth-footer-link">
                Remember your password?
                <a href="{{ route('loginForm') }}">Sign in</a>
            </div>
        </div>

        <div class="auth-home">
            <a class="auth-link" href="{{ route('home') }}"><i class="fas fa-arrow-left"></i> Back to home</a>
        </div>
    </section>
</main>
</x-layout>
