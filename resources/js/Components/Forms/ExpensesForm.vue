<template>
    <div class="mb-4">
        <div class="flex w-full justify-between mb-5">
            <div class="w-5/12">
                <div class="font-semibold mb-2">Category</div>
                <Dropdown v-model="form.category" :options="category" optionLabel="name" placeholder="Select Category" class="w-full" />
            </div>

            <div v-if="form.category && form.category['code'] === 'other'" class="w-1/2">
                <div class="font-semibold mb-2">Other</div>
                <InputText v-model="form.category_other" class="flex-auto w-full" autocomplete="off" />
            </div>
        </div>

        <div class="flex justify-between w-full mb-5">
            <div class="w-5/12">
                <div class="font-semibold mb-2">Expense Date</div>
                <Calendar v-model="form.expense_date" dateFormat="MM d, yy" showIcon :showOnFocus="true" variant="filled" inputId="buttondisplay" class="w-full"/>
            </div>

            <div class="w-1/2">
                <div class="font-semibold mb-2">Price</div>
                <InputNumber v-model="form.price" inputId="integeronly" mode="currency" currency="PHP" class="w-full"/>
            </div>
        </div>

        <div class="font-semibold mb-2">Description</div>
        <Textarea v-model="form.description" rows="5" cols="30" class="w-full"/>
    </div>

    <slot></slot>
</template>

<script setup lang="ts">
import { defineProps } from 'vue';

const props = defineProps({
    form: { type: Object },
    category: { type: Array },
})

</script>