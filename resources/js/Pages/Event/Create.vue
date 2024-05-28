<script setup>
import {Head, useForm} from '@inertiajs/vue3'
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import DateTimePicker from "@/Components/DateTimePicker.vue";
import {mdiCalendar} from "@mdi/js";

defineProps({
    tags: Array,
})

const form = useForm({
    tags: [],
    date: new Date().toISOString(),
})
</script>

<template>
    <Head title="Add event" />

    <AuthenticatedLayout>
        <template v-slot:app-bar-title>New Event</template>

        <v-container fluid>
            <v-form validate-on="submit lazy" @submit.prevent="form.post(route('event.store'))">

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
                    text="Create"
                    type="submit"
                ></v-btn>
            </v-form>
        </v-container>
    </AuthenticatedLayout>
</template>
