<template>
    <Layout>
        <Card class="h-screen">
            <template #title>
                <div>Delivery Schedules</div>
            </template>

            <template #content>
                <div class="flex justify-end">
                    <Button type="button" label="Add" icon="pi pi-plus" />
                </div>
                <DataTable :value="deliverySchedules" :loading="loading"
                stripedRows tableStyle="min-width: 50rem" class="w-full"
                paginator :rows="10" :rowsPerPageOptions="[5, 10, 20, 50]">

                    

                </DataTable>
            </template>
        </Card>
    </Layout>
</template>

<script setup lang="ts">
import { ref, defineProps, onMounted } from 'vue';
import Layout from '@/Layouts/Layout.vue';
import { useForm } from "@inertiajs/vue3";

const props = defineProps<{
    title: string
}>();

const headers = [
    { field: 'name', header: 'Name' },
    { field: 'frequency_type', header: 'Schedule' },
    { field: 'order_quantity', header: 'Order Quantity' },
    { field: 'created_at', header: 'Date Added' },
    { field: 'notes', header: 'Remarks' },
]

const loading = ref(false);
const deliverySchedules = ref<Object[]>([]);

const fetchData = () => {
    console.log("Fetching Data");

    deliverySchedules.value = [];
}

onMounted(() => {
    console.log('Component Mounted');
    fetchData();
})

</script>