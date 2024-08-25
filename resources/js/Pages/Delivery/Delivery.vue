<template>
    <Head title="Today's Delivery" />

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
import { ref, onMounted } from 'vue';
import { Head } from "@inertiajs/vue3";
import axios from 'axios';
import moment from 'moment';

import Layout from '@/Layouts/Layout.vue';
import DeliveryDT from '@/Components/Datatables/DeliveryDT.vue'

import { useToast } from 'primevue/usetoast';
const toast = useToast();
</script>