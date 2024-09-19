<template>
    <Head title="Products" />

    <Layout>
        <Card class="dark:bg-slate-700 light:bg-gray-100">
            <template #content>
                <div class="flex justify-center w-full text-2xl">
                    <div @click="activeTab = 0" :class="!activeTab ? 'border-b-2 border-indigo-500 text-indigo-300' : 'text-gray-500' " 
                        class="flex justify-center w-full max-w-2xl px-14 py-2">
                        Shop Products
                    </div>
                    <div @click="activeTab = 1" :class="activeTab ? 'border-b-2 border-indigo-500 text-indigo-300' : 'text-gray-500' " 
                        class="flex justify-center w-full max-w-2xl px-14 py-2">
                        Delivery Products
                    </div>
                </div>

                <div class="flex justify-end text-md mt-2 mb-5">
                    <Button @click="showAddProductForm()" type="button" :label="activeTab ? 'Add Delivery Product' : 'Add Shop Product'" icon="pi pi-plus" />
                </div>

                <div class="flex justify-center max-w-full px-10 ml-14">
                    <template v-if="!activeTab">
                        <div v-if="productLoading" class="flex flex-wrap gap-7">
                            <div v-for="n in 8" :key="n" class="flex flex-col w-1/5">
                                <Skeleton width="17rem" height="17rem" borderRadius="16px"></Skeleton>
                                <div class="flex flex-row mt-1">
                                    <Skeleton shape="circle" size="2.5rem" class="mr-2"></Skeleton>
                                    <Skeleton width="13.5rem" height="2rem" class="mt-1"></Skeleton>
                                </div>
                            </div>
                        </div>


                        <template v-else-if="!productLoading && products">
                            <div class="flex flex-wrap">
                                <template v-for="product in products" :key="product.id">
                                    <ProductCard :product="product" @update="showUpdateProductForm" class="mx-4"/>
                                </template>
                            </div>
                        </template>
                    </template>
                    <template v-else-if="activeTab">
                        <div v-if="deliveryLoading" class="flex flex-wrap gap-7">
                            <div v-for="n in 8" :key="n" class="flex flex-col w-1/5">
                                <Skeleton width="17rem" height="17rem" borderRadius="16px"></Skeleton>
                                <div class="flex flex-row mt-1">
                                    <Skeleton shape="circle" size="2.5rem" class="mr-2"></Skeleton>
                                    <Skeleton width="13.5rem" height="2rem" class="mt-1"></Skeleton>
                                </div>
                            </div>
                        </div>

                        <div v-else-if="!deliveryLoading && deliveryProducts" class="flex flex-wrap">
                            <template v-for="deliveryProduct in deliveryProducts" :key="deliveryProduct.id">
                                <ProductCard :product="deliveryProduct" @update="showUpdateProductForm" class="mx-4"/>
                            </template>
                        </div>
                    </template>
                </div>           
            </template>
        </Card>
    </Layout>

    <!-- Add or update product modal -->
    <Dialog v-model:visible="visible" modal :header="action === 'store' ? 'Add New Product' : 'Update Product'" :style="{ width: '40rem' }">
        <form @submit.prevent="submit">
            <ProductForm :form="productForm" :action="action">
                <div class="flex justify-end gap-2">
                    <Button type="button" label="Cancel" severity="secondary" @click="visible = false"></Button>
                    <Button type="submit" label="Save" @click="visible = false"></Button>
                </div>
            </ProductForm>
        </form>
    </Dialog>

    <Notification />
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { Head, useForm } from "@inertiajs/vue3";

import Layout from '../Layouts/Layout.vue';
import ProductForm from '../Components/Forms/ProductForm.vue'

import ProductCard from '@/Components/Card/ProductCard.vue'
import Notification from '@/Components/Toast/Notification.vue';
import { alert } from '@/Composables/useNotification';
import { useToast } from 'primevue/usetoast';
const toast = useToast();

let filter = {
    search: 'Search Value',
    status: 'Inactive',
}

// products
const products = ref([]);
const deliveryProducts = ref([]);
const activeTab = ref(0);
const productLoading = ref(false);
const deliveryLoading = ref(false);

// forms variable
const visible = ref(false);
const action = ref('');

const productForm = useForm({
    title: '',
    description: '',
    price: null,
    qty: null,
});

// form methods
const submit = () => {
    if (action.value === 'store') addProduct()

    if (!activeTab) updateProduct()

    updateDeliveryProduct()
}

const showAddProductForm = () => {    
    resetForm();
    action.value = 'store';
    visible.value = true;
}

const addProduct = () => {
    axios.post(route('products.add'), productForm)
        .then(response => {
            alert(toast, 'success', 'Success!', 'Product successfully added.');
            fetchProducts();
        })
        .catch(error => {
            alert(toast, 'error', 'Error!', 'Something went wrong. The product could not be added.');
        })
}

const showUpdateProductForm = (product) => {
    action.value = 'update';
    productForm['id'] = product.id;
    productForm['title'] = product.title;
    productForm['description'] = product.description;
    productForm['price'] = product.price;
    productForm['qty'] = product.qty;
    visible.value = true;
}

const updateProduct = () => {
    axios.put(route('products.update', productForm))
        .then(response => {
            alert(toast, 'success', 'Success!', 'Product successfully updated.');
            fetchProducts();
        })
        .catch(error => {
            alert(toast, 'error', 'Error!', 'Something went wrong. The product could not be updated.');
        })
}

const updateDeliveryProduct = () => {
    axios.put(route('delivery-products.update', productForm))
        .then(response => {
            alert(toast, 'success', 'Success!', 'Product successfully updated.');
            fetchDeliveryProducts();
        })
        .catch(error => {
            alert(toast, 'error', 'Error!', 'Something went wrong. The product could not be updated.');
        })
}

const resetForm = () => {
    action.value = '';
    productForm['title'] = '';
    productForm['description'] = '';
    productForm['price'] = null;
    productForm['qty'] = null;
}


const fetchProducts = async () => {
    productLoading.value = true;
    filter['search'] = 'John Doe';
    
    axios.get('/products/get/' + JSON.stringify(filter))
        .then(response =>{
            products.value = response.data;
        })
        .catch(error => {
            console.log(error)
            alert(toast, 'error', 'Error!', 'Error: Unable to fetch the product list.');
        })
        .finally(() => {
            productLoading.value = false;
        })
}

const fetchDeliveryProducts = async () => {
    deliveryLoading.value = true;

    axios.get(route('delivery-products.fetch'))
        .then(response => {
            deliveryProducts.value = response.data;
        })
        .catch(error => {
            console.log('Error when fetching delivery products');
            console.log(error);
        })
        .finally(() => {
            deliveryLoading.value = false;
        })
}


onMounted(() => {
    fetchProducts();
    fetchDeliveryProducts();
})

</script>

<style scoped>

</style>