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
                <Link
                    :href="route('profile.edit')"
                    class="text-white hover:border-b border-white h-full flex items-center"
                >
                    Profile
                </Link>
            </NavigationHeader>
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>
