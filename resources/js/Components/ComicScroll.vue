<script setup>
import { Link } from "@inertiajs/vue3";
const props = defineProps({
    comics: Object,
});

</script>
<template>
    <section class="py-16 px-4 sm:px-6 lg:px-12">
        <div class="mb-12">
            <h2 class="text-4xl sm:text-5xl md:text-7xl font-black text-white tracking-tight">FEATURED</h2>
            <p class="text-gray-400 text-lg sm:text-xl md:text-2xl mt-2">Comic books we love.</p>
        </div>


        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
            <div v-for="comic in comics" :key="comic.id" class="group cursor-pointer">
                <Link :href="route('comicDetails', { id: comic.id })"
                    class="block w-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-slate-950 rounded-xl h-full"
                    :aria-label="`Ver detalles de ${comic.title}`">

                    <div
                        class="flex flex-col h-full rounded-xl border border-slate-700/50 overflow-hidden transition-all duration-300 hover:border-blue-500/50 hover:shadow-2xl hover:shadow-blue-500/10 hover:-translate-y-1">

                        <!-- Image Container with Overlay -->
                        <div class="relative overflow-hidden bg-slate-900 aspect-[2/3] flex-shrink-0">
                            <img :src="comic.img" :alt="comic.title"
                                class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110" />

                            <!-- Gradient Overlay for better text visibility -->
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/20 to-transparent opacity-60">
                            </div>

                            <div class="absolute top-3 left-3">
                                <span
                                    class="inline-flex items-center px-3 py-1 text-xs font-bold tracking-wider uppercase bg-red-600/90 text-white rounded-full backdrop-blur-sm">
                                    Must Read
                                </span>
                            </div>

                        </div>

                        <!-- Info Container -->
                        <div
                            class="flex flex-col justify-between flex-1 p-4 bg-gradient-to-b from-slate-900 to-slate-950">
                            <div class="flex-1">
                                <h3
                                    class="text-xl md:text-2xl font-bold text-gray-200 group-hover:text-white transition-colors duration-300 line-clamp-2 leading-tight">
                                    {{ comic.title }}
                                </h3>
                            </div>

                            <!-- View More Indicator -->
                            <div
                                class="mt-3 flex items-center text-sm text-blue-400 group-hover:text-blue-300 transition-colors">
                                <span class="font-medium">View more</span>
                                <svg class="ml-1 w-4 h-4 transition-transform group-hover:translate-x-1" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
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

.line-clamp-2 {
    display: -webkit-box;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
