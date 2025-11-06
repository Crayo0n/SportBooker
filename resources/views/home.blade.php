<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-M">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SportBooker - Querétaro</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    <header class="main-header">
        <div class="header-container">
            <img src="/img/LogoQueretaro.jpg" alt="Logo Querétaro" class="logo">
            <nav class="main-nav">
                <a href="#">Canchas</a>
                <a href="#login-modal">Iniciar Sesión</a>
            </nav>
            <form class="search-form">
                <input type="search" placeholder="Buscar...">
            </form>
        </div>
    </header>

    <section class="slider-container">
        <img src="/img/cancha_futbol.png" alt="Cancha de Fútbol 11" class="slider-image">
        <div class="slider-caption">FÚTBOL 11</div>
    </section>

    <main class="container">

        <section class="events-section">
            <h2>Eventos</h2>
            <p>Conoce nuestros próximos eventos en los que puedes participar</p>
            <div class="card-grid">
                <div class="card">
                    <img src="/img/evento1.png" alt="Concurso de Arreglo">
                    <h4>Concurso de Arreglo</h4>
                    <button class="btn">Ver Programa</button>
                </div>
                <div class="card">
                    <img src="/img/evento2.png" alt="Portocho Techado">
                    <h4>Portocho Techado</h4>
                    <button class="btn">Ver Programa</button>
                </div>
                <div class="card">
                    <img src="/img/evento3.png" alt="Partido Social">
                    <h4>Partido Social 14's</h4>
                    <button class="btn">Ver Programa</button>
                </div>
            </div>
        </section>

        <section class="teams-section">
            <div class="card-grid">
                <div class="card">
                    <img src="/img/futbol.png" alt="Equipo de Fútbol">
                    <h4>Equipo de Fútbol</h4>
                    <button class="btn-secondary">Más Información</button>
                </div>
                <div class="card">
                    <img src="/img/americano.png" alt="Equipo de American">
                    <h4>Equipo de American</h4>
                    <button class="btn-secondary">Más Información</button>
                </div>
                <div class="card">
                    <img src="/img/basquetball.png" alt="Equipo de Basquetbol">
                    <h4>Equipo de Basquetbol</h4>
                    <button class="btn-secondary">Más Información</button>
                </div>
            </div>
            <div class="teams-join">
                <img src="/img/LogoQueretaro.jpg" alt="Logo Querétaro">
                <h3>Forma Parte de Nuestros Equipos</h3>
                <button class="btn-secondary">Más Información</button>
            </div>
        </section>

        <section class="docs-section">
            <h2>Registro De Canchas</h2>
            <p>Documentos necesarios:</p>
            <table class="docs-table">
                <thead>
                    <tr>
                        <th>Documento</th>
                        <th>Descripción</th>
                        <th>Original/Copia</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Solicitud de espacio</td>
                        <td>Escrito libre con la solicitud</td>
                        <td>Original</td>
                    </tr>
                    <tr>
                        <td>Acta de nacimiento</td>
                        <td>Datos comprobatorios del ciudadano</td>
                        <td>Copia</td>
                    </tr>
                    <tr>
                        <td>CURP</td>
                        <td>Validez del solicitante</td>
                        <td>Copia</td>
                    </tr>
                    <tr>
                        <td>Comprobante de domicilio</td>
                        <td>Domicilio del solicitante</td>
                        <td>Copia</td>
                    </tr>
                    <tr>
                        <td>INE (presentar en caso de ser menor)</td>
                        <td>Documento que compruebe la identidad del solicitante</td>
                        <td>Copia</td>
                    </tr>
                    <tr>
                        <td>Acta constitutiva (sólo si aplica)</td>
                        <td>Documento registrado en el caso de ser asociación</td>
                        <td>Copia</td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>

    <footer class="main-footer">
        <div class="footer-container">
            <div class="footer-logo">
                <img src="/img/LogoQueretaro.jpg" alt="Logo Querétaro Footer">
                <p>Palacio de la Corregidora, 5 de Mayo esq. Pasteur...</p>
            </div>
            <div class="footer-links">
                <h4>Querétaro</h4>
                <p>442 238 5770 (y más)</p>
                <h4>Línea Única de Emergencias</h4>
                <p>9-1-1</p>
            </div>
            <div class="footer-links">
                <h4>Seguridad Pública</h4>
                <p>442 427 6700</p>
                <h4>DIF Municipal</h4>
                <p>(y más números)</p>
            </div>
        </div>
    </footer>

<div id="login-modal" class="login-overlay">

    <div class="login-modal-content">
        <a href="#" class="login-close-btn">&times;</a>

        <img src="/img/LogoQueretaro.jpg" alt="Logo Querétaro" class="login-logo">

        <form>
            <div class="form-group">
                <input type="text" placeholder="Usuario" required>
            </div>
            <div class="form-group">
                <input type="password" placeholder="Contraseña" required>
            </div>
            
            <a href="{{ route('password.request') }}" class="forgot-password">Olvidé mi contraseña</a>

            <a href="{{ route('register.choice') }}" class="register-link">¿No tienes cuenta? Regístrate aquí</a>

            <button type="submit" class="btn">Entrar</button>
        </form>
    </div>

</div>
</body> 
</html>