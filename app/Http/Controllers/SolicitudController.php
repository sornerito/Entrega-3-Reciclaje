<?php

namespace App\Http\Controllers;

use App\Models\Recolectora;
use App\Models\Solicitud;
use Illuminate\Http\Request;

class SolicitudController extends Controller
{
    public function listar()
    {
        $solicitudes = Solicitud::with(['usuario.persona', 'solicitudInorganica', 'tipoResiduo'])->get();
        $recolectoras = Recolectora::with(["tiposResiduo", "persona"])->get();

        return view("admin.solicitudes", compact("solicitudes", "recolectoras"));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'idRecolectora' => 'required|exists:recolectora,nit',
        ]);

        $solicitud = Solicitud::findOrFail($id);
        $solicitud->nitRecolectora = $request->idRecolectora;
        $solicitud->estado = "En proceso";
        $solicitud->save();

        return redirect()->back()->with('success', 'Recolectora asignada correctamente.');
    }

    public function finalizar(Request $request, $id)
    {
        $solicitud = Solicitud::findOrFail($id);

        $solicitud->estado = 'Aceptado';

        if ($request->has('otorgar_puntos')) {
            $solicitud->puntosOtorgados = 200;
        }

        $solicitud->save();

        return redirect()->back()->with('success', 'Solicitud finalizada correctamente.');
    }
}
