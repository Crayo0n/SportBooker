@extends('layouts.app')

@section('title', 'Mi Perfil')

@section('content')

    @push('styles')
        @vite(['resources/css/perfil.css'])
    @endpush

    <div class="profile-page">
        <section class="profile-wrapper">

            <header class="profile-header">
                <div class="profile-header-main">
                    <h2 class="profile-title">Mi perfil</h2>
                    <p class="profile-subtitle">
                        Bienvenido, <strong>{{ $user->nombre }}</strong>. Gestiona tu información personal y revisa tus documentos.
                    </p>
                </div>
            </header>

            @if(session('success'))
                <div style="background:#dcfce7; color:#166534; padding:15px; border-radius:12px; margin-bottom:20px; border:1px solid #bbf7d0;">
                    {{ session('success') }}
                </div>
            @endif

            <section class="profile-grid">

                <article class="profile-card profile-main">
                    <header class="profile-card-header">
                        <h3>Información básica</h3>
                        <span class="profile-chip profile-chip-soft">Datos personales</span>
                    </header>

                    <div class="profile-main-body">
                        <div class="profile-field">
                            <p class="profile-label">Nombre completo</p>
                            <p class="profile-value">
                                {{ $user->nombre }} {{ $user->apellido }}
                            </p>
                        </div>

                        <div class="profile-field">
                            <p class="profile-label">Rol dentro del sistema</p>
                            <p class="profile-value">
                                {{-- Accedemos al nombre del rol a través de la relación --}}
                                {{ $user->role->nombre ?? 'Sin Rol' }}
                            </p>
                        </div>

                        <div>
                            <p class="profile-label">Correo electrónico</p>
                            <p class="profile-value">
                                {{ $user->email }}
                            </p>
                        </div>  

                        <div class="profile-field">
                            <p class="profile-label">Contraseña</p>
                            <p class="profile-value">**************</p>
                        </div>

                        <div class="profile-field">
                            <p class="profile-label">Miembro desde</p>
                            <p class="profile-value profile-value-muted">
                                {{ $user->created_at->format('d/m/Y') }}
                            </p>
                        </div>

                        <div class="profile-field-inline">
                            <div>
                                <p class="profile-label">Teléfono</p>
                                <p class="profile-value">
                                    {{ $user->telefono ?? $user->phone_number }}
                                </p>
                            </div>
                        </div>

                        <button type="button" class="profile-inline-btn" >
                                <li><a href="{{ route('perfil.editar') }}">Editar datos</a></li>
                            </button>
                    </div>
                </article>

                

                <article class="profile-card profile-docs">
                    <header class="profile-card-header">
                        <h3>Documentos</h3>
                        <span class="profile-chip profile-chip-soft">Verificación</span>
                    </header>

                    <div class="profile-docs-body">
                        @if($user->documents->count() > 0)
                            <div class="profile-docs-list">
                                @foreach($user->documents as $doc)
                                    <div class="profile-doc-item">
                                        <div class="profile-doc-text">
                                            <span class="profile-doc-name">{{ $doc->tipo ?? $doc->tipo_documento }}</span>
                                            <span class="profile-doc-status profile-doc-status-ok">Cargado</span>
                                        </div>
                                        <a href="{{ route('perfil.documento', $doc->id) }}" 
                                            target="_blank" 
                                            class="profile-doc-link" 
                                            style="text-decoration: none; display: flex; align-items: center; justify-content: center;">
                                             Ver
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="profile-docs-hint">
                                No has subido documentos o tu cuenta es de tipo Ocasional básico.
                            </p>
                        @endif
                        
                        @if($user->role->nombre === 'ClienteRecurrente')
                            <div style="margin-top: 15px; text-align:center;">
                                <span class="profile-doc-status profile-doc-status-pending">
                                    Estatus: {{ $user->status }}
                                </span>
                            </div>
                        @endif
                    </div>
                </article>

            </section>
        </section>
    </div>

@endsection