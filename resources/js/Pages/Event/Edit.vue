<script setup>
import {Head, useForm} from '@inertiajs/vue3'
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import TagifyInput from "@/Components/TagifyInput.vue";

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
    <Head title="Add event" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <section class="max-w-xl">
                        <form @submit.prevent="form.put(route('event.update', props.event.id))" class="mt-6 space-y-6">
                            <div>
                                <InputLabel for="tags" value="Name" />

                                <TagifyInput v-model="form.tags" class="mt-1 block w-full" />

                                <InputError class="mt-2" :message="form.errors.tags" />
                            </div>

                            <div>
                                <InputLabel for="date" value="Date" />

                                <VueDatePicker v-model="form.date" />

                                <InputError class="mt-2" :message="form.errors.date" />
                            </div>

                            <div>
                                <PrimaryButton>Create</PrimaryButton>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
