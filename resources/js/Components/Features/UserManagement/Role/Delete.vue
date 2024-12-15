<script setup>
// modal component
import ConfirmationModal from '@/Components/Modals/ConfirmationModal.vue';

// form component
import SecondaryButton from '@/Components/Form/SecondaryButton.vue';
import DangerButton from '@/Components/Form/DangerButton.vue';

// models
import { deleteProps } from '@/Models/RoleModel.js';

// Terima props yang dibutuhkan
defineProps(deleteProps);
</script>

<template>
    <!-- delete role confirmation -->
    <ConfirmationModal :show="confirmingRoleDeletion" @close="closeModalDeleteRole">
        <template #title>
            Delete Role
        </template>

        <template #content>
            Are you sure you want to delete this role? Once this role is deleted, users have no access to menu.
        </template>

        <template #footer>
            <SecondaryButton @click="closeModalDeleteRole">
                Cancel
            </SecondaryButton>
            <DangerButton class="ms-3" @click="deleteRoleProcess()">
                Delete Role
            </DangerButton>
        </template>
    </ConfirmationModal>
</template>
