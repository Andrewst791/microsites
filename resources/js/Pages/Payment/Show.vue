<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head} from "@inertiajs/vue3";
import {computed} from "vue";

const props = defineProps({
    payment: {
        type: Object,
    }
});

const fields_data = computed(() => {
    return props.payment.fields_data ? Object.keys(props.payment.fields_data) : [];
});

const status = {
    PENDING: 'bg-yellow-500',
    APPROVED: 'bg-green-600',
    REJECTED: 'bg-red-600',
    APPROVED_PARTIAL: 'bg-green-600',
    PARTIAL_EXPIRED: 'bg-red-400',
    UNKNOWN: 'bg-neutral-500'
}

const classStatus = computed( () => {
    const color = status[props.payment.status];
    return `inline-flex items-center gap-x-1 py-1 px-2 rounded-full text-xs font-medium ${color} text-white`;
});
</script>

<template>
    <Head title="Pago" />

    <AuthenticatedLayout>
        <!-- Card Section -->
        <div class="max-w-2xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
            <!-- Card -->
            <div class="bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-gray-800">
                <div class="text-center mb-2">
                    <h2 class="text-xl md:text-xl font-bold text-gray-800 dark:text-neutral-200">
                        {{ $t('summary_of_your_payment') }}
                    </h2>
                    <p class="text-sm text-gray-600 dark:text-neutral-400">
                        {{ $t('reference') }} # {{ payment.process_identifier }}
                    </p>
                </div>

                <!-- Grid -->
                <div class="mt-5 sm:mt-10 grid grid-cols-2 sm:grid-cols-2 gap-5">
                    <div>
                        <span class="block text-xs uppercase text-gray-500 dark:text-neutral-500">{{ $t('amount_paid') }}:</span>
                        <span class="block text-sm font-medium text-gray-800 dark:text-neutral-200">${{ payment.amount }}</span>
                    </div>
                    <!-- End Col -->

                    <div>
                        <span class="block text-xs uppercase text-gray-500 dark:text-neutral-500">{{ $t('date_paid') }}:</span>
                        <span class="block text-sm font-medium text-gray-800 dark:text-neutral-200">{{ new Date(payment.created_at).toLocaleString() }}</span>
                    </div>
                    <!-- End Col -->

<!--                    <div>-->
<!--                        <span class="block text-xs uppercase text-gray-500 dark:text-neutral-500">Payment method:</span>-->
<!--                        <div class="flex items-center gap-x-2">-->
<!--                            <svg class="size-5" width="400" height="248" viewBox="0 0 400 248" fill="none" xmlns="http://www.w3.org/2000/svg">-->
<!--                                <g clip-path="url(#clip0)">-->
<!--                                    <path d="M254 220.8H146V26.4H254V220.8Z" fill="#FF5F00"/>-->
<!--                                    <path d="M152.8 123.6C152.8 84.2 171.2 49 200 26.4C178.2 9.2 151.4 0 123.6 0C55.4 0 0 55.4 0 123.6C0 191.8 55.4 247.2 123.6 247.2C151.4 247.2 178.2 238 200 220.8C171.2 198.2 152.8 163 152.8 123.6Z" fill="#EB001B"/>-->
<!--                                    <path d="M400 123.6C400 191.8 344.6 247.2 276.4 247.2C248.6 247.2 221.8 238 200 220.8C228.8 198.2 247.2 163 247.2 123.6C247.2 84.2 228.8 49 200 26.4C221.8 9.2 248.6 0 276.4 0C344.6 0 400 55.4 400 123.6Z" fill="#F79E1B"/>-->
<!--                                </g>-->
<!--                                <defs>-->
<!--                                    <clipPath id="clip0">-->
<!--                                        <rect width="400" height="247.2" fill="white"/>-->
<!--                                    </clipPath>-->
<!--                                </defs>-->
<!--                            </svg>-->
<!--                            <span class="block text-sm font-medium text-gray-800 dark:text-neutral-200">•••• 4242</span>-->
<!--                        </div>-->
<!--                    </div>-->
                    <!-- End Col -->
                </div>
                <!-- End Grid -->

                <div class="mt-5 sm:mt-10 grid grid-cols-2 sm:grid-cols-2 gap-5">
                    <div>
                        <span class="block text-xs uppercase text-gray-500 dark:text-neutral-500">{{ $t('status') }}:</span>
<!--                        <span class="block text-sm font-medium text-gray-800 dark:text-neutral-200">{{ payment.status }}</span>-->
                        <span :class="classStatus">{{ payment.status }}</span>

                    </div>
                    <!-- End Col -->

                    <div>
                        <span class="block text-xs uppercase text-gray-500 dark:text-neutral-500">{{ $t('reference_to_pay') }}:</span>
                        <span class="block text-sm font-medium text-gray-800 dark:text-neutral-200">{{ payment.reference }}</span>
                    </div>
                </div>

                <div class="mt-5 sm:mt-10">
                    <h4 class="text-xs font-semibold uppercase text-gray-800 dark:text-neutral-200">{{ $t('data_payment') }}</h4>

                    <ul class="mt-3 flex flex-col" v-for="field in fields_data">
                        <li class="inline-flex items-center gap-x-2 py-3 px-4 text-sm border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:border-neutral-700 dark:text-neutral-200">
                            <div class="flex items-center justify-between w-full">
                                <span class="font-extrabold">{{ payment.site.fields[field].label }}:</span>
                                <span>{{ payment.fields_data[field] }}</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
