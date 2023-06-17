<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";
</script>
<template>
    <div class="min-h-screen bg-darkerGray flex">
        <div class="w-1/5 flex flex-col justify-start items-center">
            <Link :href="route('home')" as="button">
                <ApplicationLogo
                    class="mt-36 mb-10 bg-stone-800 rounded-full p-2 w-32 h-32"
            /></Link>
            <Link
                :href="route('adminComicsView')"
                class="text-gray-300 text-2xl font-semibold py-3 px-5 hover:bg-stone-800 w-full"
                >Comic</Link
            >
            <Link
                :href="route('adminUsersView')"
                class="text-gray-300 text-2xl font-semibold py-3 px-5 hover:bg-stone-800 w-full"
                >Users</Link
            >
        </div>
        <div class="w-full min-h-screen overflow-auto bg-darkerGray p-6">
            <slot />
        </div>
    </div>
</template>
