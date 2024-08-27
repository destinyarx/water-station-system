<template>
    <DataTable :value="deliveryHistory" :loading="loading"
    stripedRows tableStyle="min-width: 50rem" size="small" class="w-full text-sm"
    paginator :rows="10" :rowsPerPageOptions="[5, 10, 20, 50]">
        <Column v-for="col of headers" class="dark:text-zinc-50"
        :key="col.field" :field="col.field" :header="col.header" :sortable="col.sortable" :style="{ width: col.width }">
            <template v-if="col.field === 'status'" #body="slotProps">
                <Badge v-if="slotProps.data.status === 'success'" value="Delivered Successfully" severity="success"></Badge>
                <Badge v-else-if="slotProps.data.status === 'failed'" value="Failed Delivery" severity="danger"></Badge>
                <Badge v-else value="Daily Delivery Ended" severity="secondary"></Badge>
            </template>

            <template v-if="col.field === 'created_at'" #body="slotProps">
                {{ moment(slotProps.data.created_at).format('MMMM D, YYYY hh:mm:a') }}
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
    { field: 'name', header: 'Name', width: '20%' },
    { field: 'full_address', header: 'Address', width: '35%' },
    { field: 'status', header: 'Status', width: '12%' },
    { field: 'notes', header: 'Remarks', width: '13%', sortable: true },
    { field: 'created_at', header: 'Date',width: '10%', sortable: true }
]

// datatable data
const loading = ref(false);
const deliveryHistory = ref([]);

const fetchData = () => {
    loading.value = true;

    axios.get(route('delivery-history.fetch'))
        .then(response => {
            deliveryHistory.value = response.data;
            loading.value = false;
        })
        .catch(error => {
            loading.value = false;
            console.log('Error when fetching datatable data.');
            console.log(error);
        })
}

onMounted(() => {
    fetchData();
})

</script>