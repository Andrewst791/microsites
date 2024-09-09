<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import CardImage from "@/Components/Preline/CardImage.vue";
import { Link } from '@inertiajs/vue3';
const props = defineProps({
    sites: {
        type: Array,
    }
})
</script>

<template>
    <Head title="Inicio" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Micrositios</h2>
        </template>

        <div class="py-3">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <CardImage v-for="site in sites" :title="site.name" :url_image="site.logo" >
                        <template #body>
<!--                            <p class="mt-1 text-gray-500 dark:text-neutral-400">-->
<!--                                Some quick example text to build on the card title and make up the bulk of the card's content.-->
<!--                            </p>-->
                            <a class="mt-2 py-2 px-3 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none" href="#">
                                <Link :href="route('sites.payment', {slugId: site.slug})">
                                    {{ $t('go_to_pay') }}
                                </Link>
                            </a>
                        </template>
                    </CardImage>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
