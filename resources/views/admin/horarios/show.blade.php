@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
    

        <!-- Contenido Principal -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Detalles del Horario</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group mr-2">
                        <a href="{{ route('horarios.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver al Listado
                        </a>
                        <a href="{{ route('horarios.edit', $horario) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                    </div>
                </div>
            </div>

            <!-- Información del Horario -->
            <div class="row">
                <!-- Datos Principales -->
                <div class="col-lg-6">
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="fas fa-clock"></i> Información del Horario</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>ID Horario:</strong></td>
                                    <td>{{ $horario->id_horario ?? $horario->id }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Día de la Semana:</strong></td>
                                    <td>
                                        <span class="badge badge-info">
                                            @switch($horario->dia_semana)
                                                @case('lunes') Lunes @break
                                                @case('martes') Martes @break
                                                @case('miercoles') Miércoles @break
                                                @case('jueves') Jueves @break
                                                @case('viernes') Viernes @break
                                                @case('sabado') Sábado @break
                                                @case('domingo') Domingo @break
                                                @default {{ ucfirst($horario->dia_semana) }}
                                            @endswitch
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Hora de Inicio:</strong></td>
                                    <td>
                                        <span class="badge badge-success">
                                            {{ \Carbon\Carbon::parse($horario->hora_inicio)->format('H:i') }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Hora de Fin:</strong></td>
                                    <td>
                                        <span class="badge badge-danger">
                                            {{ \Carbon\Carbon::parse($horario->hora_fin)->format('H:i') }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Duración:</strong></td>
                                    <td>
                                        @php
                                            $inicio = \Carbon\Carbon::parse($horario->hora_inicio);
                                            $fin = \Carbon\Carbon::parse($horario->hora_fin);
                                            $duracion = $inicio->diffInMinutes($fin);
                                            $horas = intval($duracion / 60);
                                            $minutos = $duracion % 60;
                                        @endphp
                                        <span class="badge badge-warning">
                                            {{ $horas }}h {{ $minutos }}min
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Salón:</strong></td>
                                    <td>{{ $horario->salon ?? 'No especificado' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Cupo Máximo:</strong></td>
                                    <td>
                                        @if($horario->cupo_maximo)
                                            <span class="badge badge-secondary">{{ $horario->cupo_maximo }} estudiantes</span>
                                        @else
                                            Sin límite
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Estado y Metadatos -->
                <div class="col-lg-6">
                    <div class="card mb-4">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0"><i class="fas fa-info-circle"></i> Estado y Detalles</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Estado:</strong></td>
                                    <td>
                                        @if($horario->activo ?? true)
                                            <span class="badge badge-success">Activo</span>
                                        @else
                                            <span class="badge badge-danger">Inactivo</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Fecha de Creación:</strong></td>
                                    <td>{{ $horario->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Última Actualización:</strong></td>
                                    <td>{{ $horario->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Modalidad:</strong></td>
                                    <td>
                                        @if($horario->modalidad ?? false)
                                            {{ ucfirst($horario->modalidad) }}
                                        @else
                                            Presencial
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Resumen Visual -->
                    <div class="card mb-4">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0"><i class="fas fa-calendar-alt"></i> Resumen Semanal</h5>
                        </div>
                        <div class="card-body text-center">
                            <div class="row">
                                <div class="col-12">
                                    <h3 class="text-primary">
                                        @switch($horario->dia_semana)
                                            @case('lunes') LUNES @break
                                            @case('martes') MARTES @break
                                            @case('miercoles') MIÉRCOLES @break
                                            @case('jueves') JUEVES @break
                                            @case('viernes') VIERNES @break
                                            @case('sabado') SÁBADO @break
                                            @case('domingo') DOMINGO @break
                                            @default {{ strtoupper($horario->dia_semana) }}
                                        @endswitch
                                    </h3>
                                    <p class="h4">
                                        {{ \Carbon\Carbon::parse($horario->hora_inicio)->format('H:i') }} - 
                                        {{ \Carbon\Carbon::parse($horario->hora_fin)->format('H:i') }}
                                    </p>
                                    @if($horario->salon)
                                        <p class="text-muted">
                                            <i class="fas fa-map-marker-alt"></i> {{ $horario->salon }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cursos Asignados (si existe relación) -->
            @if(isset($horario->cursos) && $horario->cursos->count() > 0)
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header bg-warning text-dark">
                            <h5 class="mb-0"><i class="fas fa-book"></i> Cursos Asignados</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Curso</th>
                                            <th>Nivel</th>
                                            <th>Duración</th>
                                            <th>Precio</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($horario->cursos as $curso)
                                        <tr>
                                            <td>{{ $curso->nombre_curso }}</td>
                                            <td>{{ $curso->nivelEducativo->nombre_nivel ?? 'No asignado' }}</td>
                                            <td>{{ $curso->duracion ?? 'No especificada' }}</td>
                                            <td>S/ {{ number_format($curso->precio, 2) }}</td>
                                            <td>
                                                @if($curso->activo)
                                                    <span class="badge badge-success">Activo</span>
                                                @else
                                                    <span class="badge badge-secondary">Inactivo</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Observaciones -->
            @if($horario->observaciones ?? false)
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header bg-secondary text-white">
                            <h5 class="mb-0"><i class="fas fa-sticky-note"></i> Observaciones</h5>
                        </div>
                        <div class="card-body">
                            <p class="mb-0">{{ $horario->observaciones }}</p>
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
                            <a href="{{ route('horarios.edit', $horario) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Editar Horario
                            </a>
                            <a href="{{ route('horarios.create') }}" class="btn btn-success">
                                <i class="fas fa-plus"></i> Nuevo Horario
                            </a>
                            <a href="{{ route('horarios.index') }}" class="btn btn-secondary">
                                <i class="fas fa-list"></i> Volver al Listado
                            </a>
                            <form action="{{ route('horarios.destroy', $horario) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Está seguro de eliminar este horario?')">
                                    <i class="fas fa-trash"></i> Eliminar
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