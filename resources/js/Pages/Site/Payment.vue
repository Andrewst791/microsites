<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm, usePage } from "@inertiajs/vue3";
import {computed, onMounted, ref} from "vue";
import Input from "@/Components/Preline/Input.vue";
const page = usePage();
import Swal from "sweetalert2";

const props = defineProps({
    site: {
        type: Object,
    }
});
const fields_site = computed(() => {
    return props.site.fields ? Object.keys(props.site.fields) : [];
});

const form = useForm({
    reference:          null,
    description:        null,
    amount:             0,
    currency_id:        props.site.currency_id,
    status:             'PENDING',
    gateway:            'placetopay',
    process_identifier: null,
    expiration:         props.site.expires_at,
    fields_data:        getFieldsData(),
    site_id:            props.site.id,
    user_id:            page.props.auth.user.id
});

function getFieldsData (){
    const field_data = {};
    for(const field in props.site.fields) {
        field_data[field] = null;
    }
    return field_data;
}

onMounted(() => {
});

const save = () => {
    form.post(route('payments.store'), {
        onError: (errors) => {
            console.log('error', errors);
        },
        onSuccess: (success) => {
            console.log('success', success);
        },
        onFinish: (response) => {
            console.log('finish', response);
        }
    });
}
</script>

<template>
    <Head title="Realizar Pago" />

    <AuthenticatedLayout>
        <!-- Card Section -->
        <div class="max-w-2xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
            <!-- Card -->
            <div class="bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-gray-800">
                <div class="text-center mb-2">
                    <h2 class="text-3xl md:text-3xl font-bold text-gray-800 dark:text-neutral-200">
                        {{ $t('do_payment') }}
                    </h2>
                    <p class="text-sm text-gray-600 dark:text-neutral-400">
                        {{ $t('please_contact_data') }}
                    </p>
                </div>

                <form @submit.prevent="save">
                    <!-- Section -->
                    <div class="py-2 first:pt-0 last:pb-0 border-t first:border-transparent border-gray-200 dark:border-neutral-700 dark:first:border-transparent">
                        <label for="af-payment-billing-contact" class="inline-block text-md font-medium dark:text-white">
                            {{ $t('contact_data') }}
                        </label>

                        <div class="mt-2 space-y-3">
                            <Input v-for="field in fields_site" :data="{
                                                id: field,
                                                label: site.fields[field].label,
                                                placeholder: site.fields[field].placeholder
                                            }"
                                   v-model="form.fields_data[field]"
                                   :readonly="true"
                                   :required="site.fields[field].required"
                            />
<!--                            <input id="af-payment-billing-contact" type="text" class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="First Name">-->
<!--                            <input type="text" class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="Last Name">-->
<!--                            <input type="text" class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="Phone Number">-->

                            <Input :data="{
                                                id: 'amount',
                                                label: 'Valor a Pagar',
                                                type: 'number'
                                            }"
                                   v-model="form.amount"
                                   :readonly="true"
                            />
                        </div>
                    </div>
                    <!-- End Section -->
                    <div class="mt-5 flex justify-end gap-x-2">
                        <a type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                            <Link :href="route('home')">
                                {{ $t('cancel') }}
                                <font-awesome-icon icon="fas fa-times-circle" />
                            </Link>
                        </a>
                        <button type="submit" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                            {{ $t('go_to_pay') }}
                            <font-awesome-icon icon="fas fa-arrow-alt-circle-right" />
                        </button>
                    </div>
                </form>

            </div>
            <!-- End Card -->
        </div>
        <!-- End Card Section -->
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
