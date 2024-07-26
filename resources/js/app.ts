import './bootstrap';
import '../css/app.css';
import Ripple from 'primevue/ripple';

// PrimeVue
import 'primeicons/primeicons.css'
// import 'primevue/resources/themes/aura-light-green/theme.css'
// import 'primevue/resources/themes/lara-light-green/theme.css';
// import 'primevue/resources/themes/lara-dark-teal/theme.css';
// import 'primevue/resources/themes/aura-dark-green/theme.css';

// Primevue components
import Button from 'primevue/button';
import Card from 'primevue/card';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Badge from 'primevue/badge';
import Menubar from 'primevue/menubar';
import Dialog from 'primevue/dialog';
import InputText from 'primevue/inputtext';
import InputNumber from 'primevue/inputnumber';
import Textarea from 'primevue/textarea';
import Image from 'primevue/image';
import ToggleButton from 'primevue/togglebutton';
import FloatLabel from 'primevue/floatlabel';

import { createApp, h, DefineComponent } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import { createPinia } from 'pinia'
import PrimeVue from 'primevue/config';
import Lara from '@/Presets/lara'; 

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';
const pinia = createPinia()

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob<DefineComponent>('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) })

            app.use(plugin)
            .use(ZiggyVue)
            .use(pinia)
            .use(PrimeVue, {
                unstyled: true,
                pt: Lara,
                ripple: true
            })

        // Register PrimeVue components globally
        app.component('Button', Button);
        app.component('Card', Card);
        app.component('DataTable', DataTable);
        app.component('Column', Column);
        app.component('Badge', Badge);
        app.component('Menubar', Menubar);
        app.component('Dialog', Dialog);
        app.component('InputText', InputText);
        app.component('InputNumber', InputNumber);
        app.component('Textarea', Textarea);
        app.component('Image', Image);
        app.component('ToggleButton', ToggleButton);
        app.component('FloatLabel', FloatLabel);
        
        
        app.directive('ripple', Ripple);
        
        app.mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});

