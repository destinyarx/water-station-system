<template>
    <Menubar :model="items" class="p-shadow-4">
      <template #start>
        <h2 class="p-mr-2">Navigation Header</h2>
      </template>
    </Menubar>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  
  const items = ref([
    { label: 'Dashboard' },
    { label: 'Sales' },
    { label: 'Delivery Schedule' },
    { label: 'Billings' },
    { label: 'User Management' },
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
  