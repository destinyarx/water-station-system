<template>
    <!-- <DataTable ref="expensesTableRef" :value="sales.data" :loading="loading" :from="sales.from" :rows="sales.per_page" :totalRecords="sales.total" 
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
    </DataTable> -->
</template>

<script setup lang="ts">
import { ref, onMounted, defineProps } from 'vue';
import axios from 'axios';
import moment from 'moment';

const props = defineProps({
    filter: { type: String }
})

const header = [
    { field: 'expense_date', header: 'Date', sortable: true },
    { field: 'category', header: 'Category', width: '25%' },
    { field: 'price', header: 'Price', sortable: true },
    { field: 'description', header: 'Description', width: '35%' },
]

const expenses = ref([]);
const loading = ref(false);



const fetchData = async (url: string|null = null) => {
    let response = null;
    loading.value = true;

    if (!url) {
        response = await axios.get(route('expenses.fetch'), {
            params: { 
                filter: props.filter,
            }
        }); 
    }
    else {
        response = await axios.get(url);
    } 

    expenses.value = response.data; 
    loading.value = false;
}

onMounted(() => {
    fetchData();
})
</script>