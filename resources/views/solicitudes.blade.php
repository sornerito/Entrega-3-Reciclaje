@extends('layout.admin')
@section('content')
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
                <option selected value="1">Todos</option>
                <option value="2">Pendiente</option>
                <option value="3">En progreso</option>
                <option value="4">Aceptado</option>
                <option value="5">Cencelado</option>
            </select>
        </div>
    </div>

    <br>
    <table class="table">
        <thead>
            <tr>
                <td>Nombre</td>
                <td>F. de recolección</td>
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
                    <td>{{ $solicitud->solicitudinorganica->pesoKg ?? 'N/A' }}</td>
                    <td>{{ $solicitud->tiporesiduo->nombre }}</td>
                    <td>{{ $solicitud->estado }}</td>
                    <td class="d-flex gap-1.5">
                        @if ($solicitud->estado != 'En proceso')
                            <div>
                                <x-icon name="lupa" class="text-black" />
                            </div>
                        @endif
                        @if ($solicitud->estado == 'Pendiente')
                            <div>
                                <x-icon name="x" class=" text-danger" />
                            </div>
                            <div>
                                <x-icon name="check" class="text-success" style="cursor:pointer;" data-bs-toggle="modal"
                                    data-bs-target="#modalAceptar" data-id="{{ $solicitud->idSolicitud }}"
                                    data-residuo="{{ $solicitud->idResiduo }}" />
                            </div>
                        @endif
                        @if ($solicitud->estado == 'En proceso')
                            <div>
                                <x-icon name="flecha" class="text-primary" style="cursor:pointer;" data-bs-toggle="modal"
                                    data-bs-target="#modalFinalizar" data-id="{{ $solicitud->idSolicitud }}" />
                            </div>
                        @endif

                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // modal aceptar
            var modalAceptar = document.getElementById('modalAceptar');
            var formAceptar = document.getElementById('formAceptarSolicitud');
            var selectRecolectora = document.getElementById('select-recolectora');

            modalAceptar.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var idSolicitud = button.getAttribute('data-id');
                var idResiduo = button.getAttribute('data-residuo');

                document.getElementById('input-idSolicitud').value = idSolicitud;

                // filtro
                Array.from(selectRecolectora.options).forEach(function(opt) {
                    if (opt.value === "") return;
                    let residuos = opt.getAttribute('data-residuos').split(',');
                    opt.style.display = residuos.includes(idResiduo) ? "block" : "none";
                });

                formAceptar.action = "{{ url('/solicitudes') }}/" + idSolicitud;
            });

            // modal finalizar
            var modalFinalizar = document.getElementById('modalFinalizar');
            var formFinalizar = document.getElementById('formFinalizar');

            modalFinalizar.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var idSolicitud = button.getAttribute('data-id');

                document.getElementById('input-idSolicitud-finalizar').value = idSolicitud;

                formFinalizar.action = "{{ url('/solicitudes') }}/" + idSolicitud + "/finalizar";
            });

        });
    </script>

    <!--Modal aceptar-->
    <div class="modal fade" id="modalAceptar" tabindex="-1" aria-labelledby="modalAceptarLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <form id="formAceptarSolicitud" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-body text-center">
                        <div>
                            <x-icon name="alerta" class=" text-warning" />
                            <p>Para ACEPTAR la solicitud, seleccione uno de los recolectores especializados:</p>
                        </div>

                        <input type="hidden" name="idSolicitud" id="input-idSolicitud">

                        <div class="form-group">
                            <label for="idRecolectora">Seleccionar Recolectora:</label>
                            <select name="idRecolectora" id="select-recolectora" class="form-select">
                                <option value="">-- Selecciona --</option>
                                @foreach ($recolectoras as $recolectora)
                                    <option value="{{ $recolectora->nit }}"
                                        data-residuos="{{ implode(',', $recolectora->tiposResiduo->pluck('idResiduo')->toArray()) }}">
                                        {{ $recolectora->persona->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Aceptar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modalFinalizar" tabindex="-1" aria-labelledby="modalFinalizarLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <form id="formFinalizar" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-body text-center">
                        <x-icon name="alerta" class=" text-warning" />
                        <input type="hidden" name="idSolicitud" id="input-idSolicitud-finalizar">

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="otorgar_puntos" id="checkPuntos">
                            <label class="form-check-label text-3xl" for="checkPuntos">
                                Marque la casilla si el usuario separo correctamente las casillas.
                            </label>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Finalizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection