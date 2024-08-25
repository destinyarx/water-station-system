<template>
    <div class="flex flex-col w-full mb-2">
        <div class="flex justify-end">
            <ToggleButton v-if="!hideSkip" v-model="checked" onLabel="Skip for now" offLabel="Skip for now" class="w-9rem" aria-label="Do you confirm" />
        </div>

        <template v-if="!checked">
            
            <div class="grid grid-cols-2 mb-4">
                <div>
                    <div class="mb-1">Frequency</div>
                    <Dropdown v-model="form.frequency" :options="frequency" optionLabel="name" placeholder="Select Delivery Frequency" class="mt-1 w-full"/>
                </div>
                <div class="ml-2">
                    <div class="mb-1">{{ form.frequency['name'] === 'Once' ? 'Date' : 'Starting Date:'}}</div>
                    <Calendar v-model="form.delivery_date" :minDate="new Date(Date.now())" dateFormat="MM d, yy" showIcon :showOnFocus="true" variant="filled" inputId="buttondisplay" class="w-full"/>
                </div>
            </div>
    
            <div class="grid grid-cols-3 gap-5 my-4">
                <div class="w-full">
                    <div class="mb-1">Slim Quantity</div>
                    <InputNumber v-model="form.slim_qty" class="w-full"/>
                </div>
                <div class="w-full">
                    <div class="mb-1">Round Quantity</div>
                    <InputNumber v-model="form.round_qty" class="w-full"/>
                </div>
                <div class="w-full">
                    <div class="mb-1">Total Quantity</div>
                    <InputNumber v-model="totalQuantity" disabled class="w-full"/>
                </div>
            </div>
    
            <div class="mb-1">Remarks</div>
            <Textarea v-model="form.remarks"autoResize  rows="3" class="w-full"/>
        </template>
    </div>
    <slot name="actions"/>
</template>

<script setup lang="ts">
import { ref, onMounted, computed, defineProps, defineEmits } from 'vue'

const props = defineProps({
    form: {
        type: Object,
        required: true 
    },
    hideSkip: {
        type: Boolean,
        required: false 
    },

});

const frequency = ref([
    {name: 'Once', code: 'O'},
    {name: 'Daily', code: 'D'},
    {name: 'Every other Day', code: 'EOD'},
    {name: 'Once a week', code: '1W'},
    {name: 'Twice a week', code: '2W'},
    {name: 'Three times a week', code: '3W'},
    {name: 'Weekly (once a week)', code: 'W1'},
    {name: 'Every two weeks', code: '2Wk'},
]);

const scheduleGaps = {
    'D': 1,      // Daily
    'EOD': 2,    // Every other Day
    '1W': 7,     // Once a week
    '2W': 3,     // Twice a week (assuming a 3-day gap)
    '3W': 2,     // Three times a week (assuming a 2-day gap)
    'W1': 7,     // Weekly (once a week)
    '2Wk': 14,   // Every two weeks
};

const checked = ref<boolean>(false);

const totalQuantity = computed(() => {
    return props.form.slim_qty + props.form.round_qty;
})

onMounted(() => {
    // format form date upon loading
    props.form.delivery_date = props.form.delivery_date ? new Date(props.form.delivery_date) : '';
})

</script>