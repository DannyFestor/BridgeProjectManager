<script setup></script>
<template>
  <header>
    <h2 class="text-lg font-medium text-gray-900 dark:text-slate-100">
      <slot />
    </h2>

    <p
      v-if="$slots.subtitle"
      class="mt-1 text-sm text-gray-600 dark:text-slate-300"
    >
      <slot name="subtitle" />
    </p>
  </header>
</template>

<style scoped></style>
