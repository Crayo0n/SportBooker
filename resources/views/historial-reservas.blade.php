<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>SportBooker – Historial de Reservas (Administrador)</title>

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
                <h2>Historial de reservas (Administrador)</h2>
                <p>
                    Vista previa de todas las reservaciones registradas en el sistema.
                    Aquí puedes revisar datos de usuario, cancha, horarios, método de pago
                    y el estado tanto del pago como de la reservación.
                </p>
            </div>
        </header>

        <!-- Tarjetas de resumen (pueden conectarse a agregados de BD después) -->
        <section class="history-summary-grid">
            <article class="history-summary-card summary-all">
                <p class="summary-label">Reservas totales</p>
                <p class="summary-value">24</p>
                <p class="summary-note">Todas las reservaciones registradas en SportBooker.</p>
            </article>

            <article class="history-summary-card summary-active">
                <p class="summary-label">Reservas activas</p>
                <p class="summary-value">8</p>
                <p class="summary-note">Reservas con reservación_estatus = “activa”.</p>
            </article>

            <article class="history-summary-card summary-pending">
                <p class="summary-label">Reservas pendientes</p>
                <p class="summary-value">10</p>
                <p class="summary-note">Reservas en revisión (reservación_estatus = “pendiente”).</p>
            </article>

            <article class="history-summary-card summary-rejected">
                <p class="summary-label">Reservas rechazadas</p>
                <p class="summary-value">6</p>
                <p class="summary-note">Reservas con reservación_estatus = “rechazada”.</p>
            </article>
        </section>

        <!-- Bloque filtros + tabla en tarjetas -->
        <section class="history-table-section">

            <!-- Tarjeta de filtros -->
            <article class="history-card history-filters-card">
                <header class="history-table-header">
                    <h3>Listado de reservas</h3>
                    
                    <p>
                        Filtra por estado de reservación, estado de pago o fecha para encontrar una reservación específica.
                    </p>
                </header>

                <form class="history-filters" onsubmit="event.preventDefault()">
                    <div class="filter-group">
                        <label for="filterStatusReserva">Estado de reservación</label>
                        <select id="filterStatusReserva" name="reservacion_estatus">
                            <option value="">Todos</option>
                            <option value="pendiente">Pendiente</option>
                            <option value="activa">Activa</option>
                            <option value="rechazada">Rechazada</option>
                            <option value="cancelada">Cancelada</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label for="filterStatusPago">Estado de pago</label>
                        <select id="filterStatusPago" name="pago_estatus">
                            <option value="">Todos</option>
                            <option value="pendiente">Pendiente</option>
                            <option value="pagado">Pagado</option>
                            <option value="fallido">Fallido</option>
                            <option value="reembolsado">Reembolsado</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label for="filterDate">Fecha (hora_inicio)</label>
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
                <div class="history-status-legend">
                    <span class="legend-label">Estatus de pago:</span>
                    <span class="status-pill status-activa">Pagado</span>
                    <span class="status-pill status-pendiente">Pendiente</span>
                    <span class="status-pill status-rechazada">Fallido</span>
                    <span class="status-pill status-rechazada">Reembolsado</span>

                    <span class="legend-separator">|</span>

                    <span class="legend-label">Estatus de reservación:</span>
                    <span class="status-pill status-activa">Activa</span>
                    <span class="status-pill status-pendiente">Pendiente</span>
                    <span class="status-pill status-rechazada">Rechazada</span>
                    <span class="status-pill status-rechazada">Cancelada</span>
                </div>

                <div class="history-table-scroll">
                    <table class="history-table">
                        <thead>
                            <tr>
                                <th>Usuario</th>
                                <th>Cancha</th>
                                <th>Fecha</th>
                                <th>Horario</th>
                                <th>Método de pago</th>
                                <th>Estatus de pago</th>
                                <th>Estatus de reservación</th>
                                <th>Total</th>
                                <th class="history-actions-cell">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Ejemplos de filas (vista previa). Luego los generas con Blade desde reservaciones_tabla -->
                            <tr>
                                <td>Juan Pérez</td>
                                <td>Futbol 7 · Campo 2</td>
                                <td>2025-11-14</td>
                                <td>19:00 – 20:00</td>
                                <td>Tarjeta de crédito</td>
                                <td>
                                    <!-- pago_estatus -->
                                    <span class="status-pill status-activa">Pagado</span>
                                </td>
                                <td>
                                    <!-- reservacion_estatus -->
                                    <span class="status-pill status-activa">Activa</span>
                                </td>
                                <td>$450.00</td>
                                <td class="history-actions-cell">
                                    <button class="table-action">Detalles</button>
                                </td>
                            </tr>

                            <tr>
                                <td>Ana López</td>
                                <td>Americano · Campo Principal</td>
                                <td>2025-11-10</td>
                                <td>17:00 – 19:00</td>
                                <td>Transferencia</td>
                                <td>
                                    <span class="status-pill status-pendiente">Pendiente</span>
                                </td>
                                <td>
                                    <span class="status-pill status-pendiente">Pendiente</span>
                                </td>
                                <td>$900.00</td>
                                <td class="history-actions-cell">
                                    <button class="table-action">Revisar</button>
                                </td>
                            </tr>

                            <tr>
                                <td>Carlos Ramírez</td>
                                <td>Tenis · Cancha 1</td>
                                <td>2025-11-08</td>
                                <td>08:00 – 09:00</td>
                                <td>Pago en efectivo</td>
                                <td>
                                    <span class="status-pill status-rechazada">Fallido</span>
                                </td>
                                <td>
                                    <span class="status-pill status-rechazada">Rechazada</span>
                                </td>
                                <td>$180.00</td>
                                <td class="history-actions-cell">
                                    <button class="table-action table-action-disabled" disabled>Sin acción</button>
                                </td>
                            </tr>

                            <tr>
                                <td>Lucía Vega</td>
                                <td>Basquetbol · Techada</td>
                                <td>2025-11-02</td>
                                <td>16:00 – 18:00</td>
                                <td>Tarjeta de débito</td>
                                <td>
                                    <span class="status-pill status-activa">Pagado</span>
                                </td>
                                <td>
                                    <span class="status-pill status-activa">Activa</span>
                                </td>
                                <td>$400.00</td>
                                <td class="history-actions-cell">
                                    <button class="table-action">Detalles</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Leyenda de estados basada en pago_estatus y reservacion_estatus -->

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

</body>
</html>
