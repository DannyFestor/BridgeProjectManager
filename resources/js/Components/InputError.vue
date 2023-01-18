<script setup>
defineProps(['message']);
</script>

<template>
  <div v-show="message">
    <p class="w-full text-sm text-red-600 dark:text-red-200">
      {{ message }}
    </p>
  </div>
</template>
