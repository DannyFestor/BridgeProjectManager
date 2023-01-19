<script setup>
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import OuterContainer from '@/Components/OuterContainer.vue';
import InnerContainer from '@/Components/InnerContainer.vue';
import ContainerHeader from '@/Components/ContainerHeader.vue';
</script>

<template>
  <Head title="Show Project" />

  <AuthenticatedLayout>
    <OuterContainer>
      <InnerContainer>
        <ContainerHeader> Show A Project </ContainerHeader>
      </InnerContainer>
    </OuterContainer>
  </AuthenticatedLayout>
</template>
