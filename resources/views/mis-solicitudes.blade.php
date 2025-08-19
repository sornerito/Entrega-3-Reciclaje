<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Solicitudes</title>
    @vite('resources/css/app.css')
</head>
<body>
    @include('components.navbar')

    <div class="container">
        <h1 class="form-title">Registro Histórico Usuario</h1>

        <!-- Filtros de fecha -->
        <div class="filters-container">
            <div class="filter-group">
                <div class="date-filter">
                    <label>Fecha de recolección Desde <span class="required">*</span></label>
                    <div class="date-input-container">
                        <input type="date" name="fecha_desde" required>
                        <span class="calendar-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 34 34" fill="none">
                                <rect x="4.24133" y="8.48291" width="25.4483" height="21.2069" rx="2.26207" stroke="#5B705A" stroke-width="2.26207"/>
                                <path d="M4.24133 13.007C4.24133 10.8743 4.24133 9.808 4.90388 9.14545C5.56642 8.48291 6.63277 8.48291 8.76547 8.48291H25.1655C27.2982 8.48291 28.3645 8.48291 29.0271 9.14545C29.6896 9.808 29.6896 10.8743 29.6896 13.007V14.1381H4.24133V13.007Z" fill="#5B705A"/>
                                <path d="M9.89651 4.24146L9.89651 8.48283" stroke="#5B705A" stroke-width="2.26207" stroke-linecap="round"/>
                                <path d="M24.0344 4.24146L24.0344 8.48283" stroke="#5B705A" stroke-width="2.26207" stroke-linecap="round"/>
                                <rect x="9.89651" y="16.9656" width="5.65517" height="2.82759" rx="0.565517" fill="#5B705A"/>
                                <rect x="9.89651" y="22.6208" width="5.65517" height="2.82759" rx="0.565517" fill="#5B705A"/>
                                <rect x="18.3793" y="16.9656" width="5.65517" height="2.82759" rx="0.565517" fill="#5B705A"/>
                                <rect x="18.3793" y="22.6208" width="5.65517" height="2.82759" rx="0.565517" fill="#5B705A"/>
                            </svg>
                        </span>
                    </div>
                    <small class="help-text">Filtrar entre fechas</small>
                </div>

                <div class="date-filter">
                    <label>Fecha de recolección Hasta <span class="required">*</span></label>
                    <div class="date-input-container">
                        <input type="date" name="fecha_hasta" required>
                        <span class="calendar-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 34 34" fill="none">
                                <rect x="4.24133" y="8.48291" width="25.4483" height="21.2069" rx="2.26207" stroke="#5B705A" stroke-width="2.26207"/>
                                <path d="M4.24133 13.007C4.24133 10.8743 4.24133 9.808 4.90388 9.14545C5.56642 8.48291 6.63277 8.48291 8.76547 8.48291H25.1655C27.2982 8.48291 28.3645 8.48291 29.0271 9.14545C29.6896 9.808 29.6896 10.8743 29.6896 13.007V14.1381H4.24133V13.007Z" fill="#5B705A"/>
                                <path d="M9.89651 4.24146L9.89651 8.48283" stroke="#5B705A" stroke-width="2.26207" stroke-linecap="round"/>
                                <path d="M24.0344 4.24146L24.0344 8.48283" stroke="#5B705A" stroke-width="2.26207" stroke-linecap="round"/>
                                <rect x="9.89651" y="16.9656" width="5.65517" height="2.82759" rx="0.565517" fill="#5B705A"/>
                                <rect x="9.89651" y="22.6208" width="5.65517" height="2.82759" rx="0.565517" fill="#5B705A"/>
                                <rect x="18.3793" y="16.9656" width="5.65517" height="2.82759" rx="0.565517" fill="#5B705A"/>
                                <rect x="18.3793" y="22.6208" width="5.65517" height="2.82759" rx="0.565517" fill="#5B705A"/>
                            </svg>
                        </span>
                    </div>
                    <small class="help-text">Filtrar entre fechas</small>
                </div>
            </div>

            <div class="filter-buttons">
                <button class="btn-descargar">Descargar</button>
                <button class="btn-cancelar">Cancelar</button>
            </div>
        </div>

        <!-- Tabla de solicitudes -->
        <div class="table-container">
            <table class="solicitudes-table">
                <thead>
                    <tr>
                        <th>Descripción Recolecciones</th>
                        <th>Fecha inicio</th>
                        <th>Hora</th>
                        <th>Peso Kg</th>
                        <th>Tipo Residuo</th>
                        <th>Ver</th>
                        <th>Estado</th>
                        <th>Puntos por Recolección</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($solicitudes as $solicitud)
                    <tr>
                        <td>Trayecto {{ $loop->iteration }}</td>
                        <td>{{ \Carbon\Carbon::parse($solicitud->fechaRecoleccion)->format('d/m/y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($solicitud->fechaRecoleccion)->format('h:i a') }}</td>
                        <td>{{ $solicitud->pesoKg ?? 'N/A' }}</td>
                        <td>{{ $solicitud->tipoResiduo }}</td>
                        <td>
                            <button class="btn-ver">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </button>
                        </td>
                            <td>
                                <span class="estado-{{ $solicitud->estado }}">
                                    @if($solicitud->estado == 'completada')
                                        <svg class="icon-check" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/>
                                        </svg>
                                    @else
                                        <svg class="icon-pending" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                                        </svg>
                                    @endif
                                    {{ ucfirst($solicitud->estado) }}
                                </span>
                            </td>
                        <td>{{ $solicitud->estado == 'completada' ? '100' : '0' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="pagination">
            <button class="pagination-btn">&lt;</button>
            <button class="pagination-btn active">1</button>
            <button class="pagination-btn">2</button>
            <button class="pagination-btn">&gt;</button>
        </div>
    </div>
</body>
</html>