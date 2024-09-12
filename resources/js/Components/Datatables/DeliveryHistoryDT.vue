<template>
    <DataTable :value="deliveryHistory.data" :loading="loading" :from="deliveryHistory.from" :rows="deliveryHistory.per_page" :totalRecords="deliveryHistory.total"
    stripedRows tableStyle="min-width: 50rem" size="small" class="w-full text-sm">
        <Column v-for="col of headers" class="dark:text-zinc-50"
        :key="col.field" :field="col.field" :header="col.header" :sortable="col.sortable" :style="{ width: col.width }">
            <template v-if="col.field === 'status'" #body="slotProps">
                <Badge v-if="slotProps.data.status === 'success'" value="Delivered Successfully" severity="success"></Badge>
                <Badge v-else-if="slotProps.data.status === 'failed'" value="Failed Delivery" severity="danger"></Badge>
                <Badge v-else value="Daily Delivery Ended" severity="secondary"></Badge>
            </template>

            <template v-if="col.field === 'created_at'" #body="slotProps">
                {{ moment(slotProps.data.created_at).format('MMM D, YYYY hh:mm:a') }}
            </template>
        </Column>

        <template v-slot:footer>
            <div class="flex flex-row justify-center gap-4 font-normal">
                <i @click="fetchData(deliveryHistory.first_page_url)" :disabled="!deliveryHistory.first_page_url" class="pi pi-angle-double-left" style="font-size: 1rem"></i>
                <i @click="fetchData(deliveryHistory.prev_page_url)" :disabled="!deliveryHistory.prev_page_url" class="pi pi-angle-left" style="font-size: 1rem"></i>
                <span>Page &nbsp; {{ deliveryHistory.current_page }} &nbsp; of &nbsp; {{ deliveryHistory.last_page }}</span>
                <i @click="fetchData(deliveryHistory.next_page_url)" :disabled="!deliveryHistory.next_page_url" class="pi pi-angle-right" style="font-size: 1rem"></i>
                <i @click="fetchData(deliveryHistory.last_page_url)" :disabled="!deliveryHistory.last_page_url" class="pi pi-angle-double-right" style="font-size: 1rem"></i>
            </div>
        </template>
    </DataTable>
</template>

<script setup lang="ts">
import { ref, onMounted, defineProps, watch } from 'vue';
import axios from 'axios';
import moment from 'moment';

import { useToast } from 'primevue/usetoast';
const toast = useToast();

const props = defineProps({
    filter: { type: Object }
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
const rows = ref(10);

const fetchData = async (url: string|null = null) => {
    let response = null;
    loading.value = true;

    if (!url) {
        response = await axios.get(route('delivery-history.fetch'), {
            params: { rowsNumber: rows.value }
        }); 
    }
    else {
        response = await axios.get(url);
    } 

    deliveryHistory.value = response.data;
    loading.value = false;
}

watch(() => props.filter, () => {
    fetchData();
})

onMounted(() => {
    fetchData();
})

</script>