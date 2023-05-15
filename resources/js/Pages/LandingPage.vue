<script setup>
import { Link } from "@inertiajs/vue3";
</script>
<template>
    <header>
        <div>
            <Link :href="route('login')" class="log"> Login </Link>
            <Link :href="route('register')" class="reg"> Register </Link>
        </div>
    </header>
    <body></body>
</template>

<style scoped>
header {
    background-color: rgb(24 24 27);
    height: 8vh;
    color: gray;
}
body {
    background-color: rgb(24 24 27);
    background-image: url("https://img.freepik.com/vektoren-kostenlos/website-im-bau-hintergrund_1361-1388.jpg?w=2000");
    background-repeat: no-repeat;
    background-size: cover;
    width: 100%;
    height: 100vh;
    color: gray;
}
</style>
