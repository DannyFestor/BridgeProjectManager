<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import InputContainer from '@/Components/InputContainer.vue';

// const user = usePage().props.value.auth.user;
const user = usePage().props.auth.user;

const form = useForm({
  user_name: user.user_name,
  first_name: user.first_name,
  last_name: user.last_name,
});

const onSubmit = () => {
  form.patch(route('profile.update.name'));
};
</script>

<template>
  <header>
    <h2 class="text-lg font-medium text-gray-900 dark:text-slate-100">
      Update Name Information
    </h2>
  </header>

  <form
    class="mt-4 grid w-full gap-4 md:grid-cols-3"
    @submit.prevent="onSubmit"
  >
    <InputContainer>
      <InputLabel for="first_name">First Name</InputLabel>
      <TextInput
        id="first_name"
        v-model="form.first_name"
        name="first_name"
        type="text"
      />
      <InputError :message="form.errors.first_name"></InputError>
    </InputContainer>

    <InputContainer>
      <InputLabel for="first_name">Last Name</InputLabel>
      <TextInput
        id="last_name"
        v-model="form.last_name"
        name="last_name"
        type="text"
      />
      <InputError :message="form.errors.last_name"></InputError>
    </InputContainer>

    <InputContainer>
      <InputLabel for="first_name">User Name</InputLabel>
      <TextInput
        id="user_name"
        v-model="form.user_name"
        name="user_name"
        type="text"
      />
      <InputError :message="form.errors.user_name"></InputError>
    </InputContainer>

    <div class="flex items-center justify-end gap-4 md:col-span-3">
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
</template>
