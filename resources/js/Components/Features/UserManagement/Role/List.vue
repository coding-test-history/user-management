<script setup>
// utilities components
import Tables from '@/Components/Utilities/Tables.vue';
import Pagination from '@/Components/Utilities/Pagination.vue';

// forms components
import DangerButton from '@/Components/Form/DangerButton.vue';
import WarningButton from '@/Components/Form/WarningButton.vue';

// feature components
import Delete from '@/Components/Features/UserManagement/Role/Delete.vue';
import Edit from '@/Components/Features/UserManagement/Role/Edit.vue';

// composable
import useRole from '@/Composables/Features/UserManagement/useRole.js';

// Manage state and actions for deletion
const {
    roles,
    openModalEditRole,
    deleteRoleConfirmation,
    pagination,
    changePage,
    confirmingRoleDeletion,
    closeModalDeleteRole,
    deleteRoleProcess,
    openSuccessDialog,
    isEditRoleModalOpen,
    closeEditRoleModal,
    form,
    editRoleProcess,
} = useRole();
</script>

<template>
    <!-- listing role -->
    <Tables>
        <template #thead>
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">No</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Role Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Menu</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Action
                </th>
            </tr>
        </template>
        <template #tbody>
            <tr v-for="(role, index) in roles" :key="role.id" class="border-b border-gray-100 dark:border-gray-700">
                <td class="px-6 py-4 whitespace-nowrap text-sm text-white">{{ index + 1 }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-white">{{ role.role_name }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-white">{{ role.menu_id }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">
                    <WarningButton class="ms-3" @click="openModalEditRole(role.id)">
                        Edit
                    </WarningButton>
                    <DangerButton class="ms-3" @click="deleteRoleConfirmation(role.id)">
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
    <Delete :confirmingRoleDeletion="confirmingRoleDeletion" :closeModalDeleteRole="closeModalDeleteRole"
        :deleteRoleProcess="deleteRoleProcess" :openSuccessDialog="openSuccessDialog" />
    <!-- End Delete -->

    <!-- Edit user -->
    <Edit :isEditRoleModalOpen="isEditRoleModalOpen" :closeEditRoleModal="closeEditRoleModal" :form="form"
        :editRoleProcess="editRoleProcess" />
    <!-- End Edit user -->

</template>
