<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
    href: String,
});
</script>

<template>
    <a
        v-if="href.startsWith('http')"
        :href="href"
        rel="noopener noreferrer"
        class=""
    >
        <slot />
    </a>

    <Link v-else :href="href" class="">
        <slot />
    </Link>
</template>
