<script setup>
import { computed } from "vue";
const props = defineProps({
    color: {
        type: String,
        default: 'blue',
    },
    classButton: {
        type: String,
        default: '',
    },
    type: {
        type: String,
        default: 'button'
    },
    onClick: {
        type: Function,
        default: () => {}
    }
});

const buttonClass = computed(() => `${this.classButton} bg-${this.color}-600 text-white hover:bg-${this.color}-700 disabled:opacity-50 disabled:pointer-events-none inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent`);

const emit = defineEmits(['handleActionParent']);
const emitAction = (id, params) => {
    emit('handleActionParent', id, params);
};
</script>
<template>
    <button :class="buttonClass" @click="emitAction">
        <slot />
    </button>
</template>
