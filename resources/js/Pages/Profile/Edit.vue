<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateEmailInformationForm from './Partials/UpdateEmailInformationForm.vue';
import { Head } from '@inertiajs/inertia-vue3';
import UpdateNameInformationForm from '@/Pages/Profile/Partials/UpdateNameInformationForm.vue';

const props = defineProps({
  mustVerifyEmail: Boolean,
  status: {
    type: String,
    default: null,
  },
  isVerifiedEmail: Boolean,
});
</script>

<template>
  <Head title="Profile" />

  <AuthenticatedLayout>
    <div class="py-12">
      <div class="mx-auto w-full max-w-7xl space-y-6 sm:px-6 lg:px-8">
        <div
          class="w-full bg-white p-4 shadow dark:bg-slate-600 dark:text-white sm:rounded-lg sm:p-8"
        >
          <UpdateNameInformationForm />
        </div>

        <div
          class="w-full bg-white p-4 shadow dark:bg-slate-600 dark:text-white sm:rounded-lg sm:p-8"
        >
          <UpdateEmailInformationForm
            :must-verify-email="props.mustVerifyEmail"
            :status="props.status"
            :is-verified-email="props.isVerifiedEmail"
          />
        </div>

        <div
          class="w-full bg-white p-4 shadow dark:bg-slate-600 dark:text-white sm:rounded-lg sm:p-8"
        >
          <UpdatePasswordForm />
        </div>

        <div
          class="w-full bg-white p-4 shadow dark:bg-slate-600 dark:text-white sm:rounded-lg sm:p-8"
        >
          <DeleteUserForm class="max-w-xl" />
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
