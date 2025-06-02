<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\ApoderadoController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\MatriculaController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\HorarioController;
use App\Models\Estudiante;
use App\Models\Curso;
use App\Models\Matricula;
use App\Models\Pago;
use App\Models\NivelEducativo;

// Redireccionar la raíz al dashboard
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Dashboard
Route::get('/dashboard', function () {
    // Obtener datos para el dashboard
    $total_estudiantes = Estudiante::count();
    $total_cursos = Curso::count();
    $total_matriculas = Matricula::count();
    $total_pagos = Pago::where('estado', 'completado')->sum('monto');

    // Estudiantes recientes
    $estudiantes_recientes = Estudiante::with('gradoEscolar')
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();

    // Pagos recientes
    $pagos_recientes = Pago::with('matricula.estudiante')
        ->where('estado', 'completado')
        ->orderBy('fecha_pago', 'desc')
        ->take(5)
        ->get();

    // Niveles educativos con conteo de estudiantes
    $niveles = NivelEducativo::withCount(['estudiantes as estudiantes_count'])
        ->get();

    return view('admin.dashboard', compact(
        'total_estudiantes',
        'total_cursos',
        'total_matriculas',
        'total_pagos',
        'estudiantes_recientes',
        'pagos_recientes',
        'niveles'
    ));
})->name('dashboard');

// Rutas de estudiantes
Route::resource('estudiantes', EstudianteController::class);

// Rutas de apoderados
Route::resource('apoderados', ApoderadoController::class);

// Rutas de cursos
Route::resource('cursos', CursoController::class);
Route::get('cursos/{curso}/temas', [CursoController::class, 'temas'])->name('cursos.temas');
Route::post('cursos/{curso}/temas', [CursoController::class, 'storeTema'])->name('cursos.temas.store');
Route::delete('cursos/{curso}/temas/{tema}', [CursoController::class, 'destroyTema'])->name('cursos.temas.destroy');

// Rutas de matrículas
Route::resource('matriculas', MatriculaController::class);

// Rutas de pagos
Route::resource('pagos', PagoController::class);

// Rutas de horarios
Route::resource('horarios', HorarioController::class);