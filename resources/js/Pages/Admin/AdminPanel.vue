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
const showUpdateForm = ref(false);
const showAddForm = ref(false);
</script>
<template>
    <div class="min-h-screen bg-darkerGray flex">
        <div class="w-1/5 flex flex-col justify-start items-center">
            <Link :href="route('home')" as="button">
                <ApplicationLogo
                    class="mt-36 mb-10 bg-stone-800 rounded-full p-2 w-32 h-32"
            /></Link>
            <span class="text-gray-400 text-xl font-bold m-3">Comics</span>
            <span class="text-gray-400 text-xl font-bold m-3">Users</span>
            <span class="text-gray-400 text-xl font-bold m-3">Reviews</span>
        </div>
        <div class="w-full h-screen overflow-scroll bg-darkerGray p-6">
            <button
                class="bg-neutral-900 text-stone-200 px-4 py-2 ml-6 rounded-lg w-fit flex justify-evenly items-center hover:bg-neutral-800"
                @click="() => (showAddForm = !showAddForm)"
            >
                <img
                    src="../../../assets/addPlus.svg"
                    alt="svg"
                    class="w-7 h-7 mr-2"
                />
                Add comics
            </button>
            <Modal :show="showAddForm">
                <FormLayout @close-modal="() => (showAddForm = !showAddForm)">
                    <template v-slot:title>
                        <span class="text-3xl text-gray-300">Add Comic</span>
                    </template>
                    <template v-slot:buttonType
                        ><img
                            src="../../../assets/addPlus.svg"
                            alt="svg"
                            class="w-6 h-6 mr-2"
                        />
                        Add
                    </template>
                </FormLayout>
            </Modal>
            <div
                class="text-white w-11/12 flex m-6 rounded-l-xl"
                v-for="comics in allComics"
            >
                <Link :href="route('comicDetails', { id: comics.id })">
                    <img
                        :src="comics.img"
                        alt="ComicPic"
                        class="w-48 h-56 object-cover rounded-l-lg"
                    />
                </Link>
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
                        class="text-md my-1 p-3 rounded-lg bg-stone-900 w-full h-full font-semibold"
                    >
                        {{ comics.sinopsis }}
                    </p>
                </div>
                <div class="flex flex-col w-24">
                    <!-- <Modal :show="showUpdateForm">
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
                            class="w-6 h-6"
                            @click="showUpdateForm = !showUpdateForm"
                            ><img
                                src="../../../assets/edit.svg"
                                alt="editBttn"
                                class="w-6 h-6"
                            />
                        </span>
                    </button>
                    <Link
                        as="button"
                        :href="route('deleteComic', { id: comics.id })"
                        class="h-1/2 flex items-center justify-center"
                        ><span class="text-stone-400"
                            ><img
                                src="../../../assets/delete.svg"
                                alt="editBttn"
                                class="w-6 h-6"
                            />
                        </span>
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>
