<template>
    <Head title="Pending Deliveries" />

    <Layout>
        <Card>
            <template #title>
                <div class="flex justify-between">
                    <div>Pending Deliveries</div>
                    <div class="text-lg">
                        <Dropdown v-model="filter" :options="filterOptions" optionLabel="name" placeholder="Filter by Date" class="md:w-14rem" />
                    </div>
                </div>
            </template>
            <template #content>
                <DeliveryDT :filter="filter" />
            </template>
        </Card>
    </Layout>
    
</template>

<script setup lang="ts">
import { ref } from 'vue';
import { Head } from "@inertiajs/vue3";
import axios from 'axios';
import moment from 'moment';

import Layout from '@/Layouts/Layout.vue';
import DeliveryDT from '@/Components/Datatables/DeliveryDT.vue'

import { useToast } from 'primevue/usetoast';
const toast = useToast();

const filter = ref();

const filterOptions = [
    { name: 'Today', code: 'today' },
    { name: 'Tomorrow', code: 'tomorrow' },
    { name: 'Overdue', code: 'overdue' },
    { name: 'Upcoming', code: 'upcoming' },
    { name: 'Day after tomorrow', code: 'day_after_tomorrow' },
    { name: 'This week', code: 'this_week' },
];

</script>