<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import ComicScroll from "@/Components/ComicScroll.vue";
import SearchBar from "@/Components/SearchBar.vue";
import LatestComics from "@/Components/LatestComics.vue";

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


</script>
<template>
    <AuthenticatedLayout>
        <!-- Hero Section -->
        <section
            class="relative bg-gradient-to-b from-gray-950 via-black to-black pt-12 px-4 sm:px-6 lg:px-12 overflow-visible">
            <div class="relative w-full mx-auto">
                <!-- Title and Search -->
                <SearchBar />
            </div>
        </section>

        <!-- Featured Section -->
        <section class="bg-gradient-to-b from-black via-gray-900 to-black py-12 relative">
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
