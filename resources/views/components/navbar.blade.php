<nav class="navbar">
    <!-- Logo -->
    <div class="navbar-logo">
        <a href="{{ url('/') }}">
            <img src="{{ asset('img/logo.svg') }}" alt="EcoReciclaje Logo">
        </a>
    </div>

    <!-- Links -->
    <div class="navbar-links">
        <a href="{{ route('solicitud.create') }}" class="{{ request()->routeIs('solicitud.create') ? 'active' : '' }}">
            Solicitudes
        </a>
        <a href="{{ route('mis-solicitudes') }}" class="{{ request()->routeIs('mis-solicitudes') ? 'active' : '' }}">
            Historial
        </a>
        <a href="{{ url('/perfil') }}">Puntos</a>
        <a href="{{ url('/cerrar-iniciar') }}">Cerrar Sesión</a>
    </div>
</nav>
