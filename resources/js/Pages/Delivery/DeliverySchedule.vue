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
                stripedRows tableStyle="min-width: 50rem" size="small" class="w-full text-sm"
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
                            <div v-if="slotProps.data.frequency_type !== 'O'">
                                {{ slotProps.data.frequency_type ? frequency_value[slotProps.data.frequency_type] : '' }}
                            </div>
                            <div v-else>
                                Deliver on: {{ moment(slotProps.data.exact_date).format('MMMM D, YYYY') }}
                            </div>
                        </template>

                        <template v-if="col.field === 'created_at'" #body="slotProps">
                            <div>{{ moment(slotProps.data.created_at).format('MMMM D, YYYY hh:mm:a') }}</div>
                        </template>

                        <template v-if="col.header === 'Action'" #body="slotProps">
                            <SplitButton label="Actions" :model="actionItems(slotProps.data)" severity="info" rounded class="p-0"/>
                        </template>
                    </Column>
                </DataTable>
            </template>
        </Card>
    </Layout>

    <Dialog v-model:visible="visible" modal header="Update Delivery Schedule" :style="{ width: '60rem'}">
        <Card>
            <template #content>
                <DeliveryScheduleForm :form="form" :hideSkip="true">
                    <template #actions>
                        <div class="flex justify-end gap-2">
                            <Button @click="closeForm" label="Cancel" icon="pi pi-cross" iconPos="right" severity="danger"/>
                            <Button @click="handleSubmit" type="submit" label="Update" severity="success"/>
                        </div>
                    </template>
                </DeliveryScheduleForm>  
            </template>
        </Card>
    </Dialog>

    <Toast />
</template>

<script setup lang="ts">
import { ref, defineProps, onMounted } from 'vue';
import Layout from '@/Layouts/Layout.vue';
import { useForm, Head } from "@inertiajs/vue3";
import axios from 'axios';
import moment from 'moment';

import DeliveryScheduleForm from '@/Components/Forms/DeliveryScheduleForm.vue';
import { useToast } from 'primevue/usetoast';
const toast = useToast();


const props = defineProps({
    title: { type: String },
    frequency: { type: Array },
    frequency_value: { type: Object }
});

type Schedule = {
    id: number,
    exact_date: Date,
    frequency_type: string,
    notes: string | null,
    slim_qty: number,
    round_qty: number,
}

const headers = [
    { field: 'name', header: 'Name', width: '17%' },
    { field: 'full_address', header: 'Address', width: '20%' },
    { field: 'frequency_type', header: 'Schedule', width: '15%' },
    { field: 'order_quantity', header: 'Order Quantity', width: '10%' },
    { field: 'created_at', header: 'Date Added', sortable: true, width: '15%' },
    { field: 'notes', header: 'Remarks' },
    { field: '', header: 'Action' },
]

// datatable data
const loading = ref(false);
const deliverySchedules = ref<Object[]>([]);


// datatable methods
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

const actionItems = (data: Schedule) => {
    return [
        {
            label: 'Update Schedule',
            command: () => {
                showUpdateForm('update', data);
                console.log('Update');
            },
        },
        {
            label: 'Delete Schedule',
            command: () => {
                deleteDeliverySchedule(data.id);
                console.log('Delete');
            }
        }
    ];
}

// form variable
const visible = ref<boolean>(false);
const form = useForm({
            'id': 0 as number,
            'action': null as string | null,
            'skip_delivery': false,
            'days': null,
            'frequency': {name: null as string|null, code: null as string|null},
            'delivery_date': null as Date | null,
            'slim_qty': 0,
            'round_qty': 0,
            'total_qty': 0,
            'remarks': null as string | null,
        });

// form methods
const closeForm = () => {
    resetForm();
    visible.value = false;
}

const handleSubmit = ()=> {
    if (form['action'] === 'update') {
        updateDeliverySchedule();
    } else if (form['action'] === 'delete') {
        console.log(form['action'])
    }
}

const setFormValue = (action: string, data: Schedule) => {
    form['id'] = data.id;          
    form['action'] = action;          
    form['days'] = null;
    form['frequency'] = getFrequency(data.frequency_type);
    form['delivery_date'] = data.exact_date;
    form['slim_qty'] = data.slim_qty;
    form['round_qty'] = data.round_qty;
    form['total_qty'] = data.slim_qty + data.round_qty;
    form['remarks'] = data.notes;
}

const resetForm = () => {
    form['id'] = 0;          
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

const getFrequency = (frequencyCode: string) => {
    return { name: 'Once', code: 'O' };
}

const showUpdateForm = (action: string, data: Schedule) => {
    resetForm()
    setFormValue(action, data);
    visible.value = true;
}

const updateDeliverySchedule = () => {
    axios.put(route('delivery-schedules.update', form['id']), form)
    .then(response => {
        resetForm();
        visible.value = false;
        showSuccess();
        fetchData();
    })
    .catch(error => {
        console.log(error);
    })
}

const deleteDeliverySchedule = (id: number) => {
    axios.put(route('delivery-schedules.delete', {id}))
        .then(response => {
            visible.value = false;
            showSuccess();
            fetchData();
        })
        .catch(error => {
            console.log(error);
        })
}

const showSuccess = () => {
    toast.add({ severity: 'success', summary: 'Customer saved succesfully!', life: 3000 });
};

onMounted(() => {
    fetchData();
})

</script>

<style lang="css">
.p-splitbutton, .p-splitbutton-button {
    padding: none;
}
</style>