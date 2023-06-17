<script setup>
import InputError from "@/Components/InputError.vue";
import Modal from "@/Components/Modal.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Link, useForm, usePage } from "@inertiajs/vue3";

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const user = usePage().props.auth.user;
const emit = defineEmits(["openModal"]);

const form = useForm({
    name: user.name,
    email: user.email,
});
</script>

<template>
    <form
        @submit.prevent="form.patch(route('profile.update'))"
        class="space-y-2 flex flex-col justify-between"
    >
        <div>
            <TextInput
                id="name"
                type="text"
                class="mt-1 block w-auto min-w-full border-none bg-inherit text-4xl font-bold hover:bg-stone-900"
                v-model="form.name"
                required
                autofocus
                autocomplete="name"
            />

            <InputError class="mt-2" :message="form.errors.name" />

            <TextInput
                id="email"
                type="email"
                class="block w-auto min-w-full border-none bg-inherit text-lg hover:bg-stone-900"
                v-model="form.email"
                required
                autocomplete="username"
            />

            <InputError class="mt-2" :message="form.errors.email" />
        </div>

        <div v-if="mustVerifyEmail && user.email_verified_at === null">
            <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                Your email address is unverified.
                <Link
                    :href="route('verification.send')"
                    method="post"
                    as="button"
                    class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                >
                    Click here to re-send the verification email.
                </Link>
            </p>

            <div
                v-show="status === 'verification-link-sent'"
                class="mt-2 font-medium text-sm text-green-600 dark:text-green-400"
            >
                A new verification link has been sent to your email address.
            </div>
        </div>

        <div class="flex items-center gap-4">
            <PrimaryButton :disabled="form.processing" class="mt-auto ml-2"
                >Update profile</PrimaryButton
            >
            <Transition
                enter-from-class="opacity-0"
                leave-to-class="opacity-0"
                class="transition ease-in-out"
            >
                <p
                    v-if="form.recentlySuccessful"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >
                    Updated.
                </p>
            </Transition>
            <span
                @click="emit('openModal')"
                class="underline text-lg text-gray-600 w-fit cursor-pointer dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                >Change password</span
            >
        </div>
    </form>
</template>
