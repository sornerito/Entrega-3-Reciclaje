@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte por Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
        }

        .navbar-custom {
            background-color: #384F3C;
        }

        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link {
            color: #d1d8c5;
        }

        .navbar-custom .nav-link:hover {
            color: #ffffff;
        }
        
        /* Estilos del logo */
        .navbar-brand img {
            height: 40px;
            width: auto;
        }

        .container-content {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-report {
            background-color: #637F61;
            color: #fff;
            padding: 15px 30px;
            border-radius: 8px;
            font-size: 1.2rem;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        .btn-report:hover {
            background-color: #556b53;
        }

        .section-title {
            color: #384F3C;
            font-weight: bold;
            font-size: 1.8rem;
            margin-bottom: 20px;
        }
        
        /* Estilo para el botón de navegación activo */
        .nav-item .nav-link.active-nav {
            background-color: #637F61;
            border-radius: 8px;
            color: #fff;
            padding: 8px 15px;
        }
        
        .nav-item .nav-link.active-nav:hover {
            color: #fff;
        }
        
        /* Alineación del logo y los enlaces */
        .navbar-nav {
            align-items: center;
        }
        
        .navbar-custom .nav-link {
            margin-left: 10px;
        }

        /* Estilos específicos del formulario de búsqueda */
        .report-form .form-group {
            margin-bottom: 1rem;
        }
        .report-form .form-control, .report-form .form-select {
            border-radius: 5px;
        }
        .report-form .btn-search {
            background-color: #637F61;
            color: #fff;
        }
        .report-form .btn-search:hover {
            background-color: #556b53;
        }
        .report-form label {
            font-weight: bold;
        }
        .report-form .form-label span {
            color: red;
        }

        /* Estilos para la tabla */
        .table-responsive {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            overflow: hidden;
        }
        .table thead th {
            background-color: #f8f9fa;
            color: #495057;
        }
        .table tbody tr:hover {
            background-color: #f1f1f1;
        }
        .table tbody tr td {
            vertical-align: middle;
        }
        .pagination-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }
        .pagination-container .page-item a {
            color: #637F61;
        }
        .pagination-container .page-item.active a {
            background-color: #637F61;
            border-color: #637F61;
            color: #fff;
        }

        /* Estilos para los botones de exportación */
        .export-buttons .btn {
            background-color: #637F61;
            color: #fff;
            transition: background-color 0.3s ease;
        }
        .export-buttons .btn:hover {
            background-color: #556b53;
        }
    </style>
</head>
<body>

    <!-- Navegación -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand" href="#">
                <img src="{{ asset('img/logo.png') }}" alt="Logo de la aplicación">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Solicitudes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active-nav" aria-current="page" href="#">Reportes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Configuración</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Cerrar Sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <div class="container-content">
            <h2 class="section-title">Reporte por Usuario</h2>
            
            <!-- Formulario de Búsqueda -->
            <form action="{{ route('reportes.usuario') }}" method="GET" class="report-form mb-4">
                <div class="row g-3 align-items-end">
                    <!-- Usuario -->
                    <div class="col-md-3">
                        <label for="usuario" class="form-label">Usuario</label>
                        <select id="usuario" name="usuario" class="form-select">
                            <option value="">Seleccione un usuario</option>
                            <!-- Simulación de datos pasados desde el controlador -->
                            @if(isset($usuarios))
                                @foreach($usuarios as $usuario)
                                    <option value="{{ $usuario->id }}">{{ $usuario->nombre }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <!-- Tipo de residuo -->
                    <div class="col-md-3">
                        <label for="tipo_residuo" class="form-label">Tipo de residuo</label>
                        <select id="tipo_residuo" name="tipo_residuo" class="form-select">
                            <option value="">Seleccione un tipo</option>
                            <!-- Simulación de datos pasados desde el controlador -->
                            @if(isset($tipos_residuo))
                                @foreach($tipos_residuo as $residuo)
                                    <option value="{{ $residuo->id }}">{{ $residuo->nombre }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <!-- Fecha Desde -->
                    <div class="col-md-3">
                        <label for="fecha_desde" class="form-label">Fecha de recolección<span> *</span></label>
                        <input type="date" id="fecha_desde" name="fecha_desde" class="form-control" required>
                    </div>

                    <!-- Fecha Hasta -->
                    <div class="col-md-3">
                        <label for="fecha_hasta" class="form-label">Fecha de recolección<span> *</span></label>
                        <input type="date" id="fecha_hasta" name="fecha_hasta" class="form-control" required>
                    </div>

                    <!-- Botón de Búsqueda -->
                    <div class="col-12 text-center mt-4">
                        <button type="submit" class="btn btn-search px-5">Buscar</button>
                    </div>
                </div>
            </form>

            <!-- Tabla de Reporte -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>F. de recolección</th>
                            <th>F. de registro</th>
                            <th>Kg</th>
                            <th>Tipo de residuo</th>
                            <th>Estado</th>
                            <th>Puntos por recolección</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Se asume que $reporte es una colección de resultados del controlador -->
                        @if(isset($reporte) && $reporte->count() > 0)
                            @foreach($reporte as $fila)
                            <tr>
                                <td>{{ $fila->nombre_usuario }}</td>
                                <td>{{ $fila->fecha_recoleccion }}</td>
                                <td>{{ $fila->fecha_registro }}</td>
                                <td>{{ $fila->kg }}</td>
                                <td>{{ $fila->tipo_residuo }}</td>
                                <td>{{ $fila->estado }}</td>
                                <td>{{ $fila->puntos }}</td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="text-center text-muted">No se encontraron resultados.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <div class="d-flex justify-content-center">
                <!-- Se asume que se usa la paginación de Laravel, por ejemplo: $reporte->links() -->
                <nav aria-label="Page navigation">
                    <ul class="pagination mt-4">
                        <li class="page-item disabled"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">&lt;</span></a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">&gt;</span></a></li>
                    </ul>
                </nav>
            </div>

            <!-- Botones de Exportación -->
            <div class="row mt-4 export-buttons justify-content-center">
                <div class="col-6 col-md-3">
                    <a href="#" class="btn btn-block">Exportar PDF</a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="#" class="btn btn-block">Exportar CSV</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection