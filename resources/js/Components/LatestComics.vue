<script setup>
import { Link } from "@inertiajs/vue3";
const props = defineProps({
    latest: {
        required: true,
        type: [Object],
    },
});
</script>
<template>
    <div class="flex justify-evenly flex-wrap mt-6">
        <div
            v-for="latest in latest"
            class="w-56 h-full px-2 my-12 mx-3 flex justify-center content-center"
        >
            <Link
                :href="route('comicDetails', { id: latest.id })"
                as="button"
                class="w-full"
            >
                <div class="relative">
                    <img
                        :src="latest.img"
                        alt="img"
                        class="h-[35vh] w-full rounded-lg object-cover relative"
                    />
                    <span class="w-full h-1/6 bg-darkGray text-xl">{{
                        latest.title
                    }}</span>
                </div>
            </Link>
        </div>
    </div>
</template>
