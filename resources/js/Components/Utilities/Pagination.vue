<script setup>
defineProps(['pagination', 'changePage']);
</script>

<template>
    <div class="mt-4 flex justify-between items-center">
        <button class="px-4 py-2 bg-gray-700 text-white rounded" :disabled="pagination.current_page === 1"
            @click="changePage(pagination.current_page - 1)">
            Previous
        </button>

        <span class="text-white">
            Page {{ pagination.current_page }} of {{ pagination.last_page }}
        </span>

        <button class="px-4 py-2 bg-gray-700 text-white rounded"
            :disabled="pagination.current_page === pagination.last_page"
            @click="changePage(pagination.current_page + 1)">
            Next
        </button>
    </div>
</template>
