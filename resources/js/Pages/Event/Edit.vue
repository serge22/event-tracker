<script setup>
import {Head, useForm} from '@inertiajs/vue3'
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import DateTimePicker from "@/Components/DateTimePicker.vue";
import {mdiCalendar} from "@mdi/js";

const props = defineProps({
    event: Object,
})

const form = useForm({
    tags: props.event.tags.map(tag => tag.name),
    date: props.event.created_at,
})

console.log(props.event.tags)
</script>

<template>
    <Head title="Edit event" />

    <AuthenticatedLayout>
        <template v-slot:app-bar-title>Edit Event</template>

        <v-container fluid>
            <v-form validate-on="submit lazy" @submit.prevent="form.put(route('event.update', props.event.id))">

                <v-combobox
                    label="Tags"
                    v-model="form.tags"
                    :items="tags"
                    :error-messages="form.errors.tags"
                    chips
                    closable-chips
                    multiple
                    hide-selected
                ></v-combobox>

                <DateTimePicker
                    label="Date"
                    v-model="form.date"
                    :error-messages="form.errors.date"
                    :append-inner-icon="mdiCalendar"
                ></DateTimePicker>

                <v-btn
                    :loading="form.processing"
                    text="Save"
                    type="submit"
                ></v-btn>
            </v-form>
        </v-container>
    </AuthenticatedLayout>
</template>
