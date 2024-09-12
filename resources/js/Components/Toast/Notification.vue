<template>
    <Toast position="top-right" group="headless">
        <template #container="{ message, closeCallback }">
            <div class="flex items-center bg-zinc-50 dark:bg-slate-500 p-4 gap-5 rounded-lg shadow-lg">
                <i v-if=" message.type === 'success'" class="pi pi-check-circle text-2xl text-green-500"></i>
                <i v-else-if=" message.type === 'error'" class="pi pi-times-circle text-2xl text-red-700"></i>
                <div class="dark:text-white ml-4">
                    <strong class="font-bold">{{ message.summary }}</strong>
                    <p>{{ message.detail }}</p>
                </div>
            </div>
        </template>
    </Toast>
</template>

<script setup>

</script>
