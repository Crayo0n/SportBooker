@extends('layouts.app')

@section('title', 'Gestión de Administradores')

@section('content')

    @push('styles')
        @vite(['resources/css/gestion-administradores.css'])
    @endpush

    <main class="admin-wrapper">
        <header class="admin-header">
            <div class="admin-header-main">
                <h2>Gestión de administradores</h2>
                <p>
                    Controla los administradores del sistema: agrega nuevos, revisa sus datos
                    y elimina accesos cuando sea necesario. Panel exclusivo de <strong>Super Admin</strong>.
                </p>
            </div>
        </header>

        @if(session('success'))
            <div style="background:#dcfce7; color:#166534; padding:15px; border-radius:12px; margin-bottom:20px; border:1px solid #bbf7d0;">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div style="background:#fee2e2; color:#991b1b; padding:15px; border-radius:12px; margin-bottom:20px; border:1px solid #fecaca;">
                {{ session('error') }}
            </div>
        @endif

        <section class="admin-summary-grid">
            <article class="admin-summary-card admin-summary-total">
                <p class="summary-label">Admins Totales</p>
                <p class="summary-value">{{ $totalAdmins }}</p>
                <p class="summary-note">Registrados en el sistema.</p>
            </article>

            <article class="admin-summary-card admin-summary-active">
                <p class="summary-label">Admins Activos</p>
                <p class="summary-value">{{ $activos }}</p>
                <p class="summary-note">Con estatus 'Aprobado'.</p>
            </article>

            <article class="admin-summary-card admin-summary-inactive">
                <p class="summary-label">Pendientes / Inactivos</p>
                <p class="summary-value">{{ $inactivos }}</p>
                <p class="summary-note">Requieren revisión.</p>
            </article>

            <article class="admin-summary-card admin-summary-role">
                <p class="summary-label">Tu Rol</p>
                <p class="summary-value summary-badge">Super Admin</p>
                <p class="summary-note">Acceso total.</p>
            </article>
        </section>

        <section class="admin-content-section">
            
            <section class="admin-card admin-filters-card">
                <header class="admin-card-header">
                    <div>
                        <h3>Listado de administradores</h3>
                        <p>Gestiona el acceso de los encargados de complejos deportivos.</p>
                    </div>
                    <a href="{{ route('superadmin.admins.create') }}" class="primary-btn admin-add-btn" style="text-decoration: none;">
                        + Agregar administrador
                    </a>
                </header>
                </section>

            <section class="admin-card admin-table-card">
                <div class="admin-table-scroll">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Teléfono</th>
                                <th>Estado</th>
                                <th>Fecha Registro</th>
                                <th class="admin-actions-header">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($admins as $admin)
                                <tr>
                                    <td style="font-weight:600;">{{ $admin->nombre }} {{ $admin->apellido }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>{{ $admin->phone_number }}</td>
                                    <td>
                                        @if($admin->status == 'Aprobado')
                                            <span class="status-pill status-on">Activo</span>
                                        @else
                                            <span class="status-pill status-off">{{ $admin->status }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $admin->created_at->format('d/m/Y') }}</td>
                                    <td class="admin-actions-cell">
                                        <a href="{{ route('superadmin.admins.edit', $admin->id) }}" class="table-action admin-edit" style="text-decoration: none; display: inline-block;">
                                             Editar
                                        </a>
                                        
                                        <form action="{{ route('superadmin.admins.destroy', $admin->id) }}" method="POST" onsubmit="return confirm('¿Eliminar a este administrador?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="table-action admin-danger">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" style="text-align:center; padding:40px; color:#6b7280;">
                                        No hay administradores registrados.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </section>
    </main>

@endsection