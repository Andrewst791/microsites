<script setup>
// import {computed} from "vue";
const props = defineProps({

    tabs : {
        type: Array,
        required: true
    }
});

const classesButton = 'hs-tab-active:font-semibold hs-tab-active:border-blue-600 hs-tab-active:text-blue-600 py-4 px-1 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:text-blue-500';
</script>

<template>
    <div class="border-b border-gray-200 dark:border-neutral-700">
        <nav class="flex gap-x-1" aria-label="Tabs" role="tablist" aria-orientation="horizontal">
            <button v-for="(tab, index) in tabs" type="button" :class="classesButton + `${tab.active ? ' active' : ''}`"
                    :id="`${tab.id}-item-${index}`" aria-selected="true" :data-hs-tab="`#${tab.id}-${index}`" :aria-controls="`${tab.id}-${index}`" role="tab">
                {{ tab.name }}
            </button>
        </nav>
    </div>

    <div class="mt-3">
        <div v-for="(tab, index) in tabs" :id="`${tab.id}-${index}`" :class="index > 0 ? 'hidden' : ''" role="tabpanel" :aria-labelledby="`${tab.id}-item-${index}`">
            <slot :name="`tab-${tab.id}`" class="text-gray-500 dark:text-neutral-400">
            </slot>
        </div>
    </div>
</template>

<style scoped>

</style>
