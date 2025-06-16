<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Zentrix') - Gestión Académica</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            margin: 0;
            padding: 0;
        }

        /* Navbar superior */
        .top-navbar {
            background: linear-gradient(90deg, #007bff 0%, #0056b3 100%);
            color: white;
            padding: 12px 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            color: white !important;
            font-weight: 600;
            font-size: 18px;
        }

        .user-dropdown {
            color: white;
            text-decoration: none;
        }

        /* Layout principal */
        .main-layout {
            display: flex;
            min-height: calc(100vh - 56px);
        }

        /* Sidebar */
        .sidebar {
            background: linear-gradient(180deg, #2c3e50 0%, #34495e 100%);
            width: 250px;
            min-height: calc(100vh - 56px);
            padding: 0;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }

        .sidebar-header {
            background: rgba(0,0,0,0.1);
            color: white;
            padding: 20px;
            font-weight: 600;
            font-size: 16px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-menu li {
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .sidebar-menu a:hover {
            background: rgba(255,255,255,0.1);
            color: white;
            padding-left: 25px;
        }

        .sidebar-menu a.active {
            background: #007bff;
            color: white;
            box-shadow: inset 3px 0 0 #ffffff;
        }

        .sidebar-menu i {
            width: 20px;
            margin-right: 12px;
            text-align: center;
        }

        /* Contenido principal */
        .main-content {
            flex: 1;
            padding: 30px;
            background: #f5f7fa;
        }

        .page-title {
            font-size: 28px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 30px;
        }

        /* Tarjetas de estadísticas */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 8px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-card.primary {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            color: white;
        }

        .stat-card.success {
            background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
            color: white;
        }

        .stat-card.warning {
            background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);
            color: white;
        }

        .stat-card.danger {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            color: white;
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .stat-title {
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            opacity: 0.9;
        }

        .stat-icon {
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .stat-number {
            font-size: 36px;
            font-weight: 700;
            line-height: 1;
            margin-bottom: 8px;
        }

        .stat-footer {
            font-size: 12px;
            opacity: 0.9;
        }

        .stat-footer a {
            color: inherit;
            text-decoration: none;
        }

        /* Secciones */
        .content-section {
            background: white;
            border-radius: 8px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e9ecef;
        }

        /* Tabla */
        .table {
            margin-bottom: 0;
        }

        .table th {
            background: #f8f9fa;
            font-weight: 600;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            border: none;
            padding: 12px;
        }

        .table td {
            border: none;
            padding: 12px;
            vertical-align: middle;
        }

        /* Distribución de niveles */
        .level-distribution {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .level-card {
            text-align: center;
            padding: 25px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .level-name {
            font-size: 16px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .level-count {
            font-size: 32px;
            font-weight: 700;
            color: #007bff;
            margin-bottom: 5px;
        }

        .level-label {
            font-size: 12px;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .main-layout {
                flex-direction: column;
            }
            
            .sidebar {
                width: 100%;
                min-height: auto;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar superior -->
    <nav class="top-navbar d-flex justify-content-between align-items-center">
        <span class="navbar-brand">Zentrix Grupo de Estudios</span>
        <div class="dropdown">
            <a href="#" class="user-dropdown dropdown-toggle" data-bs-toggle="dropdown">
                <i class="fas fa-user-circle me-2"></i>{{ Auth::user()->name }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">
                    <i class="fas fa-cog me-2"></i>Configuración
                </a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            <i class="fas fa-sign-out-alt me-2"></i>Cerrar sesión
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Layout principal -->
    <div class="main-layout">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">Panel de Control</div>
            <ul class="sidebar-menu">
                <li>
                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-chart-line"></i> Centro de Control
                    </a>
                </li>
                <li>
                    <a href="{{ route('estudiantes.index') }}" class="{{ request()->routeIs('admin.estudiantes.*') ? 'active' : '' }}">
                        <i class="fas fa-user-graduate"></i> Estudiantes
                    </a>
                </li>
                <li>
                    <a href="{{ route('apoderados.index') }}" class="{{ request()->routeIs('admin.apoderados.*') ? 'active' : '' }}">
                        <i class="fas fa-users"></i> Apoderados
                    </a>
                </li>
                <li>
                    <a href="{{ route('cursos.index') }}" class="{{ request()->routeIs('admin.cursos.*') ? 'active' : '' }}">
                        <i class="fas fa-book"></i> Cursos
                    </a>
                </li>
                <li>
                    <a href="{{ route('matriculas.index') }}" class="{{ request()->routeIs('admin.matriculas.*') ? 'active' : '' }}">
                        <i class="fas fa-clipboard-list"></i> Matrículas
                    </a>
                </li>
                <li>
                    <a href="{{ route('pagos.index') }}" class="{{ request()->routeIs('admin.pagos.*') ? 'active' : '' }}">
                        <i class="fas fa-money-bill-wave"></i> Pagos
                    </a>
                </li>
                <li>
                    <a href="{{ route('horarios.index') }}" class="{{ request()->routeIs('admin.horarios.*') ? 'active' : '' }}">
                        <i class="fas fa-clock"></i> Horarios
                    </a>
                </li>
            </ul>
        </div>

        <!-- Contenido principal -->
        <div class="main-content">
            <h1 class="page-title">@yield('header', 'Centro de Control')</h1>
            
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>