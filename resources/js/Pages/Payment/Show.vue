<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head} from "@inertiajs/vue3";

const props = defineProps({
    payment: {
        type: Object,
    }
});
console.log(props.payment);
</script>

<template>
    <Head title="Pago" />

    <AuthenticatedLayout>
        Prueba
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
