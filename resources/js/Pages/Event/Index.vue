<template>
    <Head title="Events" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Events</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <section class="max-w-xl">
                        <table v-if="events">
                            <tr v-for="event in events" :key="event.id">
                                <td>{{ dateFormat(event.created_at) }}</td>
                                <td>{{ tagsFormat(event.tags) }}</td>
                            </tr>
                        </table>
                    </section>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import {Head} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

defineProps({
    events: Array,
})

function dateFormat(dateString) {
    const date = new Date(dateString);
    return new Intl.DateTimeFormat('default', {dateStyle: 'medium', timeStyle: 'medium'}).format(date);
}

function tagsFormat(tags) {
    let a = [];
    tags.forEach(tag => a.push(tag.name))
    return a.join()
}
</script>
