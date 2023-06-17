<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";
import Modal from "@/Components/Modal.vue";
import FormLayout from "@/Layouts/FormLayout.vue";
import AdminLayout from "@/Components/AdminLayout.vue";

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
    <AdminLayout>
        <button
            class="bg-neutral-900 text-stone-200 px-4 py-2 ml-6 rounded-lg w-fit flex justify-evenly items-center hover:bg-neutral-800"
            @click="() => (showAddForm = !showAddForm)"
        >
            <img
                src="../../../assets/addPlus.svg"
                alt="svg"
                class="w-7 h-7 mr-2"
            />
            Add comic
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
            v-for="comic in allComics"
        >
            <Link :href="route('comicDetails', { id: comic.id })">
                <img
                    :src="comic.img"
                    alt="ComicPic"
                    class="w-48 h-56 object-cover rounded-l-lg"
                />
            </Link>
            <div
                class="bg-darkGray px-4 flex flex-col w-3/4 p-2 h-56 rounded-r-lg overflow-hidden"
            >
                <div class="flex justify-between">
                    <span class="text-3xl font-bold">
                        {{ comic.title }}
                    </span>
                    <span class="text-xl font-bold text-green-600">
                        {{ comic.price }}
                    </span>
                </div>
                <span class="text-md font-semibold">
                    {{ comic.ISBN }}
                </span>
                <span class="text-md font-semibold">
                    {{ comic.publisher }}
                </span>
                <span class="text-md font-semibold">
                    {{ comic.launch_date }}
                </span>
                <p
                    class="text-md my-1 p-3 rounded-lg bg-stone-900 w-full h-full font-semibold overflow-auto"
                >
                    {{ comic.sinopsis }}
                </p>
            </div>
            <Link
                as="button"
                :href="route('deleteComic', { id: comic.id })"
                class="flex flex-col w-24 items-center justify-center bg-red-800 rounded-r-xl hover:bg-red-600"
            >
                <img
                    src="../../../assets/delete.svg"
                    alt="deleteBttn"
                    class="w-7 h-7"
                />
            </Link>
        </div>
    </AdminLayout>
</template>
