<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportesController extends Controller
{
    public function mostrarReporteUsuario()
    {
        // Simulación de datos para los selectores y la tabla
        $usuarios = collect([
            (object)['id' => 1, 'nombre' => 'Jose Josuelo Ortiz Ortiz'],
            (object)['id' => 2, 'nombre' => 'Pedro Sanchez Houdini'],
            (object)['id' => 3, 'nombre' => 'Roger Oñate'],
        ]);

        $tipos_residuo = collect([
            (object)['id' => 1, 'nombre' => 'Inorgánico reciclable'],
            (object)['id' => 2, 'nombre' => 'Orgánico'],
        ]);

        $reporte = collect([
            (object)['nombre_usuario' => 'Jose Josuelo Ortiz Ortiz', 'fecha_recoleccion' => '4/08/25', 'fecha_registro' => '4/08/25', 'kg' => 4, 'tipo_residuo' => 'Inorgánico', 'estado' => 'Completado', 'puntos' => 400],
            (object)['nombre_usuario' => 'Pedro Sanchez Houdini', 'fecha_recoleccion' => '5/08/25', 'fecha_registro' => '25/07/25', 'kg' => 8, 'tipo_residuo' => 'Orgánico', 'estado' => 'Pendiente', 'puntos' => 1200],
            (object)['nombre_usuario' => 'Roger Oñate', 'fecha_recoleccion' => '20/12/25', 'fecha_registro' => '10/05/25', 'kg' => 2, 'tipo_residuo' => 'Inorgánico', 'estado' => 'Completado', 'puntos' => 900],
        ]);

        return view('reportes.usuario', compact('usuarios', 'tipos_residuo', 'reporte'));
    }
}