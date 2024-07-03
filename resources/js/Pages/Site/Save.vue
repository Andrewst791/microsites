<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import Input from "@/Components/Preline/Input.vue";
import Select from "@/Components/Preline/Select.vue";
import {computed} from "vue";
import Swal from "sweetalert2";

const props = defineProps({
    site: {
        type: Object,
    },
    canEdit: {
        type: Boolean,
        default: false
    },
    categories: {
        type: Array,
    },
    currencies: {
        type: Array,
    },
    document_types: {
        type: Array,
    },
    site_types: {
        type: Array,
    }
});

const form = useForm({
    id: props.site.id,
    name: props.site.name,
    slug: props.site.slug,
    document: props.site.document,
    document_type: props.site.document_type,
    category_id: props.site.category_id,
    currency_id: props.site.currency_id,
    expires_at: props.site.expires_at,
    site_type: props.site.site_type,
});

const options_document_types = computed(() =>
    props.document_types.map(item => {
        const option = {};
        option.text = item;
        option.value = item;
        return option;
    })
);

const options_categories = computed(() =>
    props.categories.map(item => {
        const option = {};
        option.text = item.name;
        option.value = item.id;
        return option;
    })
);

const options_currencies = computed(() =>
    props.currencies.map(item => {
        const option = {};
        option.text = `${item.code} - ${item.name}`;
        option.value = item.id;
        return option;
    })
);

const options_site_types = computed(() =>
    props.site_types.map(item => {
        const option = {};
        option.text = item;
        option.value = item;
        return option;
    })
);
const save = () => {
    if(props.site.id) {
        form.put(route('sites.update', props.site.id), {
            onFinish: () => {
                if(!form.hasErrors) {
                    Swal.fire({
                        title: 'Ok!',
                        html: `Se ha actualizado correctamente el sitio <b>${props.site.name}</b>`,
                        icon: "success"
                    });
                }
            }
        });
    } else {
        form.post(route('sites.store'), {
            onFinish: () => {
                if(!form.hasErrors) {
                    Swal.fire({
                        title: 'Ok!',
                        html: `Se ha creado correctamente el sitio <b>${form.name}</b>`,
                        icon: "success"
                    });
                }
            }
        });
    }
};
</script>

<template>
    <Head title="Sites" />

    <AuthenticatedLayout>
        <div>
            <!-- Form -->
            <form>
                <div class="flex justify-center mt-5">
                    <!-- Card -->
                    <div class="p-4 sm:p-7 flex flex-col bg-white rounded-2xl shadow-lg dark:bg-gray-800">
                        <div class="text-center">
                            <h1 class="block text-2xl font-bold text-gray-800 dark:text-white">
                                {{ $t('register-site') }}
                            </h1>
                        </div>
                        <form @submit.prevent="save">
                            <!-- Grid -->
                            <div class="grid grid-cols-2 gap-4 mt-3">
                                <!-- Input Group -->
                                <div>
                                    <!-- Floating Input -->
                                    <div class="relative">
                                        <Select :data="{
                                            id: 'document_type',
                                            label: $t('document_type'),
                                            options: options_document_types,
                                        }"
                                        :error="form.errors.document_type"
                                        v-model="form.document_type"
                                        :readonly="canEdit"/>
                                    </div>
                                    <!-- End Floating Input -->
                                </div>
                                <!-- End Input Group -->

                                <!-- Input Group -->
                                <div>
                                    <!-- Floating Input -->
                                    <div class="relative">
                                        <div class="max-w-sm">
                                            <Input :data="{
                                                    id: 'document',
                                                    label: $t('document'),
                                                    placeholder: $t('document')
                                                }"
                                               :error="form.errors.document"
                                                v-model="form.document"
                                                :readonly="canEdit"
                                            />
                                        </div>
                                    </div>
                                    <!-- End Floating Input -->
                                </div>
                                <!-- End Input Group -->

                                <!-- Input Group -->
                                <div>
                                    <!-- Floating Input -->
                                    <div class="relative">
                                        <Input :data="{
                                                id: 'name',
                                                label: $t('name'),
                                                placeholder: $t('name')
                                            }"
                                       :error="form.errors.name"
                                       v-model="form.name"
                                       :readonly="canEdit"/>
                                    </div>
                                    <!-- End Floating Input -->
                                </div>
                                <!-- End Input Group -->

                                <!-- Input Group -->
                                <div>
                                    <!-- Floating Input -->
                                    <div class="relative">
                                        <Input :data="{
                                                id: 'slug',
                                                label: $t('slug'),
                                                placeholder: $t('slug')
                                            }"
                                       :error="form.errors.slug"
                                       v-model="form.slug"
                                       :readonly="canEdit"></Input>
                                    </div>
                                    <!-- End Floating Input -->
                                </div>
                                <!-- End Input Group -->

                                <!-- Input Group -->
                                <div>
                                    <!-- Floating Input -->
                                    <div class="relative">
                                        <Input :data="{
                                                id: 'expires_at',
                                                label: $t('expires_at'),
                                                placeholder: $t('expires_at'),
                                                type: 'date'
                                            }"
                                               :error="form.errors.expires_at"
                                               v-model="form.expires_at"
                                               :readonly="canEdit"></Input>
                                    </div>
                                    <!-- End Floating Input -->
                                </div>
                                <!-- End Input Group -->

                                <!-- Input Group -->
                                <div>
                                    <!-- Floating Input -->
                                    <div class="relative">
                                        <Select :data="{
                                            id: 'site_type',
                                            label: $tc('site_type', 1),
                                            options: options_site_types
                                        }"
                                                :error="form.errors.site_type"
                                                v-model="form.site_type"
                                                :readonly="canEdit"/>
                                    </div>
                                    <!-- End Floating Input -->
                                </div>
                                <!-- End Input Group -->

                                <!-- Input Group -->
                                <div class="relative col-span-full">
                                    <!-- Floating Input -->
                                    <div class="relative">
                                        <Select :data="{
                                            id: 'category',
                                            label: $tc('category', 1),
                                            options: options_categories
                                        }"
                                        :error="form.errors.category_id"
                                        v-model="form.category_id"
                                        :readonly="canEdit"/>
                                    </div>
                                    <!-- End Floating Input -->
                                </div>
                                <!-- End Input Group -->

                                <!-- Input Group -->
                                <div class="relative col-span-full">
                                    <!-- Floating Input -->
                                    <div class="relative">
                                        <Select :data="{
                                            id: 'currency',
                                            label: $tc('currency', 1),
                                            options: options_currencies
                                        }"
                                                :error="form.errors.currency_id"
                                                v-model="form.currency_id"
                                                :readonly="canEdit"/>
                                    </div>
                                    <!-- End Floating Input -->
                                </div>
                                <!-- End Input Group -->

                                <!-- Input Group -->
                                <div class="relative col-span-full">
                                    <!-- Floating Input -->
                                    <div class="relative">
                                        <Input :data="{
                                            id: 'logo',
                                            label: $tc('logo', 1),
                                            placeholder: 'https://domain.com/route_img.png',
                                        }"
                                                v-model="form.logo"
                                                :readonly="canEdit"/>
                                    </div>
                                    <!-- End Floating Input -->
                                </div>
                                <!-- End Input Group -->
                            </div>
                            <!-- End Grid -->
                            <div class="mt-5">
                                <button type="submit" :disabled="!canEdit" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                    <font-awesome-icon icon="fas fa-save" />
                                    {{ $t('save') }}
                                </button>
                            </div>
                        </form>
                    </div>
                    <!-- End Card -->
                </div>
            </form>
            <!-- End Form -->
        </div>
    </AuthenticatedLayout>
</template>
