import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js','Modules/HRIS/Resources/assets/js/dashboard.js'],
            refresh: true,
        }),
    ],
});
