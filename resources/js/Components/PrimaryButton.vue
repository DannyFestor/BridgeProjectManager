<script setup>
defineProps({
  type: {
    type: String,
    default: 'submit',
  },
});
</script>

<template>
  <button
    :type="type"
    class="rounded-md border border-transparent bg-sky-800 px-4 py-2 text-sm font-semibold uppercase tracking-widest text-sky-100 text-white transition-all duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900 dark:bg-sky-200 dark:text-sky-800 dark:hover:bg-sky-300"
  >
    <slot />
  </button>
</template>
