<script setup>
import NavigationHeader from "@/Components/NavigationHeader.vue";
import { Link } from "@inertiajs/vue3";
import Dropdown from "@/Components/Dropdown.vue";
</script>

<template>
    <div>
        <div class="min-h-screen h-full w-full bg-darkerGray">
            <NavigationHeader>
                <Dropdown
                    :content-classes="'bg-neutral-900 border border-neutral-700/40  flex flex-col'"
                    v-if="$page.props.auth.user"
                >
                    <template v-slot:trigger>
                        <div
                            class="flex items-center px-5 py-2 bg-gray-800  h-full rounded-lg cursor-pointer"
                        >
                            <div class="text-white mr-4 text-xl uppercase font-italic">
                                {{ $page.props.auth.user.name }}
                            </div>
                            <div class="rounded-full w-10 h-10">
                                <img
                                    class="rounded-full w-10 h-10"
                                    :src="$page.props.auth.user.user_img"
                                    alt="img"
                                />
                            </div>
                        </div>
                    </template>
                    <template v-slot:content>
                        <Link
                            as="button"
                            :href="route('profile.edit')"
                            class="text-white hover:bg-neutral-950 p-3 border-y border-neutral-600/20"
                        >
                            Edit profile
                        </Link>
                        <Link
                            as="button"
                            :href="route('adminComicsView')"
                            class="text-white hover:bg-neutral-950 p-3 border-y border-neutral-600/20"
                            v-if="$page.props.auth.user.admin"
                        >
                            Admin panel
                        </Link>
                        <Link
                            as="button"
                            :href="route('logout')"
                            method="POST"
                            class="text-white hover:bg-neutral-950 p-3 border-y border-neutral-600/20"
                        >
                            Log out
                        </Link>
                    </template>
                </Dropdown>
                <div
                    class="flex justify-between text-white items-center"
                    v-if="!$page.props.auth.user"
                >
                    <div>
                        <Link
                            as="button"
                            :href="route('login')"
                            class="bg-gray-800 hover:bg-gray-700 rounded-xl px-3 py-2 m-2"
                        >
                            Login
                        </Link>
                        <Link
                            as="button"
                            :href="route('register')"
                            class="bg-gray-800 hover:bg-gray-700 rounded-xl px-3 py-2 m-2"
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
