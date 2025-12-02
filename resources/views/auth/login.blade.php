@extends('layouts.app')

@section('title', 'Iniciar Sesión')

@section('content')

    <div class="auth-page-wrapper">
        
        <div class="auth-static-card">
            
            <div class="auth-header">
                <img src="/images/v118_43.png" alt="SportBooker Logo" class="auth-logo">
            </div>

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


            
            @if ($errors->any())
                <div style="background: #fee2e2; color: #991b1b; padding: 12px; border-radius: 8px; margin-bottom: 20px; text-align: center; font-size: 14px;">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                <div class="auth-grid">
                    <div class="auth-field">
                        <label class="auth-label">Correo Electrónico</label>
                        <input type="email" name="email" class="auth-input" value="{{ old('email') }}" placeholder="email@ejemplo.com" required autofocus>
                    </div>
                    
                    <div class="auth-field">
                        <label class="auth-label">Contraseña</label>
                        <input type="password" name="password" class="auth-input" placeholder="......" required>
                    </div>
                </div>

                <div class="auth-actions">
                    <div class="auth-links">
                        <a href="{{ route('password.request') }}" class="auth-link">¿Olvidaste tu contraseña?</a>
                        <a href="{{ route('registrarse') }}" class="auth-link">¿No tienes cuenta? Regístrate</a>
                    </div>
                    <button type="submit" class="auth-submit">ENTRAR</button>
                </div>
            </form>
        </div>

    </div>

@endsection