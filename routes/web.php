<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\ReportesController;

Route::get('/reportes', function () {
    return view('reportes');
});

Route::get('/reportes/usuario', [ReportesController::class, 'reporteUsuario']);
Route::get('/reportes/todos', [ReportesController::class, 'reporteTodosUsuarios']);
Route::get('/reportes/recolectora', [ReportesController::class, 'reporteRecolectora']);
Route::get('/reportes/usuario', [ReportesController::class, 'mostrarReporteUsuario'])->name('reportes.usuario');