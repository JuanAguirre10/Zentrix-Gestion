<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Zentrix') }} - @yield('title', 'Autenticación')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-color: #3a86ff;
            --secondary-color: #4361ee;
            --success-color: #38b000;
            --warning-color: #ffb703;
            --danger-color: #d90429;
            --white-color: #ffffff;
            --gray-100: #f8f9fa;
            --gray-200: #e9ecef;
            --gray-800: #343a40;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --radius: 0.5rem;
        }

        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            width: 100%;
            max-width: 450px;
            margin: 0 auto;
        }

        .login-card {
            background: var(--white-color);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            animation: slideUp 0.6s ease-out;
        }

        .register-card {
            max-width: 500px;
        }

        .forgot-card {
            max-width: 400px;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 2.5rem 2rem;
            text-align: center;
        }

        .logo-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            margin-bottom: 0.5rem;
        }

        .logo-container i {
            font-size: 2rem;
        }

        .logo-container h2 {
            margin: 0;
            font-weight: 700;
            font-size: 1.75rem;
        }

        .subtitle {
            margin: 0;
            opacity: 0.9;
            font-size: 0.95rem;
        }

        .login-form {
            padding: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 600;
            color: var(--gray-800);
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .form-control {
            border: 2px solid var(--gray-200);
            border-radius: var(--radius);
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background-color: var(--gray-100);
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(58, 134, 255, 0.25);
            background-color: white;
        }

        .form-control.is-invalid {
            border-color: var(--danger-color);
        }

        .invalid-feedback {
            display: block;
            color: var(--danger-color);
            font-size: 0.85rem;
            margin-top: 0.25rem;
        }

        .password-input-container {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--gray-800);
            cursor: pointer;
            padding: 0.25rem;
            border-radius: 4px;
            transition: color 0.2s ease;
        }

        .password-toggle:hover {
            color: var(--primary-color);
        }

        .checkbox-label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
            font-size: 0.9rem;
            color: var(--gray-800);
        }

        .checkbox {
            margin: 0;
        }

        .form-actions {
            margin-top: 2rem;
        }

        .btn-login {
            width: 100%;
            padding: 0.875rem;
            font-weight: 600;
            font-size: 1rem;
            border-radius: var(--radius);
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            border: none;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(58, 134, 255, 0.3);
            background: linear-gradient(135deg, #2c6fdd 0%, #3a4fd8 100%);
        }

        .forgot-password {
            display: block;
            text-align: center;
            margin-top: 1rem;
            color: var(--primary-color);
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.2s ease;
        }

        .forgot-password:hover {
            color: var(--secondary-color);
            text-decoration: underline;
        }

        .register-link {
            background: var(--gray-100);
            padding: 1.5rem 2rem;
            text-align: center;
            border-top: 1px solid var(--gray-200);
        }

        .register-link p {
            margin: 0;
            color: var(--gray-800);
            font-size: 0.9rem;
        }

        .register-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s ease;
        }

        .register-link a:hover {
            color: var(--secondary-color);
            text-decoration: underline;
        }

        .alert {
            border-radius: var(--radius);
            padding: 1rem;
            margin-bottom: 1.5rem;
            border: none;
        }

        .alert-success {
            background-color: rgba(56, 176, 0, 0.1);
            color: var(--success-color);
            border-left: 4px solid var(--success-color);
        }

        /* Responsive */
        @media (max-width: 480px) {
            .login-container {
                padding: 0 10px;
            }
            
            .login-header {
                padding: 2rem 1.5rem;
            }
            
            .login-form {
                padding: 1.5rem;
            }
            
            .register-link {
                padding: 1.25rem 1.5rem;
            }
        }
    </style>
</head>
<body>
    @yield('content')
</body>
</html>