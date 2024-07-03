<script setup>
const value = defineModel();

const props = defineProps({
    data: { type: Object },
    readonly: { type: Boolean, default: false },
    required: { type: Boolean, default: false },
    error: { type: String },
})
const emit = defineEmits(['update:valueModel']);
const emitUpdate = () => {
    emit('update:valueModel', value);
}
</script>

<template>
    <label :for="data.id" class="block text-sm font-medium mb-2 dark:text-white">
        {{ data.label }}
    </label>
    <input :type="data?.type ?? 'text'" :id="data.id" :name="data?.name ?? data.id" v-model="value" @input="emitUpdate" :readonly="!readonly"
           class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
           :placeholder="data?.placeholder" :required="required">
    <p v-if="error" class="text-sm text-red-600 mt-2" id="hs-validation-name-error-helper">
        {{ error }}
    </p>
</template>

<style scoped>

</style>
