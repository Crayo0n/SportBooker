@extends('layouts.app')

@section('title', 'Mis Reservas')

@section('content')

    @push('styles')
        @vite(['resources/css/dashboard-cliente.css'])
    @endpush

    <div class="dashboard-container">
        
        <header class="dashboard-header">
            <h1>Mis Reservas</h1>
            <p>Historial de tus partidos y próximos encuentros.</p>
        </header>

        @if (session('success'))
            <div style="background: #dcfce7; color: #166534; padding: 15px; border-radius: 10px; margin-bottom: 20px; border: 1px solid #bbf7d0;">
                {{ session('success') }}
            </div>
        @endif

        <div class="reservas-grid">
            
            @forelse($misReservas as $reserva)
                <article class="reserva-card">
                    <div class="card-top">
                        <div class="date-badge">
                            📅 {{ $reserva->hora_inicio->format('d M Y') }}
                        </div>
                        
                        @php
                            $claseStatus = match($reserva->reservacion_estatus) {
                                'Confirmada' => 'status-confirmada',
                                'Cancelada' => 'status-cancelada',
                                default => 'status-pendiente',
                            };
                        @endphp
                        <span class="status-pill {{ $claseStatus }}">
                            {{ $reserva->reservacion_estatus }}
                        </span>
                    </div>

                    <div class="card-body">
                        <h3 class="cancha-title">{{ $reserva->cancha->nombre }}</h3>
                        
                        <div class="complejo-name">
                            📍 {{ $reserva->cancha->complejo->nombre }}
                        </div>

                        <div class="info-row">
                            <span class="info-label">Horario:</span>
                            <span>
                                {{ $reserva->hora_inicio->format('H:i') }} - 
                                {{ $reserva->hora_fin->format('H:i') }}
                            </span>
                        </div>

                        <div class="info-row">
                            <span class="info-label">Pago:</span>
                            <span>
                                @if($reserva->metodo_pago == 'EnSitio')
                                    Pago en Taquilla
                                @else
                                    Pago en Taquilla
                                @endif
                            </span>
                        </div>

                        <div class="info-row" style="margin-top: 15px; align-items: center;">
                            <span class="info-label">Total:</span>
                            <span class="price-tag">${{ number_format($reserva->precio_total, 2) }}</span>
                        </div>
                    </div>

                    @if($reserva->hora_inicio > now() && $reserva->reservacion_estatus !== 'Cancelada')
                        <div class="card-actions">
                            <form action="{{ route('reservas.cancel', $reserva->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro que deseas cancelar esta reserva? Esta acción no se puede deshacer.');">
                                @csrf <button type="submit" class="btn-cancel">Cancelar Reserva</button>
                            </form>
                        </div>
                    @endif

                    @if (session('error'))
                        <div style="background: #fee2e2; color: #991b1b; padding: 15px; border-radius: 10px; margin-bottom: 20px; border: 1px solid #fecaca;">
                            {{ session('error') }}
                        </div>
                    @endif

                    
                </article>
            
            @empty
                <div class="empty-state" style="grid-column: 1 / -1;">
                    <div style="font-size: 40px; margin-bottom: 10px;">⚽</div>
                    <h3>Aún no tienes reservas</h3>
                    <p>Explora nuestras canchas y agenda tu primer partido.</p>
                    <a href="{{ route('canchas.catalogo') }}" class="btn">Ver Canchas</a>
                </div>
            @endforelse

        </div>
    </div>

@endsection