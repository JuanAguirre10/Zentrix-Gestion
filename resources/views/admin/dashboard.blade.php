@extends('layouts.app')

@section('title', 'Centro de Control')

@section('header', 'Centro de Control')

@section('content')
<div class="stats-grid">
    <div class="stat-card primary">
        <div class="stat-header">
            <div class="stat-title">Estudiantes</div>
            <div class="stat-icon">
                <i class="fas fa-user-graduate"></i>
            </div>
        </div>
        <div class="stat-number">{{ $totalEstudiantes ?? 0 }}</div>
        <div class="stat-footer">
            <a href="{{ route('estudiantes.index') }}">Ver detalles <i class="fas fa-arrow-right"></i></a>
        </div>
    </div>
    
    <div class="stat-card success">
        <div class="stat-header">
            <div class="stat-title">Cursos</div>
            <div class="stat-icon">
                <i class="fas fa-book"></i>
            </div>
        </div>
        <div class="stat-number">{{ $totalCursos ?? 0 }}</div>
        <div class="stat-footer">
            <a href="{{ route('cursos.index') }}">Ver detalles <i class="fas fa-arrow-right"></i></a>
        </div>
    </div>
    
    <div class="stat-card warning">
        <div class="stat-header">
            <div class="stat-title">Matrículas</div>
            <div class="stat-icon">
                <i class="fas fa-clipboard-list"></i>
            </div>
        </div>
        <div class="stat-number">{{ $matriculasActivas ?? 0 }}</div>
        <div class="stat-footer">
            <a href="{{ route('matriculas.index') }}">Ver detalles <i class="fas fa-arrow-right"></i></a>
        </div>
    </div>
    
    <div class="stat-card danger">
        <div class="stat-header">
            <div class="stat-title">Apoderados</div>
            <div class="stat-icon">
                <i class="fas fa-users"></i>
            </div>
        </div>
        <div class="stat-number">{{ $totalApoderados ?? 0 }}</div>
        <div class="stat-footer">
            <a href="{{ route('apoderados.index') }}">Ver detalles <i class="fas fa-arrow-right"></i></a>
        </div>
    </div>
</div>

<div class="content-section">
    <div class="section-title">Estudiantes recientes</div>
    @if(isset($estudiantes_recientes) && count($estudiantes_recientes) > 0)
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Grado</th>
                        <th>Fecha</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($estudiantes_recientes as $estudiante)
                    <tr>
                        <td>{{ $estudiante->nombres }} {{ $estudiante->apellidos }}</td>
                        <td>{{ $estudiante->gradoEscolar->nombre_grado ?? 'N/A' }}</td>
                        <td>{{ $estudiante->created_at->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ route('estudiantes.show', $estudiante->id_estudiante) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div style="text-align: center; padding: 2rem;">
            <i class="fas fa-user-graduate" style="font-size: 3rem; color: #6c757d; margin-bottom: 1rem;"></i>
            <p style="color: #6c757d;">No hay estudiantes registrados.</p>
            <a href="{{ route('estudiantes.create') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus me-1"></i> Registrar estudiante
            </a>
        </div>
    @endif
</div>

<div class="content-section">
    <div class="section-title">Pagos recientes</div>
    @if(isset($pagos_recientes) && count($pagos_recientes) > 0)
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Estudiante</th>
                        <th>Monto</th>
                        <th>Fecha</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pagos_recientes as $pago)
                    <tr>
                        <td>{{ $pago->matricula->estudiante->nombres ?? 'N/A' }} {{ $pago->matricula->estudiante->apellidos ?? '' }}</td>
                        <td>S/ {{ number_format($pago->monto, 2) }}</td>
                        <td>{{ \Carbon\Carbon::parse($pago->fecha_pago)->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ route('pagos.show', $pago->id_pago ?? $pago->id) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div style="text-align: center; padding: 2rem;">
            <i class="fas fa-money-bill-wave" style="font-size: 3rem; color: #6c757d; margin-bottom: 1rem;"></i>
            <p style="color: #6c757d;">No hay pagos registrados.</p>
            <a href="{{ route('pagos.create') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus me-1"></i> Registrar pago
            </a>
        </div>
    @endif
</div>

<div class="content-section">
    <div class="section-title">Distribución de estudiantes por nivel</div>
    <div class="level-distribution">
        @if(isset($niveles) && count($niveles) > 0)
            @foreach($niveles as $nivel)
                <div class="level-card">
                    <div class="level-name">{{ $nivel->nombre }}</div>
                    <div class="level-count">{{ $nivel->estudiantes_count ?? 0 }}</div>
                    <div class="level-label">estudiantes</div>
                </div>
            @endforeach
        @else
            <div style="text-align: center; padding: 2rem; grid-column: 1 / -1;">
                <i class="fas fa-chart-pie" style="font-size: 3rem; color: #6c757d; margin-bottom: 1rem;"></i>
                <p style="color: #6c757d;">No hay datos disponibles.</p>
            </div>
        @endif
    </div>
</div>
@endsection