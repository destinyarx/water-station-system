<template>
    <DataTable :value="sales" :loading="loading"
    stripedRows tableStyle="min-width: 50rem" size="small" class="w-full text-sm"
    paginator :rows="10" :rowsPerPageOptions="[5, 10, 20, 50]">
        <Column v-for="col of headers" :key="col.field" :field="col.field" :header="col.header" :sortable="col.sortable" 
        class="dark:text-zinc-50" :style="{ width: col.width }">
            <template v-if="col.field === 'created_at'" #body="slotProps">
                {{ moment(slotProps.data.created_at).format('MMMM D, YYYY hh:mm:a') }}
            </template>

            <template v-if="col.field === 'total'" #body="slotProps">
                ₱ {{ slotProps.data.total }} .00
            </template>
        </Column>
    </DataTable>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue';
import axios from 'axios';
import moment from 'moment';

// datatable data
const sales = ref([]);
const loading = ref(false);
const headers = [
    { field: 'name', header: 'Customer Name', width: '30%' },
    { field: 'created_at', header: 'Transaction Date', sortable: true },
    { field: 'qty', header: 'Container Quantity', sortable: true },
    { field: 'total', header: 'Price', sortable: true },
]

const fetchData = async () => {
    loading.value = true;
    const response = await axios.get(route('sales.data'));
    sales.value = response.data; 
    loading.value = false;
}

onMounted(() => {
    fetchData();
})

</script>