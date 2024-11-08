<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
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
        <Head title="Log in" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <v-container class="fill-height">
            <v-row align="center" justify="center">
                <v-col>
                    <v-card
                        class="mx-auto"
                        max-width="344"
                        title="User Login"
                    >
                        <v-container>
                            <v-form @submit.prevent="submit">
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

                                <v-checkbox v-model="form.remember" label="Remember me"></v-checkbox>

                                <v-btn class="mt-2" type="submit" :disabled="form.processing" block>Log in</v-btn>
                                <v-btn :href="route('register')" class="mt-2" block>Register</v-btn>

                                <Link
                                    v-if="canResetPassword"
                                    :href="route('password.request')"
                                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                >
                                    Forgot your password?
                                </Link>

                            </v-form>
                        </v-container>
                    </v-card>
                </v-col>
            </v-row>
        </v-container>

    </GuestLayout>
</template>
