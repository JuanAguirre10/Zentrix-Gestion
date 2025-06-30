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
        :root {
            --primary-blue: #007bff;
            --secondary-blue: #0056b3;
            --accent-gold: #ffc107;
            --light-blue: #e8f4fd;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            margin: 0;
            padding: 0;
        }

        /* Navbar superior mejorado */
        .top-navbar {
    background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
    color: white;
    padding: 20px 25px;
    box-shadow: 0 4px 20px rgba(0,123,255,0.3);
    position: relative;
    overflow: visible;
}

        .top-navbar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="2" fill="rgba(255,255,255,0.1)"/><circle cx="80" cy="40" r="1.5" fill="rgba(255,255,255,0.1)"/><circle cx="40" cy="70" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="70" cy="80" r="2.5" fill="rgba(255,255,255,0.1)"/></svg>') repeat;
            animation: float 20s infinite linear;
        }

        @keyframes float {
            0% { transform: translateX(0) translateY(0); }
            100% { transform: translateX(-100px) translateY(-50px); }
        }

        .navbar-brand-container {
            display: flex;
            align-items: center;
            gap: 15px;
            position: relative;
            z-index: 2;
        }

        .logo-image {
    width: 65px;
    height: 65px;
    background: white;
    border-radius: 50%;
    padding: 8px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.3);
    transition: transform 0.3s ease;
    border: 3px solid rgba(255,255,255,0.4);
}

        .logo-image:hover {
            transform: scale(1.1) rotate(5deg);
        }

        .brand-text {
            color: white;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .brand-title {
    font-size: 1.8rem;
    margin: 0;
    letter-spacing: 2px;
    font-weight: 700;
}

        .brand-subtitle {
            font-size: 0.8rem;
            opacity: 0.9;
            margin: 0;
            font-weight: 300;
            letter-spacing: 0.5px;
        }

        .user-dropdown {
            color: white;
            text-decoration: none;
            background: rgba(255,255,255,0.2);
            border: 1px solid rgba(255,255,255,0.3);
            backdrop-filter: blur(10px);
            border-radius: 25px;
            padding: 8px 15px;
            transition: all 0.3s ease;
            position: relative;
            z-index: 2;
        }
        

        .user-dropdown:hover {
            background: rgba(255,255,255,0.3);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            color: white;
        }

        /* Layout principal */
        .main-layout {
            display: flex;
            min-height: calc(100vh - 80px);
        }

        /* Sidebar */
        .sidebar {
            background: linear-gradient(180deg, #2c3e50 0%, #34495e 100%);
            width: 250px;
            min-height: calc(100vh - 80px);
            padding: 0;
            box-shadow: 4px 0 15px rgba(0,0,0,0.1);
        }

        .sidebar-header {
            background: rgba(0,0,0,0.2);
            color: white;
            padding: 20px;
            font-weight: 600;
            font-size: 16px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            text-align: center;
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
            position: relative;
        }

        .sidebar-menu a:hover {
            background: rgba(255,255,255,0.1);
            color: white;
            padding-left: 25px;
        }

        .sidebar-menu a.active {
            background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
            color: white;
            box-shadow: inset 3px 0 0 var(--accent-gold);
        }

        .sidebar-menu a.active::before {
            content: '';
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 0;
            height: 0;
            border-top: 10px solid transparent;
            border-bottom: 10px solid transparent;
            border-right: 10px solid #f5f7fa;
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
            background: linear-gradient(135deg, #f5f7fa 0%, #e9ecef 100%);
        }

        .page-title {
            font-size: 28px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .page-title::before {
            content: '';
            width: 4px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary-blue), var(--accent-gold));
            border-radius: 2px;
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
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            border: 1px solid rgba(255,255,255,0.2);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        }

        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.15);
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
            width: 45px;
            height: 45px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            backdrop-filter: blur(10px);
        }

        .stat-number {
            font-size: 36px;
            font-weight: 700;
            line-height: 1;
            margin-bottom: 8px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }

        .stat-footer {
            font-size: 12px;
            opacity: 0.9;
        }

        .stat-footer a {
            color: inherit;
            text-decoration: none;
            transition: opacity 0.3s ease;
        }

        .stat-footer a:hover {
            opacity: 1;
        }

        /* Secciones */
        .content-section {
            background: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            border-left: 4px solid var(--primary-blue);
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e9ecef;
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 50px;
            height: 2px;
            background: var(--primary-blue);
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
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
            border-top: 3px solid var(--primary-blue);
        }

        .level-card:hover {
            transform: translateY(-5px);
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
            color: var(--primary-blue);
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
            .navbar-brand-container {
                gap: 10px;
            }
            
            .brand-title {
                font-size: 1.2rem;
            }
            
            .brand-subtitle {
                display: none;
            }
            
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
        <div class="navbar-brand-container">
            <img src="{{ asset('images/zentrix-logo.png') }}" alt="Zentrix Logo" class="logo-image">
            <div class="brand-text">
                <div class="brand-title">ZENTRIX</div>
                <div class="brand-subtitle">GRUPO DE ESTUDIOS</div>
            </div>
        </div>
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
                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="fas fa-chart-line"></i> Centro de Control
                    </a>
                </li>
                <li>
                    <a href="{{ route('estudiantes.index') }}" class="{{ request()->routeIs('estudiantes.*') ? 'active' : '' }}">
                        <i class="fas fa-user-graduate"></i> Estudiantes
                    </a>
                </li>
                <li>
                    <a href="{{ route('apoderados.index') }}" class="{{ request()->routeIs('apoderados.*') ? 'active' : '' }}">
                        <i class="fas fa-users"></i> Apoderados
                    </a>
                </li>
                <li>
                    <a href="{{ route('cursos.index') }}" class="{{ request()->routeIs('cursos.*') ? 'active' : '' }}">
                        <i class="fas fa-book"></i> Cursos
                    </a>
                </li>
                <li>
                    <a href="{{ route('matriculas.index') }}" class="{{ request()->routeIs('matriculas.*') ? 'active' : '' }}">
                        <i class="fas fa-clipboard-list"></i> Matrículas
                    </a>
                </li>
                <li>
                    <a href="{{ route('pagos.index') }}" class="{{ request()->routeIs('pagos.*') ? 'active' : '' }}">
                        <i class="fas fa-money-bill-wave"></i> Pagos
                    </a>
                </li>
                <li>
                    <a href="{{ route('horarios.index') }}" class="{{ request()->routeIs('horarios.*') ? 'active' : '' }}">
                        <i class="fas fa-clock"></i> Horarios
                    </a>
                </li>
            </ul>
        </div>

        <!-- Contenido principal -->
        <div class="main-content">
            <h1 class="page-title">@yield('header', 'Centro de Control')</h1>
            
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
    <!-- Footer -->
    <footer class="main-footer">
        <div class="footer-content">
            <div class="container-fluid">
                <div class="row">
                    <!-- Logo y descripción -->
                    <div class="col-md-4 footer-section">
                        <div class="footer-brand">
    <img src="{{ asset('images/zentrix-logo.png') }}" alt="Zentrix Logo" class="footer-logo">
    <div class="footer-brand-text">
        <h5>ZENTRIX</h5>
        <span>GRUPO DE ESTUDIOS</span>
    </div>
</div>
                        <p class="footer-description">
    Sistema integral de gestión académica diseñado para optimizar la administración 
    educativa y mejorar la experiencia de aprendizaje.
</p>
<div class="live-info">
    <div class="current-time">
        <i class="fas fa-clock me-2"></i>
        <span id="live-time">--:--:--</span>
    </div>
    <div class="current-date">
        <i class="fas fa-calendar me-2"></i>
        <span id="live-date">Cargando fecha...</span>
    </div>
</div>
                        <div class="social-links">
                            <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>

                    <!-- Enlaces rápidos -->
                    <div class="col-md-2 footer-section">
                        <h6 class="footer-title">Gestión</h6>
                        <ul class="footer-links">
                            <li><a href="{{ route('estudiantes.index') }}">Estudiantes</a></li>
                            <li><a href="{{ route('matriculas.index') }}">Matrículas</a></li>
                            <li><a href="{{ route('pagos.index') }}">Pagos</a></li>
                            <li><a href="{{ route('cursos.index') }}">Cursos</a></li>
                            <li><a href="{{ route('horarios.index') }}">Horarios</a></li>
                        </ul>
                    </div>

                    <!-- Información -->
                    <div class="col-md-3 footer-section">
                        <h6 class="footer-title">Información</h6>
                        <ul class="footer-links">
                            <li><a href="#" data-bs-toggle="modal" data-bs-target="#aboutModal">Acerca del Sistema</a></li>
                            <li><a href="#" data-bs-toggle="modal" data-bs-target="#helpModal">Centro de Ayuda</a></li>
                            <li><a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">Términos de Uso</a></li>
                            <li><a href="#" data-bs-toggle="modal" data-bs-target="#privacyModal">Privacidad</a></li>
                            <li><a href="{{ route('profile.edit') }}">Configuración</a></li>
                        </ul>
                    </div>

                    <!-- Contacto y estadísticas -->
                    <div class="col-md-3 footer-section">
                        <h6 class="footer-title">Contacto</h6>
                        <div class="contact-info">
                            <div class="contact-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Av. Principal 123<br>Lima, Perú</span>
                            </div>
                            <div class="contact-item">
                                <i class="fas fa-phone"></i>
                                <span>+51 1 234-5678</span>
                            </div>
                            <div class="contact-item">
                                <i class="fas fa-envelope"></i>
                                <span>contacto@zentrix.edu.pe</span>
                            </div>
                        </div>
                        
                        <div class="system-stats">
                            <div class="stat-item">
                                <span class="stat-number">{{ \App\Models\Estudiante::count() ?? 0 }}</span>
                                <span class="stat-label">Estudiantes</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">{{ \App\Models\Curso::count() ?? 0 }}</span>
                                <span class="stat-label">Cursos</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="footer-bottom">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p class="copyright">
                            © {{ date('Y') }} <strong>Zentrix Grupo de Estudios</strong>. 
                            Todos los derechos reservados.
                        </p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <div class="footer-meta">
                            <span class="version">Versión 1.0.0</span>
                            <span class="separator">|</span>
                            <span class="last-update">Última actualización: {{ date('d/m/Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Modales informativos -->
    
    <!-- Modal Acerca del Sistema -->
    <div class="modal fade" id="aboutModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-info-circle me-2"></i>Acerca del Sistema
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <img src="{{ asset('images/zentrix-logo.png') }}" alt="Zentrix Logo" style="width: 80px;">
                        <h4 class="mt-3">Sistema de Gestión Académica Zentrix</h4>
                        <p class="text-muted">Versión 1.0.0</p>
                    </div>
                    
                    <p>El Sistema de Gestión Académica Zentrix es una plataforma integral diseñada para facilitar la administración educativa mediante herramientas modernas y eficientes.</p>
                    
                    <h6>Características principales:</h6>
                    <ul>
                        <li>Gestión completa de estudiantes y apoderados</li>
                        <li>Administración de matrículas y pagos</li>
                        <li>Control de cursos y horarios</li>
                        <li>Reportes y estadísticas en tiempo real</li>
                        <li>Interfaz intuitiva y responsive</li>
                    </ul>
                    
                    <div class="mt-4 p-3 bg-light rounded">
                        <h6>Información técnica:</h6>
                        <p class="mb-0">
                            <strong>Framework:</strong> Laravel {{ app()->version() }}<br>
                            <strong>PHP:</strong> {{ PHP_VERSION }}<br>
                            <strong>Base de datos:</strong> MySQL<br>
                            <strong>Desarrollado:</strong> 2025
                        </p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Centro de Ayuda -->
    <div class="modal fade" id="helpModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-question-circle me-2"></i>Centro de Ayuda
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6><i class="fas fa-book me-2"></i>Guías de Usuario</h6>
                            <ul class="list-unstyled">
                                <li><a href="#" class="text-decoration-none">📝 Registrar estudiantes</a></li>
                                <li><a href="#" class="text-decoration-none">💳 Gestionar pagos</a></li>
                                <li><a href="#" class="text-decoration-none">📚 Administrar cursos</a></li>
                                <li><a href="#" class="text-decoration-none">📊 Generar reportes</a></li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h6><i class="fas fa-tools me-2"></i>Soporte Técnico</h6>
                            <ul class="list-unstyled">
                                <li><a href="#" class="text-decoration-none">🔧 Problemas técnicos</a></li>
                                <li><a href="#" class="text-decoration-none">🆘 Solicitar ayuda</a></li>
                                <li><a href="#" class="text-decoration-none">📞 Contactar soporte</a></li>
                                <li><a href="#" class="text-decoration-none">💬 Chat en vivo</a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="mt-4 p-3 bg-primary text-white rounded">
                        <h6><i class="fas fa-lightbulb me-2"></i>¿Necesitas ayuda rápida?</h6>
                        <p class="mb-2">Usa estos atajos del teclado:</p>
                        <div class="row">
                            <div class="col-6">
                                <small><kbd>Ctrl + E</kbd> Nuevo estudiante</small><br>
                                <small><kbd>Ctrl + M</kbd> Nueva matrícula</small>
                            </div>
                            <div class="col-6">
                                <small><kbd>Ctrl + P</kbd> Nuevo pago</small><br>
                                <small><kbd>Ctrl + /</kbd> Buscar</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">Contactar Soporte</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Términos de Uso -->
    <div class="modal fade" id="termsModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-file-contract me-2"></i>Términos de Uso
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
                    <h6>1. Aceptación de los Términos</h6>
                    <p>Al utilizar el Sistema de Gestión Académica Zentrix, usted acepta cumplir con estos términos de uso.</p>
                    
                    <h6>2. Uso Autorizado</h6>
                    <p>Este sistema está destinado exclusivamente para la gestión académica de Zentrix Grupo de Estudios y su uso está restringido a personal autorizado.</p>
                    
                    <h6>3. Responsabilidades del Usuario</h6>
                    <ul>
                        <li>Mantener la confidencialidad de sus credenciales de acceso</li>
                        <li>Usar el sistema de manera responsable y ética</li>
                        <li>No compartir información confidencial</li>
                        <li>Reportar cualquier problema de seguridad</li>
                    </ul>
                    
                    <h6>4. Protección de Datos</h6>
                    <p>Toda la información ingresada en el sistema está protegida y se maneja de acuerdo con las leyes de protección de datos vigentes.</p>
                    
                    <h6>5. Modificaciones</h6>
                    <p>Zentrix se reserva el derecho de modificar estos términos en cualquier momento.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Política de Privacidad -->
    <div class="modal fade" id="privacyModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-shield-alt me-2"></i>Política de Privacidad
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
                    <h6>Recopilación de Información</h6>
                    <p>Recopilamos información necesaria para la gestión académica, incluyendo datos de estudiantes, apoderados y transacciones académicas.</p>
                    
                    <h6>Uso de la Información</h6>
                    <p>La información se utiliza exclusivamente para:</p>
                    <ul>
                        <li>Gestión académica y administrativa</li>
                        <li>Comunicación con estudiantes y apoderados</li>
                        <li>Generación de reportes estadísticos</li>
                        <li>Cumplimiento de obligaciones legales</li>
                    </ul>
                    
                    <h6>Protección de Datos</h6>
                    <p>Implementamos medidas de seguridad técnicas y organizativas para proteger la información personal.</p>
                    
                    <h6>Derechos del Usuario</h6>
                    <p>Los usuarios tienen derecho a acceder, rectificar, cancelar y oponerse al tratamiento de sus datos personales.</p>
                    
                    <h6>Contacto</h6>
                    <p>Para consultas sobre privacidad, contacte a: privacidad@zentrix.edu.pe</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <style>
    /* Footer Styles */
    .main-footer {
        background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
        color: white;
        margin-top: auto;
        box-shadow: 0 -4px 20px rgba(0,0,0,0.1);
    }

    .footer-content {
        padding: 40px 0 20px;
    }

    .footer-section {
        margin-bottom: 30px;
    }

    .footer-brand {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 20px;
    }

    .footer-logo {
    width: 90px;
    height: 90px;
    background: white;
    border-radius: 50%;
    padding: 10px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.4);
}

    .footer-brand-text h5 {
        margin: 0;
        font-size: 1.2rem;
        font-weight: 700;
        letter-spacing: 1px;
    }

    .footer-brand-text span {
        font-size: 0.8rem;
        opacity: 0.8;
        letter-spacing: 0.5px;
    }

    .footer-description {
        color: rgba(255,255,255,0.8);
        font-size: 0.9rem;
        line-height: 1.6;
        margin-bottom: 20px;
    }
    .live-info {
    background: rgba(255,255,255,0.1);
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 20px;
    border-left: 4px solid #ffc107;
}

.current-time, .current-date {
    color: rgba(255,255,255,0.9);
    font-size: 0.9rem;
    margin-bottom: 5px;
}

.current-time {
    font-size: 1.1rem;
    font-weight: 600;
    color: #ffc107;
}

    .social-links {
        display: flex;
        gap: 10px;
    }

    .social-link {
        width: 40px;
        height: 40px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .social-link:hover {
        background: #007bff;
        color: white;
        transform: translateY(-2px);
    }

    .footer-title {
        color: #ffc107;
        font-weight: 600;
        margin-bottom: 20px;
        font-size: 1.1rem;
    }

    .footer-links {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-links li {
        margin-bottom: 8px;
    }

    .footer-links a {
        color: rgba(255,255,255,0.8);
        text-decoration: none;
        font-size: 0.9rem;
        transition: color 0.3s ease;
    }

    .footer-links a:hover {
        color: #ffc107;
        padding-left: 5px;
    }

    .contact-info {
        margin-bottom: 20px;
    }

    .contact-item {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin-bottom: 12px;
        font-size: 0.9rem;
        color: rgba(255,255,255,0.8);
    }

    .contact-item i {
        color: #ffc107;
        width: 16px;
        margin-top: 2px;
    }

    .system-stats {
        display: flex;
        gap: 20px;
        padding: 15px;
        background: rgba(255,255,255,0.1);
        border-radius: 8px;
    }

    .stat-item {
        text-align: center;
    }

    .stat-number {
        display: block;
        font-size: 1.5rem;
        font-weight: 700;
        color: #ffc107;
    }

    .stat-label {
        font-size: 0.8rem;
        color: rgba(255,255,255,0.8);
    }

    .footer-bottom {
        background: rgba(0,0,0,0.3);
        padding: 15px 0;
        border-top: 1px solid rgba(255,255,255,0.1);
    }

    .copyright {
        margin: 0;
        font-size: 0.9rem;
        color: rgba(255,255,255,0.8);
    }

    .footer-meta {
        font-size: 0.8rem;
        color: rgba(255,255,255,0.6);
    }

    .separator {
        margin: 0 10px;
    }

    .version {
        background: #007bff;
        padding: 2px 8px;
        border-radius: 12px;
        font-size: 0.7rem;
    }

    /* Modal customizations */
    .modal-header {
        background: linear-gradient(135deg, #007bff, #0056b3);
        color: white;
        border-bottom: none;
    }

    .modal-header .btn-close {
        filter: invert(1);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .footer-content {
            padding: 30px 0 15px;
        }
        
        .footer-brand {
            justify-content: center;
            text-align: center;
        }
        
        .social-links {
            justify-content: center;
        }
        
        .system-stats {
            justify-content: center;
        }
        
        .footer-meta {
            text-align: center !important;
            margin-top: 10px;
        }
    }

    /* Ajuste del layout para que el footer se mantenga abajo */
    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    .main-layout {
        flex: 1;
    }
    
    </style>
    <script>
function updateTime() {
    const now = new Date();
    
    const time = now.toLocaleTimeString('es-PE', {
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        hour12: true
    });
    
    const date = now.toLocaleDateString('es-PE', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
    
    document.getElementById('live-time').innerHTML = time;
    document.getElementById('live-date').innerHTML = date;
}

// Ejecutar inmediatamente
updateTime();

// Actualizar cada segundo
setInterval(updateTime, 1000);
</script>
</body>
</html>