<template>
    <Head title="Delivery Schedule" />

    <Layout>
        <Card class="h-screen">
            <template #title>
                <div>Delivery Schedules</div>
            </template>

            <template #content>
                <!-- <div class="flex justify-end mb-2">
                    <Button @click="showForm('store')" type="button" label="Add" icon="pi pi-plus" />
                </div> -->

                <DataTable :value="deliverySchedules" :loading="loading"
                stripedRows tableStyle="min-width: 50rem" class="w-full"
                paginator :rows="10" :rowsPerPageOptions="[5, 10, 20, 50]">
                    <Column v-for="col of headers" class="dark:text-zinc-50"
                    :key="col.field" :field="col.field" :header="col.header" :sortable="col.sortable" :style="{ width: col.width }">
                        <template v-if="col.field === 'frequency_type'" #body="slotProps">
                            {{ slotProps.data.frequency_type }}
                        </template>

                        <template v-if="col.field === 'order_quantity'" #body="slotProps">
                            <div>
                                Slim: {{ slotProps.data.slim_qty }}
                            </div>
                            <div>
                                Round: {{ slotProps.data.round_qty }}
                            </div>
                            <div>
                                Total: {{ slotProps.data.slim_qty + slotProps.data.round_qty}}
                            </div>
                        </template>
                        
                        <template v-if="col.field === 'frequency_type'" #body="slotProps">
                            <div>{{ slotProps.data.frequency_type }}</div>
                            <div v-if="slotProps.data.frequency_type === 'Once'">{{ moment(slotProps.data.exact_date).format('MMMM D, YYYY') }}</div>
                        </template>

                        <template v-if="col.header === 'Action'" #body="slotProps">
                            <SplitButton label="Actions" :model="actionItems" severity="info" rounded/>
                        </template>
                    </Column>
                </DataTable>
            </template>
        </Card>
    </Layout>

    <Dialog v-model:visible="visible" modal header="Add Delivery Schedule" :style="{ width: '60rem'}">
        <Card>
            <template #content>
                <DeliveryScheduleForm :form="form" :hideSkip="true">
                    <template #actions>
                        <div class="flex justify-end gap-2">
                            <Button @click="closeForm" label="Cancel" icon="pi pi-cross" iconPos="right" severity="danger"/>
                            <Button @click="submitForm" type="submit" label="Save" severity="success"/>
                        </div>
                    </template>
                </DeliveryScheduleForm>  
            </template>
        </Card>
    </Dialog>
</template>

<script setup lang="ts">
import { ref, defineProps, onMounted } from 'vue';
import Layout from '@/Layouts/Layout.vue';
import { useForm, Head } from "@inertiajs/vue3";
import axios from 'axios';
import moment from 'moment';

import DeliveryScheduleForm from '@/Components/Forms/DeliveryScheduleForm.vue';


const props = defineProps<{
    title: string
}>();

const headers = [
    { field: 'name', header: 'Name', width: '17%' },
    { field: 'full_address', header: 'Address', width: '20%' },
    { field: 'frequency_type', header: 'Schedule', width: '15%' },
    { field: 'order_quantity', header: 'Order Quantity', width: '10%' },
    { field: 'created_at', header: 'Date Added', sortable: true, width: '15%' },
    { field: 'notes', header: 'Remarks' },
    { field: '', header: 'Action' },
]

const actionItems = [
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
    }
]

const loading = ref(false);
const deliverySchedules = ref<Object[]>([]);

const fetchData = () => {
    loading.value = true;

    axios.get(route('delivery-schedules.get'))
        .then(response => {
            deliverySchedules.value = response.data;
            loading.value = false;
        })
        .catch(error => {
            console.log(error)
        })
}

// form variable
const visible = ref<boolean>(false);
const form = useForm({
            'action': null,
            'skip_delivery': false,
            'days': null,
            'frequency': {name: null, code: null},
            'delivery_date': null,
            'slim_qty': 0,
            'round_qty': 0,
            'total_qty': 0,
            'remarks': null,
        });

// form methods
const showForm = (action: string) => {
    visible.value = true;
    console.log(action);
}

const closeForm = () => {
    resetForm();
    visible.value = false;
}

const submitForm = ()=> {
    console.log('Form submitted');
}

const resetForm = () => {
    form['action'] = null;          
    form['skip_delivery'] = false;
    form['days'] = null;
    form['frequency'] = {name: null, code: null};
    form['delivery_date'] = null;
    form['slim_qty'] = 0;
    form['round_qty'] = 0;
    form['total_qty'] = 0;
    form['remarks'] = null;
}

onMounted(() => {
    fetchData();
})

</script>