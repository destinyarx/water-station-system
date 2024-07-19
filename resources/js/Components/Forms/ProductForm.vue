<template>
    <div class="card p-3">
            <div class="flex items-center gap-4 mb-4">
                <label class="font-semibold w-24">Product Title</label>
                <InputText v-model="form.title" class="flex-auto" autocomplete="off" />
            </div>
            <div class="flex items-center gap-4 mb-4">
                <label for="product_description" class="font-semibold w-24">Product Description</label>
                <Textarea v-model="form.description" autoResize rows="5" cols="30" />
            </div>
            <div class="flex items-center gap-4 mb-4">
                <label class="font-semibold w-24">Price</label>
                <InputNumber v-model="form.price" inputId="integeronly" />
            </div>
            <div class="flex items-center gap-4 mb-4">
                <label class="font-semibold w-24">Quantity</label>
                <InputNumber v-model="form.qty" inputId="integeronly" />
            </div>
        <slot></slot>
    </div>
</template>

<script setup>
import { ref, defineProps } from 'vue'

defineProps({
    form: {
        type: Object,
        required: true 
    },
    action: {
        type: String,
        required: true
    },
})

</script>

<style lang="scss" scoped>

</style>