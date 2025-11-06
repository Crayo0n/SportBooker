<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>

        <div id="login-modal" class="login-overlay">
        <div class="login-modal-content">
            <a href="#" class="login-close-btn">&times;</a>
            <img src="/img/logo-queretaro.png" alt="Logo Querétaro" class="login-logo">
            
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <input type="email" name="email" placeholder="Correo Electrónico" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="Contraseña" required>
                </div>
                
                <a href="{{ route('password.request') }}" class="forgot-password">Olvidé mi contraseña</a>
                
                <a href="{{ route('register.choice') }}" class="register-link">¿No tienes cuenta? Regístrate aquí</a>
                
                <button type="submit" class="btn">Entrar</button>
            </form>
        </div>
    </div>
    </form>


    
</x-guest-layout>
