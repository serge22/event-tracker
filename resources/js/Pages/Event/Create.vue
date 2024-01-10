<script setup>
import {Head, useForm} from '@inertiajs/vue3'
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";

const form = useForm({
    tags: '',
    date: '',
    timezone: Intl.DateTimeFormat().resolvedOptions().timeZone,
})
</script>

<template>
    <Head title="Add event" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <section class="max-w-xl">
                        <form @submit.prevent="form.post(route('event.store'))" class="mt-6 space-y-6">
                            <div>
                                <InputLabel for="tags" value="Name" />

                                <TextInput
                                    id="tags"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.tags"
                                    required
                                    autofocus
                                />

                                <InputError class="mt-2" :message="form.errors.tags" />
                            </div>

                            <div class="flex gap-3">
                                <div class="grow">
                                    <InputLabel for="date" value="Date" />

                                    <TextInput
                                        id="date"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.date"
                                    />
                                </div>

                                <div>
                                    <InputLabel for="timezone" value="Timezone" />
                                    <TextInput
                                        id="timezone"
                                        type="text"
                                        class="mt-1"
                                        v-model="form.timezone"
                                        disabled
                                    />
                                </div>
                            </div>
                            <InputError class="mt-2" :message="form.errors.date" />

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
