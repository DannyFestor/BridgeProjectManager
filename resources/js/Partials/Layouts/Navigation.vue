<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import DarkButton from '@/Partials/Layouts/DarkButton.vue';

const isOpen = ref(false);

const toggle = () => (isOpen.value = !isOpen.value);
const close = () => (isOpen.value = false);
const logout = () => {
  Inertia.post(route('logout'));
};
</script>

<template>
  <nav
    class="fixed top-0 left-0 right-0 flex h-12 justify-between bg-orange-200 shadow dark:bg-slate-900 dark:text-slate-50"
  >
    <section class="flex">
      <Link
        :href="route('dashboard')"
        class="flex h-full items-center px-4 py-1 text-3xl font-bold transition-all hover:bg-black hover:bg-opacity-10"
        >BPM</Link
      >

      <Link
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
          :src="$page.props.auth.user.avatar"
          :alt="$page.props.auth.user.name"
          class="h-full rounded-full"
        />

        {{ $page.props.auth.user.name }}
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
