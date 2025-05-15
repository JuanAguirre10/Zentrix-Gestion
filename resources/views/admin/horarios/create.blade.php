@extends('layouts.app')

@section('title', 'Nuevo Horario')

@section('header', 'Registrar Nuevo Horario')

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

        <form action="{{ route('horarios.store') }}" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="dia_semana" class="form-label">Día de la semana</label>
                    <select class="form-select" id="dia_semana" name="dia_semana" required>
                        <option value="">Seleccionar...</option>
                        <option value="Lunes" {{ old('dia_semana') == 'Lunes' ? 'selected' : '' }}>Lunes</option>
                        <option value="Martes" {{ old('dia_semana') == 'Martes' ? 'selected' : '' }}>Martes</option>
                        <option value="Miércoles" {{ old('dia_semana') == 'Miércoles' ? 'selected' : '' }}>Miércoles</option>
                        <option value="Jueves" {{ old('dia_semana') == 'Jueves' ? 'selected' : '' }}>Jueves</option>
                        <option value="Viernes" {{ old('dia_semana') == 'Viernes' ? 'selected' : '' }}>Viernes</option>
                        <option value="Sábado" {{ old('dia_semana') == 'Sábado' ? 'selected' : '' }}>Sábado</option>
                        <option value="Domingo" {{ old('dia_semana') == 'Domingo' ? 'selected' : '' }}>Domingo</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="hora_inicio" class="form-label">Hora de inicio</label>
                    <input type="time" class="form-control" id="hora_inicio" name="hora_inicio" value="{{ old('hora_inicio') }}" required>
                </div>
                <div class="col-md-4">
                    <label for="hora_fin" class="form-label">Hora de fin</label>
                    <input type="time" class="form-control" id="hora_fin" name="hora_fin" value="{{ old('hora_fin') }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="salon" class="form-label">Salón</label>
                    <input type="text" class="form-control" id="salon" name="salon" value="{{ old('salon') }}" placeholder="Ej: Aula 101, Laboratorio, etc.">
                </div>
                <div class="col-md-6">
                    <label for="cupo_max" class="form-label">Cupo máximo</label>
                    <input type="number" class="form-control" id="cupo_max" name="cupo_max" value="{{ old('cupo_max') }}" min="1" placeholder="Dejar en blanco para sin límite">
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('horarios.index') }}" class="btn btn-secondary">
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