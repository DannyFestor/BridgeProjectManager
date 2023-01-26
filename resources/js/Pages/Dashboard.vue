<script setup lang="ts">
import { Projects } from '@/Types/Project';

interface Props {
  projects: Projects;
}

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import OuterContainer from '@/Components/OuterContainer.vue';
import Draggable from 'vuedraggable';
import ProjectCard from '@/Components/Dashboard/ProjectCard.vue';
import { ref } from 'vue';

const props = defineProps<Props>();
const cards = ref(props.projects.data || []);

const onChange = (e) => {
  if (e.moved) {
    onMoved(e.moved.element.uuid, e.moved.oldIndex, e.moved.newIndex);
  }
};

const onMoved = (uuid: String, oldIndex: Number, newIndex: Number) => {
  console.log(uuid, oldIndex, newIndex);
  router.patch(route('projects.update.order', { project: uuid }), {
    old: oldIndex + 1,
    new: newIndex + 1,
  });
};
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <OuterContainer>
      <Draggable
        v-model="cards"
        group="cards"
        @change="onChange"
        item-key="uuid"
        class="flex flex-wrap gap-8"
      >
        <template #item="{ element }">
          <ProjectCard
            :uuid="element.uuid"
            :color="element.settings?.font"
            :direction="element.settings?.direction"
            :from="element.settings?.from"
            :to="element.settings?.to"
            :is-owner="element.isOwner"
          >
            {{ element.title }}
          </ProjectCard>
        </template>
      </Draggable>
    </OuterContainer>
  </AuthenticatedLayout>
</template>
