<script setup>
// form components
import InputError from '@/Components/Form/InputError.vue';
import InputLabel from '@/Components/Form/InputLabel.vue';
import PrimaryButton from '@/Components/Form/PrimaryButton.vue';
import TextInput from '@/Components/Form/TextInput.vue';

// composables
import useForgotPassword from '@/Composables/Features/Auth/useForgotPassword.js';

// defined composables
const { form, submit } = useForgotPassword();
</script>

<template>
    <form @submit.prevent="submit">
        <!-- input email -->
        <div>
            <InputLabel for="email" value="Email" />
            <TextInput id="email" v-model="form.email" type="email" class="mt-1 block w-full" required autofocus
                autocomplete="username" />
            <InputError class="mt-2" :message="form.errors.email" />
        </div>
        <!-- end input email -->

        <!-- button email password reset -->
        <div class="flex items-center justify-end mt-4">
            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Email Password Reset Link
            </PrimaryButton>
        </div>
        <!-- end button email password reset -->
    </form>
</template>