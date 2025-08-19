<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CrearSolicitudController extends Controller
{
    public function index()
    {
        $numeroIdentidad = '1234992547'; // Por ahora hardcoded, después lo tomarás del usuario autenticado
        
        $solicitudes = DB::table('Solicitud')
            ->leftJoin('SolicitudInorganica', 'Solicitud.idSolicitud', '=', 'SolicitudInorganica.idSolicitud')
            ->join('TipoResiduo', 'Solicitud.idResiduo', '=', 'TipoResiduo.idResiduo')
            ->where('numeroIdentidadUsuario', $numeroIdentidad)
            ->select(
                'Solicitud.*',
                'SolicitudInorganica.pesoKg',
                'TipoResiduo.nombre as tipoResiduo'
            )
            ->orderBy('fechaRegistro', 'desc')
            ->get();

        return view('mis-solicitudes', compact('solicitudes'));
    }

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
            'pesoKg' => 'nullable|numeric|min:0',
            'notasAdicionales' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            $numeroIdentidad = '1234992547';
            // Insertar la solicitud en la tabla "Solicitud"
            $idSolicitud = DB::table('Solicitud')->insertGetId([
                'fechaRegistro' => now(),
                'fechaRecoleccion' => $request->fechaRecoleccion,
                'estado' => 'pendiente',
                'idResiduo' => $request->idResiduo,
                'numeroIdentidadUsuario' => $numeroIdentidad,
                'notasAdicionales' => $request->notasAdicionales,
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
                'status' => 'success',
                'message' => 'Solicitud creada correctamente'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Error al crear la solicitud: ' . $e->getMessage()
            ]);
        }
    }
}