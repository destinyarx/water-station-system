<template>
    <Head title="Customers" />

    <Layout>
        <Card>
            <template #title>
                <div class="flex justify-between">
                    <div>Customers</div>
                    <div>
                        <!-- add button here -->
                    </div>
                </div>
            </template>
            <template #subtitle>
                <div class="flex justify-between">
                    <span>Active customer list</span>
                    <Button type="button" label="Add" icon="pi pi-plus" @click="showCustomerForm" />
                </div>
            </template>
            <template #content>
                <div class="card">
                    <DataTable :value="customers.data"  :loading="loading" :from="customers.from" :rows="customers.per_page" :totalRecords="customers.total"
                        stripedRows size="small" tableStyle="min-width: 50rem">
                        <Column v-for="col of customerHeaders" class="dark:text-zinc-50 text-sm"
                            :key="col.field" :field="col.field" :header="col.header" :sortable="col.sortable">

                            <template v-if="col.field === 'action'" #body="slotProps">
                                <SplitButton label="Actions" :model="actions(slotProps.data)" severity="info" rounded/>
                            </template>

                            
                        </Column>

                        <template v-slot:footer>
                            <div class="flex flex-row justify-center gap-4 font-normal">
                                <i v-if="customers.first_page_url" @click="fetchData(customers.first_page_url)" class="pi pi-angle-double-left" style="font-size: 1rem"></i>
                                <i v-if="customers.prev_page_url" @click="fetchData(customers.prev_page_url)" class="pi pi-angle-left" style="font-size: 1rem"></i>
                                <span>Page &nbsp; {{ customers.current_page }} &nbsp; of &nbsp; {{ customers.last_page }}</span>
                                <i v-if="customers.next_page_url" @click="fetchData(customers.next_page_url)" class="pi pi-angle-right" style="font-size: 1rem"></i>
                                <i v-if="customers.last_page_url" @click="fetchData(customers.last_page_url)" class="pi pi-angle-double-right" style="font-size: 1rem"></i>
                            </div>
                        </template>
                    </DataTable>
                </div>
            </template>
        </Card>
    </Layout>



    <Dialog v-model:visible="visible" modal header="Add Customer" :style="{ width: '60rem'}">
        <form @submit.prevent="submit">
            <CustomerForm :form="customerForm" :frequency="frequency" :action="action">
                <div class="flex justify-end gap-2">
                    <Button @click="submitForm" type="submit" label="Save" icon="pi pi-check" iconPos="right"/>
                </div>
            </CustomerForm>
        </form>
    </Dialog>

    <Toast />
</template>

<script setup lang="ts">
import { ref, onMounted, watch } from 'vue'
import { useForm, Head } from "@inertiajs/vue3";
import axios from 'axios';

import Layout from '@/Layouts/Layout.vue';
import CustomToast from '@/Components/Toast/CustomToast.vue'
import CustomerForm from '@/Components/Forms/CustomerForm.vue'

import { useToast } from 'primevue/usetoast';
const toast = useToast();

const props = defineProps({
    frequency: {
        type: Array,
        required: true
    },
})

// customer table data
let loading = ref(false)
let customers = ref([])
const customerHeaders = [
    { field: 'name', header: 'Name', width: '20%', sortable: true }, 
    { field: 'address.full_address', header: 'Address', width: '20%', sortable: true }, 
    { field: 'cellphone_number', header: 'Contact Number' }, 
    { field: 'email', header: 'Email', width: '10%' }, 
    { field: 'action', header: 'Action', width: '5%', sortable: true }, 
]

const actions = (data: any) => {
    let actions = [
        {
            label: 'Update',
            command: () => {
                console.log('Update');
            },
        },
        {
            label: 'Delete',
            command: () => {
                console.log('Delete');
            }
        },
    ]

    if (!data.delivery_schedule) {
        actions.push({
            label: 'Add delivery schedule',
            command: () => {
                console.log('Add delivery schedule')
            }
        });
    }

    return actions;
}

const showSuccess = () => {
    toast.add({ severity: 'success', summary: 'Customer saved succesfully!', life: 3000 });
};

const showError = () => {
    toast.add({ severity: 'error', summary: 'An error occurred while saving customer details', life: 3000 });
};

const fetchData = async (url: string|null = null) => {
    let response = null;
    loading.value = true

    const filter = {
        status: 'ACTIVE',
        deliver_schedule: 'today',
    }

    if (!url)
        response = await axios.get(route('customers.get', filter)); 
    else    
        response = await axios.get(url);
    
    customers.value = response.data
    loading.value = false;
}

// customer form
const customerForm = useForm({
    'details': 
        {
            'id': null,
            'name': '',
            'cellphone_number': null,
            'email': '',
            'messenger_name': '',
            'status': false,
        },
    'address': 
        {
            'description': null,
            'unit': null,
            'street': null,
            'barangay': null,
            'municipality': null,
            'province': null,
        },
    'delivery': 
        {
            'skip_delivery': false,
            'days': null,
            'frequency': {name: null, code: null},
            'delivery_date': null,
            'slim_qty': 0,
            'round_qty': 0,
            'total_qty': 0,
            'remarks': null,
        }
});

const visible = ref(false);
const action = ref('');

const showCustomerForm = () => {
    // resetForm();
    action.value = 'store';
    visible.value = true;
}

const resetForm = () => {
    // customer
    customerForm['details']['id'] = null;
    customerForm['details']['name'] = '';
    customerForm['details']['cellphone_number'] = null;
    customerForm['details']['email'] = '';
    customerForm['details']['messenger_name'] = '';
    customerForm['details']['status'] = true;

    // address
    customerForm['address']['description'] = null;
    customerForm['address']['unit'] = null;
    customerForm['address']['street'] = null;
    customerForm['address']['barangay'] = null;
    customerForm['address']['municipality'] = null;
    customerForm['address']['province'] = null;

    // delivery schedule
    customerForm['delivery']['skip_delivery'] = false;
    customerForm['delivery']['days'] = null;
    customerForm['delivery']['frequency'] = {name: null, code: null};
    customerForm['delivery']['delivery_date'] = null;
    customerForm['delivery']['slim_qty'] = 0;
    customerForm['delivery']['round_qty'] = 0;
    customerForm['delivery']['total_qty'] = 0;
    customerForm['delivery']['remarks'] = null;

}

const submit = () => {
    console.log('Prevent form reload');
}

const submitForm = () => {
    visible.value = false;

    axios.post(route('customers.add'), customerForm)
        .then(response => {
            showSuccess();
            fetchData();
        })
        .catch(error => {
            showError();
            console.log(error);
        })
}

// const notify = (message, severity) => {
//   showToast(message, severity);
// };

watch(visible, (newValue, oldValue) => {
    if (!newValue) resetForm();
})

onMounted(() => {
    fetchData()
})

</script>

<style lang="scss" scoped>

</style>