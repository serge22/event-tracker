<template>
    <Head title="Tags" />

    <AuthenticatedLayout>
        <template v-slot:app-bar-title>Tags</template>

        <div v-if="$page.props.flash.message">{{ $page.props.flash.message }}</div>

        <v-list v-if="tags.data">
            <v-list-item
                v-for="tag in tags.data"
                :key="tag.id"
                :to="route('tag.show', tag.id)"
            >
                {{ tag.name }}
                <v-chip size="x-small">{{ tag.events_count }}</v-chip>
            </v-list-item>
        </v-list>
<!--
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <section class="max-w-xl">
                        <table v-if="tags.data">
                            <tr v-for="tag in tags.data" :key="tag.id">
                                <td><Link :href="route('tag.show', tag.id)">{{ tag.name }}</Link></td>
                                <td>{{ tag.events_count }}</td>
                                <td>
                                    <Link :href="route('tag.edit', tag.id)">Edit</Link>
                                    <Link :href="route('tag.destroy', tag.id)" method="delete" as="button">Delete</Link>
                                </td>
                            </tr>
                        </table>

                        <Pagination :links="tags.links" />
                    </section>
                </div>
            </div>
        </div>
-->
    </AuthenticatedLayout>
</template>

<script setup>
import {Head} from "@inertiajs/vue3";
import { Link } from '@inertiajs/vue3'

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

defineProps({
    tags: Object,
})

</script>
