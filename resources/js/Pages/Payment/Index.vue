<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm, usePage } from "@inertiajs/vue3";
import Button from "@/Components/Preline/Button.vue";

const props = defineProps({
    payments: {
        type: Array
    }
});
console.log(props.payments)
</script>

<template>
    <Head title="Mis Pagos" />

    <AuthenticatedLayout>
        <div class="px-4 py-5 sm:px-6 lg:px-8 lg:py-7 mx-auto">
            <!-- Card -->
            <div class="bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-gray-800">
                <div class="text-center mb-2">
                    <h2 class="text-3xl md:text-3xl font-bold text-gray-800 dark:text-neutral-200">
                        {{ $t('my_payments') }}
                    </h2>
                    <p class="text-sm text-gray-600 dark:text-neutral-400">
                        {{ $t('list_payments') }}
                    </p>
                </div>

                <div class="flex flex-col">
                    <div class="-m-1.5 overflow-x-auto">
                        <div class="p-1.5 min-w-full inline-block align-middle">
                            <div class="overflow-hidden">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                            Sitio
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                            Valor
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                            Estado
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                            Acciones
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                    <tr v-for="(payment, index) in payments" :key="payment.id">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                            {{ payment.site.name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                            ${{ payment.amount }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                            {{ payment.status }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                            <a role="button" class="py-1 px-2 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 disabled:opacity-50 disabled:pointer-events-none">
                                                <Link :href="route('payments.show', payment.id)">
                                                    <font-awesome-icon icon="fas fa-eye" />
                                                </Link>
                                            </a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
