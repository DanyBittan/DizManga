<script setup>
import { IconSearch } from '@tabler/icons-vue';
import { Link } from '@inertiajs/vue3';
import { ref, watch } from "vue";
import axios from "axios";
import { router } from "@inertiajs/vue3";

const searchInput = ref("");
const suggestions = ref([]);
let waitingForSearch = null;

// Perform search and navigate to search results page
const search = () => {
    router.get("searchView", { search: searchInput.value });
};

// Fetch search suggestions based on user input
const searchSimilar = (query) => {
    if (query.length < 2) {
        suggestions.value = [];
        return;
    }

    axios.get(route('searchSuggestions', { q: query }))
        .then((response) => {
            suggestions.value = response.data.suggestions;
            console.log(suggestions.value);
        })
        .catch((error) => {
            console.error('Error fetching search suggestions:', error);
        });
}
// Watch for changes in the search input to fetch suggestions
watch(searchInput, (value) => {

    if (waitingForSearch) {
        clearTimeout(waitingForSearch)
    }

    waitingForSearch = setTimeout(() => {
        searchSimilar(value)
    }, 750)
}); 
</script>
<template>
    <div class="flex flex-col justify-center max-w-3xl mx-auto relative z-10">
        <!-- Search Bar Container -->
        <div class="relative">
            <!-- Main Search Bar -->
            <div
                class="flex items-center bg-neutral-800/80 backdrop-blur-sm rounded-2xl border border-neutral-700/50 focus-within:border-blue-500/50 focus-within:ring-2 focus-within:ring-blue-500/20 transition-all shadow-2xl">
                <div class="pl-5 text-gray-400">
                    <IconSearch class="w-5 h-5" />
                </div>
                <input type="text" placeholder="Search your favorite comics..." v-model="searchInput"
                    class="flex-1 border-0 bg-transparent text-white placeholder-gray-400 focus:ring-0 py-4 px-4 text-base"
                    @keyup.enter="search" />
                <button v-if="searchInput" @click="searchInput = ''; suggestions = []"
                    class="text-gray-400 hover:text-white px-3 transition">
                    ✕
                </button>
                <button @click="search"
                    class="bg-blue-600 hover:bg-blue-500 text-white font-semibold px-6 py-3 rounded-xl m-1.5 transition-all hover:shadow-lg hover:shadow-blue-500/50">
                    Search
                </button>
            </div>

            <!-- Suggestions Dropdown (Absolute) -->
            <transition enter-active-class="transition ease-out duration-200" enter-from-class="opacity-0 translate-y-1"
                enter-to-class="opacity-100 translate-y-0" leave-active-class="transition ease-in duration-150"
                leave-from-class="opacity-100 translate-y-0" leave-to-class="opacity-0 translate-y-1">
                <div v-if="suggestions.length > 0"
                    class="absolute top-full left-0 right-0 mt-2 bg-neutral-900/98 backdrop-blur-xl rounded-xl shadow-2xl border border-neutral-700/50 z-[100] max-h-[28rem] overflow-x-hidden overflow-y-auto hidden md:block">
                    <div class="p-1.5">
                        <Link :href="route('comicDetails', { id: suggestedComics.id })"
                            v-for="suggestedComics in suggestions" :key="suggestedComics.id"
                            class="flex gap-3 hover:bg-neutral-800/70 rounded-lg p-2.5 items-center transition-all group cursor-pointer">
                            <div class="relative flex-shrink-0">
                                <img :src="suggestedComics.img" alt="comic image"
                                    class="w-12 h-16 rounded-md object-cover shadow-lg group-hover:shadow-blue-500/30 transition-shadow" />
                            </div>
                            <div class="flex-1 min-w-0 max-w-full">
                                <h4
                                    class="text-lg font-extrabold text-white group-hover:text-blue-400 transition-colors truncate">
                                    {{ suggestedComics.title }}
                                </h4>
                                <span
                                    class="text-md text-gray-300 font-bold w-full block group-hover:text-blue-400 transition-colors truncate">
                                    {{ suggestedComics.volume }}
                                </span>
                                <p class="text-xs text-gray-500 mt-0.5" v-if="suggestedComics.publisher">
                                    {{ suggestedComics.publisher }}
                                </p>
                            </div>
                            <div class="text-gray-500 group-hover:text-blue-400 transition-colors text-sm">
                                →
                            </div>
                        </Link>
                    </div>
                </div>
            </transition>
        </div>
    </div>
</template>