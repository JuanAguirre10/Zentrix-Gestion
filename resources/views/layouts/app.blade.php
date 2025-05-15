<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Zentrix') - Gestión Académica</title>
    <!-- Fuentes -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    @yield('styles')
</head>
<body>
    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('dashboard') }}">Zentrix Grupo de Estudios</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-2"></i>Usuario
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Configuración</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt me-2"></i>Cerrar sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 px-0 sidebar">
                <div class="d-flex flex-column">
                    <div class="sidebar-heading">Panel de Control</div>
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                                <i class="fas fa-chart-line"></i> Centro de Control
                            </a>
                        </li>
                        
                        <div class="nav-divider"></div>
                        
                        <li class="nav-item">
                            <a href="{{ route('estudiantes.index') }}" class="{{ request()->routeIs('estudiantes.*') ? 'active' : '' }}">
                                <i class="fas fa-user-graduate"></i> Estudiantes
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('apoderados.index') }}" class="{{ request()->routeIs('apoderados.*') ? 'active' : '' }}">
                                <i class="fas fa-users"></i> Apoderados
                            </a>
                        </li>
                        
                        <div class="nav-divider"></div>
                        
                        <li class="nav-item">
                            <a href="{{ route('cursos.index') }}" class="{{ request()->routeIs('cursos.*') ? 'active' : '' }}">
                                <i class="fas fa-book"></i> Cursos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('matriculas.index') }}" class="{{ request()->routeIs('matriculas.*') ? 'active' : '' }}">
                                <i class="fas fa-clipboard-list"></i> Matrículas
                            </a>
                        </li>
                        
                        <div class="nav-divider"></div>
                        
                        <li class="nav-item">
                            <a href="{{ route('pagos.index') }}" class="{{ request()->routeIs('pagos.*') ? 'active' : '' }}">
                                <i class="fas fa-money-bill-wave"></i> Pagos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('horarios.index') }}" class="{{ request()->routeIs('horarios.*') ? 'active' : '' }}">
                                <i class="fas fa-clock"></i> Horarios
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Contenido principal -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                <div class="container">
                    <h1 class="mt-3 mb-4 fw-bold">@yield('header', 'Centro de Control')</h1>
                    
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>