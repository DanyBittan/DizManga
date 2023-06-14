<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";
</script>
<template>
    <nav class="bg-darkerGray">
        <!-- Primary Navigation Menu -->
        <div class="max-w-full sm:px-6 lg:px-8">
            <div
                class="flex justify-between h-18 border-b border-gray-700/80 items-center"
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
                            class="text-white hover:border-b border-white h-fit flex items-center mx-4"
                            >Home
                        </Link>
                        <Link
                            v-if="$page.props.auth.user"
                            :href="route('myBooks')"
                            as="button"
                            class="text-white hover:border-b border-white h-full flex items-center mx-4"
                            >Mybooks</Link
                        >
                    </div>
                </div>
                <slot />
            </div>
        </div>
    </nav>
</template>
