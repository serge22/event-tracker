<script setup>
import { Link, useForm, usePage } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    email: user.email,
});
</script>

<template>
    <div>
        <v-form @submit.prevent="form.patch(route('profile.update'))">
            <v-card>
                <v-card-item>
                    <v-card-title>Profile Information</v-card-title>
                    <v-card-subtitle>Update your account's profile information and email address.</v-card-subtitle>
                </v-card-item>
                <v-card-text>
                    <v-text-field
                        v-model="form.name"
                        label="Name"
                        :error-messages="form.errors.name"
                        autocomplete="name"
                        autofocus
                    ></v-text-field>

                    <v-text-field
                        v-model="form.email"
                        label="Email"
                        :error-messages="form.errors.email"
                        type="email"
                        autocomplete="username"
                    ></v-text-field>

                    <div v-if="mustVerifyEmail && user.email_verified_at === null">
                        <p class="text-sm mt-2 text-gray-800">
                            Your email address is unverified.
                            <Link
                                :href="route('verification.send')"
                                method="post"
                                as="button"
                                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            >
                                Click here to re-send the verification email.
                            </Link>
                        </p>

                        <div
                            v-show="status === 'verification-link-sent'"
                            class="mt-2 font-medium text-sm text-green-600"
                        >
                            A new verification link has been sent to your email address.
                        </div>
                    </div>
                </v-card-text>

                <v-card-actions>
                    <v-btn
                        :disabled="form.processing"
                        :loading="form.processing"
                        color="primary"
                        type="submit"
                    >Save</v-btn>
                </v-card-actions>
            </v-card>
        </v-form>

        <v-snackbar
            v-model="form.recentlySuccessful"
        >
            Saved

            <template v-slot:actions>
                <v-btn
                    color="pink"
                    variant="text"
                    @click="form.recentlySuccessful = false"
                >
                    Close
                </v-btn>
            </template>
        </v-snackbar>
    </div>
</template>
