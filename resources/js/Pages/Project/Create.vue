<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import OuterContainer from '@/Components/OuterContainer.vue';
import InnerContainer from '@/Components/InnerContainer.vue';
import ContainerHeader from '@/Components/ContainerHeader.vue';
import InputContainer from '@/Components/InputContainer.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import TextArea from '@/Components/TextArea.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { computed } from 'vue';
import { ProjectForm } from '@/Types/Project';

const form = useForm(<ProjectForm>{
  title: '',
  description: '',
  settings: {
    from: '#475569',
    to: '#475569',
    direction: '90',
    font: '#FFFFFF',
  },
});

const onSubmit = () => {
  form.post(route('projects.store'), {});
};

const preview = computed(
  () =>
    `linear-gradient(${form.settings.direction}deg, ${form.settings.from}, ${form.settings.to})`
);
</script>

<template>
  <Head title="Create Project" />

  <AuthenticatedLayout>
    <OuterContainer>
      <InnerContainer>
        <ContainerHeader>
          Create
          <template #subtitle> Create your next dream Project </template>
        </ContainerHeader>

        <form @submit.prevent="onSubmit" class="flex flex-col gap-4">
          <InputContainer>
            <InputLabel for="title">Title</InputLabel>
            <TextInput v-model="form.title" id="title" name="title" />
            <InputError :message="form.errors.title" />
          </InputContainer>
          <InputContainer>
            <InputLabel for="description">Description</InputLabel>
            <TextArea
              v-model="form.description"
              id="description"
              name="description"
              rows="10"
            />
            <InputError :message="form.errors.description" />
          </InputContainer>

          <div
            class="grid min-h-[600px] gap-4 sm:min-h-[300px] sm:grid-cols-2 md:min-h-[200px] md:grid-cols-4"
          >
            <InputContainer>
              <InputLabel for="from">Font Color</InputLabel>
              <TextInput
                type="color"
                v-model="form.settings.font"
                id="font"
                name="font"
                class="h-full w-full p-0"
              />
              <InputError :message="form.errors.settings" />
            </InputContainer>
            <InputContainer>
              <InputLabel for="from">BG Color 1</InputLabel>
              <TextInput
                type="color"
                v-model="form.settings.from"
                id="from"
                name="from"
                class="h-full w-full p-0"
              />
              <InputError :message="form.errors.settings" />
            </InputContainer>
            <InputContainer>
              <InputLabel for="to">BG Color 2</InputLabel>
              <TextInput
                type="color"
                v-model="form.settings.to"
                id="to"
                name="to"
                class="h-full w-full p-0"
              />
            </InputContainer>
            <InputContainer>
              <InputLabel for="direction">Direction</InputLabel>
              <TextInput
                type="range"
                min="0"
                max="360"
                step="1"
                v-model="form.settings.direction"
                id="direction"
                name="direction"
                class="mt-4 h-0 w-full appearance-none p-0 md:mt-6"
              />
            </InputContainer>

            <InputContainer>
              <InputLabel for="from">Preview</InputLabel>
              <div
                class="flex h-full w-full flex-col items-center justify-end rounded p-2 font-bold"
                :style="{ color: form.settings.font, background: preview }"
              >
                <div class="mb-auto w-full text-right text-sm">Owner</div>
                <div class="w-full overflow-x-hidden text-center font-bold">
                  {{ form.title }}
                </div>
              </div>
            </InputContainer>
          </div>

          <div class="flex items-center justify-end gap-4">
            <Transition
              enter-from-class="opacity-0"
              leave-to-class="opacity-0"
              class="transition ease-in-out"
            >
              <p
                v-if="form.recentlySuccessful"
                class="text-sm text-gray-600 dark:text-gray-200"
              >
                Saved.
              </p>
            </Transition>

            <PrimaryButton :disabled="form.processing">Save</PrimaryButton>
          </div>
        </form>
      </InnerContainer>
    </OuterContainer>
  </AuthenticatedLayout>
</template>
