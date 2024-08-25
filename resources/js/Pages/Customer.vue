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
                    <DataTable :value="customers" class="w-auto" :loading="loading"
                        stripedRows size="small" tableStyle="min-width: 50rem"
                        paginator :rows="10" :rowsPerPageOptions="[5, 10, 20, 50]">
                        <Column v-for="col of customerHeaders" class="dark:text-zinc-50 text-sm"
                            :key="col.field" :field="col.field" :header="col.header" :sortable="col.sortable">

                            <template v-if="col.field === 'action'" #body="slotProps">
                                <SplitButton label="Actions" :model="actions(slotProps.data)" severity="info" rounded/>
                            </template>

                            <!-- <template v-if="col.field === 'status'" #body="slotProps">
                                <Badge v-if="slotProps.data.status === '1'" value="ACTIVE" severity="success"></Badge>
                                <Badge v-else value="INACTIVE" severity="danger"></Badge>
                            </template> -->
                        </Column>
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
    { field: 'name', header: 'Name', sortable: true }, 
    { field: 'address.full_address', header: 'Address', sortable: true }, 
    { field: 'cellphone_number', header: 'Contact Number' }, 
    { field: 'email', header: 'Email' }, 
    { field: 'action', header: 'Action', sortable: true }, 
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

const fetchCustomer = async () => {
    loading.value = true

    const filter = {
        status: 'ACTIVE',
        deliver_schedule: 'today',
    }

    axios.get("/customers/get/" + JSON.stringify(filter))
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
            fetchCustomer();
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
    fetchCustomer()
})

</script>

<style lang="scss" scoped>

</style>