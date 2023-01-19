<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateEmailInformationForm from './Partials/UpdateEmailInformationForm.vue';
import { Head } from '@inertiajs/vue3';
import UpdateNameInformationForm from '@/Pages/Profile/Partials/UpdateNameInformationForm.vue';
import OuterContainer from '@/Components/OuterContainer.vue';
import InnerContainer from '@/Components/InnerContainer.vue';

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
    <OuterContainer>
      <InnerContainer>
        <UpdateNameInformationForm />
      </InnerContainer>

      <InnerContainer>
        <UpdateEmailInformationForm
          :must-verify-email="props.mustVerifyEmail"
          :status="props.status"
          :is-verified-email="props.isVerifiedEmail"
        />
      </InnerContainer>

      <InnerContainer>
        <UpdatePasswordForm />
      </InnerContainer>

      <InnerContainer>
        <DeleteUserForm />
      </InnerContainer>
    </OuterContainer>
  </AuthenticatedLayout>
</template>
