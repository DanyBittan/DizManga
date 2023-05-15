<script setup>
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    comic: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    title: "",
    publisher: "",
    price: "",
    launch: "",
    img: "",
    sinopsis: "",
});
console.log(form.title);
const updateComic = () => {
    form.post(route("updateComic"), {
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
                    class="mt-1 ml-2 p-1 w-full"
                    v-model="form.sinopsis"
                    required
                    autofocus
                    method="post"
                    :value="comic.title"
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
                    class="mt-1 ml-2 p-1 w-full"
                    v-model="form.publisher"
                    required
                    autofocus
                    method="post"
                    :value="comic.publisher"
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
                    class="mt-1 ml-2 p-1 w-auto"
                    v-model="form.price"
                    required
                    autofocus
                    method="post"
                    :value="comic.price"
                />
                <InputLabel
                    for="launch"
                    value="Launch:"
                    class="text-[19px] m-3"
                />
                <TextInput
                    id="launch"
                    type="text"
                    class="mt-1 ml-2 p-1 w-1/2"
                    v-model="form.launch"
                    required
                    autofocus
                    method="post"
                    :value="comic.launch_date"
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
                class="mt-1 ml-2 p-1 w-full h-fit"
                v-model="form.img"
                required
                autofocus
                method="post"
                :value="comic.img"
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
                type="textarea"
                class="mt-1 ml-2 p-1 w-full h-fit"
                v-model="form.sinopsis"
                required
                autofocus
                method="post"
                :value="comic.sinopsis"
            />
        </div>
        <div class="mt-6 flex justify-end">
            <SecondaryButton class="mr-2" @click="$emit('closeModal')">
                Cancel
            </SecondaryButton>
            <slot name="buttonType" @click="updateComic" />
        </div>
    </div>
</template>

<style scoped></style>
