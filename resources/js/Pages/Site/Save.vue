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
    categories: {
        type: Array,
    },
    document_types: {
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
const save = () => {
    if(props.site.id) {
        form.put(route('sites.update', props.site.id), {
            // onFinish: () => form.get(route('sites.index')),
            onFinish: () => {
                Swal.fire({
                    title: 'Ok!',
                    html: `Se ha actualizado correctamente el sitio <b>${props.site.name}</b>`,
                    icon: "success"
                });
            }
        });
    } else {
        form.post(route('sites.store'), {
            // onFinish: () => form.get(route('sites.index')),
            onFinish: () => {
                if(Array.isArray(Object.keys(form.errors)) && Object.keys(form.errors).length > 0) {
                    let errors = '<ul>';
                    Object.keys(form.errors).forEach(error => {
                        errors = errors + `<li><b>${form.errors[error]}</b></li>`;
                    });
                    errors = errors + '</ul>';

                    Swal.fire({
                        title: 'Error!',
                        html: `Se han presentado los siguientes errores: ${errors}`,
                        icon: "error"
                    });
                } else {
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
                                        v-model="form.document_type" />
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
                                            v-model="form.document"></Input>
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
                                       v-model="form.name"/>
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
                                       v-model="form.slug"></Input>
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
                                        v-model="form.category_id"/>
                                    </div>
                                    <!-- End Floating Input -->
                                </div>
                                <!-- End Input Group -->
                            </div>
                            <!-- End Grid -->
                            <div class="mt-5">
                                <button type="submit" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
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
