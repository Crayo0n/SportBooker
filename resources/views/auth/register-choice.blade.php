<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-M">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paso 1: Elige tu Cuenta - SportBooker</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    <header class="main-header">
        <div class="header-container">
            <a href="/"><img src="/img/LogoQueretaro.png" alt="Logo Querétaro" class="logo"></a>
            <nav class="main-nav">
                <a href="#">Canchas</a>
                <a href="#login-modal">Iniciar Sesión</a>
            </nav>
            <form class="search-form">
                <input type="search" placeholder="Buscar...">
            </form>
        </div>
    </header>

    <main class="container">
        <div class="choice-container">
            <h1>Crea tu cuenta en SportBooker</h1>
            <p>Elige el tipo de cuenta que mejor se adapte a tus necesidades. Todas las cuentas requieren verificación de documentos.</p>

            <div class="choice-grid">

                <div class="choice-card">
                    <div class="choice-icon">👤</div>
                    <h2>Cliente Ocasional</h2>
                    <p>Ideal para reservas puntuales, fiestas o eventos únicos.</p>
                    <ul class="choice-list">
                        <li>Reserva por hora.</li>
                        <li>Verificación con 2 documentos (INE, Comprobante).</li>
                    </ul>
                    <a href="#" class="btn">Registrarme como Ocasional</a>
                </div>

                <div class="choice-card">
                    <div class="choice-icon">👥</div>
                    <h2>Cliente Recurrente (Equipo)</h2>
                    <p>Para representantes de equipos, ligas o empresas que requieren abonos.</p>
                    <ul class="choice-list">
                        <li>Solicitud de reservas recurrentes (abonos).</li>
                        <li>Verificación con 6 documentos (INE, CURP, Roster, etc.).</li>
                    </ul>
                    <a href="#" class="btn">Registrarme como Equipo</a>
                </div>

            </div>
        </div>
    </main>

    <footer class="main-footer">
        </footer>

</body>
</html>