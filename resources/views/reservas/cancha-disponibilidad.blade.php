@extends('layouts.app')

@section('title', 'Disponibilidad de Cancha')

@section('content')

    @push('styles')
        @vite(['resources/css/cancha-disponibilidad.css'])
    @endpush

    <section class="hero">
        <div class="carousel" id="carousel">
            <div class="slide active">
                <img src="{{ $cancha->imagen_url ?? '/images/cancha2.png' }}" 
                     alt="{{ $cancha->nombre }}" />
            </div>
        </div>
    </section>

    <div class="availability-main">
        <section class="availability-wrapper">
            <header class="availability-header">
                <h2>Disponibilidad: {{ $cancha->nombre }}</h2>
                <p>Elige la fecha y el horario en el que deseas reservar.</p>
                
                <input type="hidden" id="canchaId" value="{{ $cancha->id }}">
            </header>

            <section class="availability-layout">
                
                <article class="card calendar-card">
                    <div class="detail-card-header">
                        <span class="detail-pill">Calendario</span>
                    </div>
                    <div class="calendar-body">
                        <div class="calendar-header">
                            <button class="cal-nav" id="calPrev" type="button">❮</button>
                            <div class="cal-month" id="calMonthLabel">Cargando...</div>
                            <button class="cal-nav" id="calNext" type="button">❯</button>
                        </div>
                        <table class="calendar">
                            <thead>
                                <tr><th>L</th><th>M</th><th>Mi</th><th>J</th><th>V</th><th>S</th><th>D</th></tr>
                            </thead>
                            <tbody id="calendarBody">
                                </tbody>
                        </table>
                        <p class="calendar-hint">Selecciona un día para ver horarios.</p>
                    </div>
                </article>

                <article class="card slots-card">
                    <div class="detail-card-header">
                        <span class="detail-pill">Horarios</span>
                    </div>
                    <div class="slots-body">
                        <p class="selected-date">
                            Disponibilidad para: <strong id="selectedDateLabel">–</strong>
                        </p>
                        <div class="slots-grid" id="slotsGrid">
                            <p style="grid-column: 1/-1; text-align: center; color: #666;">
                                Selecciona una fecha primero.
                            </p>
                        </div>
                        
                        <div class="slots-legend">
                            <span class="badge free">Libre</span>
                            <span class="badge taken">Ocupado</span>
                            <span class="badge selected">Tu Selección</span>
                        </div>
                    </div>
                </article>

            </section>

            <form id="reservaForm" method="POST" action="{{ route('reservas.store') }}">
                @csrf
                <input type="hidden" name="cancha_id" value="{{ $cancha->id }}">
                <input type="hidden" name="fecha" id="inputFecha">
                <input type="hidden" name="hora_inicio" id="inputHora">
                
                <div class="reserve-wrapper">
                    <button type="submit" class="reserve-btn" id="confirmBtn" disabled>
                        Confirmar Reserva (${{ $cancha->precio_por_hora }})
                    </button>
                </div>
            </form>

        </section>
    </div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const calendarBody = document.getElementById('calendarBody');
        const monthLabel   = document.getElementById('calMonthLabel');
        const selectedLbl  = document.getElementById('selectedDateLabel');
        const slotsGrid    = document.getElementById('slotsGrid');
        const confirmBtn   = document.getElementById('confirmBtn');
        
        // Inputs del formulario
        const inputFecha = document.getElementById('inputFecha');
        const inputHora  = document.getElementById('inputHora');
        const canchaId   = document.getElementById('canchaId').value;

        let today = new Date();
        let currentYear  = today.getFullYear();
        let currentMonth = today.getMonth();
        let selectedDate = null;

        // --- 1. Renderizar Calendario ---
        function renderMonth(year, month) {
            const monthNames = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
            monthLabel.textContent = `${monthNames[month]} ${year}`;
            calendarBody.innerHTML = '';

            const firstDay = new Date(year, month, 1);
            const startIndex = (firstDay.getDay() + 6) % 7; // Lunes=0
            const daysInMonth = new Date(year, month + 1, 0).getDate();

            let day = 1;
            for(let row=0; row<6; row++){
                const tr = document.createElement('tr');
                for(let col=0; col<7; col++){
                    const td = document.createElement('td');
                    if((row===0 && col<startIndex) || day>daysInMonth){
                        td.textContent = '';
                    } else {
                        td.textContent = day;
                        
                        let monthStr = (month+1).toString().padStart(2, '0');
                        let dayStr   = day.toString().padStart(2, '0');
                        let dateStr  = `${year}-${monthStr}-${dayStr}`;
                        td.dataset.date = dateStr;

                        // Bloquear días pasados
                        let checkDate = new Date(year, month, day);
                        let todayZero = new Date();
                        todayZero.setHours(0,0,0,0);
                        
                        if(checkDate < todayZero) {
                            td.classList.add('disabled');
                            td.style.opacity = '0.4';
                            td.style.cursor = 'not-allowed';
                        } else {
                            td.addEventListener('click', () => selectDate(td, dateStr));
                        }

                        if(day === today.getDate() && month === today.getMonth() && year === today.getFullYear()){
                            td.classList.add('today');
                        }
                        day++;
                    }
                    tr.appendChild(td);
                }
                calendarBody.appendChild(tr);
                if(day > daysInMonth) break;
            }
        }

        // --- 2. Seleccionar Fecha ---
        function selectDate(td, dateStr) {
            document.querySelectorAll('.calendar td.active').forEach(c => c.classList.remove('active'));
            td.classList.add('active');
            selectedDate = dateStr;
            selectedLbl.textContent = dateStr;
            inputFecha.value = dateStr; 
            
            loadSlots(dateStr);
        }

        // --- 3. Cargar Horarios desde la API (REAL) ---
        async function loadSlots(date) {
            slotsGrid.innerHTML = '<p style="grid-column: 1/-1; text-align:center; color:#666;">Buscando disponibilidad...</p>';
            confirmBtn.disabled = true;
            confirmBtn.style.opacity = "0.5";

            try {
                // Llamada a la API que creamos
                const response = await fetch(`/api/disponibilidad/${canchaId}?fecha=${date}`);
                
                if (!response.ok) throw new Error('Error en la red');
                
                const horasLibres = await response.json();
                
                slotsGrid.innerHTML = '';

                if (horasLibres.length === 0) {
                    slotsGrid.innerHTML = '<p style="grid-column: 1/-1; text-align:center; color:#b91c1c; font-weight:bold;">No hay horarios disponibles para este día.</p>';
                    return;
                }

                horasLibres.forEach(hora => {
                    const btn = document.createElement('button');
                    btn.type = 'button';
                    btn.className = 'slot-btn free';
                    
                    // Formateamos para mostrar rango (ej. 08:00 - 09:00)
                    // Asumimos bloques de 1 hora por defecto
                    let [h, m] = hora.split(':');
                    let nextH = parseInt(h) + 1;
                    let nextHStr = nextH.toString().padStart(2, '0');
                    
                    btn.textContent = `${hora.substring(0,5)} - ${nextHStr}:00`;
                    
                    btn.onclick = () => selectSlot(btn, hora);
                    slotsGrid.appendChild(btn);
                });

            } catch (error) {
                console.error(error);
                slotsGrid.innerHTML = '<p style="color:red; grid-column: 1/-1; text-align:center;">Error al cargar horarios. Intenta de nuevo.</p>';
            }
        }

        function selectSlot(btn, hora) {
            document.querySelectorAll('.slot-btn.selected').forEach(b => b.classList.remove('selected'));
            btn.classList.add('selected');
            
            // Guardamos la hora exacta (ej. 08:00:00) para enviar al backend
            // Aseguramos que tenga segundos para Carbon
            inputHora.value = hora.length === 5 ? hora + ':00' : hora; 
            
            confirmBtn.disabled = false;
            confirmBtn.style.opacity = "1";
        }

        // --- Inicialización ---
        document.getElementById('calPrev').onclick = () => {
            currentMonth--; if(currentMonth<0){currentMonth=11; currentYear--;}
            renderMonth(currentYear, currentMonth);
        };
        document.getElementById('calNext').onclick = () => {
            currentMonth++; if(currentMonth>11){currentMonth=0; currentYear++;}
            renderMonth(currentYear, currentMonth);
        };

        renderMonth(currentYear, currentMonth);
    });
</script>
@endpush