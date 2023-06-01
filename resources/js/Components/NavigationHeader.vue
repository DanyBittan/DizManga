<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import { Link } from "@inertiajs/vue3";
</script>
<template>
    <nav class="bg-darkerGray">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div
                class="flex justify-between h-16 border-b-2 border-gray-700 items-center"
            >
                <div>
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <Link :href="route('home')" class="mr-10" as="button">
                            <ApplicationLogo class="w-16 h-16" />
                        </Link>
                        <Link
                            :href="route('home')"
                            as="button"
                            class="text-white hover:border-b border-white h-full flex items-center"
                            >Home</Link
                        >
                    </div>
                </div>
                <slot />
            </div>
        </div>
    </nav>
</template>
