<script setup lang="ts">
import { watch } from 'vue';
import DangerButton from '@/Components/DangerButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { router } from '@inertiajs/vue3';

interface Props {
  isOpen: Boolean;
  title: String;
  uuid: String;
}
const props = defineProps<Props>();

const emit = defineEmits(['modal-open', 'modal-close']);

const onOpen = () => {
  emit('modal-open');
};
const onClose = () => {
  emit('modal-close');
};
const onDelete = () => {
  router.delete(route('projects.destroy', props.uuid), {
    onSuccess: () => {
      document.querySelector('body').style.overflowY = '';
    },
  });
};

watch(
  () => props.isOpen,
  (value: Boolean) => {
    const body = document.querySelector('body');
    if (value) {
      body.style.overflowY = 'hidden';
    } else {
      body.style.overflowY = '';
    }
  }
);
</script>

<template>
  <div class="mt-8">
    <DangerButton @click="onOpen">Delete Project</DangerButton>
  </div>

  <Teleport to="body">
    <Transition name="slide-fade">
      <div
        v-if="props.isOpen"
        class="fixed inset-0 z-50 grid place-items-center p-4"
      >
        <div
          class="absolute inset-0 bg-black bg-opacity-50"
          @click="onClose"
        ></div>

        <div
          class="relative flex max-w-lg flex-col gap-4 rounded-md bg-white p-4 shadow dark:bg-slate-500 dark:text-slate-100"
        >
          <h2 class="text-center text-2xl">
            Do you really want to delete
            <span class="font-bold">{{ props.title }}</span
            >?
          </h2>

          <div class="flex justify-end gap-4">
            <SecondaryButton @click="onClose">Cancel</SecondaryButton>
            <DangerButton @click="onDelete">Delete</DangerButton>
          </div>
        </div>
      </div>
    </Transition>
  </Teleport>
</template>

<style scoped>
.slide-fade-enter-active {
  transition: all 0.1s ease-in-out;
}

.slide-fade-leave-active {
  transition: all 0.1s ease-in-out;
}

.slide-fade-enter-from,
.slide-fade-leave-to {
  transform: translateX(20px) scale(95%);
  opacity: 0;
}
</style>
