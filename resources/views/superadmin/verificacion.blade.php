@extends('layouts.app')

@section('title', 'Verificación de Usuarios')

@section('content')

    @push('styles')
        @vite(['resources/css/gestion-administradores.css'])
    @endpush

    <main class="admin-wrapper">
        <header class="admin-header">
            <div class="admin-header-main">
                <h2>Verificación de Identidad</h2>
                <p>
                    Revisa los documentos subidos por los nuevos usuarios antes de aprobar su acceso a la plataforma.
                </p>
            </div>
        </header>

        @if(session('success'))
            <div style="background:#dcfce7; color:#166534; padding:15px; border-radius:12px; margin-bottom:20px;">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div style="background:#fee2e2; color:#991b1b; padding:15px; border-radius:12px; margin-bottom:20px;">{{ session('error') }}</div>
        @endif

        <section class="admin-card admin-table-card">
            <div class="admin-table-scroll">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Tipo de Cuenta</th>
                            <th>Documentos</th>
                            <th>Fecha Registro</th>
                            <th class="admin-actions-header">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($usuariosPendientes as $usuario)
                            <tr>
                                <td>
                                    <div style="font-weight:700;">{{ $usuario->nombre }} {{ $usuario->apellido }}</div>
                                    <div style="font-size:12px; color:#6b7280;">{{ $usuario->email }}</div>
                                    <div style="font-size:12px; color:#6b7280;">Tel: {{ $usuario->phone_number }}</div>
                                </td>

                                <td>
                                    @if($usuario->role->name === 'ClienteRecurrente')
                                        <span class="status-pill" style="background:#e0f2fe; color:#0369a1;">Equipo / Recurrente</span>
                                    @else
                                        <span class="status-pill" style="background:#f3f4f6; color:#4b5563;">Ocasional</span>
                                    @endif
                                </td>

                                <td>
                                    <div style="display:flex; flex-direction:column; gap:5px;">
                                        @foreach($usuario->documents as $doc)
                                            <a href="{{ route('superadmin.documentos.descargar', $doc->id) }}" 
                                               target="_blank"
                                               style="text-decoration:none; color:#2563eb; font-size:13px; display:flex; align-items:center; gap:4px;">
                                                📄 {{ $doc->tipo_documento ?? $doc->tipo }}
                                            </a>
                                        @endforeach
                                    </div>
                                </td>

                                <td>{{ $usuario->created_at->format('d/m/Y H:i') }}</td>

                                <td class="admin-actions-cell">
                                    <a href="{{ route('superadmin.verificacion.aprobar', $usuario->id) }}" 
                                       class="table-action" 
                                       style="background:#16a34a; text-decoration:none; display:inline-block; text-align:center;"
                                       onclick="return confirm('¿Aprobar acceso a este usuario?')">
                                        ✓ Aprobar
                                    </a>
                                    
                                    <a href="{{ route('superadmin.verificacion.rechazar', $usuario->id) }}" 
                                       class="table-action admin-danger" 
                                       style="text-decoration:none; display:inline-block; text-align:center;"
                                       onclick="return confirm('¿Rechazar usuario?')">
                                        ✕ Rechazar
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="text-align:center; padding:50px; color:#6b7280;">
                                    <div style="font-size:40px; margin-bottom:10px;">✅</div>
                                    No hay usuarios pendientes de verificación.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </main>

@endsection