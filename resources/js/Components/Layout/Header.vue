<template>
    <Menubar :model="items" class="p-shadow-4">
      <template #item="{item}">
        <Link :href="item.route">
          <div class="mx-4">
            <i :class="item.icon"></i>
            {{ item.label }}
          </div>
        </Link>
      </template>

      <template #end>
        <h2 class="p-mr-2">Navigation Header</h2>
      </template>

    </Menubar>
  </template>
  
  <script setup>
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
  h2 {
    margin: 0;
    font-size: 1.5rem;
    color: #ffffff;
  }
  
  .p-menubar {
    background-color: #007bff;
    color: #ffffff;
  }
  
  .p-menubar-root-list > li > a {
    color: #ffffff;
  }
  </style>
  