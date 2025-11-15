<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>SportBooker – Disponibilidad de Cancha</title>

    <!-- Fuentes -->
    <link href="https://fonts.googleapis.com/css?family=Black+Ops+One&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Keania+One&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Blinker:400,600,700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Inter:400,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Audiowide&display=swap" rel="stylesheet" />

<!-- CSS específico de disponibilidad (solo clases nuevas) -->
<link rel="stylesheet" href="{{ asset('css/cancha-horarios.css') }}">

</head>
<body class="horarios-page">

    <!-- ===== NAV ===== -->
    <nav class="navbar">
        <h1 class="brand">SportBooker</h1>

        <ul class="nav-links">
            <li><a href="{{ url('/') }}#inicio">Inicio</a></li>
            <li><a href="{{ route('cancha.detalle') }}">Canchas</a></li>
            <li><a href="{{ route('cancha.horarios') }}">Canchas+</a></li>
            <li><a href="#" id="loginLink">Inicio Sesión</a></li>
        </ul>

        <div class="navbar-right">
            <form id="searchForm" class="search" role="search" onsubmit="event.preventDefault()">
                <input id="searchInput" type="search" placeholder="Buscar..." aria-label="Buscar en SportBooker" autocomplete="off" />
                <button type="submit" aria-label="Buscar">⌕</button>
            </form>
        </div>
    </nav>

    <main class="availability-main">
        <!-- ===== HERO / CARRUSEL ===== -->
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

        <!-- ===== DISPONIBILIDAD ===== -->
        <section class="availability-wrapper">
            <header class="availability-header">
                <h2>Disponibilidad de Cancha</h2>
                <p>Elige la fecha y el horario en el que deseas reservar tu cancha.</p>

                <div class="field-selector">
                    <label for="fieldSelect">Cancha:</label>
                    <select id="fieldSelect">
                        <option value="americano">Cancha de Americano</option>
                        <option value="futbol">Cancha de Futbol</option>
                        <option value="basquetbol">Cancha de Basquetbol</option>
                        <option value="tenis">Cancha de Tenis</option>
                    </select>
                </div>
            </header>

            <!-- ===== GRID: CALENDARIO + HORARIOS ===== -->
            <section class="availability-layout">

                <!-- Calendario -->
                <article class="card calendar-card">
                    <div class="detail-card-header">
                        <span class="detail-pill">Calendario</span>
                    </div>

                    <div class="calendar-body">
                        <div class="calendar-header">
                            <button class="cal-nav" id="calPrev" type="button" aria-label="Mes anterior">❮</button>
                            <div class="cal-month" id="calMonthLabel">Noviembre 2025</div>
                            <button class="cal-nav" id="calNext" type="button" aria-label="Mes siguiente">❯</button>
                        </div>

                        <table class="calendar" aria-label="Calendario de disponibilidad">
                            <thead>
                                <tr>
                                    <th>L</th>
                                    <th>M</th>
                                    <th>Mi</th>
                                    <th>J</th>
                                    <th>V</th>
                                    <th>S</th>
                                    <th>D</th>
                                </tr>
                            </thead>
                            <tbody id="calendarBody">
                                <!-- Las celdas se rellenan vía JS -->
                            </tbody>
                        </table>

                        <p class="calendar-hint">Selecciona un día para ver los horarios disponibles.</p>
                    </div>
                </article>

                <!-- Horarios -->
                <article class="card slots-card">
                    <div class="detail-card-header">
                        <span class="detail-pill">Horarios</span>
                    </div>

                    <div class="slots-body">
                        <p class="selected-date">
                            Disponibilidad para: <strong id="selectedDateLabel">–</strong>
                        </p>

                        <p class="field-info" id="fieldInfoText">
                            Estás viendo los horarios de la <strong>Cancha de Americano</strong>.
                        </p>

                        <div class="slots-grid" id="slotsGrid">
                            <!-- Botones de horario generados por JS -->
                        </div>

                        <div class="slots-legend">
                            <span class="badge free">Libre</span>
                            <span class="badge taken">Ocupado</span>
                            <span class="badge selected">Seleccionado</span>
                        </div>
                    </div>
                </article>
            </section>

            <!-- Botón confirmar -->
            <div class="reserve-wrapper">
                <button type="button" class="reserve-btn" id="confirmBtn">
                    Confirmar reserva
                </button>
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

    {{-- JS general (modal login) --}}
    @vite('resources/js/app.js')

    {{-- ====== Backdrop + Panel Auth ====== --}}
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

    <!-- ===== JS del carrusel (igual que en home) ===== -->
    <script>
        (function(){
            const root = document.getElementById('carousel');
            if(!root) return;

            const slides = root.querySelectorAll('.slide');
            const dots   = root.querySelectorAll('.dot');
            const prev   = root.querySelector('.prev');
            const next   = root.querySelector('.next');
            let i = 0, t;

            function show(n){
                slides.forEach((s,idx)=>s.classList.toggle('active',idx===n));
                dots.forEach((d,idx)=>d.classList.toggle('active',idx===n));
                i = n;
            }
            function nextSlide(){ show((i+1)%slides.length); }
            function prevSlide(){ show((i-1+slides.length)%slides.length); }

            next.addEventListener('click', nextSlide);
            prev.addEventListener('click', prevSlide);
            dots.forEach((d,idx)=>d.addEventListener('click',()=>show(idx)));

            function auto(){ t = setInterval(nextSlide,5000); }
            function stop(){ clearInterval(t); }
            root.addEventListener('mouseenter', stop);
            root.addEventListener('mouseleave', auto);
            auto();
        })();
    </script>

    <!-- ===== JS de calendario y horarios (solo front demo) ===== -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const calendarBody   = document.getElementById('calendarBody');
            const monthLabel     = document.getElementById('calMonthLabel');
            const selectedLabel  = document.getElementById('selectedDateLabel');
            const fieldSelect    = document.getElementById('fieldSelect');
            const fieldInfoText  = document.getElementById('fieldInfoText');
            const slotsGrid      = document.getElementById('slotsGrid');
            const confirmBtn     = document.getElementById('confirmBtn');

            const today     = new Date();
            let currentYear = today.getFullYear();
            let currentMonth= today.getMonth();
            let selectedDate= null;
            let selectedSlot= null;

            const baseSlots = [
                '08:00 - 09:00',
                '09:00 - 10:00',
                '10:00 - 11:00',
                '11:00 - 12:00',
                '16:00 - 17:00',
                '17:00 - 18:00',
                '18:00 - 19:00',
                '19:00 - 20:00',
            ];

            const fieldDescriptions = {
                americano: 'Estás viendo los horarios de la <strong>Cancha de Americano</strong>.',
                futbol:    'Estás viendo los horarios de la <strong>Cancha de Futbol</strong>.',
                basquetbol:'Estás viendo los horarios de la <strong>Cancha de Basquetbol</strong>.',
                tenis:     'Estás viendo los horarios de la <strong>Cancha de Tenis</strong>.',
            };

            function updateFieldInfo(){
                const v = fieldSelect.value;
                fieldInfoText.innerHTML = fieldDescriptions[v] || '';
            }

            function renderMonth(year, month){
                const monthNames = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
                monthLabel.textContent = `${monthNames[month]} ${year}`;

                calendarBody.innerHTML = '';
                const firstDay   = new Date(year, month, 1);
                const startIndex = (firstDay.getDay() + 6) % 7; // Lunes=0
                const daysInMonth= new Date(year, month + 1, 0).getDate();

                let day = 1;
                for(let row=0; row<6; row++){
                    const tr = document.createElement('tr');
                    for(let col=0; col<7; col++){
                        const td = document.createElement('td');
                        if((row === 0 && col < startIndex) || day > daysInMonth){
                            td.textContent = '';
                        } else {
                            td.textContent = day;
                            td.dataset.date = `${year}-${month+1}-${day}`;

                            if(day === today.getDate() &&
                               month === today.getMonth() &&
                               year  === today.getFullYear()){
                                td.classList.add('today');
                            }

                            td.addEventListener('click', () => {
                                document.querySelectorAll('.calendar td.active')
                                    .forEach(c => c.classList.remove('active'));
                                td.classList.add('active');
                                selectedDate = td.dataset.date;
                                selectedLabel.textContent = selectedDate;
                                renderSlots();
                            });
                            day++;
                        }
                        tr.appendChild(td);
                    }
                    calendarBody.appendChild(tr);
                    if(day > daysInMonth) break;
                }
            }

            function renderSlots(){
                slotsGrid.innerHTML = '';
                baseSlots.forEach(time => {
                    const btn = document.createElement('button');
                    btn.type = 'button';
                    btn.textContent = time;
                    btn.className = 'slot-btn free';

                    btn.addEventListener('click', () => {
                        document.querySelectorAll('.slot-btn.selected')
                            .forEach(b => b.classList.remove('selected'));
                        btn.classList.add('selected');
                        selectedSlot = time;
                    });

                    slotsGrid.appendChild(btn);
                });
            }

            document.getElementById('calPrev').addEventListener('click', () => {
                currentMonth--;
                if(currentMonth < 0){
                    currentMonth = 11;
                    currentYear--;
                }
                renderMonth(currentYear, currentMonth);
            });

            document.getElementById('calNext').addEventListener('click', () => {
                currentMonth++;
                if(currentMonth > 11){
                    currentMonth = 0;
                    currentYear++;
                }
                renderMonth(currentYear, currentMonth);
            });

            fieldSelect.addEventListener('change', updateFieldInfo);

            confirmBtn.addEventListener('click', () => {
                if(!selectedDate || !selectedSlot){
                    alert('Por favor selecciona una fecha y un horario antes de confirmar.');
                    return;
                }
                alert(`Reserva demo:\n\nCancha: ${fieldSelect.options[fieldSelect.selectedIndex].text}\nFecha: ${selectedDate}\nHorario: ${selectedSlot}`);
            });

            updateFieldInfo();
            renderMonth(currentYear, currentMonth);
            selectedLabel.textContent = 'Selecciona un día';
            renderSlots();
        });
    </script>
</body>
</html>
