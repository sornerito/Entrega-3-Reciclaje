<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-gray-100">
    <div class="max-w-4xl mx-auto p-6">
        <h1 class="text-2xl font-bold text-green-700">Bienvenido al Dashboard</h1>
        <p class="mt-2 text-gray-700">Sesión iniciada correctamente.</p>
        <form action="{{ route('logout') }}" method="POST" class="mt-6">
            @csrf
            <button class="px-4 py-2 bg-gray-800 text-white rounded">Cerrar sesión</button>
        </form>
    </div>
</body>
</html>
