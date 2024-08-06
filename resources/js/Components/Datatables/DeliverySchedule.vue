<template>
    <Card>
        <template #title>
            Delivery Schedule
        </template>
        
        <template #content>
            <Datatable :value="data" :loading="loading">

            </Datatable>

        </template>

    </Card>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue';

const data = ref<object[]>([]);
const loading = false;
const filter = {
    status: ref<string>(''),
    frequency: ref<string>('')
}

const header = [
    {field: 'full_name' , header: 'Name'},
    {field: 'next_delivery', header: 'Scheduled Delivery'},
    {field: 'status', header: 'Status'},
    {field: 'address', header: 'Address'},
    {field: 'deliver_frequency', header: 'Frequency' },
    {field: 'order', header: 'Order'},
    {field: 'notes', header: 'Notes'},
]

// const fetchData = () => {
//     loading = true;

//     axios.get('delivery-schedule/get')
//         .then(response => {
//             data.value = response.data;
//             loading = false;
//         })
//         .catch(exception => {
//             console.log(exception)
//         })
// }
</script>
