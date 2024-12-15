<script setup>
// modal components
import DialogModal from '@/Components/Modals/DialogModal.vue';

// forms components
import SecondaryButton from '@/Components/Form/SecondaryButton.vue';
import PrimaryButton from '@/Components/Form/PrimaryButton.vue';
import TextInput from '@/Components/Form/TextInput.vue';
import InputError from '@/Components/Form/InputError.vue';
import SelectOption from '@/Components/Form/SelectOption.vue';

// models
import { editProps } from '@/Models/ListModel.js';

// Props declaration
defineProps(editProps);
</script>

<template>
    <DialogModal :show="isEditUserModalOpen" @close="closeEditUserModal">
        <!-- title -->
        <template #title>
            Edit User
        </template>
        <!-- end title -->

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
                <SelectOption v-model="form.role_id" :options="roleOptions" autofocus />
                <InputError :message="form.errors.role_id?.[0]" class="mt-2" />
            </div>
        </template>

        <template #footer>
            <SecondaryButton @click="closeEditUserModal">
                Close
            </SecondaryButton>

            <PrimaryButton class="ms-3" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                @click="editUserProcess">
                Update User
            </PrimaryButton>
        </template>
    </DialogModal>
</template>
