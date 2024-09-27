import Ripple from 'primevue/ripple';
import Button from 'primevue/button';
import Card from 'primevue/card';
import DataTable from 'primevue/datatable';
import Paginator from 'primevue/paginator';
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
import Stepper from 'primevue/stepper';
import StepperPanel from 'primevue/stepperpanel';
import CascadeSelect from 'primevue/cascadeselect';
import Dropdown from 'primevue/dropdown';
import SelectButton from 'primevue/selectbutton';
import Calendar from 'primevue/calendar';
import Toast from 'primevue/toast';
import ToastService from 'primevue/toastservice';
import SplitButton from 'primevue/splitbutton';
import TabView from 'primevue/tabview';
import TabPanel from 'primevue/tabpanel';
import Skeleton from 'primevue/skeleton';
import Avatar from 'primevue/avatar';
import Chart from 'primevue/chart';




export default function registerPrimeVueComponents(app: any) {
    app.component('Button', Button);
    app.component('Card', Card);
    app.component('DataTable', DataTable);
    app.component('Paginator', Paginator);
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
    app.component('Stepper', Stepper);
    app.component('StepperPanel', StepperPanel);
    app.component('CascadeSelect', CascadeSelect);
    app.component('Dropdown', Dropdown);
    app.component('SelectButton', SelectButton);
    app.component('Calendar', Calendar);
    app.component('Toast', Toast);
    app.component('SplitButton', SplitButton);
    app.component('TabView', TabView);
    app.component('TabPanel', TabPanel);
    app.component('Skeleton', Skeleton);
    app.component('Avatar', Avatar);
    app.component('Chart', Chart);

    app.directive('ripple', Ripple);
    
    app.use(ToastService);
}