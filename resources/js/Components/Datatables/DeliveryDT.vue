<template>
    <DataTable :value="deliveries" :loading="loading"
    stripedRows tableStyle="min-width: 50rem" size="small" class="w-full text-sm"
    paginator :rows="10" :rowsPerPageOptions="[5, 10, 20, 50]">
        <Column v-for="col of headers" class="dark:text-zinc-50"
        :key="col.field" :field="col.field" :header="col.header" :sortable="col.sortable" :style="{ width: col.width }">
            <template v-if="col.field === 'target_date'" #body="slotProps">
                <Badge v-if="getDateStatus(slotProps.data.target_date) === 'today'" value="Today" severity="warning"></Badge>
                <Badge v-else-if="getDateStatus(slotProps.data.target_date) === 'overdue'" value="Overdue" severity="danger"></Badge>
                <Badge v-else-if="getDateStatus(slotProps.data.target_date) === 'tomorrow'" value="Tomorrow" severity="info"></Badge>
                <Badge v-else-if="getDateStatus(slotProps.data.target_date) === 'upcoming'" value="Upcoming" severity="secondary"></Badge>
                {{ moment(slotProps.data.target_date).format('MMMM D, YYYY') }}
            </template>


            <template v-if="col.header === 'Action'" #body="slotProps">
                <SplitButton label="Actions" :model="actions(slotProps.data)" severity="info" rounded class="p-0"/>
            </template>
        </Column>
    </DataTable>
</template>

<script setup lang="ts">
import { ref, onMounted, defineProps, watch } from 'vue';
import axios from 'axios';
import moment from 'moment';

import { useToast } from 'primevue/usetoast';
const toast = useToast();

const props = defineProps({
    filter: { type: Object }
})

// table data
const headers = [
    { field: 'name', header: 'Name', width: '25%' },
    { field: 'full_address', header: 'Address', width: '30%' },
    { field: 'target_date', header: 'Delivery Date', width: '15%', sortable: true },
    { field: 'total_qty', header: 'Quantity',width: '10%', sortable: true },
    { field: 'price', header: 'Total Price',width: '10%', sortable: true },
    { field: '', header: 'Action', width: '10%' },
]

// datatable data
const loading = ref(false);
const deliveries = ref([]);

// table method
const fetchData = () => {
    loading.value = true;
    console.log(props.filter);

    axios.get(route('delivery.fetch', { filter: props.filter }))
        .then(response => {
            deliveries.value = response.data;
            loading.value = false;
        })
        .catch(error => {
            loading.value = false;
            console.log('Error when fetching datatable data.');
            console.log(error);
        })
}

const actions = (data: object[]) => {
    let actions = [
        {
            label: 'Mark as Delivered',
            command: () => {
                console.log(data);
                data.status = 'success';
                completeDelivery(data);
                stopDelivery(data.id);
                console.log('Success Delivery');
            },
        },
        {
            label: 'Mark as Failed',
            command: () => {
                data.status = 'failed';
                completeDelivery(data);
                stopDelivery(data.id);
                console.log('Failed Delivery');
            }
        },
        {
            label: 'Stop Daily Delivery',
            command: () => {
                data.status = 'stop';
                completeDelivery(data);
                stopDelivery(data.id);
                console.log('Delivery Stop');
            }
        },
    ]

    return actions;
}

// set status for the delivery order and add next delivery record
const completeDelivery = (data: any) => {
    axios.post(route('delivery.complete', data))
        .then(response => {
            addDeliveryHistory(data);
            fetchData();
            console.log(response.data);
        })
        .catch(error => {
            console.log('Error when changing delivery status');
            console.log(error);
        })
}

// stop daily delivery
const stopDelivery = (delivery_id: number) => {
    axios.put(route('delivery.update-status', delivery_id))
        .then(response => {
            console.log(response.data);
        })
        .catch(error => {
            console.log('Error when changing delivery status');
            console.log(error);
        })
}

const addDeliveryHistory = async (data: any) => {
    let historyData = {
        customer_id: data.customer_id,
        schedule_id: data.schedule_id,
        status: data.status
    };

    axios.post(route('delivery-history.store'), historyData)
        .then(response => {
            console.log(response.data);
        })
        .catch(error => {
            console.log('Error when adding delivery history.')
            console.log(error);
        })
}

const getDateStatus = (date: Date) => {
    const targetDate = moment(date).startOf('day'); 
    const today = moment().startOf('day');
    const tomorrow = moment().add(1, 'day').startOf('day');

    if (targetDate.isSame(today, 'day')) {
        return 'today';
    } else if (targetDate.isSame(tomorrow, 'day')) {
        return 'tomorrow';
    } else if (targetDate.isBefore(today, 'day')) {
        return 'overdue';
    } else {
        return 'upcoming';
    }
}


watch(() => props.filter, () => {
  fetchData();
})


onMounted(() => {
    fetchData();
})

</script>
