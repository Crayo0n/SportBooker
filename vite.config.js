import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js',
                'resources/css/cancha-disponibilidad.css',
                'resources/css/cancha-detalle.css',
                'resources/css/registrarse.css',
                'resources/css/dashboard-cliente.css',
                'resources/css/historial-reservas.css',
                'resources/css/agregar-cancha.css',
                'resources/css/gestion-administradores.css',
                'resources/css/perfil.css',
            ],
            refresh: true,
        }),
    ],
});
