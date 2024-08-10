<template>
    <Toast position="top-right">
        <template #message="slotProps">
            <div>{{ slotProps.message.summary }}</div>>
        </template>
    </Toast>
</template>

<script setup lang="ts">
</script>

<style scoped>
</style>