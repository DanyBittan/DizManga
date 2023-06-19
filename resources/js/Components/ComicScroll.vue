<script setup>
import { Link } from "@inertiajs/vue3";
const props = defineProps({
    comics: Object,
});
</script>
<template>
    <span class="text-4xl font-bold text-gray-300 mx-12">Most popular</span>
    <div
        class="w-full h-[26rem] rounded-lg mt-10 overflow-hidden text-white flex flex-wrap justify-center items-center p-6"
    >
        <div
            class="w-72 h-full mx-16 rounded-xl"
            v-for="comic in comics"
            :key="comic.id"
        >
            <Link
                :href="route('comicDetails', { id: comic.id })"
                as="button"
                class="h-full w-full"
                ><img
                    :src="comic.img"
                    alt="Comic Img"
                    class="h-full w-full rounded-lg object-cover"
            /></Link>
        </div>
    </div>
</template>
