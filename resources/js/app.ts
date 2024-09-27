import './bootstrap';
import '../css/app.css';
import 'primeicons/primeicons.css'
import { createApp, h, DefineComponent } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import { createPinia } from 'pinia';
import SvgIcon from '@jamescoyle/vue-icon';
import PrimeVue from 'primevue/config';
import Lara from '@/Presets/lara';

import registerPrimeVueComponents from './primevue-components'; // Import the module

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';
const pinia = createPinia();

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob<DefineComponent>('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) });

        app.use(plugin)
            .use(ZiggyVue)
            .use(pinia)
            .use(PrimeVue, {
                unstyled: true,
                pt: Lara,
                ripple: true,
            });

        // Register all PrimeVue components using the module
        registerPrimeVueComponents(app);

        app.component('SvgIcon', SvgIcon);

        app.mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
