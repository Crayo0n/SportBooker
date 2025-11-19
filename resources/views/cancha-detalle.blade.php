  <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>SportBooker – Detalle de Cancha</title>

    <!-- Fuentes -->
    <link href="https://fonts.googleapis.com/css?family=Black+Ops+One&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Keania+One&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Blinker:400,600,700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Inter:400,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Audiowide&display=swap" rel="stylesheet" />

    <!-- CSS general (navbar, carrusel, footer) -->
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <!-- CSS específico de detalle de cancha -->
    <link rel="stylesheet" href="{{ asset('css/cancha-detalle.css') }}">
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

    <!-- ===== HERO / CARRUSEL ===== -->
    <section class="hero">
        <div class="carousel" id="carousel">
            <!-- Usa las mismas imágenes que ya tienes -->
            <div class="slide active"><img src="/images/cancha2.png"  alt="Cancha de fútbol"  loading="eager" /></div>
            <div class="slide"><img src="/images/v118_9.png" alt="Cancha de americano"        loading="lazy" /></div>
            <div class="slide"><img src="/images/cancha3.png" alt="Cancha de básquetbol"   loading="lazy" /></div>
            <div class="slide"><img src="/images/cancha4.png" alt="Cancha de tenis"        loading="lazy" /></div>

            <button class="carousel-btn prev" aria-label="Anterior">❮</button>
            <button class="carousel-btn next" aria-label="Siguiente">❯</button>

            <div class="carousel-indicators" role="tablist" aria-label="Indicadores">
                <span class="dot active" role="tab" aria-label="1"></span>
                <span class="dot" role="tab" aria-label="2"></span>
                <span class="dot" role="tab" aria-label="3"></span>
                <span class="dot" role="tab" aria-label="4"></span>
            </div>
        </div>
    </section>

    <main>
        <div class="detail-wrapper">
            <header class="detail-header">
                <h2 id="fieldTitle">Cancha de Fútbol Americano</h2>
                <span>Información adicional</span>
            </header>

            <section class="detail-grid">
                <!-- Descripción -->
                <article class="detail-card descripcion">
                    <div class="detail-card-header">
                        <span class="detail-pill">Descripción</span>
                    </div>
                    <div class="detail-card-body">
                        <p id="descText">
                            Cancha de pasto sintético pensada para partidos completos y torneos locales.
                            Iluminación perimetral y zonas de calentamiento para ambos equipos, ideal para
                            entrenamientos nocturnos y encuentros recreativos o competitivos.
                        </p>
                    </div>
                </article>

                <!-- Datos rápidos -->
                <article class="detail-card quick">
                    <div class="detail-card-header">
                        <span class="detail-pill">Datos Rápidos</span>
                    </div>
                    <div class="detail-card-body">
                        <ul id="quickList">
                            <!-- Se llena dinámicamente -->
                        </ul>
                    </div>
                </article>

                <!-- Precio -->
                <article class="detail-card price">
                    <div class="detail-card-header">
                        <span class="detail-pill">Precio</span>
                    </div>
                    <div class="detail-card-body">
                        <p id="priceText">$250 por hora de juego</p>
                    </div>
                </article>

                <!-- Recuerda -->
                <article class="detail-card remember">
                    <div class="detail-card-header">
                        <span class="detail-pill">Recuerda</span>
                    </div>
                    <div class="detail-card-body">
                        <p id="rememberText">
                            <strong>Antes de salir</strong>, asegúrate de retirar botellas, cinta atlética,
                            envolturas y tapas. Está prohibido dejar colillas o chicle en el pasto para mantener la
                            cancha en óptimas condiciones para todos los jugadores.
                        </p>
                    </div>
                </article>
            </section>

            <!-- Botón Reservar -->
            <div class="reserve-wrapper">
                <button class="reserve-btn">Reservar</button>
            </div>
        </div>
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

    <!-- Carrusel + cambio dinámico de tarjetas -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // ===== Datos por cancha (4 slides) =====
            const fieldInfo = [
                {
                    name: 'Cancha de Fútbol Americano',
                    desc: 'Cancha de pasto sintético con dimensiones reglamentarias para fútbol americano. ' +
                          'Incluye zonas de banca amplias y marcas de yardas bien definidas, ideal para entrenamientos ' +
                          'tácticos y scrimmages completos.',
                    quick: [
                        'Dimensiones: aprox. 110 × 49 m',
                        'Superficie: pasto sintético 3G amortiguado',
                        'Iluminación: LED nocturna en todo el perímetro',
                        'Capacidad sugerida: 22 jugadores + staff'
                    ],
                    price: '$450 por hora de juego',
                    remember: 'Antes de salir, asegúrate de retirar cascos, cintas, botellas y cualquier marcador ' +
                              'de jugadas. Está prohibido dejar cinta adhesiva o marcas sobre el campo para mantener la ' +
                              'superficie en óptimas condiciones.'
                },
                {
                    name: 'Cancha de Fútbol Soccer',
                    desc: 'Cancha de pasto natural/sintético pensada para partidos completos y torneos locales. ' +
                          'Cuenta con porterías reglamentarias y área de calentamiento a los costados.',
                    quick: [
                        'Dimensiones: aprox. 100 × 64 m',
                        'Superficie: pasto natural o sintético 3G',
                        'Iluminación: LED nocturna en zonas clave',
                        'Capacidad sugerida: 22 jugadores + cambios'
                    ],
                    price: '$250 por hora de juego',
                    remember: 'Antes de salir, recoge conos, redes de portería adicionales y balones. ' +
                              'Evita dejar botines embarrados o residuos dentro del área técnica.'
                },
                {
                    name: 'Cancha de Básquetbol',
                    desc: 'Cancha de piso deportivo con tableros de acrílico y aros reforzados. ' +
                          'Ideal para ligas locales, entrenamientos de equipo y sesiones recreativas.',
                    quick: [
                        'Dimensiones: 28 × 15 m aprox.',
                        'Superficie: piso sintético amortiguado',
                        'Iluminación: uniforme sobre la duela',
                        'Capacidad sugerida: 10 jugadores en juego'
                    ],
                    price: '$200 por hora de juego',
                    remember: 'Antes de salir, asegúrate de no dejar botellas sobre la duela y evita marcar la ' +
                              'superficie con plumones o cinta no autorizada para cuidar el piso.'
                },
                {
                    name: 'Cancha de Tenis',
                    desc: 'Cancha individual con superficie lisa y líneas reglamentarias, perfecta para entrenamientos, ' +
                          'clases particulares y partidos amistosos.',
                    quick: [
                        'Dimensiones: 23.77 × 10.97 m (dobles)',
                        'Superficie: dura con buen bote',
                        'Iluminación: enfocada sobre la pista',
                        'Capacidad sugerida: 2–4 jugadores'
                    ],
                    price: '$180 por hora de juego',
                    remember: 'Antes de salir, recoge pelotas y botellas, y procura no arrastrar sillas o bancos sobre ' +
                              'la superficie para evitar rayones.'
                }
            ];

            // ===== Elementos de tarjetas =====
            const titleEl    = document.getElementById('fieldTitle');
            const descEl     = document.getElementById('descText');
            const quickList  = document.getElementById('quickList');
            const priceEl    = document.getElementById('priceText');
            const rememberEl = document.getElementById('rememberText');

            function applyFieldInfo(index) {
                const data = fieldInfo[index] || fieldInfo[0];

                if (titleEl)    titleEl.textContent    = data.name;
                if (descEl)     descEl.textContent     = data.desc;
                if (priceEl)    priceEl.textContent    = data.price;
                if (rememberEl) rememberEl.textContent = data.remember;

                if (quickList) {
                    quickList.innerHTML = '';
                    data.quick.forEach(item => {
                        const li = document.createElement('li');
                        li.textContent = item;
                        quickList.appendChild(li);
                    });
                }
            }

            // ===== Lógica de carrusel =====
            const carousel = document.getElementById('carousel');
            const slides   = carousel ? carousel.querySelectorAll('.slide') : [];
            const dots     = carousel ? carousel.querySelectorAll('.dot')   : [];
            const prev     = carousel ? carousel.querySelector('.prev')     : null;
            const next     = carousel ? carousel.querySelector('.next')     : null;

            let current = 0;
            let timer;

            function showSlide(n) {
                if (!slides.length) return;
                current = (n + slides.length) % slides.length;

                slides.forEach((s, i) => s.classList.toggle('active', i === current));
                dots.forEach((d, i) => d.classList.toggle('active', i === current));

                applyFieldInfo(current);
            }

            function nextSlide() { showSlide(current + 1); }
            function prevSlide() { showSlide(current - 1); }

            function startAuto() {
                stopAuto();
                timer = setInterval(nextSlide, 5000);
            }

            function stopAuto() {
                if (timer) clearInterval(timer);
            }

            if (carousel && slides.length) {
                if (next) next.addEventListener('click', () => {
                    stopAuto();
                    nextSlide();
                    startAuto();
                });

                if (prev) prev.addEventListener('click', () => {
                    stopAuto();
                    prevSlide();
                    startAuto();
                });

                dots.forEach((dot, i) => {
                    dot.addEventListener('click', () => {
                        stopAuto();
                        showSlide(i);
                        startAuto();
                    });
                });

                carousel.addEventListener('mouseenter', stopAuto);
                carousel.addEventListener('mouseleave', startAuto);

                // Inicial
                showSlide(0);
                startAuto();
            } else {
                // Por si falla el carrusel, al menos carga la info base
                applyFieldInfo(0);
            }
        });
    </script>

    {{-- JS global (modal de login, etc.) --}}
    @vite('resources/js/app.js')

</body>
</html>