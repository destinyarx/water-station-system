<template>
    <Head title="Products" />

    <Layout>
        <Card class="dark:bg-slate-700 light:bg-gray-100">
            <template #title>
                <div class="flex justify-end mt-5 mb-2 text-sm">
                    <Button @click="showAddProductForm" type="button" label="Add Product" icon="pi pi-plus" />
                </div>
            </template>
            
            <template #content>
                <div class="flex flex-wrap">
                    <Card v-for="(product, index) in products" :key="product.id" class="w-full md:w-1/2 lg:w-1/5 dark:bg-gray-500 dark:text-zinc-50 px-4 mb-4 mx-1 p-4">
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
                                        Quantity: {{ product.qty }}
                                    </div>
                                    <div>
                                        Price: {{ product.price }}
                                    </div>
                                </div>

                                <div class="flex justify-center">
                                    <Button @click="showUpdateProductForm(index)" type="button" label="Update" icon="pi pi-pen-to-squares" class="self-end"/>
                                </div>
                            </div>
                        </template>
    
                    </Card>
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
</template>

<script setup>
import { ref, defineProps, onMounted } from 'vue'
import { Head, useForm, Link, usePage } from "@inertiajs/vue3";

import Layout from '../Layouts/Layout.vue';
import ProductForm from '../Components/Forms/ProductForm.vue'

let filter = {
    search: 'Search Value',
    status: 'Inactive',
}

// products
let products = ref([]);

// forms variable
let visible = ref(false);
let action = ref('');

const productForm = useForm({
    title: '',
    description: '',
    price: null,
    qty: null,
});

// form methods
const submit = () => {
    console.log('form submitted');

    if (action.value === 'store') {
        addProduct()
        console.log('New Record Inserted: ' + productForm['title']);
    } else {
        updateProduct()
        console.log('Record Updated: ' + productForm['title']);
    }
}

const showAddProductForm = () => {
    resetForm();
    action.value = 'store';
    visible.value = true;
}

const addProduct = () => {
    axios.post(route('products.add'), productForm)
        .then(response => {
            console.log(response);
            fetchProducts();
        })
}

const showUpdateProductForm = (index) => {
    action.value = 'update';
    console.log(index)
    productForm['title'] = products.value[index]['title'];
    productForm['description'] = products.value[index]['description'];
    productForm['price'] = products.value[index]['price'];
    productForm['qty'] = products.value[index]['qty'];
    productForm['id'] = products.value[index]['id'];
    visible.value = true;

    updateProduct(products.value[index]['id']);
}

const updateProduct = () => {
    axios.put('/products/update/', productForm)
        .then(response => {
            console.log(response);
            fetchProducts();
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
    filter['search'] = 'John Doe';

    axios.get('/products/get/' + JSON.stringify(filter))
        .then(response =>{
            products.value = response.data;
            console.log(products.value)
        })
}


onMounted(() => {
    console.log('Components umounted!');

    fetchProducts();
})

</script>

<style scoped>

</style>