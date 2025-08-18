@extends("layout.admin")
@section("content")

<div class="row">
    <div class="col-5">
        <h1>Solicitudes</h1>
    </div>
    <div class="col">
        <label for="">Fecha:</label>
        <select class="form-select" aria-label="Fecha selector">
            <option selected value="1">Fecha de recolección ascendente</option>
            <option value="2">Fecha de recolección descendiente</option>
            <option value="3">Fecha de registro ascendente</option>
            <option value="4">Fecha de registro descendiente</option>
        </select>
    </div>
    <div class="col">
        <label for="">Tipo de residuo:</label>
        <select class="form-select" aria-label="Tipo de residuo selector">
            <option selected value="1">Todos</option>
            <option value="2">Orgánico</option>
            <option value="3">Inorgánico</option>
            <option value="4">Peligroso</option>
        </select>
    </div>
    <div class="col">
        <label for="">Estado:</label>
        <select class="form-select" aria-label="Estado selector">
            <option selected value="1">Pendiente</option>
            <option value="2">En progreso</option>
            <option value="3">Aceptado</option>
            <option value="4">Cencelado</option>
        </select>
    </div>
</div>

<br>
<table class="table">
    <thead>
        <tr>
            <td>Nombre</td>
            <td>F. de recoleeción</td>
            <td>F. de registro</td>
            <td>Kg</td>
            <td>Tipo de residuo</td>
            <td>Estado</td>
            <td>Acciones</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($solicitudes as $solicitud)
            <tr>
                <td>{{ $solicitud->usuario->persona->nombre ?? 'Sin usuario' }}</td>
                <td>{{ $solicitud->fechaRecoleccion }}</td>
                <td>{{ $solicitud->fechaRegistro }}</td>
                <td>{{ $solicitud->solicitudinorganica->pesoKg }}</td>
                <td>{{ $solicitud->tiporesiduo->nombre }}</td>
                <td>{{ $solicitud->estado }}</td>
                <td></td>
            </tr>
        @endforeach
        
    </tbody>
</table>


@endsection