@extends('layouts.guest')

@section('content')
<div class="login-page">
    <div class="login-card fade-in">
        <div class="login-header">
            <div class="login-icon">
                <i class="bi bi-cup-hot-fill"></i>
            </div>
            <h3>Welcome Back</h3>
            <p>Sign in to your account to continue</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="form-label">Email Address</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0">
                        <i class="bi bi-envelope-fill text-muted"></i>
                    </span>
                    <input id="email" type="email" class="form-control border-start-0 @error('email') is-invalid @enderror"
                           name="email" value="{{ old('email') }}" placeholder="Enter your email" required autofocus>
                </div>
                @error('email')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0">
                        <i class="bi bi-lock-fill text-muted"></i>
                    </span>
                    <input id="password" type="password" class="form-control border-start-0 @error('password') is-invalid @enderror"
                           name="password" placeholder="Enter your password" required>
                </div>
                @error('password')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4 d-flex justify-content-between align-items-center">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label" for="remember">Remember Me</label>
                </div>
            </div>

            <button type="submit" class="btn-login">
                <i class="bi bi-box-arrow-in-right me-2"></i>Sign In
            </button>
        </form>
    </div>
</div>
@endsection
