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
</head>
<body>

    <nav class="navbar">
        <h1 class="brand">SportBooker</h1>

        <ul class="nav-links">
    <li><a href="{{ url('/') }}">Inicio</a></li>

    @guest
        <li><a href="{{ route('admin.canchas.index') }}">Canchas</a></li> <li><a href="#" onclick="openAuthModal(event)">Inicio Sesión</a></li>
    @endguest

    @auth
        @if(Auth::user()->role->nombre === 'AdminCancha')
            <li><a href="{{ url('/mi-dashboard') }}">Mi Panel</a></li>
            <li><a href="{{ route('admin.canchas.index') }}">Gestionar Canchas</a></li>
            <li><a href="{{ url('/admin/abonos/pendientes') }}">Solicitudes</a></li>
        @endif

        @if(Auth::user()->role->nombre === 'SuperAdmin')
            <li><a href="{{ url('/mi-dashboard') }}">Panel Maestro</a></li>
            <li><a href="{{ url('/admin/pendientes') }}">Verificar Usuarios</a></li>
        @endif

        @if(in_array(Auth::user()->role->nombre, ['ClienteOcasional', 'ClienteRecurrente']))
            <li><a href="{{ url('/mi-dashboard') }}">Mis Reservas</a></li>
            @if(Auth::user()->role->nombre === 'ClienteRecurrente')
                <li><a href="{{ url('/cliente/solicitar-abono') }}">Solicitar Abono</a></li>
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

    <div id="authPanelBackdrop" onclick="closeAuthModal()"></div>
    
    <div id="authPanel">
        <button class="auth-close" onclick="closeAuthModal()">×</button>
        
        <div class="auth-header">
            <img src="/images/v118_43.png" alt="Logo" class="auth-logo">
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="auth-grid">
                <div class="auth-field">
                    <label class="auth-label">Correo Electrónico</label>
                    <input type="email" name="email" class="auth-input" required>
                </div>
                <div class="auth-field">
                    <label class="auth-label">Contraseña</label>
                    <input type="password" name="password" class="auth-input" required>
                </div>
            </div>

            <div class="auth-actions">
                <div class="auth-links">
                    <a href="{{ route('password.request') }}" class="auth-link">¿Olvidaste tu contraseña?</a>
                    <a href="{{ route('register.choice') }}" class="auth-link">Registrarse</a>
                </div>
                <button type="submit" class="auth-submit">ENTRAR</button>
            </div>
        </form>
    </div>

    <script>
        // Lógica del Modal
        function openAuthModal(e) {
            e.preventDefault();
            document.getElementById('authPanelBackdrop').style.display = 'block';
            document.getElementById('authPanel').style.display = 'block';
        }
        function closeAuthModal() {
            document.getElementById('authPanelBackdrop').style.display = 'none';
            document.getElementById('authPanel').style.display = 'none';
        }
    </script>
    
    @stack('scripts')

</body>
</html>