@extends('layouts.app')

@section('title', 'Gestión de Horarios')

@section('header', 'Gestión de Horarios')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            @if($cursoSeleccionado)
                Horarios del curso: {{ $curso->nombre_curso }}
            @else
                Listado de Horarios
            @endif
        </h5>
        <a href="{{ route('horarios.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Nuevo Horario
        </a>
    </div>
    
    <div class="card-body">
        <!-- Filtro por curso -->
        <div class="row mb-3">
            <div class="col-md-6">
                <form method="GET" action="{{ route('horarios.index') }}" id="filtroForm">
                    <div class="input-group">
                        <label class="input-group-text" for="curso_id">
                            <i class="fas fa-filter"></i> Filtrar por curso:
                        </label>
                        <select class="form-select" id="curso_id" name="curso_id" onchange="document.getElementById('filtroForm').submit()">
                            <option value="">Todos los horarios</option>
                            @foreach($cursos as $curso)
                                <option value="{{ $curso->id_curso }}" 
                                    {{ $cursoSeleccionado == $curso->id_curso ? 'selected' : '' }}>
                                    {{ $curso->nombre_curso }} - {{ $curso->nivelEducativo->nombre_nivel ?? 'N/A' }}
                                </option>
                            @endforeach
                        </select>
                        @if($cursoSeleccionado)
                            <a href="{{ route('horarios.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times"></i> Limpiar
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        @if($horarios->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped table-hover">
    <thead class="bg-light text-black">

        <tr>
            <th>ID</th>
            <th>DÍA</th>
            <th>HORA INICIO</th>
            <th>HORA FIN</th>
            <th>SALÓN</th>
            <th>CUPO MÁXIMO</th>
            @if($cursoSeleccionado)
                <th>MATRICULADOS</th>
                <th>DISPONIBLES</th>
                <th>OCUPACIÓN</th>
                <th>ESTUDIANTES</th>
            @endif
            <th>ACCIONES</th>
        </tr>
    </thead>
    <tbody>
        @foreach($horarios as $horario)
            <tr>
                <td><strong>{{ $horario->id_horario }}</strong></td>
                <td>
                    <span class="badge bg-dark text-white">
                        {{ ucfirst($horario->dia_semana) }}
                    </span>
                </td>
                <td><strong>{{ $horario->hora_inicio }}</strong></td>
                <td><strong>{{ $horario->hora_fin }}</strong></td>
                <td>
                    <i class="fas fa-door-open me-1 text-primary"></i>
                    <strong>{{ $horario->salon }}</strong>
                </td>
                <td>
                    <span class="badge bg-dark text-white">
                        {{ $horario->cupo_max }}
                    </span>
                </td>
                
                @if($cursoSeleccionado)
                    <td>
                        <span class="badge bg-success text-white">
                            {{ $horario->estudiantes_matriculados }}
                        </span>
                    </td>
                    <td>
                        <span class="badge {{ $horario->cupos_disponibles > 0 ? 'bg-warning text-dark' : 'bg-danger text-white' }}">
                            {{ $horario->cupos_disponibles }}
                        </span>
                    </td>
                    <td>
                        <div class="progress" style="height: 25px;">
                            <div class="progress-bar 
                                {{ $horario->porcentaje_ocupacion >= 90 ? 'bg-danger' : 
                                   ($horario->porcentaje_ocupacion >= 70 ? 'bg-warning' : 'bg-success') }}" 
                                role="progressbar" 
                                style="width: {{ $horario->porcentaje_ocupacion }}%">
                                <strong class="text-dark">{{ $horario->porcentaje_ocupacion }}%</strong>
                            </div>
                        </div>
                    </td>
                    <td>
                        @if($horario->estudiantes_matriculados > 0)
                            <button class="btn btn-info btn-sm text-white" 
                                data-bs-toggle="collapse" 
                                data-bs-target="#estudiantes-{{ $horario->id_horario }}">
                                <i class="fas fa-users"></i> Ver ({{ $horario->estudiantes_matriculados }})
                            </button>
                        @else
                            <span class="text-muted"><strong>Sin estudiantes</strong></span>
                        @endif
                    </td>
                @endif
                
                <td>
                    <div class="btn-group" role="group">
                        <a href="{{ route('horarios.edit', $horario) }}" 
                           class="btn btn-warning btn-sm" title="Editar">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('horarios.destroy', $horario) }}" 
                              method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" 
                                onclick="return confirm('¿Eliminar este horario?')" title="Eliminar">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            
            @if($cursoSeleccionado && $horario->estudiantes_matriculados > 0)
                <tr>
                    <td colspan="{{ $cursoSeleccionado ? 11 : 7 }}">
                        <div class="collapse" id="estudiantes-{{ $horario->id_horario }}">
                            <div class="card card-body mt-2 bg-light">
                                <h6 class="text-dark"><strong>Estudiantes matriculados en este horario:</strong></h6>
                                <div class="row">
                                    @foreach($horario->detallesMatricula as $detalle)
                                        <div class="col-md-6 mb-2">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-user-graduate me-2 text-primary"></i>
                                                <div>
                                                    <strong class="text-dark">{{ $detalle->matricula->estudiante->nombres }} {{ $detalle->matricula->estudiante->apellidos }}</strong><br>
                                                    <small class="text-dark">
                                                        <strong>DNI:</strong> {{ $detalle->matricula->estudiante->dni ?? 'N/A' }} | 
                                                        <strong>Matrícula:</strong> #{{ $detalle->matricula->id_matricula }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endif
        @endforeach
    </tbody>
</table>
            </div>
        @else
            <div class="alert alert-info text-center">
                <i class="fas fa-info-circle fa-2x mb-3"></i>
                <h5>No hay horarios disponibles</h5>
                @if($cursoSeleccionado)
                    <p>No se encontraron horarios para el curso seleccionado.</p>
                    <a href="{{ route('horarios.index') }}" class="btn btn-primary">Ver todos los horarios</a>
                @else
                    <p>Comienza creando tu primer horario.</p>
                    <a href="{{ route('horarios.create') }}" class="btn btn-primary">Crear Horario</a>
                @endif
            </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
// Auto-submit del filtro cuando cambia la selección
document.getElementById('curso_id').addEventListener('change', function() {
    document.getElementById('filtroForm').submit();
});
</script>
@endsection