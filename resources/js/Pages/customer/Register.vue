<template>
    <div class="card">
        <Steps :model="items" class="custom-steps" :readonly="false">
            <template #item="{ item, active }">
                <span :class="['inline-flex align-items-center justify-content-center align-items-center border-circle border-primary border-1 h-3rem w-3rem z-1 cursor-pointer', { 'bg-primary': active, 'surface-overlay text-primary': !active }]">
                    <i :class="[item.icon, 'text-xl']" />
                </span>
            </template>
        </Steps>
    </div>
</template>

<script setup>
import { ref } from "vue";
import Steps from 'primevue/steps';
import Button from 'primevue/button';


const active = ref(0);

const items = ref([
    {
        icon: 'pi pi-user'
    },
    {
        icon: 'pi pi-calendar'
    },
    {
        icon: 'pi pi-check'
    }
]);
</script>
