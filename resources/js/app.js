import './bootstrap';
import { createApp, h } from 'vue';
import { createInertiaApp, Head, Link } from '@inertiajs/inertia-vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import App from '@/Share/Layout/App.vue';
import '../css/app.css';

createInertiaApp({
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
    setup({el, App, props, plugin}) {
        createApp({render: () => h(App, props)})
            .use(plugin)
            .component('InertiaLink', Link)
            .component('InertiaHead', Head)
            .mount(el)
    },
});
