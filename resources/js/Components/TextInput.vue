<script setup>
import { onMounted, ref } from 'vue';

defineProps(['modelValue']);

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
  if (input.value.hasAttribute('autofocus')) {
    input.value.focus();
  }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
  <input
    ref="input"
    class="form-input rounded border-gray-300 text-black shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-slate-500 dark:text-slate-50 dark:focus:border-indigo-200 dark:focus:ring-indigo-200"
    :value="modelValue"
    @input="$emit('update:modelValue', $event.target.value)"
  />
</template>
