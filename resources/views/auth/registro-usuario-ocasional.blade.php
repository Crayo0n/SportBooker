@extends('layouts.app')

@section('title', 'Registro Cliente Ocasional')

@section('content')

    <div class="auth-page-wrapper">
        <div class="auth-static-card" style="max-width: 800px;">
            
            <div class="auth-header">
                <img src="/images/v118_43.png" alt="SportBooker" class="auth-logo">
                <h2 style="margin-top: 10px; color: #004f7c; font-family: 'Audiowide';">Registro Ocasional</h2>
            </div>

            @if ($errors->any())
                <div style="background: #fee2e2; color: #991b1b; padding: 15px; border-radius: 10px; margin-bottom: 20px;">
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register.ocasional.store') }}" enctype="multipart/form-data">
                @csrf

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
                        <label class="auth-label">Correo Electrónico</label>
                        <input type="email" name="email" class="auth-input" value="{{ old('email') }}" required>
                    </div>
                    <div class="auth-field">
                        <label class="auth-label">Teléfono</label>
                        <input type="tel" name="telefono" class="auth-input" value="{{ old('telefono') }}" required>
                    </div>
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

                <hr style="border: 0; border-top: 1px solid #eee; margin: 30px 0;">

                <h3 style="color: #004f7c; font-family: 'Blinker'; margin-bottom: 15px;">Documentación Requerida</h3>
                <p style="font-size: 14px; color: #666; margin-bottom: 20px;">Sube tus documentos en formato PDF o Imagen (Max 5MB).</p>

                <div class="auth-grid">
                    <div class="auth-field">
                        <label class="auth-label">Identificación Oficial (INE)</label>
                        <input type="file" name="archivo_ine" class="auth-input" style="padding-top: 20px; font-size: 16px;" required>
                    </div>
                    <div class="auth-field">
                        <label class="auth-label">Comprobante de Domicilio</label>
                        <input type="file" name="archivo_dom" class="auth-input" style="padding-top: 20px; font-size: 16px;" required>
                    </div>
                </div>

                <div class="auth-actions" style="margin-top: 40px;">
                    <div class="auth-links">
                        <a href="{{ route('login') }}" class="auth-link">¿Ya tienes cuenta? Inicia Sesión</a>
                    </div>
                    <button type="submit" class="auth-submit">ENVIAR</button>
                </div>

            </form>
        </div>
    </div>

@endsection