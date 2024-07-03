<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head, useForm} from "@inertiajs/vue3";
import Input from "@/Components/Preline/Input.vue";
import Swal from "sweetalert2";

const props = defineProps({
    category: {
        type: Object
    },
    canEdit: {
        type: Boolean,
        default: false
    }
});

const form = useForm({
    id: props.category.id,
    name: props.category.name,
});

const save = () => {
    if(props.category.id) {
        form.put(route('categories.update', props.category.id), {
            onFinish: () => {
                Swal.fire({
                    title: 'Ok!',
                    html: `Se ha actualizado correctamente el sitio <b>${props.category.name}</b>`,
                    icon: "success"
                });
            }
        });
    } else {
        form.post(route('categories.store'), {
            onFinish: () => {
                console.log(form.errors);
                Swal.fire({
                    title: 'Ok!',
                    html: `Se ha creado correctamente el sitio <b>${form.name}</b>`,
                    icon: "success"
                });
            }
        });
    }
};
</script>
<template>
    <Head :title="$t('category')" />

    <AuthenticatedLayout>
        <div>
            <!-- Form -->
            <form>
                <div class="flex justify-center mt-5">
                    <!-- Card -->
                    <div class="p-4 sm:p-7 flex flex-col bg-white rounded-2xl shadow-lg dark:bg-gray-800">
                        <div class="text-center">
                            <h1 class="block text-2xl font-bold text-gray-800 dark:text-white">
                                {{ $t('register-category') }}
                            </h1>
                        </div>
                        <form @submit.prevent="save">
                            <!-- Grid -->
                            <div class="grid grid-cols-2 gap-4 mt-3">
                                <!-- Input Group -->
                                <div class="relative col-span-full">
                                    <!-- Floating Input -->
                                    <div class="relative">
                                        <Input :data="{
                                                id: 'name',
                                                label: $t('name'),
                                                placeholder: $t('name')
                                            }"
                                               v-model="form.name"
                                               :readonly="canEdit"/>
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
