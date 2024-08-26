<template>
    <DataTable :value="deliveries" :loading="loading"
    stripedRows tableStyle="min-width: 50rem" size="small" class="w-full text-sm"
    paginator :rows="10" :rowsPerPageOptions="[5, 10, 20, 50]">
        <Column v-for="col of headers" class="dark:text-zinc-50"
        :key="col.field" :field="col.field" :header="col.header" :sortable="col.sortable" :style="{ width: col.width }">
            <template v-if="col.field === 'target_date'" #body="slotProps">
                {{ moment(slotProps.data.target_date).format('MMMM D, YYYY') }}
            </template>


            <template v-if="col.header === 'Action'" #body="slotProps">
                <SplitButton label="Actions" :model="actions(slotProps.data)" severity="info" rounded class="p-0"/>
            </template>
        </Column>
    </DataTable>
</template>

<script setup lang="ts">
import { ref, onMounted, defineProps } from 'vue';
import axios from 'axios';
import moment from 'moment';

import { useToast } from 'primevue/usetoast';
const toast = useToast();

const props = defineProps({
    filter: { type: String }
})

// table data
const headers = [
    { field: 'name', header: 'Name', width: '17%' },
    { field: 'full_address', header: 'Address', width: '20%' },
    { field: 'target_date', header: 'Delivery Date', width: '20%', sortable: true },
    { field: 'total_qty', header: 'Quantity', sortable: true },
    { field: 'price', header: 'Total Price', sortable: true },
    { field: 'status', header: 'Status' },
    { field: '', header: 'Action', width: '7%' },
]

// datatable data
const loading = ref(false);
const deliveries = ref([]);

// table method
const fetchData = () => {
    loading.value = true;

    axios.get(route('delivery.fetch'))
        .then(response => {
            deliveries.value = response.data;
            loading.value = false;
        })
        .catch(error => {
            loading.value = false;
            console.log('Error when fetching datatable data.');
            console.log(error);
        })
}

const actions = (data: any) => {
    let actions = [
        {
            label: 'Mark as Delivered',
            command: () => {
                console.log('Success Delivery');
            },
        },
        {
            label: 'Mark as Failed',
            command: () => {
                console.log('Failed Delivery');
            }
        },
    ]

    return actions;
}

onMounted(() => {
    fetchData();
})

</script>
