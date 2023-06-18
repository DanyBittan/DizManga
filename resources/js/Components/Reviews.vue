<script setup>
import { Link, useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const props = defineProps({
    comicId: {
        type: Number,
        required: true,
    },
    reviews: {
        type: Object,
        required: true,
    },
});

const ratingValue = ref(20);
const form = useForm({
    new_review: "",
    rating: ratingValue,
});

const submit = () => {
    form.post(route("postReview", { id: props.comicId }), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
    });
};
</script>
<template>
    <div class="w-full h-auto p-12">
        <span
            class="text-neutral-400 text-4xl font-bold block w-full pb-10 border-b border-gray-600/50"
            >Comments</span
        >
        <form @submit.prevent="submit">
            <div class="w-full items-center flex flex-col mt-4 mb-4">
                <span class="text-white m-4 text-5xl">{{ ratingValue }}%</span>
                <input
                    type="range"
                    min="20"
                    max="100"
                    step="1"
                    v-model="ratingValue"
                    class="range w-1/2 h-2 rounded-lg appearance-none cursor-pointer bg-gray-400"
                />
            </div>
            <div class="flex">
                <textarea
                    v-model="form.new_review"
                    placeholder="Write a review for this comic!!"
                    class="bg-neutral-800 h-20 w-full text-white text-lg rounded-xl resize-none border-gray-800 mt-4 placeholder-white/60"
                >
                </textarea>
            </div>
            <button
                class="text-gray-200 p-2 md:w-[15vh] w-full bg-neutral-600 rounded-xl mt-4"
            >
                Submit
            </button>
        </form>
        <div
            class="w-full md:w-11/12 max-h-fit h-40 bg-neutral-800 my-6 text-white py-4 px-6 rounded-lg flex items-center"
            v-for="review in reviews"
        >
            <img
                :src="review.user_img"
                alt="aaa"
                class="rounded-full w-16 h-16"
            />
            <div class="py-1 flex flex-col justify-between w-full h-full">
                <div class="flex justify-between w-full pl-6">
                    <span class="text-xl font-bold text-white">{{
                        review.name
                    }}</span>
                    <span class="bg-blue-700 px-2 py-1 rounded-full">{{
                        review.rating
                    }}</span>
                </div>
                <span
                    class="w-full h-full overflow-auto px-6 mt-1 text-lg text-gray-200"
                    >{{ review.comment }}</span
                >
                <div class="flex w-auto justify-between">
                    <Link
                        :href="
                            route('deleteReview', {
                                id: review.id,
                            })
                        "
                    >
                        <img
                            src="../../assets/delete.svg"
                            alt=""
                            class="w-6 h-6 mx-6 mt-2"
                        />
                    </Link>
                    <div
                        class="w-auto flex justify-end items-end h-fit self-end"
                    >
                        <img
                            src="../../assets/like.svg"
                            alt=""
                            class="w-6 h-6"
                        />
                        <span class="mx-4">{{ review.likes }}</span>
                        <img
                            src="../../assets/dislike.svg"
                            alt=""
                            class="w-6 h-6"
                        />
                        <span class="mx-4">{{ review.dislikes }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped></style>
