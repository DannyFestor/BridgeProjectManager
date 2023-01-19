<script setup lang="ts">
import { Projects } from '@/Types/Project';

interface Props {
  projects: Projects;
}

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import OuterContainer from '@/Components/OuterContainer.vue';
import InnerContainer from '@/Components/InnerContainer.vue';

const props = defineProps<Props>();
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <OuterContainer>
      <InnerContainer class="flex flex-wrap gap-8">
        <article v-for="project in props.projects.data" :key="project.uuid">
          <Link
            :href="route('projects.show', project.uuid)"
            class="flex h-[100px] w-[250px] flex-col justify-end rounded bg-orange-100 px-4 py-2 shadow transition hover:bg-orange-200 dark:bg-slate-800 dark:hover:bg-slate-700"
            :style="{
              color: `${project.settings?.font ?? '#000'}`,
              background: `linear-gradient(${
                project.settings?.direction ?? '90'
              }deg, ${project.settings?.from ?? '#FFF'}, ${
                project.settings?.to ?? '#FFF'
              })`,
            }"
          >
            <div v-if="project.isOwner" class="mb-auto text-right text-sm">
              Owner
            </div>
            <div class="w-full overflow-x-hidden text-center font-bold">
              {{ project.title }}
            </div>
          </Link>
        </article>
      </InnerContainer>
    </OuterContainer>
  </AuthenticatedLayout>
</template>
