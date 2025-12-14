<script setup>
import { useForm } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import ComicScroll from "@/Components/ComicScroll.vue";
import LatestComics from "@/Components/LatestComics.vue";
import { IconSearch } from '@tabler/icons-vue';

const props = defineProps({
    allComics: {
        type: Object,
        required: true,
    },
    latest: {
        type: Object,
        required: true,
    },
});
const form = useForm({
    search: "",
});
const search = () => {
    form.post("searchView");
};
/* watch(searcher, (value) => {
    if (value) {
        router.get("home", {
            searcher: value,
            only: ["search"],
            preserveState: true,
            preserveScroll: true,
        });
    }
}); */
</script>
<template>
    <AuthenticatedLayout>
        <!-- Hero Section -->
        <section class="relative bg-gradient-to-b from-gray-950 via-black to-black pt-12 pb-8 px-4 sm:px-6 lg:px-12 overflow-hidden">
            
            <div class="relative max-w-7xl mx-auto">
                <!-- Title and Search -->
                <div >
                    <!-- Search Bar -->
                    <div class="flex gap-2 max-w-2xl mx-auto">
                        <input
                            type="search"
                            placeholder="Search comics..."
                            v-model="form.search"
                            class="flex-1 border-0 rounded-lg bg-neutral-800 text-white placeholder-gray-500 focus:ring-2 focus:ring-blue-500 py-3 px-4"
                            @keyup.enter="search"
                        />
                        <button
                            @click="search"
                            class="bg-blue-900 hover:bg-blue-500 text-white font-bold px-6 py-3 rounded-lg transition"
                        >
                            <IconSearch class="w-6 h-6" />
                        </button>
                    </div>
                    <div class="h-16 bg-white">

                    </div>
                </div>
            </div>
        </section>

        <!-- Featured Section -->
        <section class="bg-gradient-to-b from-black via-gray-950 to-black py-12">
            <ComicScroll :comics="allComics" />
        </section>

        <!-- Smooth Separator -->
        <div class="h-px bg-gradient-to-r from-transparent via-gray-900 to-transparent"></div>

        <!-- Latest Releases Section -->
        <section class="bg-gradient-to-b from-black to-gray-900 py-12">
            <LatestComics :latest="latest" />
        </section>
    </AuthenticatedLayout>
</template>
