<script setup>
import { ref } from "vue";
import NavigationHeader from "@/Components/NavigationHeader.vue";
import { Link } from "@inertiajs/vue3";

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div>
        <div class="min-h-screen bg-darkerGray">
            <NavigationHeader>
                <div class="flex items-center justify-center text-white">
                    Profile
                </div>
            </NavigationHeader>
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>
