<template>
    <Toast position="top-right" group="headless">
        <template #container="{ message, closeCallback }">
            <div class="flex items-center p-4 gap-4 text-white rounded-lg shadow-lg">
                <i class="pi pi-check-circle text-2xl"></i>
                <div>
                    <strong>{{ message.summary }}</strong>
                    <p>{{ message.detail }}</p>
                </div>
            </div>
        </template>
    </Toast>
</template>

<script setup>

</script>
