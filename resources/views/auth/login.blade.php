@extends('layouts.guest')

@section('content')
<div class="login-container">
    <div class="login-card">
        <div class="login-header">
            <div class="logo-container">
                <i class="fas fa-graduation-cap"></i>
                <h2>Zentrix</h2>
            </div>
            <p class="subtitle">Sistema de Gestión Académica</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="login-form">
            @csrf

            <!-- Email Address -->
            <div class="form-group">
                <label for="email" class="form-label">
                    <i class="fas fa-envelope"></i>
                    Correo Electrónico
                </label>
                <input id="email" 
                       class="form-control @error('email') is-invalid @enderror" 
                       type="email" 
                       name="email" 
                       value="{{ old('email') }}" 
                       required 
                       autofocus 
                       autocomplete="username"
                       placeholder="ejemplo@correo.com">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password" class="form-label">
                    <i class="fas fa-lock"></i>
                    Contraseña
                </label>
                <div class="password-input-container">
                    <input id="password" 
                           class="form-control @error('password') is-invalid @enderror"
                           type="password"
                           name="password"
                           required 
                           autocomplete="current-password"
                           placeholder="••••••••">
                    <button type="button" class="password-toggle" onclick="togglePassword()">
                        <i class="fas fa-eye" id="toggleIcon"></i>
                    </button>
                </div>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="form-group">
                <label for="remember_me" class="checkbox-label">
                    <input id="remember_me" type="checkbox" class="checkbox" name="remember">
                    <span class="checkmark"></span>
                    Recordarme
                </label>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary btn-login">
                    <i class="fas fa-sign-in-alt"></i>
                    Iniciar Sesión
                </button>

                @if (Route::has('password.request'))
                    <a class="forgot-password" href="{{ route('password.request') }}">
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif
            </div>
        </form>

        <div class="register-link">
            <p>¿No tienes una cuenta? 
                <a href="{{ route('register') }}">Regístrate aquí</a>
            </p>
        </div>
    </div>
</div>

<script>
function togglePassword() {
    const password = document.getElementById('password');
    const toggleIcon = document.getElementById('toggleIcon');
    
    if (password.type === 'password') {
        password.type = 'text';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    } else {
        password.type = 'password';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    }
}
</script>
@endsection