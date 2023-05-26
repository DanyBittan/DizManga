<script setup>
import { ref } from "vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";
import Modal from "@/Components/Modal.vue";
import FormLayout from "@/Layouts/FormLayout.vue";

const props = defineProps({
    allComics: {
        required: true,
        type: Object,
    },
});
const showForm = ref(false);

const showModal = () => {
    showForm.value ? (showForm.value = false) : (showForm.value = true);
};
</script>
<template>
    <div class="min-h-screen bg-darkerGray flex">
        <div class="w-1/5 flex flex-col justify-start items-center">
            <Link :href="route('home')" as="button">
                <ApplicationLogo
                    class="mt-36 mb-10 bg-stone-600 rounded-full p-2"
            /></Link>
            <span class="text-gray-400 text-xl font-bold m-3">Comics</span>
            <span class="text-gray-400 text-xl font-bold m-3">Users</span>
            <span class="text-gray-400 text-xl font-bold m-3">Reviews</span>
        </div>
        <div class="w-full h-screen overflow-scroll bg-darkerGray p-6">
            <div
                class="text-white w-11/12 flex m-8 rounded-l-xl"
                v-for="comics in allComics"
            >
                <img
                    :src="comics.img"
                    alt="ComicPic"
                    class="w-48 h-56 object-cover rounded-l-lg"
                />
                <div
                    class="bg-darkGray px-4 flex flex-col w-3/4 p-2 rounded-r-lg"
                >
                    <div class="flex justify-between">
                        <span class="text-3xl font-bold">
                            {{ comics.title }}
                        </span>
                        <span class="text-xl font-bold text-green-600">
                            {{ comics.price }}
                        </span>
                    </div>
                    <span class="text-md font-semibold">
                        {{ comics.ISBN }}
                    </span>
                    <span class="text-md font-semibold">
                        {{ comics.publisher }}
                    </span>
                    <span class="text-md font-semibold">
                        {{ comics.launch_date }}
                    </span>
                    <p
                        class="text-md my-1 p-3 rounded-lg bg-stone-900 w-full h-full font-semibold overflow-scroll"
                    >
                        {{ comics.sinopsis }}
                    </p>
                </div>
                <div class="flex flex-col w-24">
                    <!-- <Modal :show="showForm">
                        <FormLayout @close-modal="showModal" :comic="comics">
                            <template v-slot:title>
                                <span class="text-3xl text-gray-300"
                                    >Edit Comic</span
                                >
                            </template>
                            <template v-slot:buttonType>
                                <SecondaryButton>Update</SecondaryButton>
                            </template>
                        </FormLayout>
                    </Modal> -->
                    <button class="h-1/2 flex items-center justify-center">
                        <span
                            class="text-stone-400"
                            @click="showForm = !showForm"
                            ><svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-6 h-6"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"
                                />
                            </svg>
                        </span>
                    </button>
                    <Link
                        as="button"
                        :href="route('deleteComic', { id: comics.id })"
                        class="h-1/2 flex items-center justify-center"
                        ><span class="text-stone-400"
                            ><svg
                                class="w-6 h-6"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.5"
                                viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                            </svg>
                        </span>
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>
