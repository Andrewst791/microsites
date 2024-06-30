<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import Swal from "sweetalert2";
import {ref, computed} from "vue";
import Button from "@/Components/Preline/Button.vue";

const form = useForm({});

const props = defineProps({
    categories: {
        type: Array,
    },
});

const createCategory = () => {
    form.get(route('categories.create'));
}
const showEdit = (site_id) => {
    form.get(route('categories.edit', {site: site_id}));
}

const deleteCategory = (site_id) => {
    Swal.fire({
        title: "¿Seguro?",
        html: 'Esta acción eliminará la categoría',
        showDenyButton: true,
        showCancelButton: true,
        showConfirmButton: false,
        cancelButtonText: 'Cancelar',
        denyButtonText: `Eliminar`
    }).then((result) => {
        if (result.isDenied) {
            form.delete(route('categories.destroy', { id: site_id }), {
                preserveScroll: true,
            });
            Swal.fire("Se ha eliminado el sitio correctamente", "", "info");
        } else {
            Swal.fire("No se realizaron cambios", "", "info");
        }
    });
}

const updateSite = (site_id) => {
    console.log('updateSite', site_id);
}

</script>

<template>
    <Head title="Sites" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-neutral-200 leading-tight">
                Listado de Categorías
                <button @click="createCategory" class="py-1 px-2 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                    <font-awesome-icon icon="fas fa-plus" />
                </button>
            </h2>
        </template>
        <template #default>
            <div class="flex flex-col">
                <div class="-m-1.5 overflow-x-auto">
                    <div class="p-1.5 min-w-full inline-block align-middle">
                        <div class="overflow-hidden">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                                <thead>
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                        Nombre
                                    </th>
                                    <th>
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                <tr v-for="(category, index) in categories" :key="index">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                        {{ category.name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                        <button @click="showEdit(category.id)" class="py-1 px-2 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                            <font-awesome-icon icon="fas fa-edit" />
                                        </button>

                                        <button @click="deleteCategory(category.id)" class="py-1 px-2 ml-2 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-red-600 text-white hover:bg-red-700 disabled:opacity-50 disabled:pointer-events-none">
                                            <font-awesome-icon icon="fas fa-trash" />
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </AuthenticatedLayout>
</template>
