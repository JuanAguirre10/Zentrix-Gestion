@extends('layouts.app')

@section('title', 'Editar Estudiante')

@section('header', 'Editar Estudiante')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Formulario de Edición</h5>
    </div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('estudiantes.update', $estudiante->id_estudiante) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="nombres" class="form-label">Nombres</label>
                    <input type="text" class="form-control" id="nombres" name="nombres" value="{{ old('nombres', $estudiante->nombres) }}" required>
                </div>
                <div class="col-md-6">
                    <label for="apellidos" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" id="apellidos" name="apellidos" value="{{ old('apellidos', $estudiante->apellidos) }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="dni" class="form-label">DNI</label>
                    <input type="text" class="form-control" id="dni" name="dni" value="{{ old('dni', $estudiante->dni) }}">
                </div>
                <div class="col-md-4">
                    <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento', $estudiante->fecha_nacimiento) }}">
                </div>
                <div class="col-md-4">
                    <label for="centro_estudios" class="form-label">Centro de Estudios</label>
                    <input type="text" class="form-control" id="centro_estudios" name="centro_estudios" value="{{ old('centro_estudios', $estudiante->centro_estudios) }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="id_apoderado" class="form-label">Apoderado</label>
                    <select class="form-control" id="id_apoderado" name="id_apoderado" required>
                        <option value="">Seleccionar apoderado</option>
                        @if(isset($apoderados))
                            @foreach($apoderados as $apoderado)
                                <option value="{{ $apoderado->id_apoderado }}" 
                                    {{ old('id_apoderado', $estudiante->id_apoderado) == $apoderado->id_apoderado ? 'selected' : '' }}>
                                    {{ $apoderado->nombres }} {{ $apoderado->apellidos }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="id_grado" class="form-label">Grado Escolar</label>
                    <select class="form-control" id="id_grado" name="id_grado" required>
                        <option value="">Seleccionar grado</option>
                        @if(isset($grados))
                            @foreach($grados as $grado)
                                <option value="{{ $grado->id_grado }}" 
                                    {{ old('id_grado', $estudiante->id_grado) == $grado->id_grado ? 'selected' : '' }}>
                                    {{ $grado->nombre_grado }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="observaciones" class="form-label">Observaciones</label>
                    <textarea class="form-control" id="observaciones" name="observaciones" rows="3">{{ old('observaciones', $estudiante->observaciones) }}</textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Actualizar Estudiante
                    </button>
                    <a href="{{ route('estudiantes.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-1"></i> Cancelar
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection