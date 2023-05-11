<script setup>
import NavigationHeader from "@/Components/NavigationHeader.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div>
        <div class="min-h-screen bg-darkerGray">
            <NavigationHeader>
                <div class="flex justify-between text-white items-center">
                    <div>
                        <Link
                            :href="route('login')"
                            class="bg-gray-800 hover:bg-gray-700 rounded-xl p-3 m-2"
                        >
                            Login
                        </Link>
                        <Link
                            :href="route('register')"
                            class="bg-gray-800 hover:bg-gray-700 rounded-xl p-3 m-2"
                        >
                            Register
                        </Link>
                    </div>
                </div>
            </NavigationHeader>
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>
