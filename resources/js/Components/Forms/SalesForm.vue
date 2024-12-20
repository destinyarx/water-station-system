<template>
    <Card>
        <template #content>
            <div class="flex mb-8">
                <div class="w-1/2">
                    <FloatLabel v-if="isNewCustomer" variant="in">
                        <InputText id="in_label" v-model="customName" variant="filled" class="w-full"/>
                        <label for="in_label">Customer Name</label>
                    </FloatLabel>

                    <div v-else class="w-full">
                        <AutoComplete  v-model="selectedProduct" optionLabel="title" :suggestions="filteredProducts" @complete="search" 
                            dropdown>
                            <template #option="slotProps">
                                <div class="flex w-full">
                                    <i class="pi pi-check"></i>
                                    <div class="ml-4">
                                        {{ slotProps.option.title }}
                                    </div>
                                </div> 
                            </template>
                        </AutoComplete>
                    </div>
                </div>

                <div class="flex items-center ml-4">
                    <InputSwitch v-model="isNewCustomer" class="ml-2"/>
                    <span class="ml-2">New customer?</span>
                </div>
            </div>

            <div class="flex gap-4 mb-8">
                <ToggleButton v-model="isShopProducts" onLabel="Shop Products" offLabel="Delivery Products" onIcon="pi pi-shopping-bag" 
                    offIcon="pi pi-truck" class="w-9rem" />

                <AutoComplete v-model="selectedProduct" optionLabel="title" :suggestions="filteredProducts" @complete="search" dropdown>
                    <template #option="slotProps">
                        <div class="flex">
                            <i class="pi pi-check"></i>
                            <div class="ml-4">
                                {{ slotProps.option.title }}
                            </div>
                        </div> 
                    </template>
                </AutoComplete>

                <InputNumber v-model="selectedProductQuantity" inputId="integeronly" fluid />

                <Button @click="appendProductToOrder" icon="pi pi-plus"/>
            </div>

            <div class="flex mb-8">
                <Textarea v-model="remarks" rows="3" class="w-full" />
            </div>

            <div class="flex">
                <i class="pi pi-shopping-cart my-5" style="font-size: 2rem; color: slateblue;"></i>
            </div>

            <Button>
                <i class="pi pi-shopping-cart my-5" style="font-size: 1rem; color: slateblue;"></i>
            </Button>

            <div class="flex justify-end gap-4">
                <Button @click="emit('closeModal');" label="Cancel" class="bg-rose-500"/>
                <Button @click="appendProductToOrder" label="Submit"/>
            </div>
        </template>
    </Card>
</template>

<script setup lang="ts">
import { ref, onMounted, defineProps, defineEmits } from 'vue'
import axios from 'axios';

const props = defineProps({
    action: { type: String },
    form: { type: Object }
});

const emit = defineEmits(['closeModal']);

const shopProducts = ref<Object[]>([]);
const deliveryProducts = ref<Object[]>([]);
const productLoading = ref(false);
const selectedProduct = ref();
const filteredProducts = ref<Object[]>();
const isShopProducts = ref(true);
const orderProducts = ref([]);
const selectedProductQuantity = ref();
const customName = ref();
const isNewCustomer = ref(false);
const remarks = ref();

// search products in autocomplete dropdown
const search = (event: any) => {
    setTimeout(() => {
        if (!event.query.trim().length) {
            filteredProducts.value = shopProducts.value.filter((product) => product.is_delivery == !isShopProducts.value);
        } else {
            filteredProducts.value = shopProducts.value.filter((product) => {
                    return product.title.toLowerCase().startsWith(event.query.toLowerCase()) && product.is_delivery == !isShopProducts.value;
                
            });
        }
    }, 250);
}

const fetchProducts = async () => {
    productLoading.value = true;
    
    axios.get('/products/get/none')
        .then(response =>{
            if (response.data.length) {
                for (let product of response.data) {
                    if (product.is_delivery) 
                        deliveryProducts.value.push(product);
                     else 
                        shopProducts.value.push(product);
                }
            }
        })
        .catch(error => {
            console.log(error)
            // alert(toast, 'error', 'Error!', 'Error: Unable to fetch the product list.');
        })
        .finally(() => {
            productLoading.value = false;
        })
}

const appendProductToOrder = () => {
    if (selectedProduct.value) {
        selectedProduct.value['orderQuantity'] = selectedProductQuantity.value;
        orderProducts.value.push(selectedProduct.value);
    }
}

onMounted(() => {
    fetchProducts();
})
</script>