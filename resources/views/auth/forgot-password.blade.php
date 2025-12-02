@extends('layouts.app')

@section('title', 'Recuperar Contraseña')

@section('content')

    <div class="auth-page-wrapper">
        
        <div class="auth-static-card">
            
            <div class="auth-header">
                <img src="/images/v118_43.png" alt="SportBooker Logo" class="auth-logo">
            </div>

            <p style="color: #666; font-size: 15px; line-height: 1.5; margin-bottom: 25px; text-align: center;">
                ¿Olvidaste tu contraseña? No hay problema. Simplemente déjanos saber tu dirección de correo electrónico y te enviaremos un enlace para restablecerla.
            </p>

            @if (session('status'))
                <div style="background: #dcfce7; color: #166534; padding: 12px; border-radius: 8px; margin-bottom: 20px; text-align: center; font-size: 14px; border: 1px solid #bbf7d0;">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div style="background: #fee2e2; color: #991b1b; padding: 12px; border-radius: 8px; margin-bottom: 20px; text-align: center; font-size: 14px;">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                
                <div class="auth-field" style="margin-bottom: 25px;">
                    <label class="auth-label">Correo Electrónico</label>
                    <input type="email" name="email" class="auth-input" value="{{ old('email') }}" placeholder="tu@correo.com" required autofocus>
                </div>

                <div class="auth-actions">
                    <div class="auth-links">
                        <a href="{{ route('login') }}" class="auth-link">Volver a Iniciar Sesión</a>
                    </div>
                    
                    <button type="submit" class="auth-submit" style="width: auto; min-width: 150px; font-size: 18px;">
                        ENVIAR ENLACE
                    </button>
                </div>
            </form>
        </div>

    </div>

@endsection