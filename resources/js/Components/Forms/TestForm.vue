<template>
    <Card>
        <template #title>
            <h2>Form Component</h2>
        </template>
        <template #content>
            <Button @click="submit" label="Submit" />
        </template>
    </Card>
</template>

<script setup lang="ts">
import { defineEmits } from 'vue';

const emit = defineEmits(['submit']);


const submit = () => {
    const data = {
        action: 'submit',
        id: '#0004',
        details: 'This is the description'
    }
    emit('submit', data);
}


</script>

<style scoped>

</style>