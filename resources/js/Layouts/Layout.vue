<template>
    <div class="min-h-screen min-w-screen dark:bg-slate-400">
        
        <Header />

        <div class="w-full flex flex-row">
            <div class="fixed top-0 left-0 z-50 h-full w-[5.1rem] text-white bg-gray-800 transition-all duration-300 ease-in-out hover:w-[15.2rem]">
                <div class="text-cyan-200 mt-5 mb-10">
                    Logo Here
                </div>
                <ul>
                    <li v-for="item in sidebarItems" class="my-4">
                        <Link :href="item.route">
                            <i :class="item.icon" class="mr-1 self-center"></i>
                            {{ item.label }}
                        </Link>
                    </li>
                </ul>
            </div>
            <div class="min-h-screen grow ml-20">
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import Header from '@/Layouts/Header.vue';

const sidebarItems = ref([
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
      label: 'Products',
      icon: 'pi-shopping-cart',
      route: '/products'
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