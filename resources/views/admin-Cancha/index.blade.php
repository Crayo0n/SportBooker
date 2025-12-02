@extends('layouts.app')
@section('title', 'Gestionar Canchas')
@section('content')
    @push('styles') @vite(['resources/css/dashboard-admin-cancha.css']) @endpush

    <div class="admin-container">
        <div class="admin-header">
            <div class="admin-title">
                <h1>Mis Canchas</h1>
                <p>Inventario de {{ $complejo->nombre }}</p>
            </div>
            <a href="{{ route('admin.canchas.create') }}" class="btn" style="text-decoration: none;">+ Nueva Cancha</a>
        </div>

        @if(session('success'))
            <div style="background:#dcfce7; color:#166534; padding:15px; border-radius:8px; margin-bottom:20px;">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div style="background:#fee2e2; color:#991b1b; padding:15px; border-radius:8px; margin-bottom:20px;">{{ session('error') }}</div>
        @endif

        <div class="table-container">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Deporte</th>
                        <th>Precio/Hora</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($canchas as $cancha)
                        <tr>
                            <td class="user-name">{{ $cancha->nombre }}</td>
                            <td><span class="cancha-badge">{{ $cancha->tipo_deporte }}</span></td>
                            <td class="user-name">${{ $cancha->precio_por_hora }}</td>
                            <td>
                                <span class="status-pill {{ $cancha->status == 'Disponible' ? 'status-confirmada' : 'status-cancelada' }}">
                                    {{ $cancha->status }}
                                </span>
                            </td>
                            <td style="display: flex; gap: 10px;">
                                <a href="{{ route('admin.canchas.edit', $cancha->id) }}" style="color: #0284c7; font-weight: 600; text-decoration: none;">Editar</a>
                                <form action="{{ route('admin.canchas.destroy', $cancha->id) }}" method="POST" onsubmit="return confirm('¿Eliminar esta cancha?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-action-cancel" style="border:0; padding:0; background:none;">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="empty-state">No tienes canchas registradas.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection