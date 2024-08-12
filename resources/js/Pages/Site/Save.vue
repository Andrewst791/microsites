<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import Input from "@/Components/Preline/Input.vue";
import Select from "@/Components/Preline/Select.vue";
import Tabs from "@/Components/Preline/Tabs.vue";
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
    },
    input_types: {
        type: Array
    }
});

let new_field = {
    type: null,
    name: null,
    label: null,
    placeholder: null,
    required: false,
}

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
    logo: props.site.logo,
    fields: props.site.fields ?? {"name": {"type": "TEXT", "label": "Nombres", "required": true, "placeholder": "Nombres"}, "email": {"type": "EMAIL", "label": "Email", "required": true, "placeholder": "Email"}, "document": {"type": "TEXT", "label": "Documento", "required": true, "placeholder": "Documento"}, "last_name": {"type": "TEXT", "label": "Apellidos", "required": true, "placeholder": "Apellidos"}, "document_type": {"type": "TEXT", "label": "Tipo Documento", "required": true, "placeholder": "Tipo Documento"}},
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

const options_input_types = computed(() =>
    props.input_types.map(item => {
        const option = {};
        option.text = item;
        option.value = item;
        return option;
    })
);

const fields_site = computed(() => {
    return form.fields ? Object.keys(form.fields) : [];
})
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

const addField = () => {
    form.fields[new_field.name] = {};
    form.fields[new_field.name].type = new_field.type;
    form.fields[new_field.name].label = new_field.label;
    form.fields[new_field.name].placeholder = new_field.placeholder;
    form.fields[new_field.name].required = new_field.required;
    save();
    resetNewField();
}

const deleteInput = (input_name) => {
    delete form.fields[input_name];
    save();
    resetNewField();
}

const resetNewField = () => {
    new_field = {
        type: null,
        name: null,
        label: null,
        placeholder: null,
        required: false,
    }
}

const tabs = [
    {id: 'basic', name: 'Básico', active: true},
    {id: 'inputs', name: 'Campos'},
];
</script>

<template>
    <Head title="Sites" />

    <AuthenticatedLayout>
        <Tabs :tabs="tabs">
            <template #tab-basic>
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
            </template>
            <template #tab-inputs>
                <div class="flex justify-center mt-5">
                    <!-- Card -->
                    <div class="p-4 sm:p-7 flex flex-col bg-white rounded-2xl shadow-lg dark:bg-gray-800">
                        <div class="text-center">
                            <h1 class="block text-2xl font-bold text-gray-800 dark:text-white">
                                {{ $t('add_fields') }}
                            </h1>
                        </div>
                        <form @submit.prevent="addField">
                            <!-- Grid -->
                            <div class="gap-4 mt-3">
                                <!-- Input Group -->
                                <div class="relative col-span-full">
                                    <!-- Floating Input -->
                                    <div class="relative">
                                        <Select :data="{
                                        id: 'input_type',
                                        label: $t('input_type'),
                                        options: options_input_types
                                    }"
                                                :error="form.errors.category_id"
                                                v-model="new_field.type"
                                                :readonly="canEdit"/>
                                    </div>
                                    <!-- End Floating Input -->
                                </div>
                                <!-- End Input Group -->

                                <!-- Input Group -->
                                <div class="relative col-span-full mt-2">
                                    <!-- Floating Input -->
                                    <div class="relative">
                                        <Input :data="{
                                        id: 'name',
                                        label: $t('name'),
                                        placeholder: '',
                                    }"
                                               v-model="new_field.name"
                                               :readonly="canEdit"/>
                                    </div>
                                    <!-- End Floating Input -->
                                </div>
                                <!-- End Input Group -->

                                <!-- Input Group -->
                                <div class="relative col-span-full mt-2">
                                    <!-- Floating Input -->
                                    <div class="relative">
                                        <Input :data="{
                                        id: 'label',
                                        label: $t('label'),
                                    }"
                                               v-model="new_field.label"
                                               :readonly="canEdit"/>
                                    </div>
                                    <!-- End Floating Input -->
                                </div>
                                <!-- End Input Group -->

                                <!-- Input Group -->
                                <div class="relative col-span-full mt-2">
                                    <!-- Floating Input -->
                                    <div class="relative">
                                        <Input :data="{
                                        id: 'placeholder',
                                        label: 'Placeholder',
                                        placeholder: '',
                                    }"
                                               v-model="new_field.placeholder"
                                               :readonly="canEdit"/>
                                    </div>
                                    <!-- End Floating Input -->
                                </div>
                                <!-- End Input Group -->

                                <!-- Input Group -->
                                <div class="relative col-span-full mt-2">
                                    <!-- Floating Input -->
                                    <div class="relative">
                                        <input v-model="new_field.required" type="checkbox" :checked="new_field.required"
                                               class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500
                                               disabled:opacity-50 disabled:pointer-events-none
                                               dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500
                                               dark:focus:ring-offset-gray-800"
                                               id="hs-default-checkbox">
                                        <label for="hs-default-checkbox" class="text-sm font-medium ml-2 dark:text-white">
                                            {{ $t('required') }}
                                        </label>
                                    </div>
                                </div>
                                <!-- End Input Group -->
                                <div class="mt-5">
                                    <button type="submit" :disabled="!canEdit" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                        <font-awesome-icon icon="fas fa-save" />
                                        {{ $t('add') }}
                                    </button>
                                </div>

                                <div class="flex flex-col mt-5">
                                    <div class="-m-1.5 overflow-x-auto">
                                        <div class="p-1.5 min-w-full inline-block align-middle">
                                            <div class="overflow-hidden">
                                                <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                                                {{ $t('input_type') }}
                                                            </th>
                                                            <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                                                {{ $t('name') }}
                                                            </th>
                                                            <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                                                {{ $t('label') }}
                                                            </th>
                                                            <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                                                {{ $t('placeholder') }}
                                                            </th>
                                                            <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-400">
                                                                {{ $t('action') }}
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                                        <tr v-for="field in fields_site">
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                                                {{ form.fields[field].type }}
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                                                {{ field }}
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                                                {{ form.fields[field].label }}
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                                                {{ form.fields[field].placeholder }}
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                                                <button @click="deleteInput(field)" type="button" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 focus:outline-none focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-400 dark:focus:text-blue-400">
                                                                    {{ $t('delete') }}
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Grid -->
                        </form>
                    </div>
                    <!-- End Card -->
                </div>
            </template>
        </Tabs>
    </AuthenticatedLayout>
</template>
