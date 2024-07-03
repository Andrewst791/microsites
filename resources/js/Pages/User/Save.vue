<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import Input from "@/Components/Preline/Input.vue";
import Checkbox from "@/Components/Preline/Checkbox.vue";
import {ref, watchEffect, computed} from "vue";
import Swal from "sweetalert2";
import Select from "@/Components/Preline/Select.vue";

const props = defineProps({
    user: {
        type: Object,
        default: {
            id: null,
            name: null,
            email: null,
            password: null,
            password_confirmation: null,
            role: null
        }
    },
    canEdit: {
        type: Boolean,
        default: false
    },
    roles: {
        type: Array,
    }
});

watchEffect(() => {
    // console.log(props.user);
});

const optionsRoles = computed(() => props.roles.map(role => ({ text: role.name, value: role.name })))

const form = useForm({
    id: props.user.id,
    name: props.user.name,
    email: props.user.email,
    password: props.user.password,
    password_confirmation: props.user.password_confirmation,
    role: props.user.role,
});

const save = () => {
    console.log('save', form)
    if(props.user.id) {
        form.put(route('users.update', props.user.id), {
            onFinish: () => {
                if(!form.hasErrors) {
                    showAlert(`Se ha actualizado correctamente el usuario <b>${props.user.name}</b>`);
                }
            }
        });
    } else {
        form.post(route('users.store'), {
            onFinish: () => {
                if(!form.hasErrors) {
                    showAlert(`Se ha creado correctamente el usuario <b>${form.name}</b>`);
                }
            }
        });
    }
};

const showAlert = (message) => {
    Swal.fire({
        title: 'Ok!',
        html: message,
        icon: "success"
    });
}
</script>

<template>
    <Head title="Users" />

    <AuthenticatedLayout>
        <div>
            <!-- Form -->
            <form>
                <div class="flex justify-center mt-5">
                    <!-- Card -->
                    <div class="p-4 sm:p-7 flex flex-col bg-white rounded-2xl shadow-lg dark:bg-gray-800 w-1/2">
                        <div class="text-center">
                            <h1 class="block text-2xl font-bold text-gray-800 dark:text-white">
                                {{ $t('register_user') }}
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
                                               :error="form.errors.name"
                                               v-model="form.name"
                                               :readonly="canEdit"
                                               :required="true"
                                        />
                                    </div>
                                    <!-- End Floating Input -->
                                </div>
                                <!-- End Input Group -->

                                <!-- Input Group -->
                                <div class="relative col-span-full">
                                    <!-- Floating Input -->
                                    <div class="relative">
                                        <Input :data="{
                                                id: 'email',
                                                label: $t('email'),
                                                placeholder: $t('email'),
                                                type: 'email',
                                            }"
                                               :error="form.errors.email"
                                               v-model="form.email"
                                               :required="true"
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
                                                id: 'password',
                                                label: $t('password'),
                                                placeholder: $t('password'),
                                                type: 'password'
                                            }"
                                               :error="form.errors.password"
                                               v-model="form.password"
                                               :readonly="canEdit"></Input>
                                    </div>
                                    <!-- End Floating Input -->
                                </div>
                                <!-- End Input Group -->

                                <!-- Input Group -->
                                <div class="relative col-span-full">
                                    <!-- Floating Input -->
                                    <div class="relative">
                                        <Input :data="{
                                                id: 'password_confirmation',
                                                label: $t('password_confirmation'),
                                                placeholder: $t('password_confirmation'),
                                                type: 'password'
                                            }"
                                               v-model="form.password_confirmation"
                                               :readonly="canEdit"></Input>
                                    </div>
                                    <!-- End Floating Input -->
                                </div>
                                <!-- End Input Group -->

                                <!-- Input Group -->
<!--                                <div class="relative col-span-full" v-for="(role, index) in roles" :key="role.id">-->
<!--                                    &lt;!&ndash; Floating Input &ndash;&gt;-->
<!--                                    <div class="relative">-->
<!--                                        <Checkbox :data="{-->
<!--                                                id: role.id,-->
<!--                                                label: $t(role.name)-->
<!--                                            }"-->
<!--                                               v-model="form.roles[index][role.name]"-->
<!--                                               :readonly="canEdit"></Checkbox>-->
<!--                                    </div>-->
<!--                                    &lt;!&ndash; End Floating Input &ndash;&gt;-->
<!--                                </div>-->
                                <!-- End Input Group -->

                                <!-- Input Group -->
                                <div class="relative col-span-full">
                                    <!-- Floating Input -->
                                    <div class="relative">
                                        <Select :data="{
                                            id: 'role',
                                            label: $tc('role', 1),
                                            options: optionsRoles
                                        }"
                                                v-model="form.role"
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

<style scoped>

</style>
