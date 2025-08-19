<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro</title>
  @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
  <div class="w-full max-w-md p-8 bg-white rounded-2xl shadow-lg">
    <!-- Logo -->
    <div class="flex justify-center mb-6">
      <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-16">
    </div>

    <h2 class="text-2xl font-bold text-center text-gray-700 mb-6">Registro</h2>

    @if ($errors->any())
      <div class="mb-4 p-3 rounded bg-red-100 text-red-800 text-sm">
        <ul class="list-disc list-inside">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
      @csrf

      <label class="block text-sm font-medium text-gray-700">Nombre</label>
      <input name="name" type="text" value="{{ old('name') }}" required
             class="mt-1 mb-3 block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"/>

      <label class="block text-sm font-medium text-gray-700">Correo</label>
      <input name="email" type="email" value="{{ old('email') }}" required
             class="mt-1 mb-3 block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"/>

      <label class="block text-sm font-medium text-gray-700">Contraseña</label>
      <input name="password" type="password" required
             class="mt-1 mb-3 block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"/>

      <label class="block text-sm font-medium text-gray-700">Confirmar contraseña</label>
      <input name="password_confirmation" type="password" required
             class="mt-1 mb-4 block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"/>

      <button type="submit"
              class="w-full px-4 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition">
        Registrarme
      </button>
    </form>

    <p class="text-center text-sm text-gray-600 mt-4">
      ¿Ya tienes cuenta?
      <!-- Enlace directo al login -->
      <a href="{{ route('login') }}" class="text-green-700 hover:text-green-900 font-semibold">Inicia sesión aquí</a>
    </p>
  </div>
</body>
</html>
