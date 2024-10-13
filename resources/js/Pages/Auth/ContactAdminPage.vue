<template>
    <div class="text-center">
        <div class="text-3xl text-red-700 mb-24 mt-24">
            Your account is not yet activated.
        </div>

        <div class="mt-16">Please contact admin to activate your account.</div>

        <Link href="/login">
            <Button label="Go Back" icon="pi pi-arrow-left" class="mt-4"/>
        </Link>

    </div>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

</script>
