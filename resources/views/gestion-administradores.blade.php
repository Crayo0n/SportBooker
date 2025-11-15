<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>SportBooker – Gestión de Administradores</title>

    <!-- Fuentes -->
    <link href="https://fonts.googleapis.com/css?family=Black+Ops+One&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Keania+One&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Blinker:400,600,700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Inter:400,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Audiowide&display=swap" rel="stylesheet" />

    <!-- CSS base (navbar, footer, modal) -->
    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}">
    <!-- CSS específico de gestión de administradores -->
    <link rel="stylesheet" href="{{ asset('css/gestion-administradores.css') }}">
</head>
<body>
    <!-- ===== NAVBAR ===== -->
    <nav class="navbar">
        <h1 class="brand">SportBooker</h1>

        <ul class="nav-links">
            <li><a href="{{ url('/') }}#inicio">Inicio</a></li>
            <li><a href="{{ route('cancha.detalle') }}">Canchas</a></li>
            <li><a href="{{ route('cancha.horarios') }}">Canchas+</a></li>
            <li><a href="{{ route('perfil') }}">Mi Perfil</a></li>
            <li><a href="#" id="loginLink">Inicio Sesión</a></li>
        </ul>

        <div class="navbar-right">
            <form id="searchForm" class="search" role="search" onsubmit="event.preventDefault()">
                <input id="searchInput" type="search" placeholder="Buscar..." aria-label="Buscar en SportBooker" autocomplete="off" />
                <button type="submit" aria-label="Buscar">⌕</button>
            </form>
        </div>
    </nav>

    {{-- ===== CONTENIDO PRINCIPAL (SOLO SUPER ADMIN) ===== --}}
    <main class="admin-wrapper">
        <!-- HEADER PRINCIPAL -->
        <header class="admin-header">
            <div class="admin-header-main">
                <h2>Gestión de administradores</h2>
                <p>
                    Controla los administradores del sistema: agrega nuevos, revisa sus datos
                    y elimina accesos cuando sea necesario. Este panel está restringido al
                    <strong>Super Admin</strong>.
                </p>
            </div>
        </header>

        <!-- TARJETAS DE RESUMEN (similar a historial-reservas) -->
        <section class="admin-summary-grid">
            <article class="admin-summary-card admin-summary-total">
                <p class="summary-label">Administradores totales</p>
                <p class="summary-value">5</p>
                <p class="summary-note">Incluye Super Admin + Admins.</p>
            </article>

            <article class="admin-summary-card admin-summary-active">
                <p class="summary-label">Admins activos</p>
                <p class="summary-value">4</p>
                <p class="summary-note">Con acceso vigente al panel.</p>
            </article>

            <article class="admin-summary-card admin-summary-inactive">
                <p class="summary-label">Admins inactivos / suspendidos</p>
                <p class="summary-value">1</p>
                <p class="summary-note">Requieren revisión o reactivación.</p>
            </article>

            <article class="admin-summary-card admin-summary-role">
                <p class="summary-label">Acceso a este panel</p>
                <p class="summary-value summary-badge">Solo Super Admin</p>
                <p class="summary-note">Las altas y bajas definitivas están restringidas.</p>
            </article>
        </section>

        <!-- TARJETA DE FILTROS Y ACCIONES -->
        <section class="admin-content-section">
            <section class="admin-card admin-filters-card">
                <header class="admin-card-header">
                    <div>
                        <h3>Listado de administradores</h3>
                        <p>
                            Usa los filtros para encontrar administradores por nombre, correo, estado
                            o tipo de rol.
                        </p>
                    </div>

                    <button class="primary-btn admin-add-btn">
                        + Agregar administrador
                    </button>
                </header>

                <form class="admin-filters-form" onsubmit="event.preventDefault()">
                    <div class="admin-filter-group admin-filter-search">
                        <label for="searchAdmin" class="admin-filter-label">Buscar</label>
                        <input
                            id="searchAdmin"
                            type="text"
                            class="admin-filter-input"
                            placeholder="Nombre, correo o rol…"
                        />
                    </div>

                    <div class="admin-filter-group">
                        <label for="statusFilter" class="admin-filter-label">Estado</label>
                        <select id="statusFilter" class="admin-filter-select">
                            <option value="all">Todos</option>
                            <option value="active">Activo</option>
                            <option value="inactive">Inactivo</option>
                            <option value="suspended">Suspendido</option>
                        </select>
                    </div>

                    <div class="admin-filter-group">
                        <label for="roleFilter" class="admin-filter-label">Tipo</label>
                        <select id="roleFilter" class="admin-filter-select">
                            <option value="all">Todos</option>
                            <option value="super">Super Admin</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>

                    <button type="submit" class="filter-btn">
                        Aplicar filtros
                    </button>
                </form>
            </section>

            <!-- TARJETA CON LA TABLA (estilo similar a historial-reservas) -->
            <section class="admin-card admin-table-card">
                <div class="admin-table-header-row">
                    <div>
                        <h4 class="admin-table-title">Administradores registrados</h4>
                        <span class="admin-table-subtitle">
                            Usuarios con permisos avanzados sobre canchas, reservas y gestión de usuarios.
                        </span>
                    </div>
                </div>

                <div class="admin-table-scroll">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Tipo</th>
                                <th>Estado</th>
                                <th>Último acceso</th>
                                <th class="admin-actions-header">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Ejemplos estáticos. Luego los cambias por tu foreach --}}
                            <tr>
                                <td>María López</td>
                                <td>maria.lopez@sportbooker.com</td>
                                <td>Super Admin</td>
                                <td>
                                    <span class="status-pill status-on">Activo</span>
                                </td>
                                <td>14/11/2025 · 09:32</td>
                                <td class="admin-actions-cell">
                                    <button class="table-action">Ver</button>
                                    <button class="table-action admin-edit">Editar</button>
                                    <button class="table-action admin-danger">Eliminar</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Carlos Ramírez</td>
                                <td>carlos.ramirez@sportbooker.com</td>
                                <td>Admin</td>
                                <td>
                                    <span class="status-pill status-on">Activo</span>
                                </td>
                                <td>13/11/2025 · 18:10</td>
                                <td class="admin-actions-cell">
                                    <button class="table-action">Ver</button>
                                    <button class="table-action admin-edit">Editar</button>
                                    <button class="table-action admin-danger">Eliminar</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Ana Torres</td>
                                <td>ana.torres@sportbooker.com</td>
                                <td>Admin</td>
                                <td>
                                    <span class="status-pill status-off">Inactivo</span>
                                </td>
                                <td>02/11/2025 · 12:45</td>
                                <td class="admin-actions-cell">
                                    <button class="table-action">Ver</button>
                                    <button class="table-action admin-edit">Editar</button>
                                    <button class="table-action admin-danger">Eliminar</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Jorge Hernández</td>
                                <td>jorge.hernandez@sportbooker.com</td>
                                <td>Admin</td>
                                <td>
                                    <span class="status-pill status-on">Activo</span>
                                </td>
                                <td>14/11/2025 · 15:02</td>
                                <td class="admin-actions-cell">
                                    <button class="table-action">Ver</button>
                                    <button class="table-action admin-edit">Editar</button>
                                    <button class="table-action admin-danger">Eliminar</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Lucía Vega</td>
                                <td>lucia.vega@sportbooker.com</td>
                                <td>Admin</td>
                                <td>
                                    <span class="status-pill status-on">Activo</span>
                                </td>
                                <td>13/11/2025 · 21:20</td>
                                <td class="admin-actions-cell">
                                    <button class="table-action">Ver</button>
                                    <button class="table-action admin-edit">Editar</button>
                                    <button class="table-action admin-danger">Eliminar</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="admin-status-legend">
                    <span><span class="status-pill status-on">Activo</span> Admin con acceso completo al panel.</span>
                    <span><span class="status-pill status-off">Inactivo</span> Acceso pausado, requiere revisión.</span>
                </div>
            </section>
        </section>
    </main>
    {{-- @endcan --}}

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