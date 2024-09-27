<template>
    <DataTable ref="salesTableRef" :value="sales.data" :loading="loading" :from="sales.from" :rows="sales.per_page" :totalRecords="sales.total" 
    stripedRows tableStyle="min-width: 50rem" size="small" class="w-full text-sm">
        <Column v-for="col of headers" :key="col.field" :field="col.field" :header="col.header" :sortable="col.sortable" 
        class="dark:text-zinc-50" :style="{ width: col.width }">
            <template v-if="col.field === 'created_at'" #body="slotProps">
                {{ moment(slotProps.data.created_at).format('MMM D, YYYY hh:mm:a') }}
            </template>

            <template v-if="col.field === 'total'" #body="slotProps">
                ₱ {{ slotProps.data.total }} .00
            </template>
        </Column>

        <template v-slot:footer>
            <div class="flex flex-row justify-center gap-4 font-normal">
                <i @click="fetchData(sales.first_page_url)" :disabled="!sales.first_page_url" class="pi pi-angle-double-left" style="font-size: 1rem"></i>
                <i @click="fetchData(sales.prev_page_url)" :disabled="!sales.prev_page_url" class="pi pi-angle-left" style="font-size: 1rem"></i>
                <span>Page &nbsp; {{ sales.current_page }} &nbsp; of &nbsp; {{ sales.last_page }}</span>
                <i @click="fetchData(sales.next_page_url)" :disabled="!sales.next_page_url" class="pi pi-angle-right" style="font-size: 1rem"></i>
                <i @click="fetchData(sales.last_page_url)" :disabled="!sales.last_page_url" class="pi pi-angle-double-right" style="font-size: 1rem"></i>
            </div>
        </template>
    </DataTable>
    
    <!-- <Paginator :rows="sales.per_page" :totalRecords="sales.total" template="FirstPageLink PrevPageLink CurrentPageReport NextPageLink LastPageLink"
            currentPageReportTemplate="Showing {first} to {last} of {totalRecords}" /> -->
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue';
import axios from 'axios';
import moment from 'moment';

// datatable data
const salesTableRef = ref();
const sales = ref([]);
const loading = ref(false);
const headers = [
    { field: 'name', header: 'Customer Name', width: '30%' },
    { field: 'created_at', header: 'Transaction Date', sortable: true },
    { field: 'qty', header: 'Quantity', sortable: true },
    { field: 'total', header: 'Price', sortable: true },
]

const rows = ref(10);

const fetchData = async (url: string|null = null) => {
    let response = null;
    loading.value = true;

    if (!url) {
        response = await axios.get(route('sales.data'), {
            params: { 
                rowsNumber: rows.value,
            }
        }); 
    }
    else {
        response = await axios.get(url);
    } 

    sales.value = response.data; 
    loading.value = false;
}

onMounted(() => {
    fetchData();
})

</script>