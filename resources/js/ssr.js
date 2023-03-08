import { createSSRApp, h } from 'vue';
import { renderToString } from '@vue/server-renderer';
import createServer from '@inertiajs/server'
import { createInertiaApp, Head } from '@inertiajs/inertia-vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import App from '@/Share/Layout/App.vue';
import '../css/app.css';

createServer(page =>
    createInertiaApp({
        page,
        render: renderToString,
        resolve: async (name) => {
            const page = resolvePageComponent(
                `./Pages/${name}.vue`,
                import.meta.glob('./Pages/**/*.vue'),
            );

            page.then((module) => {
                module.default.layout = module.default.layout || App
            });

            return page;
        },
        setup({ app, props, plugin }) {
            return createSSRApp({
                render: () => h(app, props)
            }).use(plugin).component('InertiaHead', Head);
        },
    })
);
