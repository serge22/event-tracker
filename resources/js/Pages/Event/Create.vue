<script setup>
import {Head, useForm} from '@inertiajs/vue3'
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const form = useForm({
    label: null,
    date: null,
})
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <form @submit.prevent="form.post(route('event.store'))">
            <div>
                <label>
                    <input type="text" v-model="form.label">
                    <div v-if="form.errors.label">{{ form.errors.label }}</div>
                </label>
            </div>

            <div>
                <button type="submit">Create</button>
            </div>
        </form>
    </AuthenticatedLayout>
</template>
