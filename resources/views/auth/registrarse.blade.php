@extends('layouts.app')

@section('title', 'Elige tu Cuenta')

@section('content')

    @push('styles')
        @vite(['resources/css/registrarse.css'])
    @endpush

    <div class="auth-page-wrapper">
        <div class="choice-container">
            
            <h1 class="choice-title">Crea tu cuenta en SportBooker</h1>
            <p class="choice-subtitle">
                Elige el tipo de cuenta que mejor se adapte a tus necesidades.
            </p>

            <div class="choice-grid">

                <div class="choice-card">
                    <div class="choice-header">
                        <div class="choice-icon">👤</div>
                        <h2>Cliente Ocasional</h2>
                    </div>
                    <p class="choice-desc">
                        Ideal para reservas puntuales, fiestas o eventos únicos.
                    </p>
                    <ul class="choice-list">
                        <li>Reserva por hora.</li>
                        <li>Verificación de documentos (INE, Comprobante).</li>
                        <li>Pago en línea o en sitio.</li>
                    </ul>
                    
                    <a href="{{ route('register.ocasional') }}" class="choice-btn outline">
                        Registrarme como Cliente Ocasional
                    </a>
                </div>

                <div class="choice-card">
                    <div class="choice-header">
                        <div class="choice-icon">👥</div>
                        <h2>Representante de Equipo</h2>
                    </div>
                    <p class="choice-desc">
                        Para representantes de equipos, ligas o empresas.
                    </p>
                    <ul class="choice-list">
                        <li>Solicitud de abonos (fechas múltiples).</li>
                        <li>Verificación completa (Roster, Actas, etc).</li>
                        <li>Gestión de equipo.</li>
                    </ul>

                    <a href="{{ route('register.recurrente') }}" class="choice-btn outline">
                        Registrarme como Representante de Equipo
                    </a>
                </div>

            </div>
            
            <div style="text-align: center; margin-top: 30px;">
                <a href="{{ route('login') }}" class="auth-link">¿Ya tienes cuenta? Iniciar Sesión</a>
            </div>

        </div>
    </div>

@endsection