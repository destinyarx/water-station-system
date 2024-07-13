<template>
    <Card>
        <template #title>Customers</template>
        <template #subtitle>
            <div class="flex justify-between">
                <span>Active customer list</span>
                <Button type="button" label="Add" icon="pi pi-plus" @click="addCustomer" />
            </div>
        </template>
        <template #content>
            <div class="card">
                <DataTable :value="customers" class="w-auto"
                    stripedRows size="normal" tableStyle="min-width: 50rem"
                    paginator :rows="10" :rowsPerPageOptions="[5, 10, 20, 50]">
                    <Column v-for="col of customerHeaders" class="dark:text-zinc-50"
                        :key="col.field" :field="col.field" :header="col.header" :sortable="col.sortable">
                    </Column>
                </DataTable>
            </div>
        </template>
    </Card>

</template>

<script setup>
import { defineProps } from 'vue'

import Button from 'primevue/button';
import Card from 'primevue/card';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import ColumnGroup from 'primevue/columngroup';  
import Row from 'primevue/row';                   


const props = defineProps({
    customers: {
        type: Array,
        required: true
    },
})

// customer table data
const customerHeaders = [
    { field: 'name', header: 'Name', sortable: true }, 
    { field: 'address.municipality', header: 'Municipality', sortable: true }, 
    { field: 'cellphone_number', header: 'Contact Number' }, 
    { field: 'email', header: 'Email' }, 
    { field: 'status', header: 'Status', sortable: true }, 
]


const addCustomer = () => {
    console.log('customer created')
}

</script>

<style lang="scss" scoped>

</style>