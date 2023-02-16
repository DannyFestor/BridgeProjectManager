<script setup lang="ts">
import Delete from '@/Pages/ProjectUser/Delete.vue';
import { ProjectUser } from '@/Types/ProjectUser';
import { ProjectWrap } from '@/Types/Project';

import { Link } from '@inertiajs/vue3';

interface IProps {
  users: ProjectUser[];
  project: ProjectWrap;
}
const props = defineProps<IProps>();
</script>
<template>
  <div class="pt-8">
    <h2 class="mb-4 text-xl font-bold dark:text-white"><slot /></h2>
    <ul class="flex flex-col gap-4">
      <li
        v-for="user in props.users"
        :key="user.uuid"
        class="flex gap-2 rounded bg-white px-4 py-2 text-slate-900 shadow dark:bg-slate-600 dark:text-slate-100"
      >
        <div class="flex-1">{{ user.email }}</div>
        <Link
          v-if="!user.is_owner && !user.is_manager"
          :href="
            route('projects.users.update.manager', {
              project: props.project.data.uuid,
              user: user.uuid,
            })
          "
          method="patch"
          :data="{ is_manager: true }"
          as="button"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="h-6 w-6 text-emerald-600"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"
            />
          </svg>
        </Link>
        <Link
          v-if="
            !user.is_owner &&
            user.is_manager &&
            user.uuid !== $page.props.auth.user.data.uuid
          "
          :href="
            route('projects.users.update.manager', {
              project: props.project.data.uuid,
              user: user.uuid,
            })
          "
          method="patch"
          :data="{ is_manager: false }"
          as="button"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="h-6 w-6 text-red-600"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"
            />
          </svg>
        </Link>
        <Delete
          v-if="!user.is_owner && $page.props.auth.user.data.uuid !== user.uuid"
          :user="user"
          :project="props.project.data"
        />
      </li>
    </ul>
  </div>
</template>
