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


</style>

  <style>
  .auth-tabs {
    display: flex;
    justify-content: center;
    gap: 16px;
    margin-bottom: 24px;
  }
  .auth-tabs button {
    background: none;
    border: none;
    font-weight: 700;
    color: #555;
    font-size: 18px;
    cursor: pointer;
    padding: 6px 12px;
    border-bottom: 3px solid transparent;
    transition: all 0.3s ease;
  }
  .auth-tabs button.active {
    color: #2b6fd0;
    border-color: #2b6fd0;
  }
  </style>

<!-- Modal content -->
<!-- ===== Modal estilo "Querétaro" ===== -->
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

      <!-- Login -->
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

      <!-- Registro -->
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

      <!-- Recuperar -->
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

    <!-- ====== Scripts ====== -->
    <script>
      // Modal logic
      (function(){
        const backdrop = document.getElementById('authPanelBackdrop');
        const panel = document.getElementById('authPanel');
        const closeBtn = document.getElementById('authClose');

        const formLogin = document.getElementById('formLogin');
        const formRegister = document.getElementById('formRegister');
        const formRecover = document.getElementById('formRecover');

        const tabLogin = document.getElementById('tabLogin');
        const tabRegister = document.getElementById('tabRegister');
        const tabRecover = document.getElementById('tabRecover');

        const goRegister = document.getElementById('goRegister');
        const goRecover = document.getElementById('goRecover');
        const backLoginFromReg = document.getElementById('backLoginFromReg');
        const backLoginFromRec = document.getElementById('backLoginFromRec');

        const loginLink = document.getElementById('loginLink');

        function openPanel(section='login'){
          backdrop.style.display='block';
          panel.style.display='block';
          showSection(section);
          setTimeout(()=>panel.focus(), 0);
        }
        function closePanel(){
          backdrop.style.display='none';
          panel.style.display='none';
        }
        function showSection(section){
          formLogin.style.display='none';
          formRegister.style.display='none';
          formRecover.style.display='none';
          tabLogin.classList.remove('active');
          tabRegister.classList.remove('active');
          tabRecover.classList.remove('active');
          if(section==='register'){ formRegister.style.display='grid'; tabRegister.classList.add('active'); }
          else if(section==='recover'){ formRecover.style.display='grid'; tabRecover.classList.add('active'); }
          else { formLogin.style.display='grid'; tabLogin.classList.add('active'); }
        }

        // Abrir desde navbar
        loginLink?.addEventListener('click', e=>{ e.preventDefault(); openPanel('login'); });

        // Tabs
        tabLogin.addEventListener('click', ()=>showSection('login'));
        tabRegister.addEventListener('click', ()=>showSection('register'));
        tabRecover.addEventListener('click', ()=>showSection('recover'));

        // Enlaces internos
        goRegister.addEventListener('click', e=>{ e.preventDefault(); showSection('register'); });
        goRecover.addEventListener('click', e=>{ e.preventDefault(); showSection('recover'); });
        backLoginFromReg.addEventListener('click', e=>{ e.preventDefault(); showSection('login'); });
        backLoginFromRec.addEventListener('click', e=>{ e.preventDefault(); showSection('login'); });

        // Cerrar
        closeBtn.addEventListener('click', closePanel);
        backdrop.addEventListener('click', closePanel);
        document.addEventListener('keydown', e=>{ if(e.key==='Escape') closePanel(); });

        // Demos
        formLogin.addEventListener('submit', e=>{ e.preventDefault(); alert('Inicio de sesión demo'); });
        formRegister.addEventListener('submit', e=>{ e.preventDefault(); alert('Registro demo'); });
        formRecover.addEventListener('submit', e=>{ e.preventDefault(); alert('Recuperación demo'); });
      })();
    </script>
</body>
</html>
    <!-- ===== NAV ===== -->
    <nav class="navbar">
        <h1 class="brand">SportBooker</h1>

        <ul class="nav-links">
        <li><a href="{{ url('/') }}#inicio">Inicio</a></li>
        <li><a href="{{ route('cancha.horarios') }}">Canchas+</a></li>
        <li><a href="{{ route('perfil') }}">Canchas+*</a></li>
        <li><a href="{{ route('solicitud.reserva') }}">Solicitud</a></li>
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
<!-- Modal - Panel de autenticación o acción -->
<div id="authPanelBackdrop"></div>
<div id="authPanel">
    <button class="auth-close" onclick="closeModal()">×</button>
    <div class="auth-header">
        <h3>Detalles de la Reserva</h3>
    </div>

    <!-- Formulario o información que se muestra en el modal -->
    <div class="auth-grid">
        <div class="auth-field">
            <label class="auth-label" for="userName">Nombre del Usuario</label>
            <input type="text" id="userName" class="auth-input" placeholder="Ingrese el nombre" readonly />
        </div>

        <div class="auth-field">
            <label class="auth-label" for="fechaReserva">Fecha de la Reserva</label>
            <input type="text" id="fechaReserva" class="auth-input" placeholder="Fecha de la reserva" readonly />
        </div>
        
        <div class="auth-field">
            <label class="auth-label" for="estadoReserva">Estado de la Reserva</label>
            <input type="text" id="estadoReserva" class="auth-input" placeholder="Estado de la reserva" readonly />
        </div>
    </div>

    <!-- Botones de acción -->
    <div class="auth-actions">
        <button class="auth-submit" onclick="approveReservation()">Aprobar</button>
        <button class="auth-submit" onclick="rejectReservation()">Rechazar</button>
    </div>
</div>
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

      <!-- Login -->
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

      <!-- Registro -->
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

      <!-- Recuperar -->
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

    <!-- ====== Scripts ====== -->
    <script>
      // Modal logic
      (function(){
        const backdrop = document.getElementById('authPanelBackdrop');
        const panel = document.getElementById('authPanel');
        const closeBtn = document.getElementById('authClose');

        const formLogin = document.getElementById('formLogin');
        const formRegister = document.getElementById('formRegister');
        const formRecover = document.getElementById('formRecover');

        const tabLogin = document.getElementById('tabLogin');
        const tabRegister = document.getElementById('tabRegister');
        const tabRecover = document.getElementById('tabRecover');

        const goRegister = document.getElementById('goRegister');
        const goRecover = document.getElementById('goRecover');
        const backLoginFromReg = document.getElementById('backLoginFromReg');
        const backLoginFromRec = document.getElementById('backLoginFromRec');

        const loginLink = document.getElementById('loginLink');

        function openPanel(section='login'){
          backdrop.style.display='block';
          panel.style.display='block';
          showSection(section);
          setTimeout(()=>panel.focus(), 0);
        }
        function closePanel(){
          backdrop.style.display='none';
          panel.style.display='none';
        }
        function showSection(section){
          formLogin.style.display='none';
          formRegister.style.display='none';
          formRecover.style.display='none';
          tabLogin.classList.remove('active');
          tabRegister.classList.remove('active');
          tabRecover.classList.remove('active');
          if(section==='register'){ formRegister.style.display='grid'; tabRegister.classList.add('active'); }
          else if(section==='recover'){ formRecover.style.display='grid'; tabRecover.classList.add('active'); }
          else { formLogin.style.display='grid'; tabLogin.classList.add('active'); }
        }

        // Abrir desde navbar
        loginLink?.addEventListener('click', e=>{ e.preventDefault(); openPanel('login'); });

        // Tabs
        tabLogin.addEventListener('click', ()=>showSection('login'));
        tabRegister.addEventListener('click', ()=>showSection('register'));
        tabRecover.addEventListener('click', ()=>showSection('recover'));

        // Enlaces internos
        goRegister.addEventListener('click', e=>{ e.preventDefault(); showSection('register'); });
        goRecover.addEventListener('click', e=>{ e.preventDefault(); showSection('recover'); });
        backLoginFromReg.addEventListener('click', e=>{ e.preventDefault(); showSection('login'); });
        backLoginFromRec.addEventListener('click', e=>{ e.preventDefault(); showSection('login'); });

        // Cerrar
        closeBtn.addEventListener('click', closePanel);
        backdrop.addEventListener('click', closePanel);
        document.addEventListener('keydown', e=>{ if(e.key==='Escape') closePanel(); });

        // Demos
        formLogin.addEventListener('submit', e=>{ e.preventDefault(); alert('Inicio de sesión demo'); });
        formRegister.addEventListener('submit', e=>{ e.preventDefault(); alert('Registro demo'); });
        formRecover.addEventListener('submit', e=>{ e.preventDefault(); alert('Recuperación demo'); });
      })();
    </script>
</body>
</html>
