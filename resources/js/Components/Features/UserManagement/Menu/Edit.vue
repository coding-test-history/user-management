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
import { editProps } from '@/Models/MenuModel.js';

// Props declaration
defineProps(editProps);
</script>

<template>
    <DialogModal :show="isEditMenuModalOpen" @close="closeEditMenuModal">
        <!-- title -->
        <template #title>
            Edit Menu
        </template>
        <!-- end title -->

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

        <template #footer>
            <SecondaryButton @click="closeEditMenuModal">
                Close
            </SecondaryButton>

            <PrimaryButton class="ms-3" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                @click="editMenuProcess">
                Update Menu
            </PrimaryButton>
        </template>
    </DialogModal>
</template>
