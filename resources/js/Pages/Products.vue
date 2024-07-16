<template>
    <Header />

    {{ products }}
</template>

<script setup>
import { ref, defineProps, onMounted } from 'vue'
import Header from '../Components/Layout/Header.vue';

let filter = {
    search: 'Search Value',
    status: 'Inactive',
}

// products
let products = ref([])

const fetchProducts = async () => {
    filter['search'] = 'John Doe'

    axios.get('/products/get/' + JSON.stringify(filter))
        .then(response =>{
            products = response.data
            console.log('Products:')
            console.log(products)
        })
}

onMounted(() => {
    console.log('Components umounted!')

    fetchProducts()
})

</script>

<style scoped>

</style>