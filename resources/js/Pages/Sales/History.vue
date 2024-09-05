<template>
    <Head title="Sales" />

    <Layout>
        <Card class="min-h-screen">
            <template #title>
                <div>Sales History</div>
            </template>
            <template #content>
                <SalesDT />
            </template>
        </Card>
    </Layout>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";

import Layout from '@/Layouts/Layout.vue'
import SalesDT from '@/Components/Datatables/SalesDT.vue'

</script>