<?php

use App\Http\Controllers\SolicitudController;
use Illuminate\Support\Facades\Route;

Route::get('/adminSolicitud', [SolicitudController::class, "listar"]);
Route::put('/solicitudes/{id}', [SolicitudController::class, 'update'])->name('solicitudes.update');
Route::put('/solicitudes/{id}/finalizar', [SolicitudController::class, 'finalizar'])->name('solicitudes.finalizar');