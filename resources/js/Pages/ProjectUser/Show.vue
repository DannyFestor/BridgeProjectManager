<script setup lang="ts">
import { ProjectUser } from '@/Types/ProjectUser';
import { Head, useForm, Link } from '@inertiajs/vue3';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import OuterContainer from '@/Components/OuterContainer.vue';
import InnerContainer from '@/Components/InnerContainer.vue';
import ContainerHeader from '@/Components/ContainerHeader.vue';
import Delete from './Delete.vue';
import { ProjectWrap } from '@/Types/Project';
import { computed } from 'vue';
import UserList from '@/Partials/ProjectUser/UserList.vue';

interface IProps {
  users: ProjectUser[];
  project: ProjectWrap;
}

const props = defineProps<IProps>();

const owner = computed<ProjectUser[]>(() => {
  return props.users.filter((user) => user.is_owner === true);
});

const manager = computed<ProjectUser[]>(() => {
  return props.users.filter(
    (user) => user.is_manager === true && user.is_owner === false
  );
});

const users = computed<ProjectUser[]>(() => {
  return props.users.filter(
    (user) => user.is_manager === false && user.is_owner === false
  );
});
</script>

<template>
  <Head title="Show A Projects Users" />
  <AuthenticatedLayout>
    <OuterContainer>
      <ContainerHeader>
        User Control
        <template #subtitle> Add or Remove Users </template>
      </ContainerHeader>

      <div
        class="flex flex-col space-y-8 divide-y-2 divide-slate-800 dark:divide-slate-100"
      >
        <UserList :project="props.project" :users="owner">Owner</UserList>
        <UserList :project="props.project" :users="manager">Manager</UserList>
        <UserList :project="props.project" :users="users">Users</UserList>
      </div>
    </OuterContainer>
  </AuthenticatedLayout>
</template>
