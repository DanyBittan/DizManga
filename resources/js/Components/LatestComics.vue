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
    <section class="py-16 px-4 sm:px-6 lg:px-12">
        <!-- Header -->
        <div class="mb-12">
            <h2 class="text-5xl font-black text-white tracking-tight">LATEST RELEASES</h2>
            <p class="text-gray-400 text-lg mt-2">Fresh comics just added to our collection.</p>
            <div class="mt-4 h-1 w-24 bg-gradient-to-r from-blue-500 to-purple-600 rounded"></div>
        </div>

        <!-- Grid Container -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <Link
                v-for="comic in latest"
                :key="comic.id"
                :href="route('comicDetails', { id: comic.id })"
                as="button"
                class="group focus:outline-none"
            >
                <div class="relative overflow-hidden rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 h-full">
                    <!-- Image Container -->
                    <div class="relative overflow-hidden bg-gray-900 h-96">
                        <img
                            :src="comic.img"
                            :alt="comic.title"
                            class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110"
                        />
                        
                        <!-- Overlay on hover -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        
                        <!-- Title overlay -->
                        <div class="absolute inset-0 p-4 flex items-end opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <p class="text-white font-bold text-2xl line-clamp-2">{{ comic.title }}</p>
                        </div>
                    </div>

                    <!-- Footer Info -->
                    <div class="bg-neutral-900 border-t border-neutral-700 p-4">
                        <h3 class="text-white font-bold text-2xl line-clamp-1 group-hover:text-blue-400 transition">
                            {{ comic.title }}
                        </h3>
                        <p class="text-gray-400 text-lg mt-2 line-clamp-1">
                            {{ comic.publisher }}
                        </p>
                        <div class="mt-3 flex items-center justify-between">
                            <span class="text-blue-400 font-bold text-lg">{{ comic.price }}€</span>
                            <span class="text-lg text-gray-400 bg-gray-800 px-2 py-1 rounded">
                                Click to view
                            </span>
                        </div>
                    </div>
                </div>
            </Link>
        </div>
    </section>
</template>

<style scoped>
/* Smooth hover effect */
:deep(button) {
    transition: all 0.3s ease;
}
</style>