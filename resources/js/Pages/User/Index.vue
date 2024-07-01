<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { watchEffect, ref, computed } from "vue";
import Swal from "sweetalert2";
import Button from "@/Components/Preline/Button.vue";

const search = ref('');
const form = useForm({});

const props = defineProps({
    users: {
        type: Object,
    },
});
watchEffect(() => {
    // console.log(props.users);
});

const userWithRoles = computed(() => props.users.data.map(user => ({
    ...user,
    role: user.roles.map(role => role.name).join(', ')
})));
const hasNextPage = (page) => props.users.links.find(link => link.label == page)
const getUrlPage = (page) => props.users.links.find(link => link.label == page)

const searchPosts = () => {
    let params = { page: 1 }
    if(search.value) {
        params['search'] = search.value;
    }
    form.get(route('users.index', params), {
        preserveState: true,
        preserveScroll: true,
    });
};
const changePage = (url) => {
    const page = new URL(url).searchParams.get('page');
    let params = { page }
    if(search.value) {
        params['search'] = search.value;
    }
    form.get(route('users.index', params), {
        preserveState: true,
        preserveScroll: true,
    });
};
const deleteUser = (user) => {
    Swal.fire({
        title: "¿Seguro?",
        html: 'Esta acción eliminará el usuario',
        icon: 'error',
        showDenyButton: true,
        showCancelButton: true,
        showConfirmButton: false,
        cancelButtonText: 'Cancelar',
        denyButtonText: `Eliminar`
    }).then((result) => {
        if (result.isDenied) {
            form.delete(route("users.destroy", { id: user.id }), {
                preserveScroll: true,
            });
            Swal.fire('Ok', `Se ha eliminado el usuario <b>${user.name}</b> correctamente`, "info");
        } else {
            Swal.fire('No se realizaron cambios', "", "info");
        }
    });
}
</script>

<template>
    <Head title="Users" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-neutral-200 leading-tight">
                {{ $t('list_of_users') }}
                <button @click="createSite" class="py-1 px-2 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                    <font-awesome-icon icon="fas fa-plus" />
                </button>
            </h2>
        </template>
        <template #default>
            <div class="py-3 px-4">
                <form @submit.prevent="searchPosts">
                    <div class="relative max-w-xs">
                        <label for="hs-table-search" class="sr-only">Search</label>
                        <input type="text" name="hs-table-search" id="hs-table-search" v-model="search"
                               class="py-2 px-3 ps-9 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                               :placeholder="$t('search')">
                        <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-3">
                            <font-awesome-icon icon="fas fa-search" class="text-white" />
                        </div>
                    </div>
                </form>
            </div>
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
                                            Email
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                            Roles
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                            Acciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                    <tr v-for="(user, index) in userWithRoles" :key="user.id">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                            {{ user.name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                            {{ user.email }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                            {{ user.role }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                            <button @click="showEdit(user.id)" class="py-1 px-2 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 disabled:opacity-50 disabled:pointer-events-none">
                                                <font-awesome-icon icon="fas fa-eye" />
                                            </button>
                                            <button @click="showEdit(user.id, true)" class="py-1 px-2 ml-2 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                                <font-awesome-icon icon="fas fa-edit" />
                                            </button>
                                            <button @click="deleteUser(user)" class="py-1 px-2 ml-2 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-red-600 text-white hover:bg-red-700 disabled:opacity-50 disabled:pointer-events-none">
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
            <!-- Pagination -->
            <nav class="flex items-center gap-x-1">
                <button :disabled="!users.prev_page_url" @click="changePage(users.prev_page_url)" type="button" class="min-h-[38px] min-w-[38px] py-2 px-2.5 inline-flex justify-center items-center gap-x-1.5 text-sm rounded-lg text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
                    <svg aria-hidden="true" class="hidden flex-shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m15 18-6-6 6-6"></path>
                    </svg>
                    <span>{{ $t('previous') }}</span>
                </button>
                <div class="flex items-center gap-x-1">
                    <button v-if="users.current_page != 1" @click="changePage(getUrlPage(users.current_page - 1)?.url)"
                            type="button" class="min-h-[38px] min-w-[38px] flex justify-center items-center text-gray-800 hover:bg-gray-100 py-2 px-3 text-sm rounded-lg focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
                        {{ users.current_page - 1 }}
                    </button>
                    <button type="button"
                            class="min-h-[38px] min-w-[38px] flex justify-center items-center bg-gray-600 text-gray-800
                            hover:bg-gray-100 py-2 px-3 text-sm rounded-lg focus:outline-none focus:bg-gray-100
                            disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10" aria-current="page">
                        {{ users.current_page }}
                    </button>
                    <button v-if="hasNextPage(users.current_page + 1)" @click="changePage(getUrlPage(users.current_page + 1)?.url)"
                            type="button" class="min-h-[38px] min-w-[38px] flex justify-center items-center text-gray-800 hover:bg-gray-100 py-2 px-3 text-sm rounded-lg focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
                        {{ users.current_page + 1 }}
                    </button>
                </div>
                <button :disabled="!users.next_page_url" @click="changePage(users.next_page_url)" type="button" class="min-h-[38px] min-w-[38px] py-2 px-2.5 inline-flex justify-center items-center gap-x-1.5 text-sm rounded-lg text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
                    <span>{{ $t('next') }}</span>
                    <svg aria-hidden="true" class="hidden flex-shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m9 18 6-6-6-6"></path>
                    </svg>
                </button>
            </nav>
            <!-- End Pagination -->
        </template>
    </AuthenticatedLayout>
</template>

<style scoped>
</style>
