<template>
    <Head title="Expenses Summary" />

    <Layout>
        <Card class="min-h-screen">
            <template #title>
                <div>Expenses Summary</div>
            </template>
            <template #content>
                Add Content Here..
            </template>
        </Card>
    </Layout>
</template>

<script setup lang="ts">
import { Head } from "@inertiajs/vue3";

import Layout from '@/Layouts/Layout.vue';

import { useToast } from 'primevue/usetoast';
const toast = useToast();
</script>