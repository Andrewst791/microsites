<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Dropdown from "@/Components/Preline/Dropdown.vue";
import {computed} from "vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import Swal from "sweetalert2";
import {ref} from "vue";

const form = useForm({});

const props = defineProps({
    sites: {
        type: Array,
    },
});

const sitesWithActions = computed(() =>
    props.sites.map(item => ({
        ...item,
        actions: [
            {
                id: item.id,
                name: 'Editar',
                params: {
                    type: 'edit'
                }
            },
            {
                id: item.id,
                name: 'Habilitar',
                params: {
                    type: 'updateSite'
                }
            },
            {
                id: item.id,
                name: 'Eliminar',
                params: {
                    type: 'delete'
                }
            },
        ]
    }))
);

const showEdit = (site_id) => {
    console.log('showEdit', site_id);
}

const deleteSite = (site_id) => {
    Swal.fire({
        title: "¿Seguro?",
        html: 'Esta acción eliminará el sitio',
        showDenyButton: true,
        showCancelButton: true,
        showConfirmButton: false,
        cancelButtonText: 'Cancelar',
        denyButtonText: `Eliminar`
    }).then((result) => {
        if (result.isDenied) {
            form.delete(route("sites.destroy", { id: site_id }), {
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

const handleAction = (id, params) => {
    switch (params.type) {
        case 'edit':
            showEdit(id);
            break;
        case 'delete':
            deleteSite(id);
            break;
        case 'updateSite':
            updateSite(id);
            break;
        default:
            console.log(`No action defined`);
    }
}
</script>

<template>
    <Head title="Sites" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-neutral-200 leading-tight">
                Listado de Sitios
            </h2>
        </template>
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
                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                        Slug
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                        Categoría
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                        Tipo Documento
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                        Documento
                                    </th>
                                    <th>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                <tr v-for="(site, index) in sitesWithActions" :key="index">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                        {{ site.name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                        {{ site.slug }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                        {{ site.category.name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                        {{ site.document_type }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                        {{ site.document }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
<!--                                        <button type="button" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-400">-->
<!--                                            Delete-->
<!--                                        </button>-->
                                        <Dropdown :actions="site.actions" @handleActionParent="handleAction" />
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
