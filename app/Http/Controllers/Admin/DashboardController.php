<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Estudiante;
use App\Models\Apoderado;
use App\Models\Curso;
use App\Models\Matricula;
use App\Models\Pago;
use App\Models\NivelEducativo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Estadísticas básicas
        $totalEstudiantes = Estudiante::count();
        $totalApoderados = Apoderado::count();
        $totalCursos = Curso::count();
        $matriculasActivas = Matricula::where('estado', 'activa')->count();

        // Estudiantes recientes (últimos 5)
        $estudiantes_recientes = Estudiante::with(['gradoEscolar'])
            ->latest()
            ->limit(5)
            ->get();

        // Pagos recientes (últimos 5)
        $pagos_recientes = Pago::with(['matricula.estudiante'])
            ->latest('fecha_pago')
            ->limit(5)
            ->get();

        // Niveles educativos con cantidad de estudiantes
        $niveles = DB::table('niveles_educativo')
    ->leftJoin('grados_escolar', 'niveles_educativo.id_nivel_educativo', '=', 'grados_escolar.id_nivel')
    ->leftJoin('estudiantes', 'grados_escolar.id_grado', '=', 'estudiantes.id_grado')
    ->select('niveles_educativo.nombre', DB::raw('COUNT(estudiantes.id_estudiante) as estudiantes_count'))
    ->groupBy('niveles_educativo.id_nivel_educativo', 'niveles_educativo.nombre')
    ->get();
        return view('admin.dashboard', compact(
            'totalEstudiantes',
            'totalApoderados', 
            'totalCursos',
            'matriculasActivas',
            'estudiantes_recientes',
            'pagos_recientes',
            'niveles'
        ));
    }
}