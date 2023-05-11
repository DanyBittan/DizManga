<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import ComicScroll from "@/Components/ComicScroll.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";

const props = defineProps({
    allComics: Array,
});
</script>
<template>
    <GuestLayout>
        <ComicScroll :comics="allComics"> </ComicScroll>
    </GuestLayout>
</template>
