<?php

use App\Http\Controllers\CrearSolicitudController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/nueva-solicitud', [CrearSolicitudController::class, 'create']);
Route::post('/nueva-solicitud', [CrearSolicitudController::class, 'store']);