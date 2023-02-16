<script setup lang="ts">
import { ref, watch } from 'vue';
import DangerButton from '@/Components/DangerButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { router } from '@inertiajs/vue3';
import { ProjectUser } from '@/Types/ProjectUser';
import { Project } from '@/Types/Project';

interface Props {
  user: ProjectUser;
  project: Project;
}
const props = defineProps<Props>();

const isOpen = ref<boolean>(false);

const onOpen = () => {
  console.log('OPEN');
  isOpen.value = true;
};
const onClose = () => {
  isOpen.value = false;
};
const onDelete = () => {
  router.delete(
    route('projects.users.destroy', {
      project: props.project.uuid,
      user: props.user.uuid,
    }),
    {
      onFinish: () => {
        isOpen.value = false;
      },
    }
  );
};

watch(isOpen, (value: Boolean) => {
  const body = document.querySelector('body');
  if (value) {
    body.style.overflowY = 'hidden';
  } else {
    body.style.overflowY = '';
  }
});
</script>

<template>
  <button @click="onOpen" class="text-pink-800 dark:text-pink-300">
    <svg
      xmlns="http://www.w3.org/2000/svg"
      fill="none"
      viewBox="0 0 24 24"
      stroke-width="1.5"
      stroke="currentColor"
      class="h-6 w-6"
    >
      <path
        stroke-linecap="round"
        stroke-linejoin="round"
        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
      />
    </svg>
  </button>

  <Teleport to="body">
    <Transition name="slide-fade">
      <div v-if="isOpen" class="fixed inset-0 z-50 grid place-items-center p-4">
        <div
          class="absolute inset-0 bg-black bg-opacity-50"
          @click="onClose"
        ></div>

        <div
          class="relative flex max-w-lg flex-col gap-4 rounded-md bg-white p-4 shadow dark:bg-slate-500 dark:text-slate-100"
        >
          <h2 class="text-center text-2xl">
            Do you really want to remove
            <span class="font-bold"
              >{{ props.user.user_name }} ({{ props.user.email }})</span
            >
            from {{ props.project.title }}?
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
