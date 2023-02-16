<script setup lang="ts">
import { Project } from '@/Types/Project';
import { computed, ref } from 'vue';
import { Link, usePage, router } from '@inertiajs/vue3';
import DarkButton from '@/Partials/Layouts/DarkButton.vue';
import { AuthUser } from '@/Types/User';

const isOpen = ref(false);

const toggle = () => (isOpen.value = !isOpen.value);
const close = () => (isOpen.value = false);
const logout = () => {
  router.post(route('logout'));
};

const activeProject = computed<Project>(() => usePage().props.project?.data);
const canUpdate = computed<Boolean>(() => !!usePage().props.can_update);
const user = computed<AuthUser>(() => usePage().props.auth.user.data);
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
        :href="route('projects.show', activeProject.uuid)"
        class="flex h-full items-center px-4 py-1 text-3xl font-bold transition-all hover:bg-black hover:bg-opacity-10"
      >
        {{ activeProject.title }}
      </Link>
      <Link
        v-if="!!activeProject"
        :href="
          route('projects.users.edit', {
            project: activeProject.uuid,
            user: user.uuid,
          })
        "
        class="flex h-full items-center px-4 py-1 text-3xl font-bold transition-all hover:bg-black hover:bg-opacity-10"
      >
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
            d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 011.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.56.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.893.149c-.425.07-.765.383-.93.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 01-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.397.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 01-.12-1.45l.527-.737c.25-.35.273-.806.108-1.204-.165-.397-.505-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.107-1.204l-.527-.738a1.125 1.125 0 01.12-1.45l.773-.773a1.125 1.125 0 011.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894z"
          />
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
          />
        </svg>
      </Link>
      <Link
        v-if="!!activeProject && canUpdate"
        :href="route('projects.edit', activeProject.uuid)"
        class="flex h-full items-center px-4 py-1 text-3xl font-bold transition-all hover:bg-black hover:bg-opacity-10"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke-width="1.5"
          stroke="currentColor"
          class="h-8 w-8"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"
          />
        </svg>
      </Link>
      <Link
        v-if="!!activeProject && canUpdate"
        :href="route('projects.users.show', activeProject.uuid)"
        class="flex h-full items-center px-4 py-1 text-3xl font-bold transition-all hover:bg-black hover:bg-opacity-10"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke-width="1.5"
          stroke="currentColor"
          class="h-8 w-8"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"
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
