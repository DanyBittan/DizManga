<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";
import AdminLayout from "@/Components/AdminLayout.vue";

const props = defineProps({
    users: {
        required: true,
        type: Object,
    },
});
</script>
<template>
    <AdminLayout>
        <div
            class="text-white w-11/12 h-36 flex m-12 rounded-l-xl"
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
                    class="mt-auto w-fit"
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
        <div class="text-white">aaa</div>
    </AdminLayout>
</template>
