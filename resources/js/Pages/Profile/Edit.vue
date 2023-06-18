<script setup>
import { ref } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import DeleteUserForm from "./Partials/DeleteUserForm.vue";
import Modal from "@/Components/Modal.vue";
import UpdatePasswordForm from "./Partials/UpdatePasswordForm.vue";
import UpdateProfileInformationForm from "./Partials/UpdateProfileInformationForm.vue";
import { Head, usePage } from "@inertiajs/vue3";

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});
const showForm = ref(false);
const user = usePage().props.auth.user;
</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <div class="py-12 flex items-start">
            <div
                class="max-w-7xl h-full flex flex-col sm:px-6 lg:px-8 space-y-6"
            >
                <div
                    class="p-2 sm:p-8 shadow sm:rounded-lg w-full h-full border flex border-stone-800"
                >
                    <img
                        :src="user.user_img"
                        alt="user_img"
                        class="w-56 h-56 rounded-full mr-5"
                    />
                    <div class="flex flex-col">
                        <UpdateProfileInformationForm
                            :must-verify-email="mustVerifyEmail"
                            :status="status"
                            @open-modal="() => (showForm = !showForm)"
                            class="max-w-xl mx-5 self-start h-full"
                        />
                    </div>
                </div>
                <Modal :show="showForm">
                    <div class="p-4 sm:p-8 shadow sm:rounded-lg">
                        <UpdatePasswordForm
                            class="max-w-xl"
                            @close-modal="showForm = !showForm"
                        />
                    </div>
                </Modal>
            </div>
            <div class="p-4 sm:p-8 shadow sm:rounded-lg">
                <DeleteUserForm class="max-w-xl" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
