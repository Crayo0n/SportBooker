@extends('layouts.app')

@section('title', 'Detalle de Canchas')

@section('content')

    @push('styles')
        @vite(['resources/css/cancha-detalle.css'])
    @endpush

    <section class="hero">
        <div class="carousel" id="carousel">
            
            @php
                $imagenesDefault = [
                    '/images/v118_9.png',
                    '/images/cancha2.png',
                    '/images/cancha3.png',
                    '/images/cancha4.png',
                    '/images/cancha5.png'
                ];
            @endphp

            @foreach($canchas as $index => $cancha)
                <div class="slide {{ $index === 0 ? 'active' : '' }}">
                    <img src="{{ $cancha->imagen_url ?? $imagenesDefault[$index % count($imagenesDefault)] }}" 
                         alt="{{ $cancha->nombre }}" 
                         loading="{{ $index === 0 ? 'eager' : 'lazy' }}" />
                </div>
            @endforeach

            <button class="carousel-btn prev" aria-label="Anterior">❮</button>
            <button class="carousel-btn next" aria-label="Siguiente">❯</button>

            <div class="carousel-indicators" role="tablist">
                @foreach($canchas as $index => $cancha)
                    <span class="dot {{ $index === 0 ? 'active' : '' }}" role="tab" aria-label="{{ $index + 1 }}"></span>
                @endforeach
            </div>
        </div>
    </section>

    <div class="page-detail">
        <div class="detail-wrapper">
            <header class="detail-header">
                <h2 id="fieldTitle">Cargando...</h2>
                <span>Información adicional</span>
            </header>

            <section class="detail-grid">
                <article class="detail-card descripcion">
                    <div class="detail-card-header">
                        <span class="detail-pill">Descripción</span>
                    </div>
                    <div class="detail-card-body">
                        <p id="descText">...</p>
                    </div>
                </article>

                <article class="detail-card quick">
                    <div class="detail-card-header">
                        <span class="detail-pill">Datos Rápidos</span>
                    </div>
                    <div class="detail-card-body">
                        <ul id="quickList">
                            </ul>
                    </div>
                </article>

                <article class="detail-card price">
                    <div class="detail-card-header">
                        <span class="detail-pill">Precio</span>
                    </div>
                    <div class="detail-card-body">
                        <p id="priceText">...</p>
                    </div>
                </article>

                <article class="detail-card remember">
                    <div class="detail-card-header">
                        <span class="detail-pill">Recuerda</span>
                    </div>
                    <div class="detail-card-body">
                        <p id="rememberText">
                            Antes de salir, asegúrate de retirar basura y cuidar las instalaciones.
                        </p>
                    </div>
                </article>
            </section>


             @if(Auth::user()->role->nombre === 'ClienteOcasional')
                <div class="reserve-wrapper">
                <button class="reserve-btn" onclick="iniciarReserva()">Reservar esta Cancha</button>
            </div>
            @endif
            
        </div>
    </div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        
        // ===== 1. DATOS DINÁMICOS DE LARAVEL =====
        const dbCanchas = @json($canchas);

        const fieldInfo = dbCanchas.map(cancha => {
            return {
                id: cancha.id,
                name: cancha.nombre,
                desc: cancha.descripcion,
                quick: [
                    'Deporte: ' + cancha.tipo_deporte,
                    // Si tuvieras el complejo cargado, podrías poner cancha.complejo.nombre
                    'Ubicación: ' + cancha.complejo.nombre, 
                    'Estado: ' + cancha.status
                ],
                price: '$' + parseFloat(cancha.precio_por_hora).toFixed(2) + ' por hora de juego',
                remember: 'Por favor respeta el reglamento del complejo y los horarios asignados.'
            };
        });

        // ===== 2. REFERENCIAS DOM =====
        const titleEl    = document.getElementById('fieldTitle');
        const descEl     = document.getElementById('descText');
        const quickList  = document.getElementById('quickList');
        const priceEl    = document.getElementById('priceText');
        const rememberEl = document.getElementById('rememberText');

        // Variable global para saber el ID actual
        window.currentCanchaId = null;

        // Función para actualizar el texto según el índice del carrusel
        function applyFieldInfo(index) {
            const data = fieldInfo[index];
            if(!data) return;

            window.currentCanchaId = data.id;

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

        // ===== 3. LÓGICA DEL CARRUSEL =====
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
            if (next) next.addEventListener('click', () => { stopAuto(); nextSlide(); startAuto(); });
            if (prev) prev.addEventListener('click', () => { stopAuto(); prevSlide(); startAuto(); });
            
            dots.forEach((dot, i) => {
                dot.addEventListener('click', () => { stopAuto(); showSlide(i); startAuto(); });
            });

            carousel.addEventListener('mouseenter', stopAuto);
            carousel.addEventListener('mouseleave', startAuto);
            
            // Inicializar
            showSlide(0);
            startAuto();
        } else {
            // Si por algo falla el carrusel visual, cargamos la data del primero
            if(fieldInfo.length > 0) applyFieldInfo(0);
        }
    });

    // ===== 4. FUNCIÓN DE RESERVA =====
    function iniciarReserva() {
        if (window.currentCanchaId) {
            const baseUrl = "{{ url('/reservar') }}";
            window.location.href = baseUrl + '/' + window.currentCanchaId;
        } else {
            alert("Cargando información...");
        }
    }
</script>
@endpush