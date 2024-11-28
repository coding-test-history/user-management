<script setup>
import { Head } from '@inertiajs/vue3';

// card components
import AuthenticationCard from '@/Components/Cards/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/Cards/AuthenticationCardLogo.vue';

// page components
import ResetPasswordForm from '@/Components/Features/Auth/ResetPasswordForm.vue';

const props = defineProps({
    email: String,
    token: String,
});
</script>

<template>
    <!-- head -->
    <Head title="Reset Password" />
    <!-- end head -->

    <AuthenticationCard>
        <!-- logo -->
        <template #logo>
            <AuthenticationCardLogo />
        </template>
        <!-- end logo -->

        <!-- reset password form -->
        <ResetPasswordForm :email="props.email" :token="props.token" />
        <!-- end reset password form -->
    </AuthenticationCard>
</template>
