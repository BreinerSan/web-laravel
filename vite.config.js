import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        host: '0.0.0.0',       // escucha en todas las interfaces dentro del contenedor
        port: 5173,
        strictPort: true,      // falla si el puerto está ocupado (útil para depurar)
        hmr: {
            host: process.env.VITE_HMR_HOST ?? 'localhost', // ajusta al host que usas en el navegador
            port: 5173,
        },
        watch: {
            usePolling: true,    // necesario a menudo con volúmenes montados en Docker/WSL2
        },
        // Agregar configuración de optimización
        optimizeDeps: {
            include: ['laravel-vite-plugin'],
        },
        // Configuración para ESM
        define: {
            global: 'globalThis',
        },
    },
});
