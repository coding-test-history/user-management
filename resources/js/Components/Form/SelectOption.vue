<script setup>
import { onMounted, ref } from 'vue';

defineProps({
    modelValue: [String, Number], // Supports string or number values
    options: {
        type: Array,
        required: true,
        default: () => [], // Default to an empty array if no options are provided
    },
});

defineEmits(['update:modelValue']);

const select = ref(null);

onMounted(() => {
    if (select.value.hasAttribute('autofocus')) {
        select.value.focus();
    }
});

defineExpose({ focus: () => select.value.focus() });
</script>

<template>
    <select ref="select"
        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full"
        :value="modelValue" @change="$emit('update:modelValue', $event.target.value)">
        <option value="" disabled>Select an option</option>
        <option v-for="(option, index) in options" :key="index" :value="option.value">
            {{ option.label }}
        </option>
    </select>
</template>
