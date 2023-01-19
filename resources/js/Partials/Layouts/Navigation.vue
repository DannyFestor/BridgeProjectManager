<script setup lang="ts">
import { Project } from '@/Types/Project';
import { computed, ref } from 'vue';
import { Link, usePage, router } from '@inertiajs/vue3';
import DarkButton from '@/Partials/Layouts/DarkButton.vue';

const isOpen = ref(false);

const toggle = () => (isOpen.value = !isOpen.value);
const close = () => (isOpen.value = false);
const logout = () => {
  router.post(route('logout'));
};

const activeProject = computed<Project>(() => usePage().props.project?.data);
</script>

<template>
  <nav
    class="fixed top-0 left-0 right-0 flex h-12 justify-between bg-orange-200 shadow dark:bg-slate-900 dark:text-slate-50"
  >
    <section class="flex">
      <Link
        :href="route('dashboard')"
        class="flex h-full items-center px-4 py-1 text-3xl font-bold transition-all hover:bg-black hover:bg-opacity-10"
      >
        BPM
      </Link>
      <Link
        v-if="!!activeProject"
        :href="route('projects.edit', activeProject.uuid)"
        class="flex h-full items-center px-4 py-1 text-3xl font-bold transition-all hover:bg-black hover:bg-opacity-10"
      >
        {{ activeProject.title }}

        <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke-width="1.5"
          stroke="currentColor"
          class="ml-2 h-8 w-8"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"
          />
        </svg>
      </Link>
      <Link
        v-if="!activeProject"
        title="Create A New Project"
        :href="route('projects.create')"
        class="transistion flex h-full flex-col items-center justify-center px-4 py-1 font-bold hover:bg-black hover:bg-opacity-10"
      >
        <span class="text-3xl"> &plus; </span>
        <span class="-translate-y-[8px] text-xs">Project</span>
      </Link>
    </section>

    <section v-click-outside="close" class="relative flex items-center">
      <DarkButton />
      <button
        class="mx-2 flex h-full items-center gap-2 rounded px-2 py-1 transition hover:bg-black hover:bg-opacity-10"
        @click.prevent="toggle"
      >
        <img
          :src="$page.props.auth.user.data.avatar"
          :alt="$page.props.auth.user.data.name"
          class="h-full rounded-full"
        />

        {{ $page.props.auth.user.data.name }}
      </button>

      <Transition name="slide-fade">
        <section
          v-if="isOpen"
          class="absolute top-12 right-2 flex w-[250px] flex-col bg-white shadow dark:bg-slate-700"
        >
          <section class="flex items-center justify-end">
            <span class="mx-auto">Menu</span>

            <button
              class="px-3 py-2 hover:bg-black hover:bg-opacity-10"
              @click="close"
            >
              &cross;
            </button>
          </section>
          <hr />
          <Link
            :href="route('profile.edit')"
            class="cursor-pointer p-2 transition-all hover:bg-black hover:bg-opacity-10"
          >
            Settings
          </Link>
          <form @submit.prevent="logout">
            <button
              type="submit"
              class="h-full w-full p-2 text-left transition-all hover:bg-black hover:bg-opacity-10"
            >
              Logout
            </button>
          </form>
        </section>
      </Transition>
    </section>
  </nav>
</template>

<style>
.slide-fade-enter-active {
  transition: all 0.1s ease-in-out;
}

.slide-fade-leave-active {
  transition: all 0.1s ease-in-out;
}

.slide-fade-enter-from,
.slide-fade-leave-to {
  transform: translateX(20px) scale(90%);
  opacity: 0;
}
</style>
