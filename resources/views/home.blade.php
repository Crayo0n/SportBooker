<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>SportBooker – Inicio</title>

    <!-- Fuentes -->
    <link href="https://fonts.googleapis.com/css?family=Black+Ops+One&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Keania+One&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Blinker:400,600,700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Inter:400,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Audiowide&display=swap" rel="stylesheet" />

    <!-- CSS externo -->
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body>

    <!-- ===== NAV ===== -->
    <nav class="navbar">
        <h1 class="brand">SportBooker</h1>

        <ul class="nav-links">
        <li><a href="{{ url('/') }}#inicio">Inicio</a></li>
            <li><a href="{{ route('cancha.detalle') }}">Canchas</a></li>
            <li><a href="#" id="loginLink">Inicio Sesión</a></li>
        </ul>

        <div class="navbar-right">
            <form id="searchForm" class="search" role="search" onsubmit="event.preventDefault()">
                <input id="searchInput" type="search" placeholder="Buscar..." aria-label="Buscar en SportBooker" autocomplete="off" />
                <button type="submit" aria-label="Buscar">⌕</button>
            </form>
        </div>
    </nav>

    <main id="inicio">
        <!-- ===== HERO ===== -->
        <section class="hero">
            <div class="carousel" id="carousel">
                <div class="slide active"><img src="/images/v118_9.png" alt="Cancha 1" loading="eager" /></div>
                <div class="slide"><img src="/images/cancha2.png" alt="Cancha 2" loading="lazy" /></div>
                <div class="slide"><img src="/images/cancha3.png" alt="Cancha 3" loading="lazy" /></div>
                <div class="slide"><img src="/images/cancha4.png" alt="Cancha 4" loading="lazy" /></div>
                <div class="slide"><img src="/images/cancha5.png" alt="Cancha 5" loading="lazy" /></div>

                <button class="carousel-btn prev" aria-label="Anterior">❮</button>
                <button class="carousel-btn next" aria-label="Siguiente">❯</button>

                <div class="carousel-indicators" role="tablist" aria-label="Indicadores">
                    <span class="dot active" role="tab" aria-label="1"></span>
                    <span class="dot" role="tab" aria-label="2"></span>
                    <span class="dot" role="tab" aria-label="3"></span>
                    <span class="dot" role="tab" aria-label="4"></span>
                    <span class="dot" role="tab" aria-label="5"></span>
                </div>
            </div>
        </section>

        <!-- ===== EVENTOS ===== -->
        <section class="section container" id="eventos">
            <div class="ev-layout">
                <!-- Columna Izquierda -->
                <div class="ev-left">
                    <!-- PNG de título (o fallback si no existe) -->
                    <img src="/images/v118_58.png" alt="Eventos" style="max-width:260px;height:auto"
                         onerror="this.replaceWith(Object.assign(document.createElement('span'),{className:'h-script',textContent:'Eventos'}));" />
                    <p>Conoce nuestros próximos eventos en los que puedes participar.</p>
                    <button class="btn">Ver Más</button>
                </div>

                <!-- Columna Derecha: 3 tarjetas (puedes agregar una cuarta si la necesitas) -->
                <div class="ev-grid">
                    <article class="card">
                        <img src="/images/v118_17.png" alt="Competencia de Atletismo" loading="lazy">
                        <div class="content"><h3>Atletismo</h3></div>
                        <div class="actions"><button class="btn">Ver Programa</button></div>
                    </article>
                    <article class="card">
                        <img src="/images/v118_18.png" alt="Partido Día del Padre" loading="lazy">
                        <div class="content"><h3>Partido Día Del Padre</h3></div>
                        <div class="actions"><button class="btn">Ver Programa</button></div>
                    </article>
                    <article class="card">
                        <img src="/images/v118_19.png" alt="Partido Día del Niño" loading="lazy">
                        <div class="content"><h3>Partido Día Del Niño</h3></div>
                        <div class="actions"><button class="btn">Ver Programa</button></div>
                    </article>
                </div>
            </div>

            <div class="divider"></div>
        </section>

        <!-- ===== QUERÉTARO / EQUIPOS ===== -->
        <section class="section container" id="equipos">
            <div class="qro-layout">
                <!-- Izquierda: Tarjetas de equipos -->
                <div class="team-grid">
                    <article class="card">
                        <img src="/images/v118_53.png" alt="Equipo de Futbol" loading="lazy">
                        <div class="content"><h3>Equipo De Futbol</h3></div>
                        <div class="actions"><button class="btn">Más Información</button></div>
                    </article>
                    <article class="card">
                        <img src="/images/v118_54.png" alt="Equipo de Americano" loading="lazy">
                        <div class="content"><h3>Equipo De Americano</h3></div>
                        <div class="actions"><button class="btn">Más Información</button></div>
                    </article>
                    <article class="card">
                        <img src="/images/v118_55.png" alt="Equipo de Básquetbol" loading="lazy">
                        <div class="content"><h3>Equipo De Básquetbol</h3></div>
                        <div class="actions"><button class="btn">Más Información</button></div>
                    </article>
                </div>

                <!-- Derecha: Bloque Querétaro -->
                <div class="qro-right">
                    <div class="qro-logo"
                         onerror="this.replaceWith(Object.assign(document.createElement('span'),{className:'qro-fallback',textContent:'Querétaro'}));">
                    </div>
                    <p>Forma Parte De Nuestros Equipos.</p>
                    <button class="btn" style="min-width:120px">Ver Más</button>
                </div>
            </div>

            <div class="divider"></div>
        </section>

        <!-- ===== REGISTRO DE CANCHAS / TABLA ===== -->
        <section class="section container" id="registro">
            <div class="table-wrap">
                <div class="reg-title">
                    <div class="logo"
                         onerror="this.replaceWith(Object.assign(document.createElement('span'),{className:'fallback',textContent:'Registro De Canchas'}));">
                    </div>
                </div>

                <div class="subtle">Documentos necesarios</div>

                <table class="tabla" role="table">
                    <thead>
                    <tr>
                        <th>Documento</th>
                        <th>Descripción</th>
                        <th>Original/Copia</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr><td>Solicitud de espacio</td><td>Escrito libre con la solicitud</td><td>Original</td></tr>
                    <tr><td>Acta de nacimiento</td><td>Datos complementarios del ciudadano</td><td>Copia</td></tr>
                    <tr><td>CURP</td><td>Validar al ciudadano</td><td>Copia</td></tr>
                    <tr><td>Comprobante de domicilio</td><td>Domicilio del solicitante</td><td>Copia</td></tr>
                    <tr><td>INE (credencial del padre en caso de ser menor)</td><td>Documento que compruebe la identidad del solicitante</td><td>Copia</td></tr>
                    <tr><td>Acta constitutiva (sólo si aplica)</td><td>Documento solicitado en el caso de ser asociación</td><td>Copia</td></tr>
                    </tbody>
                </table>
            </div>
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

    <!-- ===== Carrusel JS ===== -->
    <script>
        (function(){
            const root=document.getElementById('carousel');
            if(!root) return;
            const slides=root.querySelectorAll('.slide');
            const dots=root.querySelectorAll('.dot');
            const prev=root.querySelector('.prev');
            const next=root.querySelector('.next');
            let i=0, t;

            function show(n){
                slides.forEach((s,idx)=>s.classList.toggle('active',idx===n));
                dots.forEach((d,idx)=>d.classList.toggle('active',idx===n));
                i=n;
            }
            function nextSlide(){ show((i+1)%slides.length); }
            function prevSlide(){ show((i-1+slides.length)%slides.length); }

            next.addEventListener('click', nextSlide);
            prev.addEventListener('click', prevSlide);
            dots.forEach((d,idx)=>d.addEventListener('click',()=>show(idx)));

            function auto(){ t=setInterval(nextSlide,5000); }
            function stop(){ clearInterval(t); }
            root.addEventListener('mouseenter', stop);
            root.addEventListener('mouseleave', auto);
            auto();
        })();
    </script>


</div>

</body>
</html>