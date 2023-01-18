<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Link, useForm, usePage } from '@inertiajs/inertia-vue3';
import InputContainer from '@/Components/InputContainer.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';

const props = defineProps({
  mustVerifyEmail: Boolean,
  status: { type: String, default: null },
  isVerifiedEmail: Boolean,
});

const user = usePage().props.value.auth.user;

const form = useForm({
  email: user.email,
});

const onSubmit = () => {
  form.patch(route('profile.update.email'));
};
</script>

<template>
  <header>
    <h2 class="text-lg font-medium text-gray-900 dark:text-slate-100">
      Email Information
    </h2>

    <p class="mt-1 text-sm text-gray-600 dark:text-slate-300">
      Update your account's email address.
    </p>
  </header>

  <form class="mt-4 grid w-full gap-4" @submit.prevent="onSubmit">
    <InputContainer>
      <InputLabel for="first_name">Email</InputLabel>
      <TextInput id="email" v-model="form.email" name="email" type="email" />
      <InputError :message="form.errors.email">
        {{ form.errors.email }}
      </InputError>
    </InputContainer>

    <div v-if="props.mustVerifyEmail && !props.isVerifiedEmail">
      <p class="mt-2 text-sm text-gray-800">
        Your email address is unverified.
        <Link
          :href="route('verification.send')"
          method="post"
          as="button"
          class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
        >
          Click here to re-send the verification email.
        </Link>
      </p>

      <div
        v-show="props.status === 'verification-link-sent'"
        class="mt-2 text-sm font-medium text-green-600"
      >
        A new verification link has been sent to your email address.
      </div>
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
</template>
