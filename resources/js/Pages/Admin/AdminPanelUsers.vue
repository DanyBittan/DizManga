<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";
import Modal from "@/Components/Modal.vue";
import FormLayout from "@/Layouts/FormLayout.vue";
import AdminLayout from "@/Components/AdminLayout.vue";

const props = defineProps({
    users: {
        required: true,
        type: Object,
    },
});
const showUpdateForm = ref(false);
</script>
<template>
    <AdminLayout>
        <div
            class="text-white w-11/12 h-44 flex my-8 rounded-l-xl"
            v-for="user in users"
        >
            <img
                :src="user.user_img"
                alt="ComicPic"
                class="w-36 h-auto object-cover rounded-l-xl"
            />
            <div class="px-4 flex flex-col w-1/3 p-2 rounded-r-lg bg-darkGray">
                <div class="flex justify-between">
                    <span class="text-2xl font-semibold">
                        {{ user.name }}
                    </span>
                    <img
                        v-if="user.admin"
                        src="../../../assets/crown.svg"
                        alt="adminLogo"
                        class="w-6 h-6"
                    />
                </div>
                <span class="text-xl font-bold text-gray-400/70">
                    {{ user.email }}
                </span>
                <Link
                    :href="route('adminUserDelete', { id: user.id })"
                    class="mt-auto"
                    v-if="user.id != $page.props.auth.user.id && !user.admin"
                >
                    <img
                        src="../../../assets/delete.svg"
                        alt="deleteButton"
                        class="w-6 h-6"
                    />
                </Link>
            </div>
        </div>
        <!-- <Modal :show="showUpdateForm">
            <FormLayout @close-modal="showModal" :comic="comic[index]">
                <template v-slot:title>
                    <span class="text-3xl text-gray-300">Edit Comic</span>
                </template>
                <template v-slot:buttonType>
                    <SecondaryButton>Update</SecondaryButton>
                </template>
            </FormLayout>
        </Modal> -->
    </AdminLayout>
</template>
