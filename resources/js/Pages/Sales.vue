<template>

    <Header />

    <div> {{ page }}</div>

</template>

<script setup>
import { defineProps } from 'vue';
import Header from '../Components/Layout/Header.vue'



const props = defineProps({
    page: {
        type: String,
        required: false
    },
})


</script>