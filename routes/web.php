<?php

use App\Http\Controllers\CrearSolicitudController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('welcome');
});

// Rutas para solicitudes
Route::get('/nueva-solicitud', [CrearSolicitudController::class, 'create'])->name('solicitud.create');
Route::post('/nueva-solicitud', [CrearSolicitudController::class, 'store'])->name('solicitud.store');
Route::get('/mis-solicitudes', [CrearSolicitudController::class, 'index'])->name('mis-solicitudes');