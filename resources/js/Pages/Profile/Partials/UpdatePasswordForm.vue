<script setup>
import {useForm} from '@inertiajs/vue3';
import { ref } from 'vue';

const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const updatePassword = () => {
    form.put(route('password.update'), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.password) {
                form.reset('password', 'password_confirmation');
                passwordInput.value.focus();
            }
            if (form.errors.current_password) {
                form.reset('current_password');
                currentPasswordInput.value.focus();
            }
        },
    });
};
</script>

<template>
    <div>
        <v-form @submit.prevent="updatePassword">
            <v-card>
                <v-card-item>
                    <v-card-title>Update Password</v-card-title>
                    <v-card-subtitle>Ensure your account is using a long, random password to stay secure.</v-card-subtitle>
                </v-card-item>
                <v-card-text>
                    <v-text-field
                        label="Current Password"
                        type="password"
                        ref="currentPasswordInput"
                        v-model="form.current_password"
                        :error-messages="form.errors.current_password"
                        autocomplete="current-password"
                    ></v-text-field>

                    <v-text-field
                        label="New Password"
                        type="password"
                        ref="passwordInput"
                        v-model="form.password"
                        :error-messages="form.errors.password"
                        autocomplete="new-password"
                    ></v-text-field>

                    <v-text-field
                        label="Confirm Password"
                        type="password"
                        v-model="form.password_confirmation"
                        :error-messages="form.errors.password_confirmation"
                        autocomplete="new-password"
                    ></v-text-field>
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
