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
            <div class="flex flex-col justify-between text-gray-300 w-full p-6">
                <div class="flex justify-between">
                    <span class="text-5xl font-bold text-gray-200">{{
                        props.comic.title
                    }}</span>
                    <span class="text-2xl text-yellow-300 font-bold">
                        {{ props.comic.price }}€</span
                    >
                </div>
                <span class="text-lg text-white/50 font-bold">
                    {{ props.comic.launch_date }}</span
                >
                <span class="text-xl font-bold"> {{ props.comic.ISBN }}</span>
                <span class="text-xl font-bold">{{
                    props.comic.publisher
                }}</span>
                <span class="text-xl font-bold">
                    {{ props.comic.launch_date }}</span
                >
                <span class="text-xl font-bold"> {{ props.comic.type }}</span>
                <span class="text-xl font-bold"> {{ props.comic.genres }}</span>

                <span class="text-xl font-bold">Sinopsis:</span>
                <div
                    class="h-1/3 p-5 bg-neutral-900 text-gray-400 rounded-xl overflow-auto"
                >
                    {{ props.comic.sinopsis }}
                </div>
            </div>
        </div>
    </div>
    <div class="w-3/4 m-auto p-4 flex justify-between">
        <div>
            <button
                class="bg-black border border-gray-600/50 text-gray-300 font-bold text-xl m-2 w-20 p-2 rounded-xl"
                as="button"
            >
                Buy
            </button>
            <button
                as="button"
                class="bg-black border border-gray-600/50 text-gray-300 font-bold text-xl m-2 w-20 p-2 rounded-xl"
            >
                Save
            </button>
        </div>
        <div>
            <button
                @click="showForm = !showForm"
                v-if="$page.props.auth.user?.admin"
                class="bg-blue-800 w-32 border border-gray-600/50 text-gray-300 font-bold text-xl m-2 p-2 rounded-xl"
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
