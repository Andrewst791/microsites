<script setup>
import {ref, watch} from "vue";

const value = defineModel();

const props = defineProps({
    data: { type: Object },
    readonly: { type: Boolean, default: false },
    error: { type: String, default: '' },
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
    <select :id="data.id" :name="data?.name ?? data.id" v-model="value" @change="emitUpdate" :disabled="!readonly"
        class="py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
        <option value=""></option>
        <option v-for="option in data.options" :value="option.value">
            {{ option.text }}
        </option>
    </select>
    <p v-if="error" class="text-sm text-red-600 mt-2" id="hs-validation-name-error-helper">
        {{ error }}
    </p>
</template>

<style scoped>

</style>
