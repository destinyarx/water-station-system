<template>
    <Card class="w-full md:w-1/2 lg:w-1/5 dark:bg-gray-500 dark:text-zinc-50 px-4 mb-4 mx-1 p-4">
        <template #header>
            <div class="text-2xl font-medium">
                {{ product.description }} 
            </div>                       
        </template>
        <template #title>
            <!-- <div>{{ product.title }}</div> -->
            <Image src="/image/round_gallon.jpg" alt="Image" width="auto" />
        </template>
        <!-- <template #subtitle>
            {{ product.description }}
        </template> -->
        <template #content>
            <div class="bg-green-500 h-full flex flex-col justify-between">
                <div>
                    <div>
                        Quantity: {{ product.quantity }}
                    </div>
                    <div>
                        Price: {{ product.price }}
                    </div>
                </div>

                <div class="flex justify-center">
                    <Button type="button" @click="updateProduct(product)" label="Update" icon="pi pi-pen-to-squares" class="self-end"/>
                </div>
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