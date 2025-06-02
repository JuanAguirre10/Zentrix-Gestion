 
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-2 d-none d-md-block bg-dark sidebar">
            <div class="sidebar-sticky">
                <h4 class="text-white text-center py-3">Panel de Control</h4>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i> Centro de Control
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white active" href="{{ route('estudiantes.index') }}">
                            <i class="fas fa-user-graduate"></i> Estudiantes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('apoderados.index') }}">
                            <i class="fas fa-users"></i> Apoderados
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('cursos.index') }}">
                            <i class="fas fa-book"></i> Cursos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('matriculas.index') }}">
                            <i class="fas fa-clipboard-list"></i> Matrículas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('pagos.index') }}">
                            <i class="fas fa-money-bill"></i> Pagos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('horarios.index') }}">
                            <i class="fas fa-clock"></i> Horarios
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Contenido Principal -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Detalles del Estudiante</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group mr-2">
                        <a href="{{ route('estudiantes.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver al Listado
                        </a>
                        <a href="{{ route('estudiantes.edit', $estudiante) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                    </div>
                </div>
            </div>

            <!-- Información del Estudiante -->
            <div class="row">
                <!-- Datos Personales -->
                <div class="col-lg-6">
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="fas fa-user"></i> Datos Personales</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>ID Estudiante:</strong></td>
                                    <td>{{ $estudiante->id_estudiante }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Nombres:</strong></td>
                                    <td>{{ $estudiante->nombres }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Apellidos:</strong></td>
                                    <td>{{ $estudiante->apellidos }}</td>
                                </tr>
                                <tr>
                                    <td><strong>DNI:</strong></td>
                                    <td>{{ $estudiante->dni ?? 'No registrado' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Fecha de Nacimiento:</strong></td>
                                    <td>
                                        @if($estudiante->fecha_nacimiento)
                                            {{ \Carbon\Carbon::parse($estudiante->fecha_nacimiento)->format('d/m/Y') }}
                                            <small class="text-muted">
                                                ({{ \Carbon\Carbon::parse($estudiante->fecha_nacimiento)->age }} años)
                                            </small>
                                        @else
                                            No registrada
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Centro de Estudios:</strong></td>
                                    <td>{{ $estudiante->centro_estudios ?? 'No especificado' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Estado:</strong></td>
                                    <td>
                                        @if($estudiante->activo)
                                            <span class="badge badge-success">Activo</span>
                                        @else
                                            <span class="badge badge-danger">Inactivo</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Información Académica -->
                <div class="col-lg-6">
                    <div class="card mb-4">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0"><i class="fas fa-graduation-cap"></i> Información Académica</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Nivel Educativo:</strong></td>
                                    <td>
                                        @if($estudiante->gradoEscolar && $estudiante->gradoEscolar->nivelEducativo)
                                            {{ $estudiante->gradoEscolar->nivelEducativo->nombre_nivel }}
                                        @else
                                            No asignado
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Grado Escolar:</strong></td>
                                    <td>
                                        @if($estudiante->gradoEscolar)
                                            {{ $estudiante->gradoEscolar->nombre_grado }}
                                        @else
                                            No asignado
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Fecha de Registro:</strong></td>
                                    <td>{{ $estudiante->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Última Actualización:</strong></td>
                                    <td>{{ $estudiante->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Información del Apoderado -->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0"><i class="fas fa-user-friends"></i> Información del Apoderado</h5>
                        </div>
                        <div class="card-body">
                            @if($estudiante->apoderado)
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tr>
                                                <td><strong>Nombres:</strong></td>
                                                <td>{{ $estudiante->apoderado->nombres }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Apellidos:</strong></td>
                                                <td>{{ $estudiante->apoderado->apellidos }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>DNI:</strong></td>
                                                <td>{{ $estudiante->apoderado->dni ?? 'No registrado' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Parentesco:</strong></td>
                                                <td>
                                                    <span class="badge badge-primary">
                                                        {{ ucfirst($estudiante->apoderado->parentesco) }}
                                                    </span>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tr>
                                                <td><strong>Teléfono:</strong></td>
                                                <td>{{ $estudiante->apoderado->telefono ?? 'No registrado' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Celular:</strong></td>
                                                <td>{{ $estudiante->apoderado->celular ?? 'No registrado' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Email:</strong></td>
                                                <td>{{ $estudiante->apoderado->email ?? 'No registrado' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Ocupación:</strong></td>
                                                <td>{{ $estudiante->apoderado->ocupacion ?? 'No especificada' }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <strong>Dirección:</strong>
                                        <p>{{ $estudiante->apoderado->direccion ?? 'No registrada' }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <a href="{{ route('apoderados.show', $estudiante->apoderado) }}" class="btn btn-outline-info btn-sm">
                                        <i class="fas fa-eye"></i> Ver Perfil Completo del Apoderado
                                    </a>
                                </div>
                            @else
                                <div class="alert alert-warning">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    Este estudiante no tiene un apoderado asignado.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Matrículas del Estudiante -->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header bg-warning text-dark">
                            <h5 class="mb-0"><i class="fas fa-clipboard-list"></i> Historial de Matrículas</h5>
                        </div>
                        <div class="card-body">
                            @if($estudiante->matriculas && $estudiante->matriculas->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Fecha</th>
                                                <th>Monto Total</th>
                                                <th>Descuento</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($estudiante->matriculas as $matricula)
                                            <tr>
                                                <td>{{ $matricula->id_matricula ?? $matricula->id }}</td>
                                                <td>{{ \Carbon\Carbon::parse($matricula->fecha_matricula)->format('d/m/Y') }}</td>
                                                <td>S/ {{ number_format($matricula->monto_total, 2) }}</td>
                                                <td>{{ $matricula->descuento_porcentaje }}%</td>
                                                <td>
                                                    @switch($matricula->estado)
                                                        @case('activa')
                                                            <span class="badge badge-success">Activa</span>
                                                            @break
                                                        @case('inactiva')
                                                            <span class="badge badge-secondary">Inactiva</span>
                                                            @break
                                                        @case('suspendida')
                                                            <span class="badge badge-danger">Suspendida</span>
                                                            @break
                                                        @default
                                                            <span class="badge badge-light">{{ $matricula->estado }}</span>
                                                    @endswitch
                                                </td>
                                                <td>
                                                    <a href="{{ route('matriculas.show', $matricula) }}" class="btn btn-info btn-sm">
                                                        <i class="fas fa-eye"></i> Ver
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle"></i>
                                    Este estudiante aún no tiene matrículas registradas.
                                    <a href="{{ route('matriculas.create') }}" class="btn btn-primary btn-sm ml-2">
                                        <i class="fas fa-plus"></i> Crear Primera Matrícula
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Observaciones -->
            @if($estudiante->observaciones)
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header bg-secondary text-white">
                            <h5 class="mb-0"><i class="fas fa-sticky-note"></i> Observaciones</h5>
                        </div>
                        <div class="card-body">
                            <p class="mb-0">{{ $estudiante->observaciones }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Botones de Acción -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body text-center">
                            <a href="{{ route('estudiantes.edit', $estudiante) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Editar Estudiante
                            </a>
                            <a href="{{ route('matriculas.create') }}?estudiante={{ $estudiante->id_estudiante }}" class="btn btn-success">
                                <i class="fas fa-plus"></i> Nueva Matrícula
                            </a>
                            <a href="{{ route('estudiantes.index') }}" class="btn btn-secondary">
                                <i class="fas fa-list"></i> Volver al Listado
                            </a>
                            <form action="{{ route('estudiantes.destroy', $estudiante) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Está seguro de eliminar este estudiante? Esta acción no se puede deshacer.')">
                                    <i class="fas fa-trash"></i> Eliminar Estudiante
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection