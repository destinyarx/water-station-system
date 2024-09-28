<template>
    <Head title="Expenses History" />

    <Layout>
        <Card class="min-h-screen">
            <template #title>
                <div>Expenses History</div>
            </template>
            <template #content>
                <div class="flex justify-end">
                    <Button @click="showForm()" type="button" label="Add" icon="pi pi-plus" />
                </div>
            </template>
        </Card>
    </Layout>

    <Dialog v-model:visible="visible" modal header="Add Expenses" :style="{ width: '60rem'}">
        <Card>
            <template #content>
                Add Content Here...
            </template>
        </Card>
    </Dialog>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import { Head } from "@inertiajs/vue3";

import Layout from '@/Layouts/Layout.vue';

import { useToast } from 'primevue/usetoast';
const toast = useToast();


// Form Modal
const visible = ref(false);
const showForm = () => {
    visible.value = true;
}


</script>