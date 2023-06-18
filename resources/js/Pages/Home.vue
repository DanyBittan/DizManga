<script setup>
import { Link, useForm } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import ComicScroll from "@/Components/ComicScroll.vue";
import LatestComics from "@/Components/LatestComics.vue";
import TextInput from "@/Components/TextInput.vue";
import { ref, watch } from "vue";
import { router } from "@inertiajs/core";

const props = defineProps({
    allComics: {
        type: Object,
        required: true,
    },
    latest: {
        type: Object,
        required: true,
    },
    search: {
        type: Object,
    },
});
const form = useForm({
    search: "",
});
const search = () => {
    form.post("searchView");
};
/* watch(searcher, (value) => {
    if (value) {
        router.get("home", {
            searcher: value,
            only: ["search"],
            preserveState: true,
            preserveScroll: true,
        });
    }
}); */
</script>
<template>
    <AuthenticatedLayout>
        <div class="flex justify-end p-8">
            <div class="md:w-1/5 sm:w-1/2 w-full flex-col relative">
                <TextInput
                    type="search"
                    placeholder="Search..."
                    v-model="form.search"
                    class="rounded-t-xl w-full mr-8 border-gray-600"
                    @keyup.enter="search"
                />
                <!-- <div
                    class="absolute w-full h-fit max-h-96 bg-darkGray border rounded-b-xl border-gray-800 overflow-auto hidden sm:block"
                >
                    <div
                        v-for="search in search"
                        class="h-20 relative my-2 border-b border-gray-600/10"
                    >
                        <Link :href="route('comicDetails', { id: search.id })">
                            <div
                                class="h-full bg-darkGray flex absolute w-full p-1"
                            >
                                <img
                                    :src="search.img"
                                    alt="img"
                                    class="h-full w-1/6"
                                />
                                <span class="text-gray-300 mx-2">
                                    {{ search.title }}
                                </span>
                            </div>
                        </Link>
                    </div>
                </div> -->
            </div>
        </div>
        <ComicScroll :comics="allComics" />
        <div
            class="w-full min-h-full h-full text-gray-400 px-10 mt-10 text-4xl font-bold"
        >
            Latest
            <LatestComics :latest="latest" />
        </div>
    </AuthenticatedLayout>
</template>
