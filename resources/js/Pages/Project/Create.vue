<script setup>
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import OuterContainer from '@/Components/OuterContainer.vue';
import InnerContainer from '@/Components/InnerContainer.vue';
import ContainerHeader from '@/Components/ContainerHeader.vue';

const onSubmit = () => {
  console.log('submit');
};
</script>

<template>
  <Head title="Create Project" />

  <AuthenticatedLayout>
    <OuterContainer>
      <InnerContainer>
        <ContainerHeader>
          Create A New Project
          <template #subtitle>
            Just fill out the form and begin working on your next dream project
          </template>
        </ContainerHeader>

        <form @submit.prevent="onSubmit"></form>
      </InnerContainer>
    </OuterContainer>
  </AuthenticatedLayout>
</template>
