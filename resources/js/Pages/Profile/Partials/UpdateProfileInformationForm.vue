<script setup>
// message components
import ActionMessage from '@/Components/Messages/ActionMessage.vue';

// section components
import FormSection from '@/Components/Sections/FormSection.vue';

// form components
import PrimaryButton from '@/Components/Form/PrimaryButton.vue';

// composable
import useUpdateProfileInformationForm from '@/Composables/Features/Profile/useUpdateProfileInformationForm.js';

// featur components
import UpdateProfileInformationForm from '@/Components/Features/Profile/UpdateProfileInformationForm.vue';

const props = defineProps({
    user: Object,
    form: Object,
});

const {
    updateProfileInformation,
    sendEmailVerification,
    updatePhotoPreview,
    selectNewPhoto,
    deletePhot,
    form } = useUpdateProfileInformationForm(props);
</script>

<template>
    <FormSection @submitted="updateProfileInformation">
        <template #title>
            Profile Information
        </template>

        <template #description>
            Update your account's profile information and email address.
        </template>

        <template #form>
            <UpdateProfileInformationForm :form="form" :user="user" />
        </template>

        <template #actions>
            <ActionMessage :on="form.recentlySuccessful" class="me-3">
                Saved.
            </ActionMessage>

            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </PrimaryButton>
        </template>
    </FormSection>
</template>
