<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";
import Modal from "@/Components/Modal.vue";
import FormLayout from "@/Layouts/FormLayout.vue";
import AdminLayout from "@/Components/AdminLayout.vue";
import SearchBar from "@/Components/SearchBar.vue";

const props = defineProps({
    allComics: {
        required: true,
        type: Object,
    },
});
const filteredComics = ref(props.allComics);
const showAddForm = ref(false);
</script>
<template>
    <AdminLayout>

        <button
            class="bg-neutral-900 text-stone-200 px-4 py-2 ml-6 rounded-lg w-fit flex justify-evenly items-center hover:bg-neutral-800 mb-4"
            @click="() => (showAddForm = !showAddForm)">
            <img src="../../../assets/addPlus.svg" alt="svg" class="w-7 h-7 mr-2" />
            Add comic
        </button>
        <SearchBar @update:filtered-comics="filteredComics = $event" :comicData="allComics" />
        <Modal :show="showAddForm">
            <FormLayout @close-modal="() => (showAddForm = !showAddForm)">
                <template v-slot:title>
                    <span class="text-3xl text-gray-300">Add Comic</span>
                </template>
                <template v-slot:buttonType><img src="../../../assets/addPlus.svg" alt="svg" class="w-6 h-6 mr-2" />
                    Add
                </template>
            </FormLayout>
        </Modal>
        <div class="text-white w-11/12 flex border-2 h-64 border-neutral-800 rounded-r-lg m-2 relative shadow-md shadow-neutral-900"
            v-for="comic in filteredComics" :key="comic.id">
            <Link :href="route('comicDetails', { id: comic.id })">
                <img :src="comic.img" alt="ComicPic" class="w-56 h-full object-cover" />
            </Link>
            <div class="bg-darkGray px-4 flex flex-col w-full p-2 h-full overflow-hidden rounded-r-lg">
                <div class="flex gap-4 items-center">
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
                    class="text-md my-1 p-3 rounded-lg bg-stone-900 w-full h-full font-semibold overflow-auto synopsis-scroll">
                    {{ comic.sinopsis }}
                </p>
            </div>
            <Link as="button" :href="route('deleteComic', { id: comic.id })" method="delete"
                class="items-center justify-center bg-red-700 rounded-full hover:bg-red-600 absolute p-1 right-4 top-4">
                <img src="../../../assets/delete.svg" alt="deleteBttn" class="w-6 h-6" />
            </Link>
        </div>
    </AdminLayout>
</template>

<style scoped>
/* Discreet monochrome scrollbar for synopsis (WebKit + Firefox) */
::v-deep .synopsis-scroll {
    scrollbar-width: thin;
    scrollbar-color: #4b5563 transparent;
    /* gray-600 */
}

::v-deep .synopsis-scroll::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

::v-deep .synopsis-scroll::-webkit-scrollbar-track {
    background: transparent;
}

::v-deep .synopsis-scroll::-webkit-scrollbar-thumb {
    background: #4b5563;
    /* gray-600 */
    border-radius: 9999px;
    border: 2px solid rgba(255, 255, 255, 0.03);
}

::v-deep .synopsis-scroll::-webkit-scrollbar-thumb:hover {
    filter: brightness(0.95);
}
</style>
