<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head, Link, useForm, usePage} from "@inertiajs/vue3";
import Swal from "sweetalert2";
import {ref, computed} from "vue";
import Button from "@/Components/Preline/Button.vue";

const page = usePage();
const form = useForm({});
const permissions = computed(() => page.props.auth.permissions);
const hasPermission = (permission) => {
    return permissions.value.includes(permission);
};

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

const createSite = () => {
    form.get(route('sites.create'));
}
const showEdit = (site_id, edit = false) => {
    if(edit) {
        form.get(route('sites.edit', {site: site_id}));
    } else {
        form.get(route('sites.show', {site: site_id}));
    }
}

const deleteSite = (site_id) => {
    Swal.fire({
        title: "¿Seguro?",
        html: 'Esta acción eliminará el sitio',
        icon: 'error',
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
                <button v-if="hasPermission('sites.create')" @click="createSite" class="py-1 px-2 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
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
                                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                            Slug
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                            Categoría
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                            Tipo Documento
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                            Documento
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                            Acciones
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
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                            <button v-if="hasPermission('sites.view')" @click="showEdit(site.id)" class="py-1 px-2 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 disabled:opacity-50 disabled:pointer-events-none">
                                                <font-awesome-icon icon="fas fa-eye" />
                                            </button>
                                            <button v-if="hasPermission('sites.update')" @click="showEdit(site.id, true)" class="py-1 px-2 ml-2 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                                <font-awesome-icon icon="fas fa-edit" />
                                            </button>
                                            <button v-if="hasPermission('sites.delete')" @click="deleteSite(site.id)" class="py-1 px-2 ml-2 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-red-600 text-white hover:bg-red-700 disabled:opacity-50 disabled:pointer-events-none">
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
