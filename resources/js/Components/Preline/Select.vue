<script setup>
import {ref, watch} from "vue";

const value = defineModel();

const props = defineProps({
    data: { type: Object },
})
const emit = defineEmits(['update:valueModel']);
const emitUpdate = () => {
    emit('update:valueModel', value);
}
</script>

<template>
    <label for="document_type" class="block text-sm font-medium mb-2 dark:text-white">
        {{ data.label }}
    </label>
    <select :id="data.id" :name="data?.name ?? data.id" v-model="value" @change="emitUpdate"
        class="py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
        <option value=""></option>
        <option v-for="option in data.options" :value="option.value">
            {{ option.text }}
        </option>
    </select>
</template>

<style scoped>

</style>
