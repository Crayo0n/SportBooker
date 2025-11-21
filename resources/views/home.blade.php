@extends('layouts.app')

@section('title', 'Bienvenido')

@section('content')

    <section class="hero">
        <div class="carousel" id="carousel">
            <div class="slide active"><img src="/images/v118_9.png" alt="Cancha 1" /></div>
            <div class="slide"><img src="/images/cancha2.png" alt="Cancha 2" /></div>
            <div class="slide"><img src="/images/cancha3.png" alt="Cancha 3" /></div>
            
            <button class="carousel-btn prev">❮</button>
            <button class="carousel-btn next">❯</button>

            <div class="carousel-indicators">
                <span class="dot active"></span>
                <span class="dot"></span>
                <span class="dot"></span>
            </div>
        </div>
    </section>

    <section class="section container" id="eventos">
        <div class="ev-layout">
            <div class="ev-left">
                <img src="/images/v118_58.png" alt="Eventos" style="max-width:260px;"
                     onerror="this.replaceWith(Object.assign(document.createElement('span'),{className:'h-script',textContent:'Eventos'}));" />
                <p>Conoce nuestros próximos eventos en los que puedes participar.</p>
                <button class="btn">Ver Más</button>
            </div>

            <div class="ev-grid">
                <article class="card">
                    <img src="/images/v118_17.png" alt="Atletismo">
                    <div class="content"><h3>Atletismo</h3></div>
                    <div class="actions"><button class="btn">Ver Programa</button></div>
                </article>
                </div>
        </div>
        <div class="divider"></div>
    </section>

    <section class="section container" id="equipos">
        <div class="qro-layout">
            <div class="team-grid">
                <article class="card">
                    <img src="/images/v118_53.png" alt="Futbol">
                    <div class="content"><h3>Equipo De Futbol</h3></div>
                    <div class="actions"><button class="btn">Más Información</button></div>
                </article>
                </div>

            <div class="qro-right">
                <div class="qro-logo"></div>
                <p>Forma Parte De Nuestros Equipos.</p>
                <button class="btn">Ver Más</button>
            </div>
        </div>
        <div class="divider"></div>
    </section>

    @guest
    <section class="section container" id="registro">
        <div class="table-wrap">
            <div class="reg-title">
                <div class="logo" onerror="this.textContent='Registro De Canchas'"></div>
            </div>
            <div class="subtle">Documentos necesarios</div>
            <table class="tabla">
                <thead>
                    <tr>
                        <th>Documento</th><th>Descripción</th><th>Original/Copia</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>Solicitud de espacio</td><td>Escrito libre</td><td>Original</td></tr>
                    <tr><td>INE</td><td>Identificación</td><td>Copia</td></tr>
                    </tbody>
            </table>
        </div>
    </section>
    @endguest

@endsection

@push('scripts')
<script>
    // JS del Carrusel (Solo corre en esta página)
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

        next?.addEventListener('click', nextSlide);
        prev?.addEventListener('click', prevSlide);
        
        function auto(){ t=setInterval(nextSlide,5000); }
        function stop(){ clearInterval(t); }
        root.addEventListener('mouseenter', stop);
        root.addEventListener('mouseleave', auto);
        auto();
    })();
</script>
@endpush