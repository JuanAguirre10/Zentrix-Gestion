@extends('layouts.app')

@section('title', 'Editar Horario')

@section('header', 'Editar Horario')

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

        <form action="{{ route('horarios.update', $horario) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="dia_semana" class="form-label">Día de la Semana</label>
                    <select class="form-select" id="dia_semana" name="dia_semana" required>
                        <option value="">Seleccionar...</option>
                        <option value="Lunes" {{ old('dia_semana', $horario->dia_semana) == 'Lunes' ? 'selected' : '' }}>Lunes</option>
                        <option value="Martes" {{ old('dia_semana', $horario->dia_semana) == 'Martes' ? 'selected' : '' }}>Martes</option>
                        <option value="Miércoles" {{ old('dia_semana', $horario->dia_semana) == 'Miércoles' ? 'selected' : '' }}>Miércoles</option>
                        <option value="Jueves" {{ old('dia_semana', $horario->dia_semana) == 'Jueves' ? 'selected' : '' }}>Jueves</option>
                        <option value="Viernes" {{ old('dia_semana', $horario->dia_semana) == 'Viernes' ? 'selected' : '' }}>Viernes</option>
                        <option value="Sábado" {{ old('dia_semana', $horario->dia_semana) == 'Sábado' ? 'selected' : '' }}>Sábado</option>
                        <option value="Domingo" {{ old('dia_semana', $horario->dia_semana) == 'Domingo' ? 'selected' : '' }}>Domingo</option>
                    </select>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="hora_inicio" class="form-label">Hora de Inicio</label>
                    <input type="time" class="form-control" id="hora_inicio" name="hora_inicio" 
                           value="{{ old('hora_inicio', $horario->hora_inicio) }}" required>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="hora_fin" class="form-label">Hora de Fin</label>
                    <input type="time" class="form-control" id="hora_fin" name="hora_fin" 
                           value="{{ old('hora_fin', $horario->hora_fin) }}" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="salon" class="form-label">Salón</label>
                    <input type="text" class="form-control" id="salon" name="salon" 
                           value="{{ old('salon', $horario->salon) }}" placeholder="Ej: Aula 101" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="cupo_max" class="form-label">Cupo Máximo</label>
                    <input type="number" class="form-control" id="cupo_max" name="cupo_max" 
                           value="{{ old('cupo_max', $horario->cupo_max) }}" min="1" max="100" required>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('horarios.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Cancelar
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Actualizar Horario
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script>
    // Validar que la hora de fin sea mayor que la hora de inicio
    document.getElementById('hora_fin').addEventListener('change', function() {
        const horaInicio = document.getElementById('hora_inicio').value;
        const horaFin = this.value;
        
        if (horaInicio && horaFin && horaFin <= horaInicio) {
            alert('La hora de fin debe ser mayor que la hora de inicio');
            this.value = '';
        }
    });
    
    document.getElementById('hora_inicio').addEventListener('change', function() {
        const horaInicio = this.value;
        const horaFin = document.getElementById('hora_fin').value;
        
        if (horaInicio && horaFin && horaFin <= horaInicio) {
            alert('La hora de fin debe ser mayor que la hora de inicio');
            document.getElementById('hora_fin').value = '';
        }
    });
</script>
@endsection