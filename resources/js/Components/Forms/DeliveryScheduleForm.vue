<template>
    <div class="flex flex-col w-full mb-2">
        <div class="flex justify-end">
            <ToggleButton v-model="checked" onLabel="Skip for now" offLabel="Skip for now" class="w-9rem" aria-label="Do you confirm" />
        </div>

        <template v-if="!checked">
            
            <div class="grid grid-cols-2 mb-4">
                <div>
                    <div class="mb-1">Frequency</div>
                    <Dropdown v-model="form.frequency" :options="frequency" optionLabel="name" placeholder="Select Delivery Frequency" class="mt-1 w-full"/>
                </div>
                <div v-if="form.frequency['name'] === 'Once'" class="ml-2">
                    <div class="mb-1">Date</div>
                    <Calendar v-model="form.delivery_date" showIcon :showOnFocus="false" inputId="buttondisplay" class="w-full"/>
                </div>
            </div>
        
            <template v-if="form.frequency['name'] !== 'Once'">
                <div class="mb-1 mt-4">Days</div>
                <div class="flex justify-center w-full">
                    <div>
                        <SelectButton v-model="form.days" :options="days" optionLabel="name" multiple aria-labelledby="multiple" class="w-full"/>
                    </div>
                </div>
            </template>
    
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
</template>

<script setup lang="ts">
import { ref, onMounted, computed, defineProps, defineEmits } from 'vue'

const props = defineProps({
    form: {
        type: Object,
        required: true 
    },
});

const frequency = ref([
    {name: 'Once', code: 'O'},
    {name: 'Daily', code: 'D'},
    {name: 'Every other Day', code: 'S'},
    {name: 'Twice a week', code: '2x'},
    {name: 'Three times a week', code: '3x'},
    {name: 'Weekly (once a week)', code: 'S'},
    {name: 'Every two weeks', code: 'S'},
])

const days = ref([
    {name: 'Monday', code: 'mon'},
    {name: 'Tuesday', code: 'tue'},
    {name: 'Wednesday', code: 'wed'},
    {name: 'Thursday', code: 'thur'},
    {name: 'Friday', code: 'fri'},
    {name: 'Saturday', code: 'sat'},
    {name: 'Sunday', code: 'sun'},
])

type Frequency = {
    name: string;
    code: string;
}

const checked = ref<boolean>(false);

const totalQuantity = computed(() => {
    return props.form.slim_qty + props.form.round_qty;
})

</script>

<style scoped>

</style>