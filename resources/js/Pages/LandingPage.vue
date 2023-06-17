<script setup>
import { Link } from "@inertiajs/vue3";
</script>
<template>
    <link rel="stylesheet" href="./landing.scss" />
    <header>
        <div class="logo">
            <div id="logo__webLogo">
                <img src="../../assets/logoLanding.svg" alt="logo" />
            </div>
            <span id="logo__webTitle">DizManga</span>
        </div>
        <div class="login-buttons">
            <Link :href="route('login')" class="login-buttons__log" as="button">
                Login
            </Link>
            <Link
                :href="route('register')"
                class="login-buttons__reg"
                as="button"
            >
                Register
            </Link>
        </div>
    </header>

    <body></body>
</template>

<style scoped>
@import "../../css/landing.scss";
</style>
