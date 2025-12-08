<script setup>
import { Link } from "@inertiajs/vue3";
const props = defineProps({
    comics: Object,
});

// console.log(props.comics[2]['review'][4]['rating']);
const renderStars = (rating) => {
    if (!rating) return 0;
    return Math.round(rating / 10 * 5 * 10) / 10; // CONVERT THE AVERAGE RATING TO A 5-STAR SCALE
};
</script>
<template>
    <section class="py-16 px-4 sm:px-6 lg:px-12">
        <div class="flex justify-between items-center mb-12">
            <div>
                <h2 class="text-7xl font-black text-white tracking-tight">FEATURED</h2>
                <p class="text-gray-400 text-2xl mt-2">Comic books we love.</p>
            </div>
            <!-- <Link :href="route()" class="text-white font-bold text-2xl hover:text-gray-300 transition flex items-center gap-2">
                SEE ALL <span class="text-xl">›</span>
            </Link> -->
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div
                v-for="comic in comics"
                :key="comic.id"
                class="group cursor-pointer"
            >
                <Link
                    :href="route('comicDetails', { id: comic.id })"
                    as="button"
                    class="block w-full focus:outline-none"
                >
                    <div class="flex gap-6 h-full">
                        <!-- Image Container (Left) -->
                        <div class="relative overflow-hidden rounded-lg shadow-xl bg-gray-900 h-96 w-64 flex-shrink-0">
                            <img
                                :src="comic.img"
                                :alt="comic.title"
                                class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                            />
                        </div>

                        <!-- Info Container (Right) -->
                        <div class="space-y-3 flex flex-col justify-between py-2 overflow-hidden">
                            <!-- Label (BESTSELLER, MUST READ, etc.) -->
                            <div class="text-md text-start font-bold text-gray-400 uppercase tracking-widest">
                                MUST READ
                            </div>

                            <!-- Title -->
                            <h3 class="text-6xl font-bold text-gray-300 group-hover:text-gray-200 transition text-start ">
                                {{ comic.title }}
                            </h3>

                            <!-- Description -->
                            <!-- <p class="text-sm text-gray-400 line-clamp-3 overflow-hidden">
                                {{ comic.sinopsis }}
                            </p> -->

                            <!-- Rating Stars -->
                            <div class="flex items-center gap-1 pt-2">
                                <div class="flex gap-0.5">
                                    <span v-for="i in 5" :key="i" class="text-yellow-400">
                                        <svg v-if="i <= Math.round(renderStars(comic.rating ?? 40))" class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                        </svg>
                                        <svg v-else class="w-4 h-4 fill-gray-600" viewBox="0 0 20 20">
                                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                        </svg>
                                    </span>
                                </div>
                                <span class="text-sm text-gray-400 ml-2">{{ (renderStars(comic.rating ?? 40)).toFixed(1) }}</span>
                            </div>
                        </div>
                    </div>
                </Link>
            </div>
        </div>
    </section>
</template>

<style scoped>
:deep(a) {
    transition: all 0.3s ease;
}
</style>
