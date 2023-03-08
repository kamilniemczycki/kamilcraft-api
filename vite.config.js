import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';
import { networkInterfaces } from 'os'

export default defineConfig({
    server: {
        host: Object.values(networkInterfaces()).flat().find(i => i.family === 'IPv4' && !i.internal).address,
        hmr: {
            host: 'localhost',
        },
    },
    resolve: {
        alias: {
            '@': '/resources/js',
        },
    },
    plugins: [
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        laravel({
            input: 'resources/js/app.js',
            ssr: 'resources/js/ssr.js',
            refresh: true,
        }),
    ],
    ssr: {
        noExternal: [
            '@inertiajs/server',
            '@vue/runtime-dom'
        ],
    },
});
