@extends('layouts.guest')

@section('content')
<div class="login-container">
    <div class="login-card register-card">
        <div class="login-header">
            <div class="logo-container">
                <i class="fas fa-user-plus"></i>
                <h2>Registro</h2>
            </div>
            <p class="subtitle">Crear cuenta en Zentrix</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="login-form">
            @csrf

            <!-- Name -->
            <div class="form-group">
                <label for="name" class="form-label">
                    <i class="fas fa-user"></i>
                    Nombre Completo
                </label>
                <input id="name" 
                       class="form-control @error('name') is-invalid @enderror" 
                       type="text" 
                       name="name" 
                       value="{{ old('name') }}" 
                       required 
                       autofocus 
                       autocomplete="name"
                       placeholder="Tu nombre completo">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

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
                           autocomplete="new-password"
                           placeholder="Mínimo 8 caracteres">
                    <button type="button" class="password-toggle" onclick="togglePassword('password')">
                        <i class="fas fa-eye" id="toggleIcon1"></i>
                    </button>
                </div>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label for="password_confirmation" class="form-label">
                    <i class="fas fa-lock"></i>
                    Confirmar Contraseña
                </label>
                <div class="password-input-container">
                    <input id="password_confirmation" 
                           class="form-control @error('password_confirmation') is-invalid @enderror"
                           type="password"
                           name="password_confirmation"
                           required 
                           autocomplete="new-password"
                           placeholder="Confirma tu contraseña">
                    <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation')">
                        <i class="fas fa-eye" id="toggleIcon2"></i>
                    </button>
                </div>
                @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary btn-login">
                    <i class="fas fa-user-plus"></i>
                    Crear Cuenta
                </button>
            </div>
        </form>

        <div class="register-link">
            <p>¿Ya tienes una cuenta? 
                <a href="{{ route('login') }}">Inicia sesión aquí</a>
            </p>
        </div>
    </div>
</div>

<script>
function togglePassword(fieldId) {
    const password = document.getElementById(fieldId);
    const toggleIcon = fieldId === 'password' ? document.getElementById('toggleIcon1') : document.getElementById('toggleIcon2');
    
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