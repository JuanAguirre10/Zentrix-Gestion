<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\ApoderadoController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\MatriculaController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\HorarioController;
use Illuminate\Support\Facades\Route;

// Ruta principal
Route::get('/', function () {
    return view('welcome');
});

// Dashboard simple
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas protegidas básicas
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard de administrador
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    // Rutas CRUD básicas
    Route::resource('estudiantes', EstudianteController::class);
    Route::resource('apoderados', ApoderadoController::class);
    Route::resource('cursos', CursoController::class);
    Route::resource('matriculas', MatriculaController::class);
    Route::resource('pagos', PagoController::class);
    Route::resource('horarios', HorarioController::class);
});

// Rutas de perfil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Rutas de pagos
Route::patch('/pagos/{id}/confirmar', [PagoController::class, 'confirmar'])->name('pagos.confirmar');

require __DIR__.'/auth.php';