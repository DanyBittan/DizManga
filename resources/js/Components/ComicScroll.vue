<script setup>
import { Link } from "@inertiajs/vue3";
const props = defineProps({
    comics: Object,
});

</script>
<template>
    <section class="py-16 px-4 sm:px-6 lg:px-12">
        <div class="flex justify-between items-center mb-12">
            <div>
                <h2 class="text-4xl sm:text-5xl md:text-7xl font-black text-white tracking-tight">FEATURED</h2>
                <p class="text-gray-400 text-lg sm:text-xl md:text-2xl mt-2">Comic books we love.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div v-for="comic in comics" :key="comic.id" class="group cursor-pointer">
                <Link :href="route('comicDetails', { id: comic.id })" as="button"
                    class="block w-full focus:outline-none">
                    <div class="flex flex-col sm:flex-row gap-4 sm:gap-6 h-full">
                        <!-- Image Container (Left) -->
                        <div
                            class="relative overflow-hidden rounded-lg shadow-xl bg-gray-900 h-96 w-full sm:w-64 flex-shrink-0">
                            <img :src="comic.img" :alt="comic.title"
                                class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105" />
                        </div>

                        <!-- Info Container (Right) -->
                        <div class="flex flex-col justify-between py-2 overflow-hidden">
                            <!-- Label (BESTSELLER, MUST READ, etc.) -->
                            <div
                                class="text-sm sm:text-md text-start font-bold text-gray-400 uppercase tracking-widest">
                                MUST READ
                            </div>

                            <!-- Title -->
                            <div class="text-start">
                                <h3
                                    class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-gray-300 group-hover:text-gray-200 transition text-start">
                                    {{ comic.title }}
                                </h3>
                            </div>
                            <!-- Rating Stars -->
                            <span class="text-base sm:text-lg text-start text-neutral-400 font-bold mt-4 sm:mt-0">
                                User score: <span class="text-white">{{ comic.review_avg_rating }}%</span>
                            </span>
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
