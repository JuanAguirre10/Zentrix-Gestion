@extends('layouts.app')

@section('title', 'Editar Pago')

@section('header', 'Editar Pago')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Formulario de Edición de Pago</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('pagos.update', $pago->id_pago) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="id_matricula" class="form-label">Matrícula</label>
                        <select class="form-select" id="id_matricula" name="id_matricula" required>
                            <option value="">Seleccionar matrícula...</option>
                            @foreach($matriculas as $matricula)
                                <option value="{{ $matricula->id_matricula }}" 
                                        {{ old('id_matricula', $pago->id_matricula) == $matricula->id_matricula ? 'selected' : '' }}>
                                    Matrícula #{{ $matricula->id_matricula }} - 
                                    {{ $matricula->estudiante->nombres ?? 'N/A' }} 
                                    {{ $matricula->estudiante->apellidos ?? '' }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_matricula')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="monto" class="form-label">Monto</label>
                        <input type="number" class="form-control" id="monto" name="monto" 
                               value="{{ old('monto', $pago->monto) }}" step="0.01" min="0" required>
                        @error('monto')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="fecha_pago" class="form-label">Fecha de Pago</label>
                        <input type="date" class="form-control" id="fecha_pago" name="fecha_pago" 
                               value="{{ old('fecha_pago', $pago->fecha_pago) }}" required>
                        @error('fecha_pago')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="metodo_pago" class="form-label">Método de Pago</label>
                        <select class="form-select" id="metodo_pago" name="metodo_pago" required>
                            <option value="">Seleccionar método...</option>
                            <option value="efectivo" {{ old('metodo_pago', $pago->metodo_pago) == 'efectivo' ? 'selected' : '' }}>
                                Efectivo
                            </option>
                            <option value="tarjeta" {{ old('metodo_pago', $pago->metodo_pago) == 'tarjeta' ? 'selected' : '' }}>
                                Tarjeta
                            </option>
                            <option value="transferencia" {{ old('metodo_pago', $pago->metodo_pago) == 'transferencia' ? 'selected' : '' }}>
                                Transferencia
                            </option>
                            <option value="deposito" {{ old('metodo_pago', $pago->metodo_pago) == 'deposito' ? 'selected' : '' }}>
                                Depósito
                            </option>
                        </select>
                        @error('metodo_pago')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="comprobante" class="form-label">Comprobante</label>
                        <input type="text" class="form-control" id="comprobante" name="comprobante" 
                               value="{{ old('comprobante', $pago->comprobante) }}" 
                               placeholder="Número de comprobante">
                        @error('comprobante')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="estado" class="form-label">Estado</label>
                        <select class="form-select" id="estado" name="estado" required>
                            <option value="pendiente" {{ old('estado', $pago->estado) == 'pendiente' ? 'selected' : '' }}>
                                Pendiente
                            </option>
                            <option value="completado" {{ old('estado', $pago->estado) == 'completado' ? 'selected' : '' }}>
                                Completado
                            </option>
                            <option value="anulado" {{ old('estado', $pago->estado) == 'anulado' ? 'selected' : '' }}>
                                Anulado
                            </option>
                        </select>
                        @error('estado')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="mb-3">
                        <label for="observaciones" class="form-label">Observaciones</label>
                        <textarea class="form-control" id="observaciones" name="observaciones" rows="3">{{ old('observaciones', $pago->observaciones) }}</textarea>
                        @error('observaciones')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('pagos.show', $pago->id_pago) }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Actualizar Pago
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection