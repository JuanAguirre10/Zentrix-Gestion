@extends('layouts.app')

@section('title', 'Nuevo Pago')

@section('header', 'Registrar Nuevo Pago')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Formulario de Registro de Pago</h5>
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

        <form action="{{ route('pagos.store') }}" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="id_matricula" class="form-label">Matrícula</label>
                    <select class="form-select" id="id_matricula" name="id_matricula" required>
                        <option value="">Seleccionar matrícula...</option>
                        @foreach($matriculas as $matricula)
    @php
        $totalPagado = $matricula->pagos->sum('monto');
        $saldoPendiente = $matricula->monto_total - $totalPagado;
    @endphp
    <option value="{{ $matricula->id_matricula }}" 
            data-saldo="{{ $saldoPendiente }}" 
            data-total="{{ $matricula->monto_total }}"
            data-pagado="{{ $totalPagado }}"
            {{ old('id_matricula') == $matricula->id_matricula ? 'selected' : '' }}>
        {{ $matricula->estudiante->nombres ?? 'N/A' }} {{ $matricula->estudiante->apellidos ?? '' }} - Matrícula #{{ $matricula->id_matricula }}
    </option>
@endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="fecha_pago" class="form-label">Fecha de Pago</label>
                    <input type="date" class="form-control" id="fecha_pago" name="fecha_pago" value="{{ old('fecha_pago', date('Y-m-d')) }}" required>
                </div>
                <div class="col-md-3">
    <label for="metodo_pago" class="form-label">Método de Pago</label>
    <select class="form-select" id="metodo_pago" name="metodo_pago" required>
        <option value="">Seleccionar...</option>
        <option value="efectivo" {{ old('metodo_pago') == 'efectivo' ? 'selected' : '' }}>Efectivo</option>
        <option value="tarjeta" {{ old('metodo_pago') == 'tarjeta' ? 'selected' : '' }}>Tarjeta</option>
        <option value="transferencia" {{ old('metodo_pago') == 'transferencia' ? 'selected' : '' }}>Transferencia</option>
        <option value="deposito" {{ old('metodo_pago') == 'deposito' ? 'selected' : '' }}>Depósito</option>
    </select>
</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="monto" class="form-label">Monto</label>
                    <div class="input-group">
                        <span class="input-group-text">S/</span>
                        <input type="number" step="0.01" min="0" class="form-control" id="monto" name="monto" value="{{ old('monto', '0.00') }}" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="comprobante" class="form-label">Comprobante</label>
                    <input type="text" class="form-control" id="comprobante" name="comprobante" value="{{ old('comprobante') }}" placeholder="Número de comprobante">
                </div>
                <div class="col-md-4">
                    <label for="estado" class="form-label">Estado</label>
                    <select class="form-select" id="estado" name="estado" required>
                        <option value="completado" {{ old('estado') == 'completado' ? 'selected' : '' }}>Completado</option>
                        <option value="pendiente" {{ old('estado') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="anulado" {{ old('estado') == 'anulado' ? 'selected' : '' }}>Anulado</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <div class="card bg-light">
                    <div class="card-body">
                        <h6 class="card-title">Información de Matrícula</h6>
                        <p id="infoMatricula" class="mb-1">Seleccione una matrícula para ver detalles</p>
                        <p id="infoSaldo" class="mb-1 mt-2 fw-bold"></p>
                    </div>
                </div>
            </div>
            <div class="mb-3">
    <label for="observaciones" class="form-label">Observaciones</label>
    <textarea class="form-control" id="observaciones" name="observaciones" rows="3">{{ old('observaciones') }}</textarea>
</div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('pagos.index') }}" class="btn btn-secondary">
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

@section('scripts')
<script>
    // Actualizar información de matrícula al seleccionar
    document.getElementById('id_matricula').addEventListener('change', function() {
        const select = this;
        const saldoPendiente = select.options[select.selectedIndex].getAttribute('data-saldo');
        const infoMatricula = document.getElementById('infoMatricula');
        const infoSaldo = document.getElementById('infoSaldo');
        const montoInput = document.getElementById('monto');
        
        if (select.value !== '') {
            // Poblar información
            infoMatricula.textContent = `Matrícula #${select.value} - ${select.options[select.selectedIndex].textContent}`;
            infoSaldo.textContent = `Saldo pendiente: S/ ${parseFloat(saldoPendiente).toFixed(2)}`;
            
            // Sugerir monto
            if (parseFloat(saldoPendiente) > 0) {
                montoInput.value = parseFloat(saldoPendiente).toFixed(2);
            } else {
                montoInput.value = '0.00';
            }
        } else {
            infoMatricula.textContent = 'Seleccione una matrícula para ver detalles';
            infoSaldo.textContent = '';
            montoInput.value = '0.00';
        }
    });
    
    // Inicializar si hay un valor seleccionado
    window.addEventListener('DOMContentLoaded', (event) => {
        const matriculaSelect = document.getElementById('id_matricula');
        if (matriculaSelect.value !== '') {
            matriculaSelect.dispatchEvent(new Event('change'));
        }
    });
</script>
@endsection