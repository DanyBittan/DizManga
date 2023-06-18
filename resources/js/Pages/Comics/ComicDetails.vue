<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import ShowDetails from "@/Components/ShowDetails.vue";
import Reviews from "@/Components/Reviews.vue";

const props = defineProps({
    comic: {
        type: Object,
        required: true,
    },
    reviews: {
        type: Object,
        required: true,
    },
    wishlist: {
        type: Object,
        required: true,
    },
});
const isInWishlist = props.wishlist != "" ? true : false;
</script>
<template>
    <AuthenticatedLayout>
        <ShowDetails :comic="comic" :wishlist="isInWishlist" />
        <Reviews :reviews="reviews" :comicId="comic.id" />
    </AuthenticatedLayout>
</template>
