@extends('layouts.app')

@section('title', 'Solicitudes de Abonos')

@section('content')

    @push('styles')
        @vite(['resources/css/historial-reservas.css'])
    @endpush

    <div class="history-wrapper">

        <header class="history-header">
            <div class="history-header-main">
                <h2>Solicitudes de Equipos: {{ $complejo->nombre }}</h2>
                <p>
                    Aquí aparecen las peticiones de <strong>Clientes Representates de Equipo</strong> que desean reservar
                    una cancha por una temporada completa. Revisa los horarios antes de aprobar.
                </p>
            </div>
        </header>

        @if(session('success'))
            <div style="background:#dcfce7; color:#166534; padding:15px; border-radius:12px; margin-bottom:25px; border:1px solid #bbf7d0;">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div style="background:#fee2e2; color:#991b1b; padding:15px; border-radius:12px; margin-bottom:25px; border:1px solid #fecaca;">
                {{ session('error') }}
            </div>
        @endif

        <section class="history-table-section">
            <article class="history-card history-table-card">
                
                <div class="history-table-scroll">
                    <table class="history-table">
                        <thead>
                            <tr>
                                <th>Representante</th>
                                <th>Cancha Solicitada</th>
                                <th>Día y Horario</th>
                                <th>Duración</th>
                                <th>Estado</th>
                                <th class="history-actions-cell">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($solicitudes as $solicitud)
                                <tr>
                                    <td>
                                        <div class="user-name">{{ $solicitud->user->nombre }} {{ $solicitud->user->apellido }}</div>
                                        <div class="user-sub">{{ $solicitud->user->telefono }}</div>
                                    </td>

                                    <td>
                                        <span class="cancha-badge">{{ $solicitud->cancha->nombre }}</span>
                                        <div class="user-sub" style="margin-top:4px;">{{ $solicitud->cancha->tipo_deporte }}</div>
                                    </td>

                                    <td>
                                        @php
                                            $dias = ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'];
                                            // Aseguramos que sea entero
                                            $diaNombre = $dias[intval($solicitud->dia_semana)] ?? 'Día ' . $solicitud->dia_semana;
                                        @endphp
                                        <div class="user-name">{{ $diaNombre }}s</div>
                                        <div class="user-sub">
                                            {{ \Carbon\Carbon::parse($solicitud->hora_inicio)->format('H:i') }} a 
                                            {{ \Carbon\Carbon::parse($solicitud->hora_fin)->format('H:i') }}
                                        </div>
                                    </td>

                                    <td>
                                        <div style="font-size:13px; color:#334155;">
                                            Del: <strong>{{ \Carbon\Carbon::parse($solicitud->fecha_inicio)->format('d/m/Y') }}</strong>
                                        </div>
                                        <div style="font-size:13px; color:#334155;">
                                            Al: <strong>{{ \Carbon\Carbon::parse($solicitud->fecha_fin)->format('d/m/Y') }}</strong>
                                        </div>
                                    </td>

                                    <td>
                                        <span class="status-pill status-pendiente">
                                            Pendiente
                                        </span>
                                    </td>

                                    <td class="history-actions-cell">
                                        <div style="display:flex; gap:10px; justify-content:flex-end;">
                                            <a href="{{ route('admin.abonos.approve', $solicitud->id) }}" 
                                               class="table-action" 
                                               style="background:#16a34a; text-decoration:none; display:inline-block; line-height:1.2;"
                                               onclick="return confirm('¿Estás seguro? Esto generará múltiples reservas en el calendario.')">
                                                Aprobar
                                            </a>

                                            <a href="{{ route('admin.abonos.reject', $solicitud->id) }}" 
                                               class="table-action" 
                                               style="background:#dc2626; text-decoration:none; display:inline-block; line-height:1.2;"
                                               onclick="return confirm('¿Rechazar esta solicitud?')">
                                                Rechazar
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" style="text-align:center; padding:50px;">
                                        <div style="font-size:40px; margin-bottom:10px;">📭</div>
                                        <p style="color:#64748b;">No tienes solicitudes  pendientes.</p>
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