<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};

const rules = {
    required: value => !!value || 'Required.',
    email: value => {
        const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        return pattern.test(value) || 'Invalid e-mail.'
    },
}
</script>

<template>
    <GuestLayout>
        <Head title="Register" />

        <v-container class="fill-height">
            <v-row align="center" justify="center">
                <v-col>
                    <v-card
                        class="mx-auto"
                        max-width="344"
                        title="Register"
                    >
                        <v-container>
                            <v-form @submit.prevent="submit">
                                <v-text-field
                                    v-model="form.name"
                                    label="Name"
                                    :error-messages="form.errors.name"
                                    :rules="[rules.required]"
                                ></v-text-field>

                                <v-text-field
                                    v-model="form.email"
                                    type="email"
                                    label="Email"
                                    :error-messages="form.errors.email"
                                    :rules="[rules.required, rules.email]"
                                ></v-text-field>

                                <v-text-field
                                    v-model="form.password"
                                    type="password"
                                    label="Password"
                                    :error-messages="form.errors.password"
                                    :rules="[rules.required]"
                                ></v-text-field>

                                <v-text-field
                                    v-model="form.password_confirmation"
                                    type="password"
                                    label="Confirm Password"
                                    :error-messages="form.errors.password_confirmation"
                                ></v-text-field>

                                <v-btn class="mt-2" type="submit" :disabled="form.processing" block>Register</v-btn>

                                <Link
                                    :href="route('login')"
                                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                >
                                    Already registered?
                                </Link>

                            </v-form>
                        </v-container>
                    </v-card>
                </v-col>
            </v-row>
<!--
            <form @submit.prevent="submit">
                <div>
                    <InputLabel for="name" value="Name" />

                    <TextInput
                        id="name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.name"
                        required
                        autofocus
                        autocomplete="name"
                    />

                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <div class="mt-4">
                    <InputLabel for="email" value="Email" />

                    <TextInput
                        id="email"
                        type="email"
                        class="mt-1 block w-full"
                        v-model="form.email"
                        required
                        autocomplete="username"
                    />

                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class="mt-4">
                    <InputLabel for="password" value="Password" />

                    <TextInput
                        id="password"
                        type="password"
                        class="mt-1 block w-full"
                        v-model="form.password"
                        required
                        autocomplete="new-password"
                    />

                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div class="mt-4">
                    <InputLabel for="password_confirmation" value="Confirm Password" />

                    <TextInput
                        id="password_confirmation"
                        type="password"
                        class="mt-1 block w-full"
                        v-model="form.password_confirmation"
                        required
                        autocomplete="new-password"
                    />

                    <InputError class="mt-2" :message="form.errors.password_confirmation" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <Link
                        :href="route('login')"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Already registered?
                    </Link>

                    <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Register
                    </PrimaryButton>
                </div>
            </form>
-->
        </v-container>
    </GuestLayout>
</template>
