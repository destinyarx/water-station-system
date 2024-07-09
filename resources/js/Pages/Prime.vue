<template>

    <Calendar v-model="date" inline showWeek class="w-3/5 h-full" dateFormat="mm/yy 'nice-one'" />

    <div class="card flex justify-content-center mt-5">
        <Dropdown v-model="selectedCity" :options="cities" optionLabel="name" placeholder="Select a City" class="w-56 pr-1 md:w-14rem" />
    </div>

    <br>

    <div class="card flex justify-content-center">
        <Sidebar v-model:visible="showSideBar" header="Sidebar">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        </Sidebar>
        <Button icon="pi pi-arrow-right" @click="showSideBar = true" />
    </div>
    <br>
    <br>

    <Card style="width: 25rem; overflow: hidden">
        <template #header>
            <img alt="user header" src="https://primefaces.org/cdn/primevue/images/usercard.png" />
        </template>
        <template #title>Advanced Card</template>
        <template #subtitle>Card subtitle</template>
        <template #content>
            <p class="m-0">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore sed consequuntur error repudiandae numquam deserunt quisquam repellat libero asperiores earum nam nobis, culpa ratione quam perferendis esse, cupiditate neque
                quas!
            </p>
        </template>
        <template #footer>
            <div class="flex gap-3 mt-1">
                <Button @click="cancel()" label="Cancel" severity="secondary" outlined class="w-full" />
                <Button @click="save()" label="Save" class="w-full" />
            </div>
        </template>
    </Card>

    <br>

    <div class="card flex justify-content-center">
        <Button label="Show" @click="visible = true" />
        <Dialog v-model:visible="visible" modal header="Edit Profile" :style="{ width: '25rem' }">
            <span class="p-text-secondary block mb-5">Update your information.</span>
            <div class="flex align-items-center gap-3 mb-3">
                <label for="username" class="font-semibold w-6rem">Username</label>
                <InputText id="username" class="flex-auto" autocomplete="off" />
            </div>
            <div class="flex align-items-center gap-3 mb-5">
                <label for="email" class="font-semibold w-6rem">Email</label>
                <InputText id="email" class="flex-auto" autocomplete="off" />
            </div>
            <div class="flex justify-content-end gap-2">
                <Button @click="cancel()" type="button" label="Cancel" severity="secondary"></Button>
                <Button type="button" label="Save" @click="visible = false"></Button>
            </div>
        </Dialog>
    </div>

    <div>
        <Button class="text-black" @click="cancel()" type="button" label="Cancel" severity="secondary"></Button>
        <Button @click="cancel('Start')" type="button" label="Start" severity="secondary"></Button>
        <Button @click="cancel('End')" type="button" label="End" severity="secondary"></Button>
    </div>

    <br>

    <FontAwesomeIcon :icon="fas.faHouse" />
  <!-- <FontAwesomeIcon :icon="far.faMouse" />
  <FontAwesomeIcon :icon="fal.faCheese" />   
   -->
  <br>
</template>



<script setup>
    import { ref } from "vue";

    import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
    import { fas } from '@fortawesome/free-solid-svg-icons'


    // PrimeVue
    import 'primeicons/primeicons.css'
    import Dropdown from 'primevue/dropdown';
    import Card from 'primevue/card';
    import Dialog from 'primevue/dialog';

    import Button from 'primevue/button';


    import Calendar from 'primevue/calendar';

    import Menubar from 'primevue/menubar';
    import InputText from 'primevue/inputtext';
    import Avatar from 'primevue/avatar';
    import MegaMenu from 'primevue/megamenu';
    import Sidebar from 'primevue/sidebar';


    const selectedCity = ref();
    const cities = ref([
        { name: 'New York', code: 'NY' },
        { name: 'Rome', code: 'RM' },
        { name: 'London', code: 'LDN' },
        { name: 'Istanbul', code: 'IST' },
        { name: 'Paris', code: 'PRS' }
    ]);

    const visible = ref(false);
    const showSideBar = ref(false);

    const cancel = (message = null) => {
        console.log(message ? message : 'no value');
    }

    const save = () => {
        console.log(showSideBar.value);
        showSideBar.value = true;
    }

</script>