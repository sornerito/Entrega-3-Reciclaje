<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reciclaje</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }
        .header {
            background-color: #4b6a4a;
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header .logo {
            font-size: 1.5rem;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .header .logo img {
            height: 30px;
        }
        .header .menu {
            display: flex;
            gap: 25px;
        }
        .header .menu a {
            color: white;
            text-decoration: none;
            font-size: 1rem;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .header .menu a:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }
        .header .menu a.active {
            background-color: #6c916b;
            font-weight: bold;
        }
        .container {
            padding: 40px;
            text-align: center;
        }
        .content {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="logo">
            <img src="https://placehold.co/30x30/6c916b/ffffff?text=♻️" alt="Logo de la aplicación">
            <span>Logo de la aplicación</span>
        </div>
        <nav class="menu">
            <a href="#">Solicitudes</a>
            <a href="{{ url('/reportes') }}" class="active">Reportes</a>
            <a href="#">Configuración</a>
            <a href="#">Cerrar Sesión</a>
        </nav>
    </header>
    <main class="container">
        @yield('content')
    </main>
</body>
</html>
