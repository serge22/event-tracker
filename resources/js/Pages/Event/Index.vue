<template>
    <Head title="Events" />

    <AuthenticatedLayout>
        <template v-slot:app-bar-title>Events</template>
        <template v-slot:app-bar-append>
            <v-btn
                :icon="mdiPlus"
                :to="route('event.create')"></v-btn>
        </template>
<!--
        <v-container v-if="$page.props.flash.message" fluid>
            <v-alert type="info" :text="$page.props.flash.message" closable></v-alert>
        </v-container>
-->
        <v-list v-if="events.data" lines="two">
            <v-list-item
                v-for="event in events.data"
                :key="event.id"
                :title="tagsFormat(event.tags)"
                :subtitle="dayjs(event.created_at).format('D MMM, H:mm')"
            >
                <template v-slot:append>
                    <v-btn icon variant="flat" :href="route('event.edit', event.id)">
                        <v-icon :icon="mdiPencil"></v-icon>
                        <v-tooltip activator="parent" location="bottom">Edit</v-tooltip>
                    </v-btn>

                    <v-btn icon variant="flat" @click="deleteEvent(event.id)">
                        <v-icon :icon="mdiDelete"></v-icon>
                        <v-tooltip activator="parent" location="bottom">Delete</v-tooltip>
                    </v-btn>
                </template>
            </v-list-item>
        </v-list>

        <v-pagination
            v-model="currentPage"
            :length="events.last_page"
        ></v-pagination>

        <v-snackbar v-model="snackbarDelete">
            Event moved to Trash.

            <template v-slot:actions>
                <v-btn
                    color="info"
                    @click="deleteUndo"
                >
                    Undo
                </v-btn>
                <v-btn
                    icon
                    @click="snackbarDelete = false"
                >
                    <v-icon :icon="mdiClose"></v-icon>
                </v-btn>
            </template>
        </v-snackbar>

        <v-snackbar v-model="snackbarUndone">
            Action undone.

            <template v-slot:actions>
                <v-btn icon @click="snackbarUndone = false">
                    <v-icon :icon="mdiClose"></v-icon>
                </v-btn>
            </template>
        </v-snackbar>

    </AuthenticatedLayout>
</template>

<script setup>
import {Head, router} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {mdiClose, mdiDelete, mdiPencil, mdiPlus} from '@mdi/js'
import dayjs from "dayjs";
import {ref, watch} from "vue";

const props = defineProps({
    events: Object,
})

const currentPage = ref(props.events.current_page);
const snackbarDelete = ref(false);
const snackbarUndone = ref(false);
const lastRemoved = ref(0);

function tagsFormat(tags) {
    let a = [];
    tags.forEach(tag => a.push(tag.name))
    return a.join()
}

watch(currentPage, (val) => {
    router.get(props.events.links[val].url)
})

function deleteEvent(eventId) {
    snackbarDelete.value = true;
    lastRemoved.value = eventId;
    router.delete(route('event.destroy', eventId));
    // router.delete(route('event.destroy', eventId), { preserveState: true });
}

function deleteUndo() {
    snackbarDelete.value = false;
    snackbarUndone.value = true;
    router.put(route('event.restore', lastRemoved.value));
}
</script>
