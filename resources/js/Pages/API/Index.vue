<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

// partials
import ApiTokenManager from '@/Pages/API/Partials/ApiTokenManager.vue';

// models
import { props } from '@/Models/ApiModel.js';

defineProps(props);
</script>

<template>
    <AppLayout :title="title">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                API Tokens
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <ApiTokenManager :tokens="tokens" :available-permissions="availablePermissions"
                    :default-permissions="defaultPermissions" />
            </div>
        </div>
    </AppLayout>
</template>
