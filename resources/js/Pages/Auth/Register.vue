<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputContainer from '@/Components/InputContainer.vue';

const form = useForm({
  first_name: '',
  last_name: '',
  user_name: '',
  email: '',
  password: '',
  password_confirmation: '',
  terms: false,
});

const submit = () => {
  form.post(route('register'), {
    onFinish: () => form.reset('password', 'password_confirmation'),
  });
};
</script>

<template>
  <GuestLayout>
    <Head title="Register" />

    <form class="flex flex-col gap-2" @submit.prevent="submit">
      <InputContainer>
        <InputLabel for="first_name">First Name</InputLabel>

        <TextInput
          id="first_name"
          v-model="form.first_name"
          type="text"
          class="mt-1 block w-full"
          required
          autofocus
          autocomplete="first_name"
        />

        <InputError class="mt-2" :message="form.errors.first_name" />
      </InputContainer>
      <InputContainer>
        <InputLabel for="last_name">Last Name</InputLabel>

        <TextInput
          id="last_name"
          v-model="form.last_name"
          type="text"
          class="mt-1 block w-full"
          required
          autofocus
          autocomplete="last_name"
        />

        <InputError class="mt-2" :message="form.errors.last_name" />
      </InputContainer>
      <InputContainer>
        <InputLabel for="user_name">User Name</InputLabel>

        <TextInput
          id="user_name"
          v-model="form.user_name"
          type="text"
          class="mt-1 block w-full"
          required
          autofocus
          autocomplete="user_name"
        />

        <InputError class="mt-2" :message="form.errors.user_name" />
      </InputContainer>

      <InputContainer>
        <InputLabel for="email" value="Email" />

        <TextInput
          id="email"
          v-model="form.email"
          type="email"
          class="mt-1 block w-full"
          required
          autocomplete="username"
        />

        <InputError class="mt-2" :message="form.errors.email" />
      </InputContainer>

      <InputContainer>
        <InputLabel for="password" value="Password" />

        <TextInput
          id="password"
          v-model="form.password"
          type="password"
          class="mt-1 block w-full"
          required
          autocomplete="new-password"
        />

        <InputError class="mt-2" :message="form.errors.password" />
      </InputContainer>

      <InputContainer>
        <InputLabel for="password_confirmation" value="Confirm Password" />

        <TextInput
          id="password_confirmation"
          v-model="form.password_confirmation"
          type="password"
          class="mt-1 block w-full"
          required
          autocomplete="new-password"
        />

        <InputError class="mt-2" :message="form.errors.password_confirmation" />
      </InputContainer>

      <div class="mt-4 flex items-center justify-end">
        <Link
          :href="route('login')"
          class="rounded-md text-sm text-gray-600 text-slate-300 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:hover:text-slate-200"
        >
          Already registered?
        </Link>

        <PrimaryButton
          class="ml-4"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          Register
        </PrimaryButton>
      </div>
    </form>
  </GuestLayout>
</template>
