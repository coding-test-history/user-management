<script setup>
// modal components
import DialogModal from '@/Components/Modals/DialogModal.vue';

// forms components
import SecondaryButton from '@/Components/Form/SecondaryButton.vue';
import PrimaryButton from '@/Components/Form/PrimaryButton.vue';
import TextInput from '@/Components/Form/TextInput.vue';
import InputError from '@/Components/Form/InputError.vue';
import Checkbox from '@/Components/Form/Checkbox.vue';
import InputLabel from '@/Components/Form/InputLabel.vue';

// models
import { editProps } from '@/Models/RoleModel.js';

// composable
import useMenu from '@/Composables/Features/UserManagement/useMenu.js';

// Manage state and actions for deletion
const {
    menus
} = useMenu();

// Props declaration
defineProps(editProps);
</script>

<template>
    <DialogModal :show="isEditRoleModalOpen" @close="closeEditRoleModal">
        <!-- title -->
        <template #title>
            Edit User
        </template>
        <!-- end title -->

        <template #content>
            <div>
                <TextInput ref="roleNameInput" v-model="form.role_name" type="text" class="mt-1 block w-full" placeholder="Role Name"
                    autocomplete="role_name" />
                <InputError :message="form.errors.role_name?.[0]" class="mt-2" />
            </div>

            <div class="mt-4" v-for="(menu, index) in menus" :key="menu.id">
                <label class="flex items-center">
                    <Checkbox v-model:checked="form.menu_id" name="menu_id[]" />
                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ menu.menu_name }}</span>
                </label>
            </div>
        </template>

        <template #footer>
            <SecondaryButton @click="closeEditRoleModal">
                Close
            </SecondaryButton>

            <PrimaryButton class="ms-3" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                @click="editRoleProcess">
                Update Role
            </PrimaryButton>
        </template>
    </DialogModal>
</template>
