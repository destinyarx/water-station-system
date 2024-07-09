import './bootstrap';
import '../css/app.css';
import Ripple from 'primevue/ripple';

// PrimeVue
import 'primeicons/primeicons.css'
// import 'primevue/resources/themes/aura-light-green/theme.css'
// import 'primevue/resources/themes/lara-light-green/theme.css';
// import 'primevue/resources/themes/lara-dark-teal/theme.css';
// import 'primevue/resources/themes/aura-dark-green/theme.css';



import { createApp, h, DefineComponent } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import PrimeVue from 'primevue/config';
import Lara from '@/Presets/lara'; 

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob<DefineComponent>('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(PrimeVue, {
                unstyled: true,
                pt: Lara,
                ripple: true
            })
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});

