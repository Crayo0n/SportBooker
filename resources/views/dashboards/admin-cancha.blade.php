@extends('layouts.app')

@section('title', 'Historial de Reservas')

@section('content')

    @push('styles')
        @vite(['resources/css/historial-reservas.css'])
    @endpush

    <div class="history-wrapper">

        <header class="history-header">
            <div class="history-header-main">
                @if($miComplejo)
    <h1>{{ $miComplejo->nombre }}</h1>
    @else
    <div class="empty-state">
        <h3>⚠️ Cuenta no configurada</h3>
        <p>Tu usuario Admin no tiene un complejo deportivo asignado. Contacta al SuperAdmin.</p>
    </div>
@endif
                <p>
                    Bienvenido, {{ Auth::user()->nombre }}. Aquí tienes la vista general de tu negocio.
                    Revisa las reservaciones, gestiona pagos y toma acciones rápidas.
                </p>
            </div>

            <div style="margin-top: 15px;">
                <a href="{{ url('/admin/bloqueos/crear') }}" class="btn" style="background:#b91c1c; text-decoration:none; font-size:14px;">
                    ⚠️ Bloquear Horario
                </a>
            </div>
        </header>

        <section class="history-summary-grid">
            <article class="history-summary-card summary-all">
                <p class="summary-label">Reservas totales</p>
                <p class="summary-value">{{ $totalReservas }}</p>
                <p class="summary-note">Total histórico.</p>
            </article>

            <article class="history-summary-card summary-active">
                <p class="summary-label">Confirmadas</p>
                <p class="summary-value">{{ $reservas->where('reservacion_estatus', 'Confirmada')->count() }}</p>
                <p class="summary-note">Listas para jugar.</p>
            </article>

            <article class="history-summary-card summary-pending">
                <p class="summary-label">Ingresos Pendientes</p>
                <p class="summary-value">${{ number_format($ingresosPendientes, 2) }}</p>
                <p class="summary-note">Pagos "En Sitio" no cobrados.</p>
            </article>

            <article class="history-summary-card summary-rejected">
                <p class="summary-label">Canceladas</p>
                <p class="summary-value">{{ $reservas->where('reservacion_estatus', 'Cancelada')->count() }}</p>
                <p class="summary-note">Reservas anuladas.</p>
            </article>
        </section>

        <section class="history-table-section">

            <article class="history-card history-filters-card">
                <header class="history-table-header">
                    <h3>Listado de reservas</h3>
                    <p>Filtra para encontrar una reservación específica.</p>
                </header>

                <form class="history-filters" onsubmit="alert('Filtros pendientes de programar'); event.preventDefault()">
                    <div class="filter-group">
                        <label>Estado</label>
                        <select name="estatus">
                            <option value="">Todos</option>
                            <option value="Confirmada">Confirmada</option>
                            <option value="Cancelada">Cancelada</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label>Fecha</label>
                        <input type="date" name="fecha" />
                    </div>
                    <button type="submit" class="filter-btn">Aplicar filtros</button>
                </form>
            </article>

            <article class="history-card history-table-card">
                
                @if(session('success'))
                    <div style="background:#dcfce7; color:#166534; padding:12px; border-radius:8px; margin-bottom:15px; font-family:'Blinker';">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="history-table-scroll">
                    <table class="history-table">
                        <thead>
                            <tr>
                                <th>Usuario</th>
                                <th>Cancha</th>
                                <th>Fecha</th>
                                <th>Horario</th>
                                <th>Pago</th>
                                <th>Estatus</th>
                                <th>Total</th>
                                <th class="history-actions-cell">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reservas as $reserva)
                                <tr>
                                    <td>
                                        <div style="font-weight:700;">{{ $reserva->user->nombre }} {{ $reserva->user->apellido }}</div>
                                        <div style="font-size:12px; color:#6b7280;">{{ $reserva->user->email }}</div>
                                    </td>
                                    <td>{{ $reserva->cancha->nombre }}</td>
                                    <td>{{ $reserva->hora_inicio->format('Y-m-d') }}</td>
                                    <td>{{ $reserva->hora_inicio->format('H:i') }} – {{ $reserva->hora_fin->format('H:i') }}</td>
                                    <td>
                                        @if($reserva->pago_estatus == 'Pagado')
                                            <span class="status-pill status-activa">Pagado</span>
                                        @else
                                            <span class="status-pill status-pendiente">Pendiente</span>
                                        @endif
                                        <div style="font-size:11px; margin-top:2px;">{{ $reserva->metodo_pago }}</div>
                                    </td>
                                    <td>
                                        @php
                                            $clase = match($reserva->reservacion_estatus) {
                                                'Confirmada' => 'status-activa',
                                                'Cancelada' => 'status-rejected', // 'rechazada' en tu css
                                                default => 'status-pendiente',
                                            };
                                        @endphp
                                        <span class="status-pill {{ $clase }}">
                                            {{ $reserva->reservacion_estatus }}
                                        </span>
                                    </td>
                                    <td style="font-weight:700;">${{ number_format($reserva->precio_total, 2) }}</td>
                                    <td class="history-actions-cell">
                                        @if($reserva->reservacion_estatus !== 'Cancelada')
                                            <form action="{{ route('reservas.cancel', $reserva->id) }}" method="POST" onsubmit="return confirm('¿Cancelar esta reserva?');">
                                                @csrf
                                                <button type="submit" class="table-action" style="background:#dc2626;">Cancelar</button>
                                            </form>
                                        @else
                                            <button class="table-action table-action-disabled" disabled>Sin acción</button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" style="text-align:center; padding:30px; color:#6b7280;">
                                        No hay reservas registradas aún.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </article>
        </section>
    </div>

@endsection