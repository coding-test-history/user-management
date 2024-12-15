<script setup>
// modal components
import DialogModal from '@/Components/Modals/DialogModal.vue';

// forms components
import SecondaryButton from '@/Components/Form/SecondaryButton.vue';
import PrimaryButton from '@/Components/Form/PrimaryButton.vue';
import TextInput from '@/Components/Form/TextInput.vue';
import InputError from '@/Components/Form/InputError.vue';
import SelectOption from '@/Components/Form/SelectOption.vue';

// composable
import useList from '@/Composables/Features/UserManagement/useList.js';

// models
import { createProps } from '@/Models/ListModel.js';

// Manage state and actions for deletion
const {
    openCreateNewUserModal,
    createNewUserModalHandler,
    form,
    createUserProcess,
    roleOptions,
} = useList();

// Props declaration
defineProps(createProps);
</script>

<template>

    <div class="mb-5">
        <PrimaryButton @click="createNewUserModalHandler(true)">
            Create New User
        </PrimaryButton>
    </div>

    <!-- sucess modals -->
    <DialogModal :show="openCreateNewUserModal" @close="createNewUserModalHandler(false)">
        <!-- title -->
        <template #title>
            Create New User
        </template>
        <!-- end title -->

        <!-- content -->
        <template #content>
            <div>
                <TextInput ref="nameInput" v-model="form.name" type="text" class="mt-1 block w-full" placeholder="Name"
                    autocomplete="name" />
                <InputError :message="form.errors.name?.[0]" class="mt-2" />
            </div>

            <div class="mt-4">
                <TextInput ref="emailInput" v-model="form.email" type="email" class="mt-1 block w-full"
                    placeholder="Email" />
                <InputError :message="form.errors.email?.[0]" class="mt-2" />
            </div>

            <div class="mt-4">
                <TextInput ref="passwordInput" v-model="form.password" type="password" class="mt-1 block w-full"
                    placeholder="Password" />
                <InputError :message="form.errors.password?.[0]" class="mt-2" />
            </div>

            <div class="mt-4">
                <SelectOption v-model="form.role_id" :options="roleOptions" autofocus />
                <InputError :message="form.errors.role_id?.[0]" class="mt-2" />
            </div>
        </template>
        <!-- end content -->

        <!-- footer -->
        <template #footer>
            <SecondaryButton @click="createNewUserModalHandler(false)">
                Close
            </SecondaryButton>

            <PrimaryButton class="ms-3" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                @click="createUserProcess">
                Create Menu
            </PrimaryButton>
        </template>
        <!-- end footer -->
    </DialogModal>
    <!-- end success modal -->
</template>
