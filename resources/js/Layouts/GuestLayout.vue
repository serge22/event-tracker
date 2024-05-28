<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <v-app>
        <v-main>
            <slot />
        </v-main>
    </v-app>
</template>
