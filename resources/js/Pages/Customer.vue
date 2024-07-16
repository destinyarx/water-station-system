<template>

    <!-- start -->
    <!-- <div class="sidebar min-h-screen w-[3.35rem] overflow-hidden border-r hover:w-56 hover:bg-white hover:shadow-lg">
        <div class="flex h-screen flex-col justify-between pt-2 pb-6">
            <div>Sidebar</div>
        </div>
    </div> -->
    <!-- end -->

    <Header />

    <br>

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

                        <template v-if="col.field === 'address.municipality'" #body="slotProps">
                            {{ slotProps.data.address.unit_number ? slotProps.data.address.unit_number + ' ' : '' }}
                            {{ slotProps.data.address.street ? slotProps.data.address.street + ' ' : '' }}
                            {{ slotProps.data.address.baranggay ? slotProps.data.address.baranggay + ' ' : '' }}
                            {{ slotProps.data.address.municipality ? slotProps.data.address.municipality + ' ' : '' }}
                            {{ slotProps.data.address.province ? slotProps.data.address.province + ' ' : '' }}
                        </template>

                        <template v-if="col.field === 'status'" #body="slotProps">
                            <Badge v-if="slotProps.data.status === '1'" value="ACTIVE" severity="success"></Badge>
                            <Badge v-else value="INACTIVE" severity="danger"></Badge>
                        </template>
                    </Column>
                </DataTable>
            </div>
        </template>
    </Card>

</template>

<script setup>
import { ref, defineProps, onMounted } from 'vue'
import Header from '../Components/Layout/Header.vue';

const props = defineProps({
    data: {
        type: Array,
        required: true
    },
})

// customer table data
let customers = ref([]);
const customerHeaders = [
    { field: 'name', header: 'Name', sortable: true }, 
    { field: 'address.municipality', header: 'Address', sortable: true }, 
    { field: 'cellphone_number', header: 'Contact Number' }, 
    { field: 'email', header: 'Email' }, 
    { field: 'status', header: 'Status', sortable: true }, 
]

// customer methods
const addCustomer = () => {
    console.log('customer created')
    fetchCustomer()
}

const fetchCustomer = async () => {
    const filter = {
        status: 'ACTIVE',
        deliver_schedule: 'today',
    }

    axios.get("/get/customers/" + JSON.stringify(filter))
        .then(response => {
            customers.value = response.data
        })
        .catch(exception => {
          console.error(exception)
        });
}

onMounted(() => {
    fetchCustomer()
})

</script>

<style lang="scss" scoped>

</style>