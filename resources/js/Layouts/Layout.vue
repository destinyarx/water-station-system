<template>
    <div class="min-h-screen min-w-screen dark:bg-slate-400">
        <Header />

        <div class="w-full flex flex-row">
            <div class="fixed top-0 left-0 z-50 h-full w-[5.1rem] group text-white bg-gray-800 transition-all duration-300 ease-in-out hover:w-[15.2rem]">
                <div class="w-full flex items-center mt-5 mb-10">
                    <i class="pi pi-amazon text-cyan-300 ml-6" style="font-size: 2.5rem"></i>
                    <span class="whitespace-nowrap inline-block overflow-hidden hidden group-hover:inline-block text-xl text-zinc-50 ml-2">Amazon</span>
                </div>
                <ul>
                    <li v-for="item in sidebarItems" class="my-8">
                      <template v-if="item.route === 'none'">
                        <div class="overflow-hidden opacity-0 group-hover:opacity-100 font-medium text-xl dark:text-white light:text-black ml-5 -mb-6">
                          {{ item.label }}
                        </div>
                      </template>

                        <Link v-else-if="item.route !== 'none'" :href="item.route">
                          <div class="w-full flex items-center">
                            <i :class="item.icon" class="self-center ml-6 mr-2" style="font-size: 1.5rem"></i>
                            <span class="whitespace-nowrap inline-block overflow-hidden hidden group-hover:inline-block ml-2">
                              {{ item.label }}
                            </span>
                          </div>
                        </Link>

                        <br v-if="item.label === 'Delivery History'">
                    </li>
                </ul>
            </div>
            <div class="min-h-screen grow ml-20 dark:bg-slate-900">
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
      label: 'Expenses',
      icon: 'pi pi-money-bill',
      route: '/expenses'
    },
    { 
      label: 'Products',
      icon: 'pi pi-shopping-bag',
      route: '/products'
    },
    {
      label: 'Delivery',
      route: 'none',
    },
    { 
      label: 'Daily Delivery',
      icon: 'pi pi-calendar-times',
      route: '/delivery',
      group: 'delivery'
    },
    { 
      label: 'Delivery Schedule',
      icon: 'pi pi-calendar-times',
      route: '/delivery-schedules',
      group: 'delivery'
    },
    { 
      label: 'Delivery History',
      icon: 'pi pi-calendar-times',
      route: '/delivery-history',
      group: 'delivery'
    },
  ]);
</script>

<style scoped>

</style>