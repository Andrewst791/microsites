<script setup>
const props = defineProps({
    title: {
        type: String,
    },
    url_image: {
        type: String,
    }
})

const url_image_default = 'https://images.unsplash.com/photo-1680868543815-b8666dba60f7?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=320&q=80';
</script>

<template>
    <div class="flex flex-col bg-white shadow-sm rounded-xl dark:bg-gray-800">
        <img class="w-full h-40 rounded-t-xl"
             :src="url_image ?? url_image_default"
             alt="Card Image">
        <div class="p-4 md:p-5">
            <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                {{ title }}
            </h3>
            <slot name="body"></slot>
        </div>
    </div>
</template>

<style scoped>

</style>
