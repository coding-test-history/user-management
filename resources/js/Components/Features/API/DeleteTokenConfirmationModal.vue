<script setup>
// modal components
import ConfirmationModal from '@/Components/Modals/ConfirmationModal.vue';

// form components
import SecondaryButton from '@/Components/Form/SecondaryButton.vue';
import DangerButton from '@/Components/Form/DangerButton.vue';

// composables
import { useApiTokenManager } from '@/Composables/Features/API/useApiTokenManager.js';

// models
import { props } from "@/Models/ApiModel.js";

const prop = defineProps(props);

const { deleteApiTokenForm, confirmApiTokenDeletion } = useApiTokenManager(prop);
</script>


<template>
    <ConfirmationModal :show="apiTokenBeingDeleted != null" @close="apiTokenBeingDeleted = null">
        <template #title>
            Delete API Token
        </template>

        <template #content>
            Are you sure you would like to delete this API token?
        </template>

        <template #footer>
            <SecondaryButton @click="apiTokenBeingDeleted = null">
                Cancel
            </SecondaryButton>

            <DangerButton class="ms-3" :class="{ 'opacity-25': deleteApiTokenForm.processing }"
                :disabled="deleteApiTokenForm.processing" @click="deleteApiToken">
                Delete
            </DangerButton>
        </template>
    </ConfirmationModal>
</template>