<script setup>
import DangerButton from "@/Components/DangerButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import Modal from "@/Components/Modal.vue";
import {ref} from "vue";

defineProps({
    eventToDelete: {
        type: Number,
    },
});

function confirmDeletion() {
    return window.confirm('Are you sure?')
}

const confirmingEventDeletion = ref(false);

const confirmEventDeletion = () => {
    confirmingEventDeletion.value = true;
};
const closeModal = () => {
    confirmingEventDeletion.value = false;
};

const deleteUser = () => {
    form.delete(route('profile.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};
</script>

<template>
    <Modal :show="!!eventToDelete" @close="closeModal">
        test

        <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>
<!--
        <DangerButton
            class="ms-3"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
            @click="deleteUser"
        >
            Delete Account
        </DangerButton>
        -->
    </Modal>
</template>
