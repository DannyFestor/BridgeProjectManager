<script setup lang="ts">
import { ProjectWrap } from '@/Types/Project';

interface Props {
  project: ProjectWrap;
}

import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import OuterContainer from '@/Components/OuterContainer.vue';
import InnerContainer from '@/Components/InnerContainer.vue';
import ContainerHeader from '@/Components/ContainerHeader.vue';

const props = defineProps<Props>();
</script>

<template>
  <Head title="Show Project" />

  <AuthenticatedLayout>
    <OuterContainer>
      <InnerContainer>
        <ContainerHeader> Show a Project </ContainerHeader>

        <section>TODO: Show boards, members, filters, yada yada yada</section>
      </InnerContainer>
    </OuterContainer>
  </AuthenticatedLayout>
</template>
