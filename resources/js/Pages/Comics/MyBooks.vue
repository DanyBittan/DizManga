<script setup>
import MyBooksLayout from "@/Layouts/MyBooksLayout.vue";
import { Link } from "@inertiajs/vue3";
import { ref } from "vue";
import SearchBar from "@/Components/SearchBar.vue";


const props = defineProps({
    myComics: {
        type: Object,
        required: true,
    },
});
const filteredComics = ref(props.myComics)
</script>
<template>
    <MyBooksLayout>
        <SearchBar @update:filtered-comics="filteredComics = $event" :comicData="myComics" />
        <div class="flex flex-wrap mt-8 gap-16">
            <div v-for="comics in filteredComics" class="h-[28rem] w-1/5">
                <Link :href="route('comicDetails', { id: comics.id })" as="button" class="w-full relative ">
                    <img :src="comics.img" alt="img"
                        class="w-72 h-[28rem] object-cover rounded-md shadow-lg shadow-black" />
                    <span
                        class="text-white w-full h-16 text-center text-lg m-auto font-bold absolute bottom-0 left-0 bg-neutral-950/95 py-1 line-clamp-2 overflow-hidden">
                        {{ comics.title }}
                    </span>
                </Link>
            </div>
        </div>
    </MyBooksLayout>
</template>
