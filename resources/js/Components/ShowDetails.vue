<script setup>
import { ref } from "vue";
import Modal from "@/Components/Modal.vue";
import FormLayout from "@/Layouts/FormLayout.vue";
import Save from "./Save.vue";
import { Link } from "@inertiajs/vue3";
import { onBeforeMount } from "vue";

const props = defineProps({
    comic: Object,
    wishlist: Boolean,
});
const color = props.wishlist ? "#ffffff" : "none";
onBeforeMount;
const showForm = ref(false);
</script>
<template>
    <div class="w-full h-full flex justify-center items-centers">
        <div
            class="bg-black w-2/3 md:w-3/4 h-[80vh] rounded-md m-7 mb-0 flex flex-col md:flex-row border border-neutral-900"
        >
            <div class="1/3">
                <img
                    :src="props.comic.img"
                    alt="comicImg"
                    class="md:w-[40vw] w-full h-[40vh] md:h-full sm:rounded-l-md rounded-t-md object-cover"
                />
            </div>
            <div class="flex flex-col text-gray-300 w-full h-full">
                <div
                    class="flex justify-between content-center bg-neutral-900 rounded-tr-md"
                >
                    <span
                        class="sm:text-3xl md:text-4xl text-2xl font-bold text-zinc-400 p-6"
                        >{{ props.comic.title }}</span
                    >
                    <span
                        class="sm:text-2xl text-xl text-yellow-300 font-bold p-3"
                    >
                        {{ props.comic.price }}€</span
                    >
                </div>
                <div
                    class="p-3 sm:p-4 flex md:flex-col flex-wrap justify-between h-full overflow-auto"
                >
                    <span
                        class="text-2xl text-white/50 font-bold w-1/2 md:w-auto"
                    >
                        {{ props.comic.launch_date }}</span
                    >
                    <span class="text-xl font-bold hidden md:block">{{
                        props.comic.publisher
                    }}</span>
                    <span class="text-xl font-bold hidden md:block">
                        {{ props.comic.ISBN }}</span
                    >
                    <span class="text-xl font-bold">Sinopsis:</span>
                    <div
                        class="h-11/12 md:h-1/3 p-5 mt-2 bg-neutral-900 text-gray-200 rounded-xl overflow-auto"
                    >
                        <span class="overflow-auto text-xl">{{
                            props.comic.sinopsis
                        }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="w-11/12 md:w-3/4 m-auto p-4 flex justify-between">
        <div class="flex">
            <button
                class="bg-black border border-gray-600/50 text-gray-300 font-bold text-xl m-2 w-28 px-3 py-2 rounded-xl flex justify-between"
                as="button"
            >
                Buy
                <img
                    src="../../assets/shoppingCart.svg"
                    alt="shopping cart"
                    class="w-7 h-7"
                />
            </button>
            <!-- <Link
                :href="
                    route('saveWishlist', {
                        id: props.comic.id,
                        saved: wishlist,
                    })
                "
            > -->
            <button
                as="button"
                class="bg-black border border-gray-600/50 text-gray-300 font-bold text-xl m-2 w-28 px-3 py-2 rounded-xl flex justify-between"
            >
                <span class="mx-1">Save</span>
                <Save :color="color"></Save></button
            ><!-- </Link> -->
        </div>
        <div>
            <button
                @click="showForm = !showForm"
                v-if="$page.props.auth.user?.admin"
                class="bg-blue-700 hover:bg-blue-500 hover:text-black w-32 border border-gray-600/50 text-gray-300 font-bold text-xl m-2 py-2 px-3 rounded-xl"
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
        </div>
    </div>
</template>

<style scoped></style>
