<script setup>
// modal component
import ConfirmationModal from '@/Components/Modals/ConfirmationModal.vue';

// form component
import SecondaryButton from '@/Components/Form/SecondaryButton.vue';
import DangerButton from '@/Components/Form/DangerButton.vue';

// models
import { deleteProps } from '@/Models/MenuModel.js';

// Terima props yang dibutuhkan
defineProps(deleteProps);
</script>

<template>
    <!-- delete menu confirmation -->
    <ConfirmationModal :show="confirmingMenuDeletion" @close="closeModalDeleteMenu">
        <template #title>
            Delete Menu
        </template>

        <template #content>
            Are you sure you want to delete this menu? Once this menu is deleted, the page is unaccessible.
        </template>

        <template #footer>
            <SecondaryButton @click="closeModalDeleteMenu">
                Cancel
            </SecondaryButton>
            <DangerButton class="ms-3" @click="deleteMenuProcess()">
                Delete Menu
            </DangerButton>
        </template>
    </ConfirmationModal>
</template>
