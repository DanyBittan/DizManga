<script setup>
const props = defineProps({
    comics: Object,
});
</script>
<template>
    <div
        class="w-full h-[60vh] bg-black mt-10 text-white flex flex-wrap justify-center items-center p-6"
    >
        <div
            class="bg-white w-1/5 h-5/6 m-10 rounded-xl"
            v-for="comic in comics"
            :key="comic.id"
        >
            <img :src="comic.img" alt="Comic Img" class="h-full rounded-xl" />
        </div>
    </div>
</template>
