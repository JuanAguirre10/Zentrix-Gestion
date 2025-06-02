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
                        <a class="nav-link text-white" href="{{ route('estudiantes.index') }}">
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
                        <a class="nav-link text-white active" href="{{ route('pagos.index') }}">
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
                <h1 class="h2">Detalles del Pago</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group mr-2">
                        <a href="{{ route('pagos.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver al Listado
                        </a>
                        <a href="{{ route('pagos.edit', $pago) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                    </div>
                </div>
            </div>

            <!-- Información del Pago -->
            <div class="row">
                <!-- Datos del Pago -->
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="fas fa-money-bill-wave"></i> Información del Pago</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>ID Pago:</strong></td>
                                    <td>{{ $pago->id_pago ?? $pago->id }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Monto:</strong></td>
                                    <td>
                                        <span class="h3 text-success">
                                            S/ {{ number_format($pago->monto, 2) }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Fecha de Pago:</strong></td>
                                    <td>{{ \Carbon\Carbon::parse($pago->fecha_pago)->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Método de Pago:</strong></td>
                                    <td>
                                        @switch($pago->metodo_pago)
                                            @case('efectivo')
                                                <span class="badge badge-success">
                                                    <i class="fas fa-money-bill"></i> Efectivo
                                                </span>
                                                @break
                                            @case('tarjeta')
                                                <span class="badge badge-info">
                                                    <i class="fas fa-credit-card"></i> Tarjeta
                                                </span>
                                                @break
                                            @case('transferencia')
                                                <span class="badge badge-warning">
                                                    <i class="fas fa-university"></i> Transferencia
                                                </span>
                                                @break
                                            @default
                                                <span class="badge badge-secondary">
                                                    {{ ucfirst($pago->metodo_pago) }}
                                                </span>
                                        @endswitch
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Comprobante:</strong></td>
                                    <td>
                                        @if($pago->comprobante)
                                            <span class="badge badge-info">{{ $pago->comprobante }}</span>
                                        @else
                                            <span class="text-muted">Sin comprobante</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Estado:</strong></td>
                                    <td>
                                        @switch($pago->estado)
                                            @case('completado')
                                                <span class="badge badge-success">
                                                    <i class="fas fa-check-circle"></i> Completado
                                                </span>
                                                @break
                                            @case('pendiente')
                                                <span class="badge badge-warning">
                                                    <i class="fas fa-clock"></i> Pendiente
                                                </span>
                                                @break
                                            @case('anulado')
                                                <span class="badge badge-danger">
                                                    <i class="fas fa-times-circle"></i> Anulado
                                                </span>
                                                @break
                                            @default
                                                <span class="badge badge-light">{{ ucfirst($pago->estado) }}</span>
                                        @endswitch
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Fecha de Registro:</strong></td>
                                    <td>{{ $pago->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Última Actualización:</strong></td>
                                    <td>{{ $pago->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Resumen Visual -->
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0"><i class="fas fa-chart-pie"></i> Resumen</h5>
                        </div>
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <i class="fas fa-money-bill-wave fa-3x text-success"></i>
                            </div>
                            <h2 class="text-success">S/ {{ number_format($pago->monto, 2) }}</h2>
                            <p class="text-muted">
                                Pagado el {{ \Carbon\Carbon::parse($pago->fecha_pago)->format('d/m/Y') }}
                            </p>
                            
                            @if($pago->estado === 'completado')
                                <div class="alert alert-success">
                                    <i class="fas fa-check-circle"></i>
                                    Pago procesado exitosamente
                                </div>
                            @elseif($pago->estado === 'pendiente')
                                <div class="alert alert-warning">
                                    <i class="fas fa-clock"></i>
                                    Pago en proceso de verificación
                                </div>
                            @else
                                <div class="alert alert-danger">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    Pago anulado
                                </div>
                            @endif

                            @if($pago->comprobante)
                                <small class="text-muted">
                                    Comprobante: {{ $pago->comprobante }}
                                </small>
                            @endif
                        </div>
                    </div>

                    <!-- Información de Tiempo -->
                    <div class="card mb-4">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0"><i class="fas fa-calendar-alt"></i> Información Temporal</h5>
                        </div>
                        <div class="card-body">
                            @php
                                $fechaPago = \Carbon\Carbon::parse($pago->fecha_pago);
                                $diasTranscurridos = $fechaPago->diffInDays(now());
                            @endphp
                            
                            <table class="table table-borderless table-sm">
                                <tr>
                                    <td><strong>Hace:</strong></td>
                                    <td>{{ $fechaPago->diffForHumans() }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Días:</strong></td>
                                    <td>{{ $diasTranscurridos }} días</td>
                                </tr>
                                <tr>
                                    <td><strong>Mes:</strong></td>
                                    <td>{{ $fechaPago->formatLocalized('%B %Y') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Día de la semana:</strong></td>
                                    <td>{{ $fechaPago->formatLocalized('%A') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Información de la Matrícula -->
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header bg-warning text-dark">
                            <h5 class="mb-0"><i class="fas fa-clipboard-list"></i> Matrícula Asociada</h5>
                        </div>
                        <div class="card-body">
                            @if($pago->matricula)
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tr>
                                                <td><strong>ID Matrícula:</strong></td>
                                                <td>{{ $pago->matricula->id_matricula ?? $pago->matricula->id }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Fecha de Matrícula:</strong></td>
                                                <td>{{ \Carbon\Carbon::parse($pago->matricula->fecha_matricula)->format('d/m/Y') }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Monto Total:</strong></td>
                                                <td>S/ {{ number_format($pago->matricula->monto_total, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Estado:</strong></td>
                                                <td>
                                                    @switch($pago->matricula->estado)
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
                                                            <span class="badge badge-light">{{ ucfirst($pago->matricula->estado) }}</span>
                                                    @endswitch
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        @if($pago->matricula->estudiante)
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td><strong>Estudiante:</strong></td>
                                                    <td>
                                                        {{ $pago->matricula->estudiante->nombres }} 
                                                        {{ $pago->matricula->estudiante->apellidos }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><strong>DNI:</strong></td>
                                                    <td>{{ $pago->matricula->estudiante->dni ?? 'No registrado' }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Grado:</strong></td>
                                                    <td>{{ $pago->matricula->estudiante->gradoEscolar->nombre_grado ?? 'No asignado' }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Apoderado:</strong></td>
                                                    <td>
                                                        @if($pago->matricula->estudiante->apoderado)
                                                            {{ $pago->matricula->estudiante->apoderado->nombres }} 
                                                            {{ $pago->matricula->estudiante->apoderado->apellidos }}
                                                        @else
                                                            No asignado
                                                        @endif
                                                    </td>
                                                </tr>
                                            </table>
                                        @endif
                                    </div>
                                </div>

                                <!-- Progress de Pagos -->
                                @php
                                    $totalPagado = $pago->matricula->pagos->where('estado', 'completado')->sum('monto');
                                    $porcentajePagado = $pago->matricula->monto_total > 0 ? ($totalPagado / $pago->matricula->monto_total) * 100 : 0;
                                    $saldoPendiente = $pago->matricula->monto_total - $totalPagado;
                                @endphp
                                
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <h6>Progreso de Pagos</h6>
                                        <div class="progress mb-2">
                                            <div class="progress-bar bg-success" role="progressbar" 
                                                 style="width: {{ $porcentajePagado }}%" 
                                                 aria-valuenow="{{ $porcentajePagado }}" aria-valuemin="0" aria-valuemax="100">
                                                 {{ number_format($porcentajePagado, 1) }}%
                                            </div>
                                        </div>
                                        <div class="row text-center">
                                            <div class="col-4">
                                                <small class="text-muted">Total</small><br>
                                                <strong>S/ {{ number_format($pago->matricula->monto_total, 2) }}</strong>
                                            </div>
                                            <div class="col-4">
                                                <small class="text-muted">Pagado</small><br>
                                                <strong class="text-success">S/ {{ number_format($totalPagado, 2) }}</strong>
                                            </div>
                                            <div class="col-4">
                                                <small class="text-muted">Pendiente</small><br>
                                                <strong class="text-danger">S/ {{ number_format($saldoPendiente, 2) }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-right mt-3">
                                    <a href="{{ route('matriculas.show', $pago->matricula) }}" class="btn btn-outline-warning btn-sm">
                                        <i class="fas fa-eye"></i> Ver Matrícula Completa
                                    </a>
                                    <a href="{{ route('estudiantes.show', $pago->matricula->estudiante) }}" class="btn btn-outline-info btn-sm">
                                        <i class="fas fa-user"></i> Ver Estudiante
                                    </a>
                                </div>
                            @else
                                <div class="alert alert-warning">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    No se encontró información de la matrícula asociada.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Observaciones -->
            @if($pago->observaciones)
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header bg-secondary text-white">
                            <h5 class="mb-0"><i class="fas fa-sticky-note"></i> Observaciones</h5>
                        </div>
                        <div class="card-body">
                            <p class="mb-0">{{ $pago->observaciones }}</p>
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
                            @if($pago->estado === 'pendiente')
                                <button class="btn btn-success" onclick="confirmarPago()">
                                    <i class="fas fa-check"></i> Confirmar Pago
                                </button>
                            @endif
                            
                            <a href="{{ route('pagos.edit', $pago) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Editar Pago
                            </a>
                            
                            <button class="btn btn-info" onclick="imprimirComprobante()">
                                <i class="fas fa-print"></i> Imprimir Comprobante
                            </button>
                            
                            <a href="{{ route('pagos.create') }}?matricula={{ $pago->matricula->id_matricula ?? $pago->matricula->id }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Nuevo Pago (Misma Matrícula)
                            </a>
                            
                            <a href="{{ route('pagos.index') }}" class="btn btn-secondary">
                                <i class="fas fa-list"></i> Volver al Listado
                            </a>
                            
                            @if($pago->estado !== 'anulado')
                                <form action="{{ route('pagos.destroy', $pago) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Está seguro de anular este pago?')">
                                        <i class="fas fa-ban"></i> Anular Pago
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
function confirmarPago() {
    if(confirm('¿Confirmar este pago como completado?')) {
        // Aquí implementarías la lógica para cambiar el estado
        alert('Funcionalidad de confirmación pendiente de implementación');
    }
}

function imprimirComprobante() {
    window.print();
}
</script>

<style>
@media print {
    .sidebar, .btn-toolbar, .card:last-child {
        display: none !important;
    }
}
</style>
@endsection