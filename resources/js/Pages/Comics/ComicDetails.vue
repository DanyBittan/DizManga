<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import ShowDetails from "@/Components/ShowDetails.vue";

import GuestLayout from "@/Layouts/GuestLayout.vue";

const props = defineProps({
    comic: Object,
});
</script>
<template>
    <AuthenticatedLayout>
        <ShowDetails :comic="comic" />
    </AuthenticatedLayout>
</template>
