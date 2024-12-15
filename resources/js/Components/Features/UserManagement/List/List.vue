<script setup>
// utilities components
import Tables from '@/Components/Utilities/Tables.vue';
import Pagination from '@/Components/Utilities/Pagination.vue';

// forms components
import DangerButton from '@/Components/Form/DangerButton.vue';
import WarningButton from '@/Components/Form/WarningButton.vue';

// feature components
import Delete from '@/Components/Features/UserManagement/List/Delete.vue';
import Edit from '@/Components/Features/UserManagement/List/Edit.vue';

// composable
import useList from '@/Composables/Features/UserManagement/useList.js';

// Manage state and actions for deletion
const {
    users,
    openModalEditUser,
    deleteUserConfirmation,
    pagination,
    changePage,
    confirmingUserDeletion,
    closeModalDeleteUser,
    deleteUserProcess,
    openSuccessDialog,
    isEditUserModalOpen,
    closeEditUserModal,
    form,
    editUserProcess,
    roleOptions
} = useList();
</script>

<template>
    <!-- listing user -->
    <Tables>
        <template #thead>
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">No</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Role</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Action
                </th>
            </tr>
        </template>
        <template #tbody>
            <tr v-for="(user, index) in users" :key="user.id" class="border-b border-gray-100 dark:border-gray-700">
                <td class="px-6 py-4 whitespace-nowrap text-sm text-white">{{ index + 1 }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-white">{{ user.name }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-white">{{ user.email }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-white">{{ user.role_name }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">
                    <WarningButton class="ms-3" @click="openModalEditUser(user.id)">
                        Edit
                    </WarningButton>
                    <DangerButton class="ms-3" @click="deleteUserConfirmation(user.id)">
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
    <Delete :confirmingUserDeletion="confirmingUserDeletion" :closeModalDeleteUser="closeModalDeleteUser"
        :deleteUserProcess="deleteUserProcess" :openSuccessDialog="openSuccessDialog" />
    <!-- End Delete -->

    <!-- Edit user -->
    <Edit :isEditUserModalOpen="isEditUserModalOpen" :closeEditUserModal="closeEditUserModal" :form="form"
        :editUserProcess="editUserProcess" :roleOptions="roleOptions" />
    <!-- End Edit user -->

</template>
