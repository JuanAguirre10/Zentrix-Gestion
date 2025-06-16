@extends('layouts.guest')

@section('content')
<div class="login-container">
    <div class="login-card forgot-card">
        <div class="login-header">
            <div class="logo-container">
                <i class="fas fa-key"></i>
                <h2>Recuperar Contraseña</h2>
            </div>
            <p class="subtitle">Te enviaremos un enlace para restablecer tu contraseña</p>
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="login-form">
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
                       placeholder="ejemplo@correo.com">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary btn-login">
                    <i class="fas fa-paper-plane"></i>
                    Enviar Enlace
                </button>
            </div>
        </form>

        <div class="register-link">
            <p>¿Recordaste tu contraseña? 
                <a href="{{ route('login') }}">Volver al login</a>
            </p>
        </div>
    </div>
</div>
@endsection