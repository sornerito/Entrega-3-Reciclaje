<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use Illuminate\Http\Request;

class SolicitudController extends Controller
{
    public function listar(){
        $solicitudes = Solicitud::with(['usuario.persona', 'solicitudInorganica', 'tipoResiduo'])->get();
        dump($solicitudes->toJson(JSON_PRETTY_PRINT));

        return view("admin.solicitudes", compact("solicitudes"));
    }
}
