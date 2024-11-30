<script setup>
import { ref } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';

// cards components
import AuthenticationCard from '@/Components/Cards/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/Cards/AuthenticationCardLogo.vue';

// feature components
import TwoFactorChallenge from '@/Components/Features/Auth/TwoFactorChallenge.vue';

// composables
import useTwoFactorChallenge from '@/Composables/Features/Auth/useTwoFactorChallenge.js';

const { form, submit, recovery, toggleRecovery, codeInput, recoveryCodeInput } = useTwoFactorChallenge();

</script>
<template>

    <Head title="Two-factor Confirmation" />

    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>

        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            <template v-if="!recovery">
                Please confirm access to your account by entering the authentication code provided by your authenticator
                application.
            </template>

            <template v-else>
                Please confirm access to your account by entering one of your emergency recovery codes.
            </template>
        </div>

        <form @submit.prevent="submit">
            <TwoFactorChallenge :form="form" :recovery="recovery" :toggleRecovery="toggleRecovery"
                :codeInput="codeInput" :recoveryCodeInput="recoveryCodeInput" />
        </form>
    </AuthenticationCard>
</template>
