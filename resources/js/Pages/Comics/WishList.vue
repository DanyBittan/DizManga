<script setup>
import MyBooksLayout from "@/Layouts/MyBooksLayout.vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    myWishList: {
        type: Object,
        required: true,
    },
});
</script>
<template>
    <MyBooksLayout>
        <div
            v-for="wishListComic in myWishList"
            class="h-[40vh] w-64 mx-8 my-4 flex flex-col justify-center relative"
        >
            <Link
                :href="route('comicDetails', { id: wishListComic.id })"
                as="button"
                class="h-full w-full"
            >
                <img
                    :src="wishListComic.img"
                    alt="img"
                    class="w-full h-80 rounded-md object-cover"
            /></Link>
            <span class="text-white w-full text-center text-lg font-bold">{{
                wishListComic.title
            }}</span>
        </div>
    </MyBooksLayout>
</template>
