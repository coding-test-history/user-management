<script setup>
// modal component
import ConfirmationModal from '@/Components/Modals/ConfirmationModal.vue';

// form component
import SecondaryButton from '@/Components/Form/SecondaryButton.vue';
import DangerButton from '@/Components/Form/DangerButton.vue';

// models
import { deleteProps } from '@/Models/ListModel.js';

// Terima props yang dibutuhkan
defineProps(deleteProps);
</script>

<template>
    <!-- delete user confirmation -->
    <ConfirmationModal :show="confirmingUserDeletion" @close="closeModalDeleteUser">
        <template #title>
            Delete User
        </template>

        <template #content>
            Are you sure you want to delete this user? Once this user is deleted, the apps is unaccessible.
        </template>

        <template #footer>
            <SecondaryButton @click="closeModalDeleteUser">
                Cancel
            </SecondaryButton>
            <DangerButton class="ms-3" @click="deleteUserProcess()">
                Delete User
            </DangerButton>
        </template>
    </ConfirmationModal>
</template>
