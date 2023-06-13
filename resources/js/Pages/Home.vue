<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import ComicScroll from "@/Components/ComicScroll.vue";
import LatestComics from "@/Components/LatestComics.vue";

const props = defineProps({
    allComics: {
        type: [Object],
        required: true,
    },
    latest: {
        type: [Object],
        required: true,
    },
});
</script>
<template>
    <AuthenticatedLayout>
        <ComicScroll :comics="allComics" />
        <div
            class="w-full h-full text-gray-400 px-10 py-8 my-5 text-4xl font-bold"
        >
            Latest
            <LatestComics :latest="latest" />
        </div>
    </AuthenticatedLayout>
</template>
