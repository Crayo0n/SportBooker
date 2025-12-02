@extends('layouts.app')

@section('title', 'Registro de Equipo')

@section('content')

    <div class="auth-page-wrapper">
        <div class="auth-static-card" style="max-width: 900px;"> <div class="auth-header">
                <img src="/images/v118_43.png" alt="SportBooker" class="auth-logo">
                <h2 style="margin-top: 10px; color: #004f7c; font-family: 'Audiowide';">Registro de Equipo</h2>
                <p style="color: #666; font-size: 14px;">Para representantes de ligas y reservas recurrentes.</p>
            </div>

            @if ($errors->any())
                <div style="background: #fee2e2; color: #991b1b; padding: 15px; border-radius: 10px; margin-bottom: 20px;">
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register.recurrente.store') }}" enctype="multipart/form-data">
                @csrf

                <h3 style="color: #004f7c; font-family: 'Blinker'; margin-bottom: 15px; border-bottom: 1px solid #eee; padding-bottom: 5px;">Datos del Representante</h3>
                
                <div class="auth-grid">
                    <div class="auth-field">
                        <label class="auth-label">Nombre(s)</label>
                        <input type="text" name="nombre" class="auth-input" value="{{ old('nombre') }}" required>
                    </div>
                    <div class="auth-field">
                        <label class="auth-label">Apellidos</label>
                        <input type="text" name="apellido" class="auth-input" value="{{ old('apellido') }}" required>
                    </div>
                </div>

                <div class="auth-grid" style="margin-top: 20px;">
                    <div class="auth-field">
                        <label class="auth-label">CURP</label>
                        <input type="text" name="curp" class="auth-input" value="{{ old('curp') }}" placeholder="18 caracteres" required>
                    </div>
                    <div class="auth-field">
                        <label class="auth-label">Teléfono Celular</label>
                        <input type="tel" name="telefono" class="auth-input" value="{{ old('telefono') }}" required>
                    </div>
                </div>

                <div class="auth-field" style="margin-top: 20px;">
                    <label class="auth-label">Correo Electrónico</label>
                    <input type="email" name="email" class="auth-input" value="{{ old('email') }}" required>
                </div>

                <div class="auth-grid" style="margin-top: 20px;">
                    <div class="auth-field">
                        <label class="auth-label">Contraseña</label>
                        <input type="password" name="password" class="auth-input" required>
                    </div>
                    <div class="auth-field">
                        <label class="auth-label">Confirmar Contraseña</label>
                        <input type="password" name="password_confirmation" class="auth-input" required>
                    </div>
                </div>

                <h3 style="color: #004f7c; font-family: 'Blinker'; margin: 30px 0 15px 0; border-bottom: 1px solid #eee; padding-bottom: 5px;">Expediente del Equipo</h3>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="auth-field">
                        <label class="auth-label">INE del Representante</label>
                        <input type="file" name="archivo_ine" class="auth-input" style="padding-top: 20px; font-size: 16px;" required>
                    </div>
                    <div class="auth-field">
                        <label class="auth-label">Comprobante de Domicilio</label>
                        <input type="file" name="archivo_dom" class="auth-input" style="padding-top: 20px; font-size: 16px;" required>
                    </div>
                    <div class="auth-field">
                        <label class="auth-label">Oficio de Petición</label>
                        <input type="file" name="archivo_oficio" class="auth-input" style="padding-top: 20px; font-size: 16px;" required>
                    </div>
                    <div class="auth-field">
                        <label class="auth-label">Cédula / Roster de Jugadores</label>
                        <input type="file" name="archivo_roster" class="auth-input" style="padding-top: 20px; font-size: 16px;" required>
                    </div>
                    <div class="auth-field" style="grid-column: 1 / -1;">
                        <label class="auth-label">Actas y Certificados Médicos (PDF único o ZIP)</label>
                        <input type="file" name="archivo_medico" class="auth-input" style="padding-top: 20px; font-size: 16px;" required>
                        <small style="color: #666;">Máximo 10MB. Incluye la documentación de todos los integrantes.</small>
                    </div>
                </div>

                <div class="auth-actions" style="margin-top: 40px;">
                    <div class="auth-links">
                        <a href="{{ route('login') }}" class="auth-link">Cancelar</a>
                    </div>
                    <button type="submit" class="auth-submit">ENVIAR </button>
                </div>

            </form>
        </div>
    </div>

@endsection