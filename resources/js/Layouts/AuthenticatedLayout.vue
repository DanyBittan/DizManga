<script setup>
import NavigationHeader from "@/Components/NavigationHeader.vue";
import { Link } from "@inertiajs/vue3";
import Dropdown from "@/Components/Dropdown.vue";
</script>

<template>
    <div>
        <div class="min-h-screen bg-darkerGray">
            <NavigationHeader>
                <Dropdown
                    :content-classes="'bg-gray-900 border-2 border-gray-950 flex flex-col'"
                >
                    <template v-slot:trigger>
                        <div
                            class="flex items-center hover:border-b border-white h-full"
                        >
                            <div class="text-white mr-4">
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
                            class="text-white hover:bg-gray-950 p-3"
                        >
                            Edit profile
                        </Link>
                        <Link
                            as="button"
                            :href="route('adminView')"
                            class="text-white hover:bg-gray-950 p-3"
                            v-if="$page.props.auth.user.admin"
                        >
                            Admin panel
                        </Link>
                        <Link
                            as="button"
                            :href="route('logout')"
                            method="POST"
                            class="text-white hover:bg-gray-950 p-3"
                        >
                            Log out
                        </Link>
                    </template>
                </Dropdown>
            </NavigationHeader>
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>
