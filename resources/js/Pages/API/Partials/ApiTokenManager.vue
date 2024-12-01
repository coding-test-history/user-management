<script setup>
// feature components
import GenerateAPIToken from '@/Components/Features/API/GenerateAPIToken.vue';
import ManageAPIToken from '@/Components/Features/API/ManageAPIToken.vue';
import TokenValueModal from '@/Components/Features/API/TokenValueModal.vue';
import APITokenPermissionsModal from '@/Components/Features/API/APITokenPermissionsModal.vue';
import DeleteTokenConfirmationModal from '@/Components/Features/API/DeleteTokenConfirmationModal.vue';

// composables
import { useApiTokenManager } from '@/Composables/Features/API/useApiTokenManager.js';

// models
import { props } from '@/Models/ApiModel.js';
defineProps(props);
</script>

<template>
    <div>
        <GenerateAPIToken :available-permissions="availablePermissions" :default-permissions="defaultPermissions" />
        <ManageAPIToken :tokens="tokens" :available-permissions="availablePermissions" :manage-api-token-permissions="manageApiTokenPermissions" :confirm-api-token-deletion="confirmApiTokenDeletion" />
        <TokenValueModal :displaying-token="displayingToken"/>
        <APITokenPermissionsModal v-model="managingPermissionsFor" :available-permissions="availablePermissions"/>
        <DeleteTokenConfirmationModal />
    </div>
</template>
