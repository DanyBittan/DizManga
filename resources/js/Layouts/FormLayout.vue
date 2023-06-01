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
    publisher: previewsData ? props.comic.publisher : "",
    price: previewsData ? props.comic.price : "",
    launch: previewsData ? props.comic.launch_date : "",
    img: previewsData ? props.comic.img : "",
    sinopsis: previewsData ? props.comic.sinopsis : "",
});

const comicAction = () => {
    previewsData
        ? form.post(route("updateComic", { id: props.comic.id }), {
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

        <div class="mt-6 flex flex-col">
            <div class="flex m-2">
                <InputLabel
                    for="title"
                    value="Title:"
                    class="text-[19px] m-3 w-1/5"
                />
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
                <InputLabel
                    for="publisher"
                    value="Publisher:"
                    class="text-[19px] m-3 w-1/5"
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
                <InputLabel
                    for="price"
                    value="Price:"
                    class="text-[19px] m-3 w-1/6"
                />
                <TextInput
                    id="price"
                    type="number"
                    v-model="form.price"
                    class="mt-1 ml-2 p-1 w-auto"
                    required
                    autofocus
                    placeholder="Publisher"
                    :value="form.price"
                />
                <InputLabel
                    for="launch"
                    value="Launch:"
                    class="text-[19px] m-3"
                />
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
        </div>
        <div class="m-2">
            <InputLabel
                for="img"
                value="Image:"
                class="text-[19px] m-2 w-1/5"
            />
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
                class="text-[19px] m-2 w-1/5"
            />
            <TextInput
                id="sinopsis"
                type="text"
                v-model="form.sinopsis"
                class="mt-1 ml-2 p-1 w-full h-fit"
                required
                autofocus
                placeholder="Sinopsis"
                :value="form.sinopsis"
            />
        </div>
        <div class="mt-6 flex justify-end">
            <SecondaryButton class="mr-2" @click="$emit('closeModal')">
                Cancel
            </SecondaryButton>
            <SecondaryButton @click="comicAction">
                <slot name="buttonType" />
            </SecondaryButton>
        </div>
    </div>
</template>

<style scoped></style>
