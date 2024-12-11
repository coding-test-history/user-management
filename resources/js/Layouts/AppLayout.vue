<script setup>
import { Head } from '@inertiajs/vue3';

// card components
import Banner from '@/Components/Cards/Banner.vue';

// utility components
import Navbar from '@/Components/Utilities/Navbar.vue';
import Header from '@/Components/Utilities/Header.vue';

// models
import { props, menuProps } from '@/Models/AppLayoutModel.js';

defineProps({ ...props, ...menuProps });
</script>

<template>
    <div>
        <!-- head -->

        <Head :title="title" />
        <!-- end head -->

        <!-- banner -->
        <Banner />
        <!-- end banner -->

        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <!-- nav -->
            <Navbar :menu="menu" />
            <!-- end nav -->

            <!-- Page Heading -->
            <Header :show-header="$slots.header?.().length > 0">
                <slot name="header" />
            </Header>
            <!-- end page heading -->

            <!-- Page Content -->
            <main>
                <slot />
            </main>
            <!-- end page content -->
        </div>
    </div>
</template>
