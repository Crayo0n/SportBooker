<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>SportBooker – Mi Perfil</title>

    <!-- Fuentes -->
    <link href="https://fonts.googleapis.com/css?family=Black+Ops+One&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Keania+One&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Blinker:400,600,700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Inter:400,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Audiowide&display=swap" rel="stylesheet" />

    <!-- CSS específico del perfil (incluye navbar, footer, etc.) -->
    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}">
</head>
<body>

    <!-- ===== NAVBAR ===== -->
    <nav class="navbar">
        <h1 class="brand">SportBooker</h1>

        <ul class="nav-links">
            <li><a href="{{ url('/') }}#inicio">Inicio</a></li>
            <li><a href="{{ route('cancha.detalle') }}">Canchas</a></li>
            <li><a href="{{ route('cancha.horarios') }}">Canchas+</a></li>
            <li><a href="{{ route('perfil') }}">Canchas+*</a></li>
            <li><a href="#" id="loginLink">Inicio Sesión</a></li>
        </ul>

        <div class="navbar-right">
            <form id="searchForm" class="search" role="search" onsubmit="event.preventDefault()">
                <input id="searchInput" type="search" placeholder="Buscar..." aria-label="Buscar en SportBooker" autocomplete="off" />
                <button type="submit" aria-label="Buscar">⌕</button>
            </form>
        </div>
    </nav>

    <!-- ===== CONTENIDO PERFIL ===== -->
    <section class="profile-wrapper">
        <!-- Tarjetas superiores -->
        <div class="profile-grid">
            <!-- Tarjeta 1: Nombre + Rol + Foto -->
            <article class="profile-card profile-main">
                <div class="profile-main-text">
                    <p class="profile-label">Nombre:</p>
                    <p class="profile-value">
                        {{-- Aquí puedes usar los datos del usuario logueado --}}
                        {{-- {{ Auth::user()->name }} --}}
                        Luis Eduardo Santano Delgado
                    </p>

                    <p class="profile-label">Rol:</p>
                    <p class="profile-value">
                        {{-- {{ $userRoleName }} --}}
                        Usuario Ocasional
                    </p>
                </div>


            </article>

            <!-- Tarjeta 2: Correo + Contraseña + Teléfono -->
            <article class="profile-card profile-access">
                <div class="profile-access-row">
                    <div>
                        <p class="profile-label">Correo:</p>
                        <p class="profile-value">
                            {{-- {{ Auth::user()->email }} --}}
                            luiseduardosantano@gmail.com
                        </p>
                    </div>
                </div>

                <div class="profile-access-row">
                    <div>
                        <p class="profile-label">Contraseña:</p>
                        <p class="profile-value">
                            ************** <span class="profile-small-action">(Editar)</span>
                        </p>
                    </div>

                    <div class="profile-access-phone">
                        <p class="profile-label">Telefono:</p>
                        <p class="profile-value">
                            442-367-0572 <span class="profile-small-action">(Editar)</span>
                        </p>
                    </div>
                </div>
            </article>

            <!-- Tarjeta 3: Documentos -->
            <article class="profile-card profile-docs">
                <p class="profile-docs-title">Documentos</p>

                <div class="profile-docs-list">
                    <div class="profile-doc-item">
                        <span class="profile-doc-name">INE</span>
                        <button type="button" class="profile-doc-link">Ver</button>
                    </div>

                    <div class="profile-doc-item">
                        <span class="profile-doc-name">Comprobante De Domicilio</span>
                        <button type="button" class="profile-doc-link">Ver</button>
                    </div>

                    <div class="profile-doc-item">
                        <span class="profile-doc-name">Carta Compromiso</span>
                        <button type="button" class="profile-doc-link">Ver</button>
                    </div>
                </div>
            </article>
        </div>

        <!-- Tabla de funcionalidades -->
        <section class="profile-table-section">
            <header class="profile-table-header">
                <h2>Panel de funcionalidades</h2>
                <p>
                    Acciones disponibles para este usuario según su rol.
                    {{-- Puedes cambiar este texto dinámicamente con Blade --}}
                </p>
            </header>

            <div class="profile-table-card">
                <table class="profile-table">
                    <thead>
                        <tr>
                            <th>Funcionalidad</th>
                            <th>Descripción</th>
                            <th>Estado</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Ejemplo estático. Luego puedes recorrer un arreglo de permisos --}}
                        {{-- @foreach($acciones as $accion) --}}
                        {{-- <tr> --}}
                        {{--   <td>{{ $accion->nombre }}</td> --}}
                        {{--   <td>{{ $accion->descripcion }}</td> --}}
                        {{--   <td>... </td> --}}
                        {{--   <td>... </td> --}}
                        {{-- </tr> --}}
                        {{-- @endforeach --}}

                        <tr>
                            <td>Reservar cancha</td>
                            <td>Permite crear nuevas reservaciones.</td>
                            <td><span class="status-pill status-on">Activo</span></td>
                            <td><button class="table-action">Ir</button></td>
                        </tr>
                        <tr>
                            <td>Historial de reservas</td>
                            <td>Consulta de todas las reservas realizadas.</td>
                            <td><span class="status-pill status-on">Activo</span></td>
                            <td><button class="table-action">Ver</button></td>
                        </tr>
                        <tr>
                            <td>Gestión de usuarios</td>
                            <td>Alta, baja y edición de usuarios (solo administradores).</td>
                            <td><span class="status-pill status-off">No disponible</span></td>
                            <td><button class="table-action table-action-disabled" disabled>Restringido</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </section>

    <!-- ===== FOOTER ===== -->
    <footer class="footer" id="contacto">
        <div class="inner">
           
            <h2>Contactos y Atención Ciudadana</h2>
            <p>
                Horarios De Atención: Lunes a viernes de 8:00 a 16:00 horas<br />
                Rivera del Río S/N, El Pueblito. C.P. 76900 Santiago de Querétaro, Qro.<br />
                atencion.ciudadana@municipiodequeretaro.gob.mx
            </p>
        </div>
    </footer>

    @vite('resources/js/app.js')

    <!-- ===== MODAL LOGIN / REGISTRO / RECUPERAR ===== -->
    <div id="authPanelBackdrop"></div>

    <div id="authPanel" aria-modal="true" role="dialog" aria-labelledby="authTitle" tabindex="-1">
        <button class="auth-close" id="authClose" aria-label="Cerrar">×</button>

        <div class="auth-header">
            <img class="auth-logo" src="{{ asset('images/v118_43.png') }}" alt="SportBooker">
        </div>

        <div class="auth-tabs" role="tablist">
            <button id="tabLogin" class="active" aria-selected="true" aria-controls="formLogin">Iniciar sesión</button>
            <button id="tabRegister" aria-selected="false" aria-controls="formRegister">Registrarse</button>
            <button id="tabRecover" aria-selected="false" aria-controls="formRecover">Recuperar</button>
        </div>

        {{-- Login --}}
        <form id="formLogin" class="auth-grid" autocomplete="on">
            <div class="auth-field">
                <label for="loginEmail" class="auth-label">Usuario</label>
                <input id="loginEmail" class="auth-input" name="email" type="text" placeholder="Usuario" required />
            </div>
            <div class="auth-field">
                <label for="loginPassword" class="auth-label">Contraseña</label>
                <input id="loginPassword" class="auth-input" name="password" type="password" placeholder="Contraseña" required />
            </div>
            <div class="auth-actions">
                <div class="auth-links">
                    <a href="#" id="goRecover" class="auth-link">Recuperar Contraseña</a>
                    <a href="#" id="goRegister" class="auth-link">Crear Cuenta</a>
                </div>
                <button type="submit" class="auth-submit">Entrar</button>
            </div>
        </form>

        {{-- Registro --}}
        <form id="formRegister" class="auth-grid" style="display:none" autocomplete="on">
            <div class="auth-field">
                <label for="regName" class="auth-label">Nombre completo</label>
                <input id="regName" class="auth-input" type="text" placeholder="Tu nombre" required />
            </div>
            <div class="auth-field">
                <label for="regEmail" class="auth-label">Correo</label>
                <input id="regEmail" class="auth-input" type="email" placeholder="tu@correo.com" required />
            </div>
            <div class="auth-field">
                <label for="regPassword" class="auth-label">Contraseña</label>
                <input id="regPassword" class="auth-input" type="password" placeholder="••••••••" required />
            </div>
            <div class="auth-actions">
                <div class="auth-links">
                    <a href="#" id="backLoginFromReg" class="auth-link">Ya tengo cuenta</a>
                </div>
                <button type="submit" class="auth-submit">Registrarse</button>
            </div>
        </form>

        {{-- Recuperar --}}
        <form id="formRecover" class="auth-grid" style="display:none" autocomplete="on">
            <div class="auth-field">
                <label for="recEmail" class="auth-label">Correo</label>
                <input id="recEmail" class="auth-input" type="email" placeholder="Ingresa tu correo" required />
            </div>
            <div class="auth-actions">
                <div class="auth-links">
                    <a href="#" id="backLoginFromRec" class="auth-link">Volver a iniciar sesión</a>
                </div>
                <button type="submit" class="auth-submit">Enviar</button>
            </div>
        </form>
    </div>
</body>
</html>
