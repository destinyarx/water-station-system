<template>
    <Dialog v-model:visible="visible" modal header="Add Expenses" :style="{ width: '60rem'}">
        <Card>
            <template #content>
                Add Content Here...
            </template>
        </Card>
    </Dialog>
</template>

<script setup lang="ts">
import { ref, defineProps } from 'vue'

const props = defineProps({
    visible: { type: Boolean }
})

</script>