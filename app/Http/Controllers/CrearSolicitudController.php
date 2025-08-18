<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CrearSolicitudController extends Controller
{
    // Mostrar formulario con residuos
    public function create()
    {
        // Traer los residuos de la tabla TipoResiduo
        $residuos = DB::table('TipoResiduo')->get();

        // Pasarlos a la vista
        return view('nueva-solicitud', compact('residuos'));
    }

    // Guardar solicitud en la base de datos
    public function store(Request $request)
    {
        // Validaciones básicas
        $request->validate([
            'fechaRecoleccion' => 'required|date',
            'idResiduo' => 'required|integer',
            'numeroIdentidadUsuario' => 'required|string',
            'pesoKg' => 'nullable|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();

            // Insertar la solicitud en la tabla "Solicitud"
            $idSolicitud = DB::table('Solicitud')->insertGetId([
                'fechaRegistro' => now(),
                'fechaRecoleccion' => $request->fechaRecoleccion,
                'estado' => 'pendiente', // siempre pendiente al crear
                'idResiduo' => $request->idResiduo,
                'numeroIdentidadUsuario' => $request->numeroIdentidadUsuario,
            ], 'idSolicitud');

            // Si el residuo es inorgánico, insertar en la tabla "SolicitudInorganica"
            if ($request->has('pesoKg')) {
                DB::table('SolicitudInorganica')->insert([
                    'idSolicitud' => $idSolicitud,
                    'pesoKg' => $request->pesoKg,
                ]);
            }

            DB::commit();

            return response()->json([
                'message' => 'Solicitud creada correctamente',
                'idSolicitud' => $idSolicitud
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Error al crear la solicitud',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
