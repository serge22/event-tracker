<template>
    <Head title="Events" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="inline-block font-semibold text-xl text-gray-800 leading-tight pr-3">Events</h2>
            <Link :href="route('event.create')" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">New Event</Link>
        </template>

        <div v-if="$page.props.flash.message">{{ $page.props.flash.message }}</div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <section class="max-w-xl">
                        <table v-if="events.data">
                            <tr v-for="event in events.data" :key="event.id">
                                <td>{{ format( parseISO( event.created_at), 'd MMM, H:mm' ) }}</td>
                                <td>{{ tagsFormat(event.tags) }}</td>
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
    </AuthenticatedLayout>
</template>

<script setup>
import {Head} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Link } from '@inertiajs/vue3'
import Pagination from "@/Components/Pagination.vue";
import {format, parseISO} from "date-fns";

defineProps({
    events: Object,
})

function tagsFormat(tags) {
    let a = [];
    tags.forEach(tag => a.push(tag.name))
    return a.join()
}
</script>
