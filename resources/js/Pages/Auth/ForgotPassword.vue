<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import {Head, useForm} from '@inertiajs/vue3';

defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
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
        <Head title="Forgot Password" />

        <v-container class="fill-height">
            <v-row align="center" justify="center">
                <v-col>
                    <v-card
                        class="mx-auto"
                        max-width="344"
                        title="Forgot Password"
                    >
                        <v-container>

                            <v-alert v-if="status" :text="status" type="success"></v-alert>

                            <div class="mb-4 text-sm text-gray-600">
                                Forgot your password? No problem. Just let us know your email address and we will email you a password reset
                                link that will allow you to choose a new one.
                            </div>

                            <v-form @submit.prevent="submit">
                                <v-text-field
                                    v-model="form.email"
                                    type="email"
                                    label="Email"
                                    :error-messages="form.errors.email"
                                    :rules="[rules.required, rules.email]"
                                ></v-text-field>

                                <v-btn class="mt-2" type="submit" :disabled="form.processing" block>Email Password Reset Link</v-btn>

                            </v-form>
                        </v-container>
                    </v-card>
                </v-col>
            </v-row>
        </v-container>

    </GuestLayout>
</template>
