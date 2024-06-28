<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {computed} from "vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import Swal from "sweetalert2";
import {ref} from "vue";

const form = useForm({});

const props = defineProps({
    users: {
        type: Array,
    },
});
</script>

<template>

</template>

<style scoped>
</style>
