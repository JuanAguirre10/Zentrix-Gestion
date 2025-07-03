@extends('layouts.app')

@section('title', 'Nuevo Estudiante')

@section('header', 'Registrar Nuevo Estudiante')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Formulario de Registro</h5>
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

        <form action="{{ route('estudiantes.store') }}" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="nombres" class="form-label">Nombres</label>
                    <input type="text" class="form-control" id="nombres" name="nombres" value="{{ old('nombres') }}" required>
                </div>
                <div class="col-md-6">
                    <label for="apellidos" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" id="apellidos" name="apellidos" value="{{ old('apellidos') }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="dni" class="form-label">DNI</label>
                    <input type="text" class="form-control" id="dni" name="dni" value="{{ old('dni') }}">
                </div>
                <div class="col-md-4">
                    <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}">
                </div>
                <div class="col-md-4">
    <label for="id_apoderado" class="form-label">Apoderado</label>
    <select class="form-select" id="id_apoderado" name="id_apoderado">
        @foreach($apoderadosCompletos as $apoderado)
            <option value="{{ $apoderado->id_apoderado }}" 
                {{ (old('id_apoderado', 1) == $apoderado->id_apoderado) ? 'selected' : '' }}>
                @if($apoderado->id_apoderado == 1)
                    Sin Apoderado (Asignar después)
                @else
                    {{ $apoderado->nombres }} {{ $apoderado->apellidos }}
                @endif
            </option>
        @endforeach
    </select>
</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
    <label for="id_grado" class="form-label">Grado</label>
    <select class="form-select" id="id_grado" name="id_grado" required>
        <option value="">Seleccionar...</option>
        @foreach($grados as $grado)
            <option value="{{ $grado->id_grado }}" {{ old('id_grado') == $grado->id_grado ? 'selected' : '' }}>
                {{ $grado->nombre_grado }}
                @if($grado->descripcion)
                    - {{ $grado->descripcion }}
                @endif
            </option>
        @endforeach
    </select>
</div>
                <div class="col-md-6">
                    <label for="centro_estudios" class="form-label">Centro de Estudios</label>
                    <input type="text" class="form-control" id="centro_estudios" name="centro_estudios" value="{{ old('centro_estudios') }}">
                </div>
            </div>

            <div class="mb-3">
                <label for="observaciones" class="form-label">Observaciones</label>
                <textarea class="form-control" id="observaciones" name="observaciones" rows="3">{{ old('observaciones') }}</textarea>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('estudiantes.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Volver
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Guardar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection