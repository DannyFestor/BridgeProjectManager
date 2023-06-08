<script setup lang="ts">
import { ProjectUser } from '@/Types/ProjectUser';
import { ProjectWrap } from '@/Types/Project';

import { Head, useForm, Link, router } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import OuterContainer from '@/Components/OuterContainer.vue';
import InnerContainer from '@/Components/InnerContainer.vue';
import ContainerHeader from '@/Components/ContainerHeader.vue';
import Delete from './Delete.vue';
import { computed, onMounted, ref, watch } from 'vue';
import UserList from '@/Partials/ProjectUser/UserList.vue';
import Invite from '@/Components/ProjectUser/Invite.vue';

interface IProps {
  users: ProjectUser[];
  project: ProjectWrap;
  flash: {
    error: string;
    success: string;
  };
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

watch(
  () => props.flash,
  (value) => {
    // todo: if value.success
    // todo: if value.error
  }
);
</script>

<template>
  <Head title="Show A Projects Users" />
  <AuthenticatedLayout>
    <OuterContainer>
      <ContainerHeader>
        User Control
        <template #subtitle> Add or Remove Users </template>
      </ContainerHeader>

      <Invite :project="props.project"></Invite>

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
