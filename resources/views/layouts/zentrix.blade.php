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
   
   <!-- TU CSS ORIGINAL EXACTO -->
   <style>
/* Colores del tema */
:root {
 --primary-color: #3a86ff;
 --secondary-color: #4361ee;
 --success-color: #38b000;
 --warning-color: #ffb703;
 --danger-color: #d90429;
 --info-color: #4cc9f0;
 --light-color: #f8f9fa;
 --dark-color: #212529;
 --white-color: #ffffff;
 --gray-100: #f8f9fa;
 --gray-200: #e9ecef;
 --gray-300: #dee2e6;
 --gray-800: #343a40;
 --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
 --radius: 0.5rem;
}

/* Layout general */
body {
 font-family: 'Nunito', sans-serif;
 background-color: #f5f7fa;
}

/* Barra de navegación */
.navbar {
 box-shadow: 0 2px 4px rgba(0,0,0,.08);
 height: 60px;
}

.navbar-brand {
 font-weight: 700;
 font-size: 1.4rem;
 letter-spacing: -0.5px;
}

/* Sidebar */
.sidebar {
 background: linear-gradient(180deg, var(--dark-color) 0%, #2c3e50 100%);
 box-shadow: var(--shadow);
 overflow-y: auto;
 min-height: calc(100vh - 60px);
 padding-top: 0.5rem;
 padding-bottom: 2rem;
}

.sidebar .sidebar-heading {
 padding: 1.2rem 1.5rem;
 font-size: 1.2rem;
 font-weight: 600;
 color: var(--white-color);
 border-bottom: 1px solid rgba(255,255,255,0.1);
 margin-bottom: 1rem;
}

.sidebar .nav-item {
 margin-bottom: 0.5rem; /* Espacio entre elementos de menú */
}

.sidebar a {
 color: rgba(255, 255, 255, 0.8);
 border-radius: 0.5rem;
 margin: 0.3rem 0.8rem;
 padding: 0.9rem 1.2rem; /* Padding aumentado */
 border-radius: var(--radius);
 transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
 display: flex;
 align-items: center;
 text-decoration: none;
}

.sidebar a:hover, .sidebar .active {
 background-color: rgba(255, 255, 255, 0.15);
 color: var(--white-color);
 transform: translateX(5px);
 box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.sidebar .active {
 background-color: var(--primary-color);
 color: var(--white-color);
 box-shadow: 0 2px 5px rgba(0,0,0,0.15);
 position: relative;
 overflow: hidden;
}

.sidebar .active::before {
 content: "";
 position: absolute;
 left: 0;
 top: 0;
 height: 100%;
 width: 4px;
 background-color: #fff;
 border-radius: 0 2px 2px 0;
}

.sidebar i {
 width: 24px;
 text-align: center;
 margin-right: 12px; /* Aumentado el espacio entre icono y texto */
 font-size: 1.1rem; /* Iconos ligeramente más grandes */
}

/* Espacio entre secciones del sidebar */
.sidebar .nav-divider {
 height: 1px;
 background-color: rgba(255,255,255,0.1);
 margin: 1rem 1.5rem;
}

/* Tarjetas de estadísticas */
.stat-card {
 border-radius: var(--radius);
 box-shadow: var(--shadow);
 border: none;
 overflow: hidden;
 transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.stat-card:hover {
 transform: translateY(-5px);
 box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
}

.stat-card .card-body {
 padding: 1.5rem;
}

.stat-card .stat-icon {
 width: 60px;
 height: 60px;
 display: flex;
 align-items: center;
 justify-content: center;
 font-size: 2rem;
 border-radius: 50%;
 background-color: rgba(255, 255, 255, 0.2);
}

.stat-card .stat-value {
 font-size: 2.5rem;
 font-weight: 700;
 margin-bottom: 0.5rem;
}

.stat-card .stat-label {
 font-size: 1rem;
 font-weight: 600;
 margin-bottom: 0.5rem;
 text-transform: uppercase;
 letter-spacing: 1px;
}

.stat-card .card-footer {
 background-color: transparent;
 border-top: 1px solid rgba(0, 0, 0, 0.05);
 padding: 0.75rem 1.5rem;
}

.stat-card .card-footer a {
 color: inherit;
 text-decoration: none;
 display: flex;
 justify-content: space-between;
 align-items: center;
 font-weight: 600;
 font-size: 0.9rem;
}

.stat-card .card-footer a:hover {
 color: var(--primary-color);
}

/* Colores de tarjetas */
.bg-primary-gradient {
 background: linear-gradient(45deg, #3a86ff, #4361ee);
 color: white;
}

.bg-success-gradient {
 background: linear-gradient(45deg, #38b000, #70e000);
 color: white;
}

.bg-warning-gradient {
 background: linear-gradient(45deg, #ffb703, #fd9e02);
 color: white;
}

.bg-danger-gradient {
 background: linear-gradient(45deg, #d90429, #ef233c);
 color: white;
}

/* Tablas */
.table {
 border-radius: var(--radius);
 overflow: hidden;
 box-shadow: var(--shadow);
}

.table thead th {
 background-color: var(--gray-200);
 border-bottom: 2px solid var(--gray-300);
 font-weight: 600;
 text-transform: uppercase;
 font-size: 0.8rem;
 letter-spacing: 1px;
}

.table-hover tbody tr:hover {
 background-color: rgba(0, 123, 255, 0.05);
}

/* Secciones */
.section-title {
 font-size: 1.2rem;
 font-weight: 700;
 margin-bottom: 1rem;
 padding-bottom: 0.5rem;
 border-bottom: 2px solid var(--primary-color);
 display: inline-block;
}

/* Distribución de estudiantes */
.distribution-card {
 text-align: center;
 padding: 2rem;
 background-color: var(--white-color);
 border-radius: var(--radius);
 box-shadow: var(--shadow);
 transition: transform 0.3s ease;
}

.distribution-card:hover {
 transform: translateY(-5px);
}

.distribution-card .level-name {
 font-weight: 700;
 margin-bottom: 1rem;
 color: var(--dark-color);
}

.distribution-card .count {
 font-size: 3rem;
 font-weight: 700;
 color: var(--primary-color);
 margin-bottom: 0.5rem;
}

.distribution-card .label {
 font-size: 0.9rem;
 color: var(--gray-800);
}

/* Animaciones */
@keyframes fadeIn {
 from { opacity: 0; transform: translateY(10px); }
 to { opacity: 1; transform: translateY(0); }
}

.animate-fadeIn {
 animation: fadeIn 0.5s ease forwards;
}

/* Altura mínima del contenido principal */
main {
 min-height: calc(100vh - 60px);
}
   </style>
   @yield('styles')
</head>
<body>
   <!-- Barra de navegación -->
   <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
       <div class="container-fluid">
           <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Zentrix Grupo de Estudios</a>
           <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
               <span class="navbar-toggler-icon"></span>
           </button>
           <div class="collapse navbar-collapse" id="navbarNav">
               <ul class="navbar-nav ms-auto">
                   <li class="nav-item dropdown">
                       <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                           <i class="fas fa-user-circle me-2"></i>{{ Auth::user()->name }}
                       </a>
                       <ul class="dropdown-menu dropdown-menu-end">
                           <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fas fa-cog me-2"></i>Configuración</a></li>
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
                           <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
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
           </main>
       </div>
   </div>

   <!-- Bootstrap JS -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
   @yield('scripts')
</body>
</html>