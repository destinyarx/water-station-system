<template>
    <Card class="w-full md:w-1/2 lg:w-1/5 px-4 mb-4 mx-1 p-4 dark:bg-gray-600 dark:text-zinc-50">
        <template #header>
            <div class="flex items-center justify-center min-h-16 text-2xl font-medium">
                <div class="text-center">
                    {{ product.title }}
                </div> 
            </div>                       
        </template>
        
        <template #content>
            <div class="flex flex-col min-h-96 min-w-full gap-y-3 rounded-md dark:bg-slate-500 px-4 py-2">
                <div class="flex justify-center">
                    <Image src="/image/round_gallon.jpg" alt="Image" width="auto" class="p-fluid rounded-lg" />
                </div>

                <div>
                    <strong> Description: </strong> 
                    {{ product.description }}
                </div>
                <div>
                    <strong>Quantity:</strong> 
                    {{ product.quantity ?? 0 }}
                </div>
                <div>
                    <strong>Price:</strong> 
                    ₱ {{ product.price ?? 0 }}.00
                </div>
            </div>
        </template>

        <template #footer>
            <div class="flex justify-center">
                <Button type="button" @click="updateProduct(product)" label="Update" icon="pi pi-pen-to-squares" />
            </div>
        </template>
    </Card>
</template>

<script setup lang="ts">
import { defineProps, defineEmits } from 'vue';

const emit = defineEmits(['update']);

const props = defineProps({
    product: { type: Object }
})

const updateProduct = (product: unknown) => {
    emit('update', product);
}

</script>