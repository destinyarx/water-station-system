<template>

   <Layout>
       <Card>
           <template #title>Customers</template>
           <template #subtitle>
               <div class="flex justify-between">
                   <span>Active customer list</span>
                   <Button type="button" label="Add" icon="pi pi-plus" @click="showCustomerForm" />
               </div>
           </template>
           <template #content>
               <div class="card">
                   <DataTable :value="customers" class="w-auto" :loading="loading"
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
   </Layout>

    <Dialog v-model:visible="visible" modal header="Add Customer" :style="{ width: '60rem'}">
        <form @submit.prevent="submit">
            <CustomerForm :form="customerForm" :action="action">
                <div class="flex justify-end gap-2">
                    <!-- <Button @click="visible = false" type="button" label="Cancel" severity="danger"></Button> -->
                    <Button @click="visible = false"type="submit" label="Save" severity="success"></Button>
                </div>
            </CustomerForm>
        </form>
    </Dialog>

</template>

<script setup>
import { ref, defineProps, onMounted } from 'vue'
import Layout from '@/Layouts/Layout.vue';
import { useForm } from "@inertiajs/vue3";

import CustomerForm from '@/Components/Forms/CustomerForm.vue'

const props = defineProps({
    data: {
        type: Array,
        required: true
    },
})

// customer table data
let loading = ref(false)
let customers = ref([])
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
    loading.value = true

    const filter = {
        status: 'ACTIVE',
        deliver_schedule: 'today',
    }

    axios.get("/customer/get/" + JSON.stringify(filter))
        .then(response => {
            customers.value = response.data
            loading.value = false
        })
        .catch(exception => {
          console.error(exception)
        });
}

// customer form
const customerForm = useForm({
    'id': null,
    'name': '',
    'cellphone_number': null,
    'email': '',
    'messenger_name': '',
    'status': false,
});

const visible = ref(false);
const action = ref('');

const showCustomerForm = () => {
    resetForm();
    action.value = 'store';
    visible.value = true;
}

const resetForm = () => {
    customerForm['id'] = '';
    customerForm['name'] = '';
    customerForm['cellphone_number'] = null;
    customerForm['email'] = '';
    customerForm['messenger_name'] = '';
    customerForm['status'] = true;
}

onMounted(() => {
    fetchCustomer()
})

</script>

<style lang="scss" scoped>

</style>