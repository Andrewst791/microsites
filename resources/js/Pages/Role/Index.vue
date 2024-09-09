<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import Button from "@/Components/Preline/Button.vue";
import {computed, ref} from "vue";
import Swal from "sweetalert2";

const search = ref('');
const form = useForm({});

const createRole = () => form.get(route('roles.create'))

const props = defineProps({
    roles: {
        type: Object,
    },
});
const rolesWithPermissions = computed(() => props.roles.map(role => ({
    ...role,
    permissions_list: role.permissions.map(permission => permission.name).join(', ')
})));
const showEdit = (role, edit = false) => {
    if(edit) {
        form.get(route('roles.edit', {role: role.id}));
    } else {
        form.get(route('roles.show', {role: role.id}));
    }
}
const deleteRole = (role) => {
    Swal.fire({
        title: "¿Seguro?",
        html: 'Esta acción eliminará el rol',
        icon: 'error',
        showDenyButton: true,
        showCancelButton: true,
        showConfirmButton: false,
        cancelButtonText: 'Cancelar',
        denyButtonText: `Eliminar`
    }).then((result) => {
        if (result.isDenied) {
            form.delete(route('role.destroy', { id: role.id }), {
                preserveScroll: true,
            });
            Swal.fire('Ok', `Se ha eliminado el rol <b>${role.name}</b> correctamente`, "info");
        } else {
            Swal.fire('No se realizaron cambios', '', "info");
        }
    });
}
</script>

<template>
    <Head title="Roles" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-neutral-200 leading-tight">
                {{ $t('list_of_roles') }}
                <button @click="createRole" class="py-1 px-2 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
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
                                        Permisos
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                        Acciones
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                <tr v-for="(role, index) in rolesWithPermissions" :key="role.id">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                        {{ role.name }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">
                                        {{ role.permissions_list }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                        <button @click="showEdit(role)" class="py-1 px-2 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 disabled:opacity-50 disabled:pointer-events-none">
                                            <font-awesome-icon icon="fas fa-eye" />
                                        </button>
                                        <button @click="showEdit(role, true)" class="py-1 px-2 ml-2 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                            <font-awesome-icon icon="fas fa-edit" />
                                        </button>
                                        <button @click="deleteRole(role)" class="py-1 px-2 ml-2 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-red-600 text-white hover:bg-red-700 disabled:opacity-50 disabled:pointer-events-none">
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

<style scoped>

</style>
