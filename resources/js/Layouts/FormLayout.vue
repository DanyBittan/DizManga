<script setup>
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    comic: {
        type: Object,
        required: false,
    },
});

const previewsData = props.comic ? true : false;

const form = useForm({
    title: previewsData ? props.comic.title : "",
    volume: previewsData ? props.comic.volume : "",
    publisher: previewsData ? props.comic.publisher : "",
    price: previewsData ? props.comic.price : "",
    launch: previewsData ? props.comic.launch_date : "",
    img: previewsData ? props.comic.img : "",
    sinopsis: previewsData ? props.comic.sinopsis : "",
});

const comicAction = () => {
    previewsData
        ? form.patch(route("updateComic", { id: props.comic.id }), {
            preserveScroll: true,
            onSuccess: () => emit("closeModal"),
            onFinish: () => form.reset(),
        })
        : form.post(route("addComic"), {
            preserveScroll: true,
            onSuccess: () => emit("closeModal"),
            onFinish: () => form.reset(),
        });
};
const emit = defineEmits(["closeModal"]);
</script>
<template>
    <div class="p-6">
        <h2 class="text-lg font-medium">
            <slot name="title" />
        </h2>

        <form @submit.prevent="comicAction" enctype="multipart/form-data">
            <div class="mt-6 flex flex-col">
                <div class="flex m-2">
                    <InputLabel for="title" value="Title:" class="m-3 w-1/5" />
                    <TextInput
                        id="title"
                        type="text"
                        v-model="form.title"
                        class="mt-1 ml-2 p-1 w-full"
                        required
                        autofocus
                        placeholder="Comic title"
                        :value="form.title"
                    />
                </div>
                <div class="flex m-2">
                    <InputLabel for="volume" value="volume:" class="m-3 w-1/5" />
                    <TextInput
                        id="volume"
                        type="text"
                        v-model="form.volume"
                        class="mt-1 ml-2 p-1 w-full"
                        required
                        autofocus
                        placeholder="Comic volume"
                        :value="form.volume"
                    />
                </div>
                <div class="flex m-2">
                    <InputLabel
                        for="publisher"
                        value="Publisher:"
                        class="m-3 w-1/5"
                    />
                    <TextInput
                        id="publisher"
                        type="text"
                        v-model="form.publisher"
                        class="mt-1 ml-2 p-1 w-full"
                        required
                        autofocus
                        placeholder="Publisher"
                        :value="form.publisher"
                    />
                </div>
                <div class="flex m-2">
                    <InputLabel for="price" value="Price:" class="m-3 w-1/6" />
                    <TextInput
                        id="price"
                        type="number"
                        step="0.01"
                        v-model="form.price"
                        class="mt-1 ml-2 p-1 w-auto"
                        required
                        autofocus
                        placeholder="Price"
                        :value="form.price"
                    />
                    <InputLabel for="launch" value="Launch:" class="m-3" />
                    <TextInput
                        id="launch"
                        type="date"
                        v-model="form.launch"
                        class="mt-1 ml-2 p-1 w-1/2"
                        required
                        autofocus
                        placeholder="Release date"
                        :value="form.launch"
                    />
                </div>

                <div class="m-2">
                    <InputLabel for="img" value="Image:" class="m-2 w-1/5" />
                    <TextInput
                        id="img"
                        type="url"
                        v-model="form.img"
                        class="mt-1 ml-2 p-1 w-full h-fit"
                        required
                        autofocus
                        placeholder="Comic portrait"
                        :value="form.img"
                    />
                </div>

                <div class="m-2">
                    <InputLabel
                        for="sinopsis"
                        value="Sinopsis:"
                        class="m-2 w-1/5"
                    />
                    <TextInput
                        id="sinopsis"
                        type="text"
                        v-model="form.sinopsis"
                        class="mt-1 ml-2 p-1 w-full"
                        required
                        autofocus
                        placeholder="Sinopsis"
                        :value="form.sinopsis"
                    />
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <SecondaryButton
                    class="mr-2"
                    @click="() => $emit('closeModal')"
                >
                    Cancel
                </SecondaryButton>
                <!-- @click="comicAction" -->
                <SecondaryButton>
                    <slot name="buttonType" />
                </SecondaryButton>
            </div>
        </form>
    </div>
</template>

<style scoped></style>
