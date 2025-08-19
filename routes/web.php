<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportesController;
use App\Models\User;
use App\Models\Reporte;


Route::get('/', function () {
    return view('welcome');
});

// Muestra la vista principal de reportes
Route::get('/reportes', function () {
    return view('reportes.principal');
});

// Rutas de reportes específicas, con nombres de método corregidos
Route::get('/reportes/usuario', [ReportesController::class, 'mostrarReporteUsuario'])->name('reportes.usuario');
Route::get('/reportes/todos', [ReportesController::class, 'reporteTodosUsuarios']); // Si este metodo existe en el controlador
Route::get('/reportes/recolectora', [ReportesController::class, 'reporteRecolectora']); // Si este metodo existe en el controlador

