<template>
    <Head title="Sales" />

    <Layout>
        <Card class="min-h-screen">
            <template #title>
                <div class="flex justify-between">
                    <div>Sales History</div>
                    <Button @click="showSalesModal('insert')" class="text-lg ml-2" label="Add Sales" icon="pi pi-plus" />
                </div>

            </template>
            <template #content>
                <SalesDT />
            </template>
        </Card>
    </Layout>

    <Dialog v-model:visible="visible" modal header="Add Sales" :style="{ width: '60rem'}">
        <SalesForm :form="[]" :action="'action'" @closeModal="visible = false">
            <div class="flex justify-end gap-2">
                <Button type="submit" label="Save" icon="pi pi-check" iconPos="right"/>
            </div>
        </SalesForm>
    </Dialog>
</template>

<script setup>
import { ref } from 'vue';
import { Head } from "@inertiajs/vue3";

import Layout from '@/Layouts/Layout.vue';
import SalesDT from '@/Components/Datatables/SalesDT.vue';
import SalesForm from '@/Components/Forms/SalesForm.vue'

const visible = ref(false);

// form methods
const showSalesModal = () => {
    visible.value = true;
}

</script>