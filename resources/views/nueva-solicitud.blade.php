<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Solicitud</title>
    <script>
        function mostrarPeso(select) {
            const pesoDiv = document.getElementById("pesoDiv");
            // Si el valor seleccionado corresponde al Inorgánico (ejemplo id=2)
            if (select.options[select.selectedIndex].text === "Inorganico") {
                pesoDiv.style.display = "block";
            } else {
                pesoDiv.style.display = "none";
            }
        }

        function cancelarFormulario() {
            window.location.href = "/";
        }
    </script>
</head>
<body>
    <h1>Crear Nueva Solicitud</h1>

    <form action="{{ url('/nueva-solicitud') }}" method="POST">
        @csrf

        <label for="fechaRecoleccion">Fecha de Recolección:</label><br>
        <input type="date" name="fechaRecoleccion" required><br><br>

        <label for="idResiduo">Tipo de Residuo:</label><br>
        <select name="idResiduo" onchange="mostrarPeso(this)" required>
            <option value="">Seleccione...</option>
            @foreach($residuos as $residuo)
                <option value="{{ $residuo->idResiduo }}">{{ $residuo->nombre }}</option>
            @endforeach
        </select><br><br>

        <div id="pesoDiv" style="display:none;">
            <label for="pesoKg">Peso en Kg:</label><br>
            <input type="number" step="0.01" name="pesoKg"><br><br>
        </div>

        <label for="numeroIdentidadUsuario">Número de Identidad:</label><br>
        <input type="text" name="numeroIdentidadUsuario" required><br><br>

        <button type="submit">Guardar</button>
        <button type="button" onclick="cancelarFormulario()">Cancelar</button>
    </form>
</body>
</html>
