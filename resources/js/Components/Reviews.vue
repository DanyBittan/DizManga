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
    <div class="w-full py-12 px-4 sm:px-6 lg:px-12">
        <div class="max-w-7xl mx-auto">
        <div class="mb-10 pb-6 border-b border-gray-700/50">
            <h2 class="text-4xl font-black text-white tracking-tight">Reviews & Ratings</h2>
            <p class="text-gray-400 text-sm mt-2">Share your thoughts about this comic</p>
        </div>

        <!-- Review Form -->
        <form @submit.prevent="submit" class="mb-12 bg-gradient-to-r from-neutral-900 to-neutral-800 p-8 rounded-xl border border-neutral-700/50">
            <!-- Rating Section -->
            <div class="mb-8">
                <label class="text-white font-bold text-lg mb-4 block">Your Rating</label>
                <div class="flex items-center gap-6">
                    <div class="text-center">
                        <div class="text-5xl font-black bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent">
                            {{ ratingValue }}%
                        </div>
                        <p class="text-gray-500 text-sm mt-1">Overall rating</p>
                    </div>
                    <input
                        type="range"
                        min="20"
                        max="100"
                        step="1"
                        v-model="ratingValue"
                        class="flex-1 h-2 rounded-lg appearance-none cursor-pointer bg-gradient-to-r from-blue-500 to-purple-500 accent-blue-600"
                    />
                </div>
            </div>

            <!-- Review Textarea -->
            <div class="mb-6">
                <label class="text-white font-bold text-lg mb-3 block">Your Review</label>
                <textarea
                    v-model="form.new_review"
                    placeholder="Share your thoughts about this comic..."
                    class="w-full h-28 bg-neutral-800 text-white text-base rounded-lg border border-neutral-600 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 outline-none transition placeholder-gray-500 p-4 resize-none"
                >
                </textarea>
            </div>

            <!-- Submit Button -->
            <button
                class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold py-3 px-6 rounded-lg transition-all duration-300 transform hover:scale-105"
            >
                Submit Review
            </button>
        </form>

        <!-- Reviews List -->
        <div class="space-y-6">
            <h3 class="text-2xl font-bold text-white mb-6">Latest Reviews</h3>
            <div
                v-if="reviews.length === 0"
                class="text-center py-12 text-gray-500"
            >
                <p class="text-lg">No reviews yet. Be the first to review!</p>
            </div>
            <div
                v-for="review in reviews"
                :key="review.id"
                class="bg-gradient-to-r from-neutral-900 to-neutral-800 border border-neutral-700/50 rounded-xl p-6 hover:border-neutral-600 transition-all duration-300 group"
            >
                <!-- Review Header -->
                <div class="flex items-start gap-4 mb-4">
                    <img
                        :src="review.user_img"
                        :alt="review.name"
                        class="w-14 h-14 rounded-full object-cover border-2 border-blue-500/30 group-hover:border-blue-500 transition"
                    />
                    <div class="flex-1">
                        <div class="flex items-center justify-between gap-4">
                            <div>
                                <h4 class="text-white font-bold text-lg">{{ review.name }}</h4>
                                <p class="text-gray-500 text-sm">Reviewer</p>
                            </div>
                            <span class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-4 py-2 rounded-full font-bold text-sm">
                                {{ review.rating }}%
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Review Comment -->
                <p class="text-gray-300 text-base leading-relaxed mb-6 line-clamp-4">
                    {{ review.comment }}
                </p>

                <!-- Review Footer -->
                <div class="flex items-center justify-between pt-4 border-t border-neutral-700/50">
                    <!-- Delete Button -->
                    <Link
                        :href="route('deleteReview', { id: review.id })"
                        class="text-red-500 hover:text-red-400 transition flex items-center gap-2"
                    >
                        <img
                            src="../../assets/delete.svg"
                            alt="Delete"
                            class="w-5 h-5"
                        />
                        <span class="text-sm font-medium">Delete</span>
                    </Link>

                    <!-- Likes & Dislikes -->
                    <div class="flex items-center gap-6">
                        <div class="flex items-center gap-2 text-green-500 hover:text-green-400 transition cursor-pointer">
                            <img
                                src="../../assets/like.svg"
                                alt="Like"
                                class="w-5 h-5"
                            />
                            <span class="font-bold">{{ review.likes }}</span>
                        </div>
                        <div class="flex items-center gap-2 text-red-500 hover:text-red-400 transition cursor-pointer">
                            <img
                                src="../../assets/dislike.svg"
                                alt="Dislike"
                                class="w-5 h-5"
                            />
                            <span class="font-bold">{{ review.dislikes }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</template>
<style scoped></style>
