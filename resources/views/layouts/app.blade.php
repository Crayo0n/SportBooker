<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>SportBooker – @yield('title', 'Inicio')</title>

    <link href="https://fonts.googleapis.com/css?family=Black+Ops+One&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Keania+One&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Blinker:400,600,700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Inter:400,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Audiowide&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body>

    <nav class="navbar">
        <h1 class="brand">SportBooker</h1>

        <ul class="nav-links">
    <li><a href="{{ url('/') }}">Inicio</a></li>

    @guest
        <li><a href="{{ route('canchas.catalogo') }}">Canchas</a></li>
         <li><a href="{{ route('login') }}" >Inicio Sesión</a></li>
    @endguest

    @auth
        @if(Auth::user()->role->nombre === 'AdminCancha')
            <li><a href="{{ url('/mi-dashboard') }}">Mi Panel</a></li>
            <li><a href="{{ route('admin.canchas.index') }}">Gestionar Canchas</a></li>
            <li><a href="{{ url('/admin/abonos/pendientes') }}">Solicitudes de Rep. Equipo</a></li>
            <li><a href="{{ url('/perfil') }}">Mi Perfil</a></li>
        @endif

        @if(Auth::user()->role->nombre === 'SuperAdmin')
            <li><a href="{{ url('/superadmin/admins') }}">Panel Maestro</a></li>
            <li><a href="{{ url('/admin/pendientes') }}">Verificar Usuarios</a></li>
        @endif

        @if(in_array(Auth::user()->role->nombre, ['ClienteOcasional', 'ClienteRecurrente']))
            <li><a href="{{ url('/mi-dashboard') }}">Mis Reservas</a></li>
            <li><a href="{{ route('canchas.catalogo') }}">Canchas</a></li>
            <li><a href="{{ url('/perfil') }}">Mi Perfil</a></li>

            @if(Auth::user()->role->nombre === 'ClienteRecurrente')
                <li><a href="{{ route('abonos.create') }}">Solicitar Reservas</a></li>
            @endif
        @endif

        <li>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <a href="#" onclick="this.closest('form').submit()">Cerrar Sesión</a>
            </form>
        </li>
    @endauth
</ul>

        <div class="navbar-right">
            <form class="search" role="search" onsubmit="event.preventDefault()">
                <input id="searchInput" type="search" placeholder="Buscar..." />
                <button type="submit">⌕</button>
            </form>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="footer" id="contacto">
        <div class="inner">
            <div class="logo"></div> <h2>Contactos y Atención Ciudadana</h2>
            <p>
                Horarios De Atención: Lunes a viernes de 8:00 a 16:00 horas<br />
                Rivera del Río S/N, El Pueblito. C.P. 76900 Santiago de Querétaro, Qro.<br />
                atencion.ciudadana@municipiodequeretaro.gob.mx
            </p>
        </div>
    </footer>

    
    
    @stack('scripts')

</body>
</html>