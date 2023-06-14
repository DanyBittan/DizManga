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
            class="w-80 h-full px-2 my-12 flex justify-center content-center"
        >
            <Link
                :href="route('comicDetails', { id: latest.id })"
                as="button"
                class="w-11/12 relative"
            >
                <img
                    :src="latest.img"
                    alt="img"
                    class="h-[35vh] hover:blur-sm w-11/12 rounded-lg object-cover"
                />
            </Link>
        </div>
    </div>
</template>
