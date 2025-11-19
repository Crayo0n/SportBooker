<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>SportBooker – Gestión de Usuarios</title>

    <!-- Fuentes -->
    <link href="https://fonts.googleapis.com/css?family=Black+Ops+One&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Keania+One&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Blinker:400,600,700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Inter:400,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Audiowide&display=swap" rel="stylesheet" />

    <!-- CSS reutilizado de perfil (navbar, footer, modal) -->
    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}">
    <!-- CSS específico de gestión de usuarios (alineado con historial-reservas / admin) -->
    <link rel="stylesheet" href="{{ asset('css/gestion-usuarios.css') }}">
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

    {{-- ===== CONTENIDO PRINCIPAL (ADMIN / SUPER ADMIN) ===== --}}
    <section class="profile-wrapper users-wrapper">
        <!-- HEADER PRINCIPAL -->
        <header class="users-header">
            <div class="users-header-main">
                <h2>Gestión de usuarios</h2>
                <p>
                    Administra las cuentas de usuarios registrados en SportBooker:
                    consulta información, cambia estados y gestiona sus roles cuando sea necesario.
                </p>
            </div>
        </header>

        <!-- TARJETAS RESUMEN (fila tipo historial-reservas / admin) -->
        <section class="users-summary-grid">
            <!-- Total usuarios -->
            <article class="users-summary-card users-summary-total">
                <p class="summary-label">Total de usuarios</p>
                <p class="summary-value">248</p>
                <p class="summary-note">Incluye  administradores y cuentas especiales.</p>
            </article>

            <!-- Usuarios activos -->
            <article class="users-summary-card users-summary-active">
                <p class="summary-label">Usuarios activos</p>
                <p class="summary-value">214</p>
                <p class="summary-note">Cuentas con acceso habilitado.</p>
            </article>

            <!-- Usuarios bloqueados -->
            <article class="users-summary-card users-summary-blocked">
                <p class="summary-label">Usuarios bloqueados</p>
                <p class="summary-value">12</p>
                <p class="summary-note">Por incumplimiento de reglas o solicitudes de baja.</p>
            </article>

            <!-- Usuarios pendientes de verificación -->
            <article class="users-summary-card users-summary-pending">
                <p class="summary-label">Pendientes de verificación</p>
                <p class="summary-value">22</p>
                <p class="summary-note">Cuentas que aún no completan su registro.</p>
            </article>
        </section>

        <!-- CONTENIDO: FILTROS + TABLA -->
        <section class="users-content-section">
            <!-- TARJETA DE FILTROS -->
            <article class="users-card users-filters-card">
                <div class="users-card-header">
                    <div>
                        <h3>Filtros de búsqueda</h3>
                        <p>Refina la lista de usuarios por nombre, estado y tipo de cuenta.</p>
                    </div>
                    <button type="button" class="primary-btn">
                        + Crear usuario
                    </button>
                </div>

                <form class="users-filters-form" onsubmit="event.preventDefault()">
                    <!-- Buscar -->
                    <div class="users-filter-group">
                        <label for="searchUser" class="users-filter-label">Buscar</label>
                        <input id="searchUser" type="text" class="users-filter-input" placeholder="Nombre, correo o teléfono…" />
                    </div>

                    <!-- Estado -->
                    <div class="users-filter-group">
                        <label for="stateFilter" class="users-filter-label">Estado</label>
                        <select id="stateFilter" class="users-filter-select">
                            <option value="all">Todos</option>
                            <option value="active">Activo</option>
                            <option value="blocked">Bloqueado</option>
                            <option value="pending">Pendiente</option>
                            <option value="verified">Verificado</option>
                        </select>
                    </div>

                    <!-- Rol / tipo -->
                    <div class="users-filter-group">
                        <label for="roleFilter" class="users-filter-label">Tipo de cuenta</label>
                        <select id="roleFilter" class="users-filter-select">
                            <option value="all">Todos</option>
                            <option value="player">Administrador</option>
                            <option value="admin">Administrador</option>
                            <option value="super">Super admin</option>
                        </select>
                    </div>

                    <!-- Botón aplicar -->
                    <button type="submit" class="filter-btn">
                        Aplicar filtros
                    </button>
                </form>
            </article>

            <!-- TARJETA TABLA PRINCIPAL -->
            <article class="users-card users-table-card">
                <div class="users-table-header-row">
                    <div>
                        <h3 class="users-table-title">Listado de usuarios</h3>
                        <span class="users-table-subtitle">
                            Visualiza y gestiona los usuarios registrados en SportBooker.
                        </span>
                    </div>

                    <!-- Info pequeña (opcional) -->

                </div>

                <div class="users-table-scroll">
                    <table class="users-table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Tipo de cuenta</th>
                                <th>Estado</th>
                                <th>Último acceso</th>
                                <th class="users-actions-header">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Ejemplos estáticos. Luego los cambias por tu foreach con Blade --}}
                            <tr>
                                <td>Luis Eduardo Santano</td>
                                <td>luis.santano@sportbooker.com</td>
                                <td>Administrador</td>
                                <td>
                                    <span class="status-pill status-on">Activo</span>
                                </td>
                                <td>14/11/2025 · 21:10</td>
                                <td class="users-actions-cell">
                                    <button class="table-action">Ver</button>
                                    <button class="table-action users-edit">Editar</button>
                                    <button class="table-action users-block">Bloquear</button>
                                </td>
                            </tr>
                            <tr>
                                <td>María López</td>
                                <td>maria.lopez@example.com</td>
                                <td>Administrador</td>
                                <td>
                                    <span class="status-pill status-on">Activo</span>
                                </td>
                                <td>14/11/2025 · 18:42</td>
                                <td class="users-actions-cell">
                                    <button class="table-action">Ver</button>
                                    <button class="table-action users-edit">Editar</button>
                                    <button class="table-action users-block">Bloquear</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Carlos Ramírez</td>
                                <td>carlos.ramirez@example.com</td>
                                <td>Administrador</td>
                                <td>
                                    <span class="status-pill status-blocked">Bloqueado</span>
                                </td>
                                <td>02/11/2025 · 11:03</td>
                                <td class="users-actions-cell">
                                    <button class="table-action">Ver</button>
                                    <button class="table-action users-edit">Editar</button>
                                    <button class="table-action users-unblock">Desbloquear</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Ana Torres</td>
                                <td>ana.torres@example.com</td>
                                <td>Administrador</td>
                                <td>
                                    <span class="status-pill status-pending">Pendiente</span>
                                </td>
                                <td>–</td>
                                <td class="users-actions-cell">
                                    <button class="table-action">Ver</button>
                                    <button class="table-action users-verify">Verificar</button>
                                    <button class="table-action users-block">Bloquear</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Jorge Hernández</td>
                                <td>jorge.hernandez@example.com</td>
                                <td>Super admin</td>
                                <td>
                                    <span class="status-pill status-on">Activo</span>
                                </td>
                                <td>10/11/2025 · 09:24</td>
                                <td class="users-actions-cell">
                                    <button class="table-action">Ver</button>
                                    <button class="table-action users-edit">Editar</button>
                                    <button class="table-action users-block">Bloquear</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Leyenda de estados / info extra -->
                <div class="users-status-legend">
                    <span><strong>Activo:</strong> el usuario puede iniciar sesión y reservar.</span>
                    <span><strong>Bloqueado:</strong> el usuario no puede acceder al sistema.</span>
                    <span><strong>Pendiente:</strong> registro incompleto o en revisión.</span>
                </div>
            </article>
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

    <!-- ===== MODAL LOGIN / REGISTRO / RECUPERAR (igual que en perfil) ===== -->
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