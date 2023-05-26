<script setup>
import { Link } from "@inertiajs/vue3";
const props = defineProps({
    comics: Object,
});
</script>
<template>
    <div
        class="w-full h-[60vh] bg-black rounded-lg mt-10 overflow-hidden text-white flex flex-wrap justify-center items-center p-6"
    >
        <div
            class="w-1/5 h-5/6 m-10 rounded-xl"
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
                    class="h-full w-full rounded-xl object-cover"
            /></Link>
        </div>
    </div>
</template>
