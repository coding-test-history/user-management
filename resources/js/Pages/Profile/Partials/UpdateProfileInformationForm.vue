<script setup>
import { ref } from 'vue';

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

// models
import { props } from '@/Models/ProfileModel.js';

const prop = defineProps(props);

const photoPreview = ref(null);
const photoInput = ref(null);

const { updateProfileInformation, form } = useUpdateProfileInformationForm(prop, photoInput, photoPreview);
</script>

<template>
    <FormSection @submitted="updateProfileInformation">
        <!-- title -->
        <template #title>
            Profile Information
        </template>
        <!-- end title -->

        <!-- description -->
        <template #description>
            Update your account's profile information and email address.
        </template>
        <!-- end description -->

        <!-- form -->
        <template #form>
            <UpdateProfileInformationForm :form="form" :user="user" />
        </template>
        <!-- end form -->

        <!-- actions -->
        <template #actions>
            <ActionMessage :on="form.recentlySuccessful" class="me-3">
                Saved.
            </ActionMessage>

            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </PrimaryButton>
        </template>
        <!-- end actions -->
    </FormSection>
</template>
