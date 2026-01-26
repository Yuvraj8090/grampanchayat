import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.scss', 'resources/js/app.js'], // Ensure this matches your files
            refresh: true,
        }),
    ],
    css: {
        preprocessorOptions: {
            scss: {
                api: 'modern-compiler', // Use the modern Sass API
                silenceDeprecations: [
                    'mixed-decls', 
                    'color-functions', 
                    'global-builtin', 
                    'import', 
                    'legacy-js-api'
                ],
            },
        },
    },
    resolve: {
        alias: {
            '$': 'jquery',
            'jQuery': 'jquery',
        },
    },
});