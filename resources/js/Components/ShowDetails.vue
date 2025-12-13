<script setup>
import { ref } from "vue";
import Modal from "@/Components/Modal.vue";
import FormLayout from "@/Layouts/FormLayout.vue";
import Save from "./Save.vue";
import { onBeforeMount } from "vue";

const props = defineProps({
    comic: Object,
    wishlist: Boolean,
});
const color = props.wishlist ? "#ffffff" : "none";
onBeforeMount;
const showForm = ref(false);
const synopsisExpanded = ref(false);
</script>
<template>
    <div class="w-full max-h-[80vh] h-full flex justify-center items-centers">
        <div
            class="bg-black overflow-hidden w-2/3 md:w-3/4 rounded-lg m-7 mb-0 flex flex-col md:flex-row border border-neutral-700 shadow-2xl"
        >
            <div class="1/3">
                <img
                    :src="props.comic.img"
                    alt="comicImg"
                    class="md:w-[40vw] w-full h-[40vh] md:h-full object-cover"
                />
            </div>
            <!-- Display of the main information about the comic -->
             
            <div class="flex flex-col text-gray-300 w-full h-full relative">
                <div
                    class=" bg-neutral-900 rounded-tr-lg py-5 px-4 border-b border-neutral-700"
                >
                    <h3
                        class="sm:text-3xl md:text-6xl w-[80%] text-2xl font-bold text-white line-clamp-2"
                        >{{ props.comic.title }}</h3
                    >
                    
                    <span
                        class="text-xl text-neutral-400 font-bold w-1/2 md:w-auto mt-4 block"
                    >
                        {{ props.comic.launch_date }}
                    </span>
                    <div>
                    <div class="flex justify-between mt-2">
                        <span class="text-xl font-bold hidden md:block">
                            Published by: {{props.comic.publisher}}
                    </span>
                    <span class="text-xl font-bold hidden md:block">
                        {{ props.comic.ISBN }}
                    </span>
                    </div>
                </div>
            </div>
                
                <span
                        class="md:text-3xl text-xl text-blue-400 font-bold p-3 absolute top-2 right-2 drop-shadow-lg"
                    >
                        {{ props.comic.price }}€</span
                    >
                <!-- Synopsis and remark of the title for easy understanding -->
                    <div
                        class="p-6 sm:p-6 flex flex-col gap-5 h-full bg-gradient-to-b from-black to-neutral-900"
                    >
                    <h1
                        class="sm:text-sm md:text-3xl w-[80%] text-xl font-bold text-gray-400 hidden md:block"
                        >{{ props.comic.title }}</h1
                    >
                    <div
                        class="h-11/12 md:h-auto p-4 flex gap-4 flex-col justify-around md:bg-neutral-900 text-gray-200 rounded-lg md:border border-neutral-700 shadow-lg"
                    >
                        <span class="text-3xl font-bold text-neutral-400 ">Synopsis:</span>

                        <div class="relative">
                            <div :class="synopsisExpanded ? 'max-h-[17rem] overflow-auto synopsis-scroll' : 'max-h-48 overflow-hidden synopsis-scroll'" class="text-2xl leading-relaxed text-gray-200 transition-all">
                                <p class="whitespace-pre-line">{{ props.comic.sinopsis }}</p>
                            </div>

                            <!-- Fade overlay when collapsed -->
                            <div v-if="!synopsisExpanded" class="pointer-events-none absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-neutral-900 via-transparent to-transparent"></div>

                            <!-- Read more toggle -->
                            <button
                                @click="synopsisExpanded = !synopsisExpanded"
                                class="mt-3 text-sm text-blue-200 hover:text-blue-300 transition "
                            >
                                {{ synopsisExpanded ? 'Show less' : 'Read more' }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="w-11/12 md:w-3/4 m-auto p-4 flex justify-between">
        <div class="flex">
            <button
                class="bg-neutral-900 border border-gray-600 text-gray-300 font-bold text-xl m-2 w-28 px-3 py-2 rounded-lg flex justify-between hover:bg-neutral-800 hover:border-gray-500 transition"
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
                class="bg-neutral-900 border border-gray-600 text-gray-300 font-bold text-xl m-2 w-28 px-3 py-2 rounded-lg flex justify-between hover:bg-neutral-800 hover:border-gray-500 transition"
            >
                <span class="mx-1">Save</span>
                <Save :color="color"></Save></button
            ><!-- </Link> -->
        </div>
        <div>
            <button
                @click="showForm = !showForm"
                v-if="$page.props.auth.user?.admin"
                class="bg-blue-700 hover:bg-blue-600 text-white w-32 border border-blue-600 font-bold text-xl m-2 py-2 px-3 rounded-lg transition shadow-lg"
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

<style scoped>
/* Discreet monochrome scrollbar for synopsis (WebKit + Firefox) */
::v-deep .synopsis-scroll {
    scrollbar-width: thin;
    scrollbar-color: #4b5563 transparent; /* gray-600 */
}

::v-deep .synopsis-scroll::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}
::v-deep .synopsis-scroll::-webkit-scrollbar-track {
    background: transparent;
}
::v-deep .synopsis-scroll::-webkit-scrollbar-thumb {
    background: #4b5563; /* gray-600 */
    border-radius: 9999px;
    border: 2px solid rgba(255,255,255,0.03);
}
::v-deep .synopsis-scroll::-webkit-scrollbar-thumb:hover {
    filter: brightness(0.95);
}
</style>
