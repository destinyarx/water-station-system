<template>
    <Head title="Sales" />

    <Layout>
        <div class="min-h-screen min-w-full dark:bg-slate-800 ">

        </div>
    </Layout>
</template>

<script setup>
import { defineProps } from 'vue';
import { Head } from "@inertiajs/vue3";
import Layout from '../Layouts/Layout.vue'



const props = defineProps({
    page: {
        type: String,
        required: false
    },
})


</script>