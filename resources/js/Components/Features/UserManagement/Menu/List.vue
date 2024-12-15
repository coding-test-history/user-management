<script setup>
// utilities components
import Tables from '@/Components/Utilities/Tables.vue';
import Pagination from '@/Components/Utilities/Pagination.vue';

// forms components
import DangerButton from '@/Components/Form/DangerButton.vue';
import WarningButton from '@/Components/Form/WarningButton.vue';

// feature components
import Delete from '@/Components/Features/UserManagement/Menu/Delete.vue';
import Edit from '@/Components/Features/UserManagement/Menu/Edit.vue';

// composable
import useMenu from '@/Composables/Features/UserManagement/useMenu.js';

// Manage state and actions for deletion
const {
    menus,
    openModalEditMenu,
    deleteMenuConfirmation,
    pagination,
    changePage,
    confirmingMenuDeletion,
    closeModalDeleteMenu,
    deleteMenuProcess,
    openSuccessDialog,
    isEditMenuModalOpen,
    closeEditMenuModal,
    form,
    editMenuProcess,
    parentOptions
} = useMenu();
</script>

<template>
    <!-- listing menu -->
    <Tables>
        <template #thead>
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">No</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Menu Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Route
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Parent</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Action
                </th>
            </tr>
        </template>
        <template #tbody>
            <tr v-for="(menu, index) in menus" :key="menu.id" class="border-b border-gray-100 dark:border-gray-700">
                <td class="px-6 py-4 whitespace-nowrap text-sm text-white">{{ index + 1 }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-white">{{ menu.menu_name }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-white">{{ menu.route }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-white">{{ menu.parent }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">
                    <WarningButton class="ms-3" @click="openModalEditMenu(menu.id)">
                        Edit
                    </WarningButton>
                    <DangerButton class="ms-3" @click="deleteMenuConfirmation(menu.id)">
                        Delete
                    </DangerButton>
                </td>
            </tr>
        </template>
    </Tables>
    <!-- end listing user -->

    <!-- Pagination -->
    <Pagination :pagination="pagination" :changePage="changePage" />
    <!-- End Pagination -->

    <!-- Delete -->
    <Delete :confirmingMenuDeletion="confirmingMenuDeletion" :closeModalDeleteMenu="closeModalDeleteMenu"
        :deleteMenuProcess="deleteMenuProcess" :openSuccessDialog="openSuccessDialog" />
    <!-- End Delete -->

    <!-- Edit Menu -->
    <Edit :isEditMenuModalOpen="isEditMenuModalOpen" :closeEditMenuModal="closeEditMenuModal" :form="form"
        :editMenuProcess="editMenuProcess" :parentOptions="parentOptions" />
    <!-- End Edit Menu -->

</template>
