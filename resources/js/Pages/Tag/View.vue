<template>
    <Head title="Events" />

    <AuthenticatedLayout>
        <template v-slot:app-bar-title>Events</template>

        <div v-if="$page.props.flash.message">{{ $page.props.flash.message }}</div>

        <v-list v-if="events.data">
            <v-list-item
                v-for="event in events.data"
                :key="event.id"
            >
                {{ dayjs(event.created_at).format('D MMM, H:mm') }}
            </v-list-item>
        </v-list>
<!--
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <section class="max-w-xl">
                        <table v-if="events.data">
                            <tr v-for="event in events.data" :key="event.id">
                                <td>{{ event.created_at }}</td>
                                <td>
                                    <Link :href="route('event.edit', event.id)">Edit</Link>
                                    <Link :href="route('event.destroy', event.id)" method="delete" as="button">Delete</Link>
                                </td>
                            </tr>
                        </table>

                        <Pagination :links="events.links" />
                    </section>
                </div>
            </div>
        </div>
-->
    </AuthenticatedLayout>
</template>

<script setup>
import {Head} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Link } from '@inertiajs/vue3'
import dayjs from "dayjs";

defineProps({
    events: Object,
})
</script>
