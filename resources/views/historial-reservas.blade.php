<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>SportBooker – Historial de Reservas</title>

    <!-- Fuentes -->
    <link href="https://fonts.googleapis.com/css?family=Black+Ops+One&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Keania+One&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Blinker:400,600,700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Inter:400,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Audiowide&display=swap" rel="stylesheet" />

    <!-- CSS específico del historial -->
    <link rel="stylesheet" href="{{ asset('css/historial-reservas.css') }}">
</head>
<body>

    <!-- ===== NAVBAR ===== -->
    <nav class="navbar">
        <h1 class="brand">SportBooker</h1>

        <ul class="nav-links">
            <li><a href="{{ url('/') }}#inicio">Inicio</a></li>
            <li><a href="{{ route('cancha.detalle') }}">Canchas</a></li>
            <li><a href="{{ route('cancha.horarios') }}">Canchas+</a></li>
            <li><a href="{{ route('perfil') }}">Perfil</a></li>
            <li><a href="#" id="loginLink">Inicio Sesión</a></li>
        </ul>

        <div class="navbar-right">
            <form id="searchForm" class="search" role="search" onsubmit="event.preventDefault()">
                <input id="searchInput" type="search" placeholder="Buscar..." aria-label="Buscar en SportBooker" autocomplete="off" />
                <button type="submit" aria-label="Buscar">⌕</button>
            </form>
        </div>
    </nav>

    <!-- ===== CONTENIDO PRINCIPAL ===== -->
    <main class="history-wrapper">

        <!-- Encabezado principal -->
        <header class="history-header">
            <div class="history-header-main">
                <h2>Historial de reservas</h2>
                <p>
                    Consulta todas tus reservas realizadas, así como su estado actual
                    (<strong>Activa</strong>, <strong>Pendiente</strong> o <strong>Rechazada</strong>).
                </p>
            </div>
        </header>

        <!-- Tarjetas de resumen -->
        <section class="history-summary-grid">
            <article class="history-summary-card summary-all">
                <p class="summary-label">Reservas totales</p>
                <p class="summary-value">12</p>
                <p class="summary-note">Incluye todas las reservas realizadas en SportBooker.</p>
            </article>

            <article class="history-summary-card summary-active">
                <p class="summary-label">Reservas activas</p>
                <p class="summary-value">3</p>
                <p class="summary-note">Reservas confirmadas y próximas a usarse.</p>
            </article>

            <article class="history-summary-card summary-pending">
                <p class="summary-label">Reservas pendientes</p>
                <p class="summary-value">7</p>
                <p class="summary-note">En espera de confirmación por el administrador.</p>
            </article>

            <article class="history-summary-card summary-rejected">
                <p class="summary-label">Reservas rechazadas</p>
                <p class="summary-value">2</p>
                <p class="summary-note">Reservas canceladas o no autorizadas.</p>
            </article>
        </section>

        <!-- Bloque filtros + tabla en tarjetas -->
        <section class="history-table-section">

            <!-- Tarjeta de filtros -->
            <article class="history-card history-filters-card">
                <header class="history-table-header">
                    <h3>Listado de reservas</h3>
                    <p>
                        Filtra por estado o por fecha para encontrar una reserva específica.
                    </p>
                </header>

                <form class="history-filters" onsubmit="event.preventDefault()">
                    <div class="filter-group">
                        <label for="filterStatus">Estado</label>
                        <select id="filterStatus" name="estado">
                            <option value="">Todos</option>
                            <option value="activa" selected>Pendiente</option>
                            <option value="activa">Activa</option>
                            <option value="rechazada">Rechazada</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label for="filterDate">Fecha</label>
                        <input type="date" id="filterDate" name="fecha" />
                    </div>

                    <button type="submit" class="filter-btn">Aplicar filtros</button>
                </form>
            </article>

            <!-- Tarjeta con tabla/listado -->
            <article class="history-card history-table-card">
                <div class="history-table-header-row">
                    <p class="history-table-title">Reservas registradas</p>
                </div>

                <div class="history-table-scroll">
                    <table class="history-table">
                        <thead>
                            <tr>
                                <th>Cancha</th>
                                <th>Fecha</th>
                                <th>Horario</th>
                                <th>Estado</th>
                                <th>Folio</th>
                                <th class="history-actions-cell">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Ejemplos de filas. Después los puedes generar con Blade -->
                            <tr>
                                <td>Cancha de Futbol 7 · Campo 2</td>
                                <td>14/11/2025</td>
                                <td>19:00 - 20:00</td>
                                <td>
                                    <span class="status-pill status-activa">Activa</span>
                                </td>
                                <td>SB-2025-0012</td>
                                <td class="history-actions-cell">
                                    <button class="table-action">Detalles</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Cancha de Basquetbol · Techada</td>
                                <td>10/11/2025</td>
                                <td>17:00 - 18:00</td>
                                <td>
                                    <span class="status-pill status-pendiente">Pendiente</span>
                                </td>
                                <td>SB-2025-0011</td>
                                <td class="history-actions-cell">
                                    <button class="table-action">Detalles</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Cancha de Tenis · Cancha 1</td>
                                <td>08/11/2025</td>
                                <td>08:00 - 09:00</td>
                                <td>
                                    <span class="status-pill status-rechazada">Rechazada</span>
                                </td>
                                <td>SB-2025-0010</td>
                                <td class="history-actions-cell">
                                    <button class="table-action table-action-disabled" disabled>Sin acción</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Cancha de Americano · Campo Principal</td>
                                <td>02/11/2025</td>
                                <td>16:00 - 18:00</td>
                                <td>
                                    <span class="status-pill status-activa">Activa</span>
                                </td>
                                <td>SB-2025-0009</td>
                                <td class="history-actions-cell">
                                    <button class="table-action">Detalles</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Cancha de Futbol 7 · Campo 1</td>
                                <td>25/10/2025</td>
                                <td>09:00 - 10:00</td>
                                <td>
                                    <span class="status-pill status-activa">Activa</span>
                                </td>
                                <td>SB-2025-0008</td>
                                <td class="history-actions-cell">
                                    <button class="table-action">Detalles</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Leyenda de estados -->
                <div class="history-status-legend">
                    <span class="status-pill status-activa">Activa</span>
                    <span class="status-pill status-pendiente">Pendiente</span>
                    <span class="status-pill status-rechazada">Rechazada</span>
                </div>
            </article>
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