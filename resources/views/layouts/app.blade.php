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

    <style>
        :root{
    --stroke:#0b0f19;
    --grad:linear-gradient(90deg,#007bb5 0%,#005f8f 50%,#003f66 100%); /* Manteniendo tonos azules */
    --nav-h:80px;
    --blue:#004f7c;



        }

        /* ===== Reset / base ===== */
        *{box-sizing:border-box}
        html,body{height:100%}
        body{
            margin:0;
            min-height:100svh;
            display:flex;
            flex-direction:column;
            padding-top:var(--nav-h);
            font-family:'Inter',system-ui,Segoe UI,Roboto,Helvetica,Arial,sans-serif;
            color:#0b0f19;
            background:#fff;
        }
        .container{width:92%; max-width:1200px; margin:0 auto}

        /* ===== NAVBAR ===== */
        .navbar{
    position:fixed;
    inset:0 0 auto 0;
    height:var(--nav-h);
    background:rgba(0,63,102,.95); /* Fondo oscuro */
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:0 40px;
    z-index:100;
    backdrop-filter:blur(8px);
}
.brand{
    font-family:'Audiowide',system-ui,sans-serif;
    font-size:30px;
    letter-spacing:.02em;
    color:white; /* Cambiado a blanco */
    margin:0;
}
.nav-links{
    display:flex;
    gap:32px;
    list-style:none;
    margin:0;
    padding:0;
}
.nav-links a{
    font-family:'Inter',system-ui,sans-serif; /* Cambiado a Inter para estilo minimalista */
    font-size:18px;
    color:white; /* Cambiado a blanco */
    text-decoration:none;
    transition:.2s transform,.2s opacity;
}
.nav-links a:hover{
    transform:scale(1.06);
    opacity:.9;
}
.navbar-right{
    display:flex;
    align-items:center;
    gap:12px;
}

/* Búsqueda pill */
.search{
    display:flex;
    align-items:center;
    height:40px;
    padding:0 6px 0 12px;
    border-radius:999px;
    background:#fff;
    border:1px solid rgba(0,0,0,.08);
    box-shadow:0 4px 14px rgba(0,0,0,.12);
    overflow:hidden;
}
.search input{
    border:0;
    outline:0;
    background:transparent;
    font-size:14px;
    min-width:160px;
    padding-right:8px;
}
.search button{
    width:34px;
    height:34px;
    border:0;
    border-radius:50%;
    background:#004f7c;
    color:#fff;
    cursor:pointer;
}
        }

        /* ===== HERO / CARRUSEL ===== */
        .hero{width:100%; position:relative}
        .carousel{
            position:relative;
            width:100%;
            min-height:clamp(320px,56vh,560px);
            overflow:hidden;
        }
        .slide{
            position:absolute;
            inset:0;
            opacity:0;
            transition:opacity .8s ease;
        }
        .slide.active{opacity:1}
        .slide img{
            width:100%;
            height:100%;
            object-fit:cover;
            display:block;
        }
        .carousel-btn{
            position:absolute;
            top:50%;
            transform:translateY(-50%);
            background:rgba(0,0,0,.45);
            color:#fff;
            border:0;
            font-size:2rem;
            padding:8px 14px;
            border-radius:10px;
            cursor:pointer;
            z-index:5;
        }
        .carousel-btn:hover{background:rgba(0,0,0,.65)}
        .carousel-btn.prev{left:16px}
        .carousel-btn.next{right:16px}
        .carousel-indicators{
            position:absolute;
            bottom:14px;
            left:50%;
            transform:translateX(-50%);
            display:flex;
            gap:8px;
            z-index:5;
        }
        .dot{
            width:12px;
            height:12px;
            border-radius:50%;
            background:rgba(255,255,255,.45);
            cursor:pointer;
        }
        .dot.active{background:rgba(255,255,255,.95)}

        /* ===== Fallbacks de títulos (si faltan PNG) ===== */
        .h-script{
            font-family:'Keania One','Black Ops One',system-ui,sans-serif;
            font-size:48px;
            line-height:1;
            color:#fff;
            display:inline-block;
            padding:4px 14px 8px;
            background:#1372c0;
            border-radius:10px;
            position:relative;
            text-shadow:0 2px 0 #0e5c99, 0 4px 0 #0e5c99, 0 6px 0 #0e5c99;
        }
        .h-script::after{
            content:'';
            position:absolute;
            inset:6px -6px -6px -6px;
            border-radius:12px;
            box-shadow:0 3px 0 #0a4a7c inset;
        }

        /* ===== Botones ===== */
        .btn{
            background:var(--blue);
            color:#fff;
            border:0;
            border-radius:10px;
            padding:10px 16px;
            cursor:pointer;
            font-family:'Blinker',sans-serif;
            font-size:16px;
            box-shadow:0 6px 14px rgba(18,111,181,.2);
        }

        /* ===== Tarjetas ===== */
        .card{
            background:#fff;
            border-radius:14px;
            box-shadow:0 8px 22px rgba(0,0,0,.08);
            overflow:hidden;
            display:flex;
            flex-direction:column;
        }
        .card img{
            width:100%;
            height:170px;
            object-fit:cover;
            display:block;
        }
        .card .content{padding:12px 14px}
        .card h3{
            font-family:'Blinker',sans-serif;
            font-size:16px;
            margin:0 0 8px;
            color:#111;
            text-align:center;
        }
        .card .actions{
            padding:0 14px 14px;
            display:flex;
            justify-content:center;
        }

        /* ===== Secciones ===== */
        .section{padding:42px 0}
        .section .divider{
            height:3px;
            background:#7db2df;
            width:100%;
            margin:26px 0;
        }

        /* ===== EVENTOS ===== */
        .ev-layout{
            display:grid;
            grid-template-columns:minmax(260px,340px) 1fr;
            gap:28px;
            align-items:start;
        }
        .ev-left{
            display:flex;
            flex-direction:column;
            gap:14px;
            align-self:start;
        }
        .ev-left p{
            font-family:'Blinker',sans-serif;
            font-size:20px;
            color:#1f2937;
            margin:0;
        }
        .ev-left .btn{min-width:120px}
        .ev-grid{
            display:grid;
            grid-template-columns:repeat(4,minmax(140px,1fr));
            gap:24px;
            align-items:start;
        }

        /* ===== QUERÉTARO / EQUIPOS ===== */
        .qro-layout{
            display:grid;
            grid-template-columns:1fr minmax(260px,360px);
            gap:28px;
            align-items:center;
        }
        .team-grid{
            display:grid;
            grid-template-columns:repeat(3,minmax(180px,1fr));
            gap:24px;
            align-items:start;
        }
        .qro-right{text-align:center}
        .qro-right .qro-logo{
            width:220px;
            height:80px;
            background:url("/images/v118_43.png") center/contain no-repeat;
            margin:0 auto 8px;
        }
        .qro-right .qro-fallback{
            display:inline-block;
            font-family:'Keania One','Black Ops One',system-ui,sans-serif;
            font-size:48px;
            color:#fff;
            background:#1372c0;
            border-radius:10px;
            padding:4px 12px;
            text-shadow:0 2px 0 #0e5c99, 0 4px 0 #0e5c99, 0 6px 0 #0e5c99;
        }
        .qro-right p{
            font-family:'Blinker',sans-serif;
            font-size:22px;
            text-align:center;
            margin:8px 0 18px;
        }

        /* ===== REGISTRO / TABLA ===== */
        .table-wrap{margin:18px 0 56px}
        .reg-title{
            display:flex;
            align-items:center;
            gap:10px;
            flex-wrap:wrap;
        }
        .reg-title .logo{
            width:230px;
            height:74px;
            background:url("/images/v118_44.png") center/contain no-repeat;
        }
        .reg-title .fallback{
            display:inline-block;
            font-family:'Keania One','Black Ops One';
            font-size:42px;
            color:#fff;
            background:#1372c0;
            border-radius:10px;
            padding:4px 12px;
            text-shadow:0 2px 0 #0e5c99, 0 4px 0 #0e5c99, 0 6px 0 #0e5c99;
        }
        .subtle{
            font-family:'Blinker',sans-serif;
            font-weight:600;
            color:#2b6fd0;
            margin:10px 0 8px;
        }
        .tabla{
            width:100%;
            border-collapse:collapse;
            font-family:'Blinker',sans-serif;
            font-size:16px;
            background:#fff;
            border-radius:10px;
            overflow:hidden;
            box-shadow:0 4px 12px rgba(0,0,0,.1);
        }
        .tabla th,.tabla td{
            border:1px solid #333;
            padding:10px 14px;
            text-align:left;
        }
        .tabla th{
            background:var(--blue);
            color:#fff;
            font-weight:700;
        }
        .tabla tr:nth-child(even){background:#f3f8fc}
        .tabla tr:hover{background:#e8f2fb}

        /* ===== Footer ===== */
        .footer{
            margin-top:auto;
            background:var(--blue);
            color:#fff;
            padding:48px 0;
        }
        .footer .inner{
            width:92%;
            max-width:1100px;
            margin:0 auto;
            display:grid;
            grid-template-columns:auto 1fr;
            gap:18px 16px;
            align-items:center;
        }
        .footer .logo{
            width:86px;
            height:86px;
            background:url("/images/v118_43.png") center/contain no-repeat;
        }
        .footer h2{
            grid-column:2;
            margin:0;
            font-family:'Audiowide',system-ui,sans-serif;
            font-size:28px;
        }
        .footer p{
            grid-column:2;
            margin:4px 0 0;
            font-size:18px;
            line-height:1.6;
        }

        /* ===== Responsive ===== */
        @media (max-width:1100px){
            .ev-grid{grid-template-columns:repeat(3,1fr)}
            .team-grid{grid-template-columns:repeat(3,1fr)}
        }
        @media (max-width:900px){
            .ev-layout{grid-template-columns:1fr}
            .qro-layout{grid-template-columns:1fr}
            .ev-grid{grid-template-columns:repeat(2,1fr)}
            .team-grid{grid-template-columns:repeat(2,1fr)}
        }
        @media (max-width:640px){
            .ev-grid,.team-grid{grid-template-columns:1fr}
            .h-script{font-size:40px}
        }
    </style>
</head>
<body>

    <!-- ===== NAV ===== -->
    <nav class="navbar">
        <h1 class="brand">SportBooker</h1>

        <ul class="nav-links">
            <li><a href="#inicio">Inicio</a></li>
            <li><a href="#equipos">Canchas</a></li>
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
                        <div class="content"><h3>Competencia De Atletismo</h3></div>
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
            <div class="logo" aria-hidden="true"></div>
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



    {{-- JS del modal --}}
    <script src="{{ asset('js/auth-modal.js') }}"></script>

</body>
</html>

