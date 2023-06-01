<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";
import Modal from "@/Components/Modal.vue";
import FormLayout from "@/Layouts/FormLayout.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

const props = defineProps({
    comic: Object,
});
const showForm = ref(false);
</script>
<template>
    <div class="w-full h-full flex justify-center items-centers">
        <div
            class="bg-neutral-950 w-3/4 h-[75vh] rounded-md m-7 mb-0 flex border border-neutral-900"
        >
            <img
                :src="props.comic.img"
                alt="comicImg"
                class="w-2/5 rounded-l-md object-cover"
            />
            <div class="flex flex-col justify-between text-white w-full p-6">
                <span class="text-5xl font-bold text-white">{{
                    props.comic.title
                }}</span>
                <span class="text-lg">ISBN: {{ props.comic.ISBN }}</span>
                <span class="text-lg"
                    >Publisher: {{ props.comic.publisher }}</span
                >
                <span class="text-lg"> {{ props.comic.launch_date }}</span>
                <span class="text-lg"> {{ props.comic.type }}</span>
                <span class="text-lg"> Genres: {{ props.comic.genres }}</span>
                <span class="text-lg"> Price: {{ props.comic.price }}€</span>

                <span class="text-lg">Sinopsis:</span>
                <div class="h-1/3 p-5 bg-neutral-900 text-gray-400 rounded-lg">
                    {{ props.comic.sinopsis }}
                </div>
            </div>
        </div>
    </div>
    <div class="w-3/4 m-auto p-4 flex justify-between">
        <div>
            <button
                class="bg-black text-gray-300 font-bold text-xl m-2 w-fit p-2 rounded-xl"
                as="button"
            >
                Buy
            </button>
            <button
                as="button"
                class="bg-black text-gray-300 font-bold text-xl m-2 w-fit p-2 rounded-xl"
            >
                WishList
            </button>
        </div>
        <div>
            <button
                @click="showForm = !showForm"
                v-if="$page.props.auth.user.admin"
                class="bg-black text-gray-300 font-bold text-xl m-2 p-2 rounded-xl"
            >
                Update
            </button>
            <Modal :show="showForm">
                <FormLayout @close-modal="showForm = !showForm" :comic="comic">
                    <template v-slot:title>
                        <span class="text-3xl text-gray-300">Edit Comic</span>
                    </template>
                    <template v-slot:buttonType
                        ><img
                            src="../../assets/edit.svg"
                            alt="editBttn"
                            class="w-5 h-5 mr-2"
                        />
                        Update
                    </template>
                </FormLayout>
            </Modal>
            <Link
                as="button"
                :href="route('deleteComic', { id: comic.id })"
                v-if="$page.props.auth.user.admin"
                class="bg-red-700 text-gray-300 font-bold text-xl m-2 w-fit p-2 rounded-xl"
                >Delete</Link
            >
        </div>
    </div>
</template>

<style scoped></style>
