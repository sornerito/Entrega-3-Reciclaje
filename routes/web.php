<?php

use App\Http\Controllers\SolicitudController;
use Illuminate\Support\Facades\Route;

Route::get('/adminSolicitud', [SolicitudController::class, "listar"]);
