<script setup>
import MyBooksLayout from "@/Layouts/MyBooksLayout.vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    myComics: {
        type: Object,
        required: true,
    },
});
</script>
<template>
    <MyBooksLayout>
        <div
            v-for="comics in myComics"
            class="h-96 w-80 mx-8 my-4 flex flex-col justify-center"
        >
            <Link
                :href="route('comicDetails', { id: comics.id })"
                as="button"
                class="w-full relative "
            >
                <img
                    :src="comics.img"
                    alt="img"
                    class="w-full h-96 object-cover rounded-md shadow-lg shadow-black"
            />
            <span
                class="text-white w-full h-16 text-center text-lg m-auto font-bold absolute bottom-0 left-0 bg-neutral-950/95 py-1 line-clamp-2 overflow-hidden"
                >{{ comics.title }}</span
            >
        </Link>
            
        </div>
    </MyBooksLayout>
</template>
