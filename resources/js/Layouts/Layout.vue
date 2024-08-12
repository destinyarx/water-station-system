<template>
    <div class="min-h-screen min-w-screen dark:bg-slate-400">
        
        <Header />

        <div class="w-full flex flex-row">
            <div class="fixed top-0 left-0 z-50 h-full w-[5.1rem] group text-white bg-gray-800 transition-all duration-300 ease-in-out hover:w-[15.2rem]">
                <div class="text-cyan-200 mt-5 mb-10">
                    <i class="pi pi-amazon ml-6" style="font-size: 2.5rem"></i>
                    <span class="text-xl text-zinc-50 opacity-0 group-hover:opacity-100 ml-2">Amazon</span>
                </div>
                <ul>
                    <li v-for="item in sidebarItems" class="my-10">
                        <Link :href="item.route">
                            <i :class="item.icon" class="mr-1 ml-6 self-center" style="font-size: 1.5rem"></i>
                            <span class="ml-2 hidden group-hover:inline-block">
                                {{ item.label }}
                            </span>
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
      route: '/dashboard'
    },
    { 
      label: 'Customer',
      icon: 'pi pi-user',
      route: '/customers'
    },
    { 
      label: 'Sales',
      icon: 'pi pi-wallet',
      route: '/sales'
    },
    { 
      label: 'Products',
      icon: 'pi pi-shopping-bag',
      route: '/products'
    },
    { 
      label: 'Delivery Schedule',
      icon: 'pi pi-calendar-times',
      route: '/delivery-schedules' 
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