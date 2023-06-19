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
            class="h-96 w-64 mx-8 my-4 flex flex-col justify-center"
        >
            <Link
                :href="route('comicDetails', { id: comics.id })"
                as="button"
                class="w-full"
            >
                <img
                    :src="comics.img"
                    alt="img"
                    class="w-full h-80 rounded-md object-cover"
            /></Link>
            <span
                class="text-white w-full text-center text-lg m-auto font-bold"
                >{{ comics.title }}</span
            >
        </div>
    </MyBooksLayout>
</template>
