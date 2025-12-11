<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";
</script>
<template>
    <nav class="sticky top-0 z-50 bg-gradient-to-r from-black via-slate-900 to-black border-b border-blue-500/20 shadow-lg">
        <!-- Primary Navigation Menu -->
        <div class="max-w-full px-4 sm:px-6 lg:px-8">
            <div
                class="flex justify-between h-20 items-center"
            >
                <!-- Left Section: Logo & Links -->
                <div class="flex items-center gap-8">
                    <!-- Logo -->
                    <Link 
                        :href="route('home')" 
                        as="button"
                        class="shrink-0 flex items-center hover:scale-110 transition-transform duration-200"
                    >
                        <ApplicationLogo class="w-14 h-14" />
                    </Link>
                    
                    <!-- Navigation Links -->
                    <div class="hidden md:flex items-center gap-6">
                        <!-- Go to index -->
                        <Link
                            :href="route('home')"
                            as="button"
                            class="text-white font-bold hover:text-blue-400 transition-colors duration-200 relative group"
                        >
                            Home
                            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-blue-500 to-purple-500 group-hover:w-full transition-all duration-300"></span>
                        </Link>
                        <!-- Go to personal user library with saved books -->
                        <Link
                            :href="route('myBooks')"
                            as="button"
                            class="text-white font-bold hover:text-blue-400 transition-colors duration-200 relative group"
                        >
                            My Books
                            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-blue-500 to-purple-500 group-hover:w-full transition-all duration-300"></span>
                        </Link>
                        <!-- Go to AI generation of comic cover: -->
                        <Link
                            :href="route('coverGenerator')"
                            as="button"
                            class="text-white font-bold hover:text-blue-400 transition-colors duration-200 relative group"
                        >
                            Generate your own cover!
                            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-blue-500 to-purple-500 group-hover:w-full transition-all duration-300"></span>
                        </Link>   
                    </div>
                </div>

                <!-- Right Section: User/Auth Menu -->
                <slot />
            </div>
        </div>
    </nav>
</template>
