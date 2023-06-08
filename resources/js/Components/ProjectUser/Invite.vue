<script setup lang="ts">
import { ProjectWrap } from '@/Types/Project';
import { onMounted, ref } from 'vue';
import { router, Link, useForm } from '@inertiajs/vue3';
import InputContainer from '@/Components/InputContainer.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import InputError from '@/Components/InputError.vue';

interface IProps {
  project: ProjectWrap;
}

const props = defineProps<IProps>();

const isInviteOpen = ref(false);

const hasInvite = (urlSearchParams: URLSearchParams) =>
  urlSearchParams.has('invite');

onMounted(() => {
  const queryString = window.location.search;
  const urlSearchParams = new URLSearchParams(queryString);
  isInviteOpen.value = hasInvite(urlSearchParams);
});

router.on('start', (event) => {
  if (event.detail.visit.method === 'post') {
    return;
  }

  isInviteOpen.value = hasInvite(event.detail.visit.url.searchParams);
  if (!isInviteOpen.value) {
    form.reset();
    form.clearErrors();
  }
});

const form = useForm({
  email: '',
});

const onSubmit = () => {
  form.post(route('projects.users.store', props.project.data.uuid), {
    preserveState: true,
    preserveScroll: true,

    onSuccess: () => {
      console.log('success');
    },
    onError: () => {
      console.log('error');
    },
    onFinish: () => {
      console.log('finish');
    },
  });
};

const onCancel = () => {
  form.reset();
  form.clearErrors();
};
</script>

<template>
  <Link
    :href="
      route('projects.users.show', {
        project: props.project.data.uuid,
        invite: true,
      })
    "
    preserve-scroll
    preserve-state
    class="flex items-center justify-end gap-4 rounded py-2 px-4 transition hover:bg-black hover:bg-opacity-10 dark:text-white"
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
        d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z"
      />
    </svg>

    <span>Invite User {{ isInviteOpen }}</span>
  </Link>

  <div
    v-if="isInviteOpen"
    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50"
  >
    <Link
      :href="
        route('projects.users.show', {
          project: props.project.data.uuid,
        })
      "
      preserve-scroll
      preserve-state
      class="absolute inset-0 cursor-default"
    ></Link>

    <form
      @submit.prevent="onSubmit"
      class="relative flex min-w-[300px] flex-col gap-4 rounded bg-white p-4 shadow-sm dark:bg-slate-700 dark:shadow-slate-400"
    >
      <InputContainer>
        <InputLabel for="email">E-Mail</InputLabel>
        <TextInput
          type="email"
          required
          v-model="form.email"
          id="email"
          name="email"
          class="h-full w-full"
        />

        <InputError :message="form.errors.email" class="mt-2" />
      </InputContainer>

      {{ form.email }}

      <div class="flex items-center justify-end gap-4">
        <Link
          :href="
            route('projects.users.show', {
              project: props.project.data.uuid,
            })
          "
          preserve-scroll
          preserve-state
          :disabled="form.processing"
          class="px-4 py-2 dark:text-slate-200 dark:hover:text-slate-300"
        >
          Cancel
        </Link>

        <PrimaryButton :disabled="form.processing">Save</PrimaryButton>
      </div>
    </form>
  </div>
</template>
