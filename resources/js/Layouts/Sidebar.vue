<template>
    <div class="min-h-screen min-w-40 bg-gray-800 text-zinc-50">
        <i class="pi pi-home"></i>
    </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';


const items = ref([
    { 
        label: 'Dashboard',
        icon: 'pi pi-home',
        route: '/'
    },
    { 
        label: 'Customer',
        icon: 'pi pi-user',
        route: '/customer'
    },
    { 
        label: 'Sales',
        icon: 'pi pi-wallet',
        route: '/sales'
    },
    { 
        label: 'Delivery Schedule',
        icon: 'pi pi-calendar-times',
        route: '/delivery/schedule' 
    },
    { 
        label: 'Expenses',
        icon: 'pi pi-money-bill',
        route: '/expenses'
    },
]);

</script>

<style scoped>

</style>