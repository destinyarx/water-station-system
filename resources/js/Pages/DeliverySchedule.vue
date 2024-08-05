<template>
    <Layout>
        <div>
            {{ title }}
        </div>
    </Layout>
</template>

<script setup lang="ts">
import { defineProps, onMounted } from 'vue';
import Layout from '@/Layouts/Layout.vue';
import { useForm } from "@inertiajs/vue3";

const props = defineProps<{
    title: string
}>();

</script>