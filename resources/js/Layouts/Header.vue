<template>
    <Menubar class="p-shadow-4">
      <template #end>
        <h2 class="p-mr-2 dark:text-white text-black">Navigation Header</h2>
        <div class="w-1/4"></div>
      </template>
    </Menubar>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  </script>
  
  <style scoped>
  h2 {
    margin: 0;
    font-size: 1.5rem;
  }
  
  .p-menubar {
    background-color: #007bff;
    color: #ffffff;
  }
  
  .p-menubar-root-list > li > a {
    color: #ffffff;
  }
  </style>
  