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
    <main class="profile-page">
        <section class="profile-wrapper">

            <!-- ===== HEADER PERFIL / RESUMEN (SIN AVATAR) ===== -->
            <header class="profile-header">
                <div class="profile-header-main">
                    <h2 class="profile-title">Mi perfil</h2>
                    <p class="profile-subtitle">
                        Revisa tu información personal, tus datos de acceso y los documentos vinculados a tu cuenta.
                    </p>


            </header>

            <!-- ===== GRID DE TARJETAS SUPERIORES ===== -->
            <section class="profile-grid">

                <!-- Tarjeta 1: Información básica -->
                <article class="profile-card profile-main">
                    <header class="profile-card-header">
                        <h3>Información básica</h3>
                        <span class="profile-chip profile-chip-soft">Datos personales</span>
                    </header>

                    <div class="profile-main-body">
                        <div class="profile-field">
                            <p class="profile-label">Nombre completo</p>
                            <p class="profile-value">
                                {{-- {{ Auth::user()->name }} --}}
                                Luis Eduardo Santano Delgado
                            </p>
                        </div>

                        <div class="profile-field">
                            <p class="profile-label">Rol dentro del sistema</p>
                            <p class="profile-value">
                                {{-- {{ $userRoleName }} --}}
                                Usuario Ocasional
                            </p>
                        </div>

                        <div class="profile-field-inline">
                            <div>
                                <p class="profile-label">Teléfono</p>
                                <p class="profile-value">
                                    442-367-0572
                                </p>
                            </div>
                            <button type="button" class="profile-inline-btn">
                                Editar datos
                            </button>
                        </div>
                    </div>
                </article>

                <!-- Tarjeta 2: Acceso a la cuenta -->
                <article class="profile-card profile-access">
                    <header class="profile-card-header">
                        <h3>Acceso a la cuenta</h3>
                        <span class="profile-chip">Seguridad</span>
                    </header>

                    <div class="profile-access-body">
                        <div class="profile-field">
                            <p class="profile-label">Correo de acceso</p>
                            <p class="profile-value">
                                {{-- {{ Auth::user()->email }} --}}
                                luiseduardosantano@gmail.com
                            </p>
                        </div>

                        <div class="profile-field">
                            <p class="profile-label">Contraseña</p>
                            <p class="profile-value">
                                **************
                            </p>
                            <button type="button" class="profile-inline-link">
                                Cambiar contraseña
                            </button>
                        </div>

                        <div class="profile-field">
                            <p class="profile-label">Último inicio de sesión</p>
                            <p class="profile-value profile-value-muted">
                                14/11/2025 · 21:45
                            </p>
                        </div>
                    </div>
                </article>

                <!-- Tarjeta 3: Documentos -->
                <article class="profile-card profile-docs">
                    <header class="profile-card-header">
                        <h3>Documentos</h3>
                        <span class="profile-chip profile-chip-soft">Verificación</span>
                    </header>

                    <div class="profile-docs-body">
                        <p class="profile-docs-hint">
                            Estos documentos ayudan a verificar tu identidad y agilizar el proceso de reserva.
                        </p>

                        <div class="profile-docs-list">
                            <div class="profile-doc-item">
                                <div class="profile-doc-text">
                                    <span class="profile-doc-name">INE</span>
                                    <span class="profile-doc-status profile-doc-status-ok">Cargado</span>
                                </div>
                                <button type="button" class="profile-doc-link">Ver</button>
                            </div>

                            <div class="profile-doc-item">
                                <div class="profile-doc-text">
                                    <span class="profile-doc-name">Comprobante de domicilio</span>
                                    <span class="profile-doc-status profile-doc-status-ok">Cargado</span>
                                </div>
                                <button type="button" class="profile-doc-link">Ver</button>
                            </div>

                            <div class="profile-doc-item">
                                <div class="profile-doc-text">
                                    <span class="profile-doc-name">Carta compromiso</span>
                                    <span class="profile-doc-status profile-doc-status-pending">Pendiente</span>
                                </div>
                                <button type="button" class="profile-doc-link">Cargar</button>
                            </div>
                        </div>
                    </div>
                </article>
            </section>

            <!-- ===== PANEL DE FUNCIONALIDADES ===== -->
            <section class="profile-table-section">
                <article class="profile-table-card">
                    <header class="profile-table-header">
                        <div>
                            <h2>Panel de funcionalidades</h2>
                            <p>
                                Acciones disponibles para este usuario según su rol dentro del sistema.
                            </p>
                        </div>

                        <div class="profile-table-legend">
                            <span class="profile-pill profile-pill-role">Admin / Super admin</span>
                            <span class="profile-pill profile-pill-soft">Usuario ocasional</span>
                        </div>
                    </header>

                    <div class="profile-table-wrapper">
                        <table class="profile-table">
                            <thead>
                                <tr>
                                    <th>Funcionalidad</th>
                                    <th>Descripción</th>
                                    <th>Rol</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Gestión de administradores (solo super admin) --}}
                                <tr>
                                    <td>Gestión de administradores</td>
                                    <td>Permite aceptar o rechazar solicitudes y administrar cuentas de administradores.</td>
                                    <td>
                                        <span class="profile-tag profile-tag-danger">
                                            Solo Super admin
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('gestion-administradores') }}" class="table-action">
                                            Ver
                                        </a>
                                    </td>
                                </tr>

                                {{-- Historial de reservas (para todos los usuarios) --}}
                                <tr>
                                    <td>Historial de reservas</td>
                                    <td>Consulta todas las reservas realizadas y su estado (activa, pendiente o rechazada).</td>
                                    <td>
                                        <span class="profile-tag profile-tag-ok">
                                            Todos los usuarios
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('reservas.historial') }}" class="table-action">
                                            Ver
                                        </a>
                                    </td>
                                </tr>

                                {{-- Gestión de usuarios (admin y super admin) --}}
                                <tr>
                                    <td>Gestión de usuarios</td>
                                    <td>Alta, baja y edición de usuarios del sistema (solo administradores).</td>
                                    <td>
                                        <span class="profile-tag profile-tag-warn">
                                            Admin / Super admin
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('gestion.usuarios') }}" class="table-action">
                                            Ver
                                        </a>
                                    </td>
                                </tr>

                                {{-- Ejemplo de funcionalidad restringida actual para este perfil --}}
                                <tr>
                                    <td>Gestión avanzada de usuarios</td>
                                    <td>Configuraciones especiales de acceso y permisos detallados.</td>
                                    <td>
                                        <span class="profile-tag profile-tag-danger">
                                            Restringido
                                        </span>
                                    </td>
                                    <td>
                                        <button class="table-action table-action-disabled" disabled>
                                            Restringido
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </article>
            </section>
        </section>
    </main>

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
