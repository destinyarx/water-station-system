<template>
    <DataTable ref="expensesTableRef" :value="expenses.data" :loading="loading" :from="expenses.from" :rows="expenses.per_page" :totalRecords="expenses.total" 
    stripedRows tableStyle="min-width: 50rem" size="small" class="w-full text-sm">
        <Column v-for="col of headers" :key="col.field" :field="col.field" :header="col.header" :sortable="col.sortable" 
        class="dark:text-zinc-50" :style="{ width: col.width }">
            <template v-if="col.field === 'expense_date'" #body="slotProps">
                {{ moment(slotProps.data.expense_date).format('MMMM D, YYYY') }}
            </template>

            <template v-if="col.field === 'category'" #body="slotProps">
                {{ categoryValue[slotProps.data.category] }}
            </template>

            <template v-if="col.field === 'price'" #body="slotProps">
                ₱ {{ slotProps.data.price }} .00
            </template>
        </Column>

        <template v-slot:footer>
            <div class="flex flex-row justify-center gap-4 font-normal">
                <i v-if="expenses.first_page_url" @click="fetchData(expenses.first_page_url)" class="pi pi-angle-double-left" style="font-size: 1rem"></i>
                <i v-if="expenses.prev_page_url" @click="fetchData(expenses.prev_page_url)" class="pi pi-angle-left" style="font-size: 1rem"></i>
                <span>Page &nbsp; {{ expenses.current_page }} &nbsp; of &nbsp; {{ expenses.last_page }}</span>
                <i v-if="expenses.next_page_url" @click="fetchData(expenses.next_page_url)" class="pi pi-angle-right" style="font-size: 1rem"></i>
                <i v-if="expenses.last_page_url" @click="fetchData(expenses.last_page_url)" class="pi pi-angle-double-right" style="font-size: 1rem"></i>
            </div>
        </template>
    </DataTable>
</template>

<script setup lang="ts">
import { ref, onMounted, defineProps } from 'vue';
import axios from 'axios';
import moment from 'moment';

const props = defineProps({
    filter: { type: Object },
    categoryValue: { type: Object }
})

const headers = [
    { field: 'expense_date', header: 'Expense Date', sortable: true },
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