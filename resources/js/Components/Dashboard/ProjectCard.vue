<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

defineProps({
  uuid: {
    type: String,
    required: true,
  },
  color: {
    type: String,
    required: false,
    default: '#000',
  },
  direction: {
    type: String,
    required: false,
    default: '90',
  },
  from: {
    type: String,
    required: false,
    default: '#FFF',
  },
  to: {
    type: String,
    required: false,
    default: '#FFF',
  },
  isOwner: {
    type: Boolean,
    required: false,
    default: false,
  },
});
</script>
<template>
  <Link
    :href="route('projects.show', uuid)"
    class="flex h-[100px] w-[250px] flex-col justify-end rounded bg-orange-100 px-4 py-2 shadow transition hover:bg-orange-200 dark:bg-slate-800 dark:hover:bg-slate-700"
    :style="{
      color: color,
      background: `linear-gradient(${direction}deg, ${from}, ${to})`,
    }"
  >
    <div v-if="isOwner" class="mb-auto text-right text-sm">Owner</div>
    <div class="w-full overflow-x-hidden text-center font-bold">
      <slot>No title set</slot>
    </div>
  </Link>
</template>

<style scoped></style>
