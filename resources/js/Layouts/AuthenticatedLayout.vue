<script setup>
import { ref } from 'vue';
import {router} from "@inertiajs/vue3";

const drawer = ref(null);

</script>

<template>
    <v-app>

        <v-app-bar>
            <template v-slot:prepend>
                <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
            </template>

            <v-app-bar-title>
                <slot name="app-bar-title" />
            </v-app-bar-title>

            <template v-slot:append>
                <slot name="app-bar-append" />
            </template>
        </v-app-bar>

        <v-navigation-drawer v-model="drawer">
            <v-list>
                <v-list-item
                    title="Events"
                    :to="route('event.index')"
                    :active="route().current('event.index')"
                ></v-list-item>
                <v-list-item
                    title="Tags"
                    :to="route('tag.index')"
                    :active="route().current('tag.index')"
                ></v-list-item>

                <v-list-item
                    title="Profile"
                    :to="route('profile.edit')"
                    :active="route().current('profile.edit')"
                ></v-list-item>

                <v-list-item
                    title="Log Out"
                    @click="router.post( route( 'logout' ) )"
                ></v-list-item>
            </v-list>
        </v-navigation-drawer>

        <v-main>
            <slot />
        </v-main>
    </v-app>
</template>
