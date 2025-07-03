@extends('layouts.app')

@section('title', 'Nuevo Horario')

@section('header', 'Crear Nuevo Horario')

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
                <div class="col-md-6">
                    <label for="dia_semana" class="form-label">Día de la Semana</label>
                    <select class="form-select" id="dia_semana" name="dia_semana" required>
                        <option value="">Seleccionar...</option>
                        <option value="lunes" {{ old('dia_semana') == 'lunes' ? 'selected' : '' }}>Lunes</option>
                        <option value="martes" {{ old('dia_semana') == 'martes' ? 'selected' : '' }}>Martes</option>
                        <option value="miercoles" {{ old('dia_semana') == 'miercoles' ? 'selected' : '' }}>Miércoles</option>
                        <option value="jueves" {{ old('dia_semana') == 'jueves' ? 'selected' : '' }}>Jueves</option>
                        <option value="viernes" {{ old('dia_semana') == 'viernes' ? 'selected' : '' }}>Viernes</option>
                        <option value="sabado" {{ old('dia_semana') == 'sabado' ? 'selected' : '' }}>Sábado</option>
                        <option value="domingo" {{ old('dia_semana') == 'domingo' ? 'selected' : '' }}>Domingo</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="salon" class="form-label">Salón</label>
                    <input type="text" class="form-control" id="salon" name="salon" 
                           value="{{ old('salon') }}" placeholder="Ej: Aula 101" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="hora_inicio" class="form-label">Hora de Inicio</label>
                    <input type="time" class="form-control" id="hora_inicio" name="hora_inicio" 
                           value="{{ old('hora_inicio') }}" required>
                </div>
                <div class="col-md-4">
                    <label for="hora_fin" class="form-label">Hora de Fin</label>
                    <input type="time" class="form-control" id="hora_fin" name="hora_fin" 
                           value="{{ old('hora_fin') }}" required>
                </div>
                <div class="col-md-4">
                    <label for="cupo_max" class="form-label">Cupo Máximo</label>
                    <input type="number" class="form-control" id="cupo_max" name="cupo_max" 
                           value="{{ old('cupo_max', 30) }}" min="1" max="100" required>
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