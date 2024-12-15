<script setup>
// layout
import AppLayout from '@/Layouts/AppLayout.vue';

// card components
import Breadcrumb from '@/Components/Utilities/Breadcrumb.vue';

// feature components
import List from '@/Components/Features/UserManagement/List/List.vue';
import Create from '@/Components/Features/UserManagement/List/Create.vue';

// models
import { generalProps, createProps } from '@/Models/ListModel.js';

// props management
defineProps({ ...generalProps, ...createProps });
</script>

<template>
    <AppLayout :title="title">

        <!-- header -->
        <template #header>
            <Breadcrumb :title="title" />
        </template>
        <!-- end header -->

        <!-- content -->
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <Create :successDialog="successDialog" :openSuccessDialog="openSuccessDialog"
                    :openCreateNewUserModal="openCreateNewUserModal" :createNewUserModal="createNewUserModal"
                    :closeModalCreateNewUser="closeModalCreateNewUser" :form="form"
                    :createUserProcess="createUserProcess" />
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <List />
                </div>
            </div>
        </div>
        <!-- end content -->
    </AppLayout>
</template>