<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Solicitud</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    @include('components.navbar')

    <div class="container">
        <h1 class="form-title">Nueva Solicitud</h1>

        <form action="{{ url('/nueva-solicitud') }}" method="POST" class="solicitud-form">
            @csrf
            
            <div class="form-row">
                <div class="form-group">
                    <label for="idResiduo">Tipo de residuo <span class="required">*</span></label>
                    <select name="idResiduo" onchange="mostrarPeso(this)" required>
                        <option value="">Seleccione...</option>
                        @foreach($residuos as $residuo)
                            <option value="{{ $residuo->idResiduo }}">{{ $residuo->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="fechaRecoleccion">Fecha de recolección <span class="required">*</span></label>
                    <div class="date-input-container">
                        <input type="date" name="fechaRecoleccion" required>
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
                    <small class="help-text">La fecha puede estar sujeta a cambios</small>
                </div>
            </div>

            <div id="pesoDiv" class="form-group" style="display:none;">
                <label for="pesoKg">Peso <span class="required">*</span></label>
                <input type="number" step="0.01" name="pesoKg" placeholder="25kg">
                <small class="help-text">Ingrese un peso estimado</small>
            </div>

            <div class="form-group">
                <label for="notasAdicionales">Notas adicionales</label>
                <textarea name="notasAdicionales" rows="3" placeholder="Residuo pesado, traer ayuda"></textarea>
            </div>

            <div class="button-group">
                <button type="submit" class="btn-guardar">Guardar</button>
                <button type="button" class="btn-cancelar" onclick="cancelarFormulario()">Cancelar</button>
            </div>
        </form>
    </div>
    <script>
        function mostrarPeso(select) {
            const pesoDiv = document.getElementById("pesoDiv");
            if (select.options[select.selectedIndex].text === "Inorganico") {
                pesoDiv.style.display = "block";
            } else {
                pesoDiv.style.display = "none";
            }
        }

        function cancelarFormulario() {
            window.location.href = "/";
        }

        // Manejar envío del formulario
        const form = document.querySelector('.solicitud-form');
        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¿Deseas crear esta solicitud?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#5B705A',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, crear',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Enviar formulario con fetch
                        const formData = new FormData(this);
                        
                        fetch(this.action, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                Swal.fire({
                                    title: '¡Éxito!',
                                    text: data.message,
                                    icon: 'success',
                                    confirmButtonColor: '#5B705A'
                                }).then(() => {
                                    window.location.href = "{{ route('mis-solicitudes') }}";
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error',
                                    text: data.message,
                                    icon: 'error',
                                    confirmButtonColor: '#5B705A'
                                });
                            }
                        })
                        .catch(error => {
                            Swal.fire({
                                title: 'Error',
                                text: 'Ocurrió un error al procesar la solicitud',
                                icon: 'error',
                                confirmButtonColor: '#5B705A'
                            });
                        });
                    }
                });
            });
        }
    </script>
</body>
</html>