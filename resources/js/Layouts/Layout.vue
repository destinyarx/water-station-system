<template>
    <div class="min-h-screen min-w-screen dark:bg-slate-400">
        <Header />

        <div class="w-full flex flex-row">
            <div class="fixed top-0 left-0 z-50 h-full w-[5.1rem] group text-white bg-gray-800 transition-all duration-300 ease-in-out hover:w-[15.2rem]">
                <div class="w-full flex items-center mb-10">
                    <Image src="/image/mountain-logo.png" alt="logo" class="min-w-24 max-w-24" />

                    <span class="whitespace-nowrap inline-block overflow-hidden hidden group-hover:inline-block text-2xl text-cyan-500 -ml-2">
                      Hydro
                    </span>
                </div>

                <ul class="mt-8">
                    <li v-for="item in sidebarItems" class="my-6">
                      <template v-if="item.route === 'none'">
                        <div class="overflow-hidden opacity-0 group-hover:opacity-100 font-medium text-xl dark:text-white light:text-black ml-5 mt-8 -mb-4">
                          {{ item.label }}
                        </div>
                      </template>

                        <Link v-else-if="item.route !== 'none'" :href="item.route">
                          <div class="w-full flex items-center">
                            <!-- <i :class="item.icon" class="self-center ml-7 mr-2" style="font-size: 1.5rem"></i> -->
                            <svg-icon type="mdi" :path="item.icon" class="self-center w-9 h-9 ml-7 mr-2"></svg-icon>
                            <span class="whitespace-nowrap inline-block overflow-hidden hidden group-hover:inline-block ml-2">
                              {{ item.label }}
                            </span>
                          </div>
                        </Link>

                        <br v-if="['Sales History', 'Delivery History'].includes(item.label)">
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

import { 
  mdiMonitorDashboard, 
  mdiAccountGroupOutline,
  mdiCashMultiple,
  mdiShoppingOutline,
  mdiCashFast,
  mdiCashClock,
  mdiTruckDeliveryOutline,
  mdiTruckFastOutline,
  mdiTruckAlertOutline,
  mdiInvoiceTextFastOutline,
  mdiClipboardTextClockOutline,
} from '@mdi/js';

const sidebarItems = ref([
    { 
      label: 'Dashboard',
      icon: mdiMonitorDashboard,
      route: '/dashboard'
    },
    { 
      label: 'Customer',
      icon: mdiAccountGroupOutline,
      route: '/customers'
    },
    { 
      label: 'Expenses',
      icon: mdiCashMultiple,
      route: '/expenses'
    },
    { 
      label: 'Products',
      icon: mdiShoppingOutline,
      route: '/products'
    },
    {
      label: 'Sales',
      route: 'none',
    },
    { 
      label: 'Summary',
      icon: mdiCashFast,
      route: '/sales'
    },
    { 
      label: 'History',
      icon: mdiCashClock,
      route: '/sales/history'
    },
    {
      label: 'Delivery',
      route: 'none',
    },
    { 
      label: 'Daily Delivery',
      icon: mdiTruckDeliveryOutline,
      route: '/delivery',
      group: 'delivery'
    },
    { 
      label: 'Schedule',
      icon: mdiTruckAlertOutline,
      route: '/delivery-schedules',
      group: 'delivery'
    },
    { 
      label: 'History',
      icon: mdiTruckFastOutline,
      route: '/delivery-history',
      group: 'delivery'
    },
    {
      label: 'Expenses',
      route: 'none',
    },
    { 
      label: 'Summary',
      icon: mdiInvoiceTextFastOutline,
      route: '/expenses',
      group: 'expenses'
    },
    { 
      label: 'History',
      icon: mdiClipboardTextClockOutline,
      route: '/expenses/history',
      group: 'expenses'
    },
  ]);
</script>

<style scoped>

</style>