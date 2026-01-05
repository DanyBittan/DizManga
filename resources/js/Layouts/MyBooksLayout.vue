<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Link } from "@inertiajs/vue3";
</script>
<template>
    <AuthenticatedLayout>
        <div class="flex">
            <div class="w-1/6 min-h-screen flex flex-col mt-4 border-r border-gray-700/50">
                <span class="text-gray-300 text-4xl font-bold mb-12 text-start px-3 py-4">DizManga</span>
                <Link :href="route('myBooks')" class="text-gray-300 text-xl font-semibold py-3 px-4 hover:bg-stone-800">
                    <span>My Comics</span>
                </Link>
                <Link :href="route('wishList')"
                    class="text-gray-300 text-xl font-semibold py-4 px-4 hover:bg-stone-800"><span>Wishlist</span>
                </Link>
            </div>
            <div class="w-full min-h-screen px-8 py-12">
                <slot />
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped></style>
