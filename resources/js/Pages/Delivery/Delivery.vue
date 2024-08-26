<template>
    <Head title="Pending Deliveries" />

    <Layout>
        <Card>
            <template #title>
                Pending Deliveries
            </template>
            <template #content>
                <DeliveryDT :filter="filter" />
            </template>
        </Card>
    </Layout>
    
</template>

<script setup lang="ts">
import { ref, defineProps, onMounted } from 'vue';
import { Head } from "@inertiajs/vue3";
import axios from 'axios';
import moment from 'moment';

import Layout from '@/Layouts/Layout.vue';
import DeliveryDT from '@/Components/Datatables/DeliveryDT.vue'

import { useToast } from 'primevue/usetoast';
const toast = useToast();

const filter = ref('');

const filterOptions = [
    { name: 'Today', value: 'today'},
    { name: 'Tomorrow', value: 'tomorrow'},
    { name: 'Two days from today', value: '2D'},
    { name: 'Three days from today', value: '3D'},
    { name: 'This week', value: 'week'},
]

</script>