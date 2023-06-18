<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Link } from "@inertiajs/vue3";
const props = defineProps({
    search: {
        type: Object,
        required: true,
    },
});
</script>
<template>
    <AuthenticatedLayout>
        <div class="w-full min-h-screen h-full">
            <div class="w-full py-5 px-16" v-for="search in search">
                <Link
                    :href="route('comicDetails', { id: search.id })"
                    as="button"
                    class="flex w-full rounded-r-xl"
                >
                    <div>
                        <img
                            :src="search.img"
                            alt="search"
                            class="h-72 w-64 rounded-l-xl"
                        />
                    </div>
                    <div
                        class="w-full h-72 bg-darkGray px-6 py-4 text-white rounded-r-xl"
                    >
                        <div class="flex justify-between">
                            <span class="text-4xl">{{ search.title }}</span>
                            <span class="text-2xl text-yellow-500">{{
                                search.price
                            }}</span>
                        </div>
                        <div class="flex flex-col items-start">
                            <span
                                class="text-gray-200/70 text-xl text-start mt-2"
                                >{{ search.launch_date }}</span
                            >
                            <div class="mt-4 h-32 flex flex-col items-start">
                                <span class="text-xl">Sinopsis:</span>
                                <p class="p-2 h-full overflow-auto">
                                    {{ search.sinopsis }}
                                </p>
                            </div>
                        </div>
                    </div>
                </Link>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
