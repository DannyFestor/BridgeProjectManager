<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Link, useForm, usePage } from '@inertiajs/inertia-vue3';

const props = defineProps({
  mustVerifyEmail: Boolean,
  status: String,
});

const user = usePage().props.value.auth.user;

const form = useForm({
  user_name: user.user_name,
  first_name: user.first_name,
  last_name: user.last_name,
  email: user.email,
});
</script>

<template>
  <header>
    <h2 class="text-lg font-medium text-gray-900 dark:text-slate-100">
      Profile Information
    </h2>

    <p class="mt-1 text-sm text-gray-600 dark:text-slate-300">
      Update your account's profile information and email address.
    </p>
  </header>

  <form
    class="grid w-full gap-4 sm:grid-cols-2"
    @submit.prevent="form.patch(route('profile.update'))"
  >
    <div class="flex flex-col">
      <label for="first_name">First Name</label>
      <input
        id="first_name"
        v-model="form.first_name"
        name="first_name"
        type="text"
        class="form-input rounded text-black dark:bg-slate-500 dark:text-slate-50"
      />

      <div
        v-if="form.errors.first_name"
        class="w-full text-sm text-red-600 dark:text-red-200"
      >
        {{ form.errors.first_name }}
      </div>
    </div>

    <div class="flex flex-col">
      <label for="first_name">Last Name</label>
      <input
        id="last_name"
        v-model="form.last_name"
        name="last_name"
        type="text"
        class="form-input rounded text-black dark:bg-slate-500 dark:text-slate-50"
      />

      <div
        v-if="form.errors.last_name"
        class="w-full text-sm text-red-600 dark:text-red-200"
      >
        {{ form.errors.last_name }}
      </div>
    </div>

    <div class="flex flex-col">
      <label for="first_name">Email</label>
      <input
        id="email"
        v-model="form.email"
        name="email"
        type="text"
        class="form-input rounded text-black dark:bg-slate-500 dark:text-slate-50"
      />

      <div
        v-if="form.errors.email"
        class="w-full text-sm text-red-600 dark:text-red-200"
      >
        {{ form.errors.email }}
      </div>
    </div>

    <div v-if="props.mustVerifyEmail && user.email_verified_at === null">
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

    <div class="flex items-center gap-4">
      <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

      <Transition
        enter-from-class="opacity-0"
        leave-to-class="opacity-0"
        class="transition ease-in-out"
      >
        <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">
          Saved.
        </p>
      </Transition>
    </div>
  </form>
</template>
