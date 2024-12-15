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
import useMenu from '@/Composables/Features/UserManagement/useMenu.js';

// models
import { createProps } from '@/Models/MenuModel.js';

// Manage state and actions for deletion
const {
    openCreateNewMenuModal,
    createNewMenuModalHandler,
    form,
    createMenuProcess,
    parentOptions,
} = useMenu();

// Props declaration
defineProps(createProps);
</script>

<template>
    
    <div class="mb-5">
        <PrimaryButton @click="createNewMenuModalHandler(true)">
            Create New Menu
        </PrimaryButton>
    </div>

    <!-- sucess modals -->
    <DialogModal :show="openCreateNewMenuModal" @close="createNewMenuModalHandler(false)">
        <!-- title -->
        <template #title>
            Create New Menu
        </template>
        <!-- end title -->

        <!-- content -->
        <template #content>
            <div>
                <TextInput ref="menuNameInput" v-model="form.menu_name" type="text" class="mt-1 block w-full"
                    placeholder="Menu Name" autocomplete="menu_name" />

                <InputError :message="form.errors.menu_name?.[0]" class="mt-2" />
            </div>

            <div class="mt-4">
                <TextInput ref="routeInput" v-model="form.route" type="text" class="mt-1 block w-full"
                    placeholder="route" />

                <InputError :message="form.errors.route?.[0]" class="mt-2" />
            </div>

            <div class="mt-4">
                <SelectOption v-model="form.parent_menu_id" :options="parentOptions" autofocus  />
                <InputError :message="form.errors.parent_menu_id?.[0]" class="mt-2" />
            </div>
        </template>
        <!-- end content -->

        <!-- footer -->
        <template #footer>
            <SecondaryButton @click="createNewMenuModalHandler(false)">
                Close
            </SecondaryButton>

            <PrimaryButton class="ms-3" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                @click="createMenuProcess">
                Create Menu
            </PrimaryButton>
        </template>
        <!-- end footer -->
    </DialogModal>
    <!-- end success modal -->
</template>
