<template>
    <Head title="Delivery History" />

    <Layout>
        <Card>
            <template #title>
                <div class="flex justify-between">
                    <div>Delivery History</div>
                    <div class="text-lg">
                        <Dropdown v-model="filter" :options="filterOptions" showClear optionLabel="name" placeholder="Filter by Status" class="md:w-14rem" />
                    </div>
                </div>
            </template>
            <template #content>
                <DeliveryHistoryDT :filter="filter" />
            </template>
        </Card>
    </Layout>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { Head } from "@inertiajs/vue3";
import axios from 'axios';
import moment from 'moment';

import Layout from '@/Layouts/Layout.vue';
import DeliveryHistoryDT from '@/Components/Datatables/DeliveryHistoryDT.vue';

import { useToast } from 'primevue/usetoast';
const toast = useToast();

const filter = ref();

const filterOptions = [
    { 'name': 'Failed', code: 'failed'},
    { 'name': 'Success', code: 'success'},
    { 'name': 'Stop', code: 'stop'},
];

</script>