<template>
    <Head title="Delivery Schedule" />

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
                    <Column v-for="col of headers" class="dark:text-zinc-50"
                    :key="col.field" :field="col.field" :header="col.header" :sortable="col.sortable" :style="{ width: col.width }">
                        <template v-if="col.field === 'frequency_type'" #body="slotProps">
                            {{ slotProps.data.frequency_type }}
                        </template>

                        <template v-if="col.field === 'order_quantity'" #body="slotProps">
                            <div>
                                Slim: {{ slotProps.data.slim_qty }}
                            </div>
                            <div>
                                Round: {{ slotProps.data.round_qty }}
                            </div>
                            <div>
                                Total: {{ slotProps.data.total_qty }}
                            </div>
                        </template>
                        
                        <template v-if="col.field === 'frequency_type'" #body="slotProps">
                            {{ slotProps.data.frequency_type }}
                        </template>
                    </Column>
                </DataTable>
            </template>
        </Card>
    </Layout>
</template>

<script setup lang="ts">
import { ref, defineProps, onMounted } from 'vue';
import Layout from '@/Layouts/Layout.vue';
import { useForm, Head } from "@inertiajs/vue3";
import axios from 'axios';


const props = defineProps<{
    title: string
}>();

const headers = [
    { field: 'name', header: 'Name', width: '20%' },
    { field: 'full_address', header: 'Address', width: '20%' },
    { field: 'frequency_type', header: 'Schedule' },
    { field: 'order_quantity', header: 'Order Quantity', width: '10%' },
    { field: 'created_at', header: 'Date Added', sortable: true },
    { field: 'notes', header: 'Remarks' },
]

const loading = ref(false);
const deliverySchedules = ref<Object[]>([]);

const fetchData = () => {
    loading.value = true;

    axios.get(route('delivery-schedules.get'))
        .then(response => {
            deliverySchedules.value = response.data;
            loading.value = false;
        })
        .catch(error => {
            console.log(error)
        })
}

onMounted(() => {
    console.log('Component Mounted');
    fetchData();
})

</script>