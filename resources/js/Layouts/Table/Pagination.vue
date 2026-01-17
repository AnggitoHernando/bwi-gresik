<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    links: {
        type: Array,
        default: () => [],
    },
    meta: {
        type: Object,
        default: () => ({
            total: 0,
            per_page: 0,
        }),
    },
});
</script>

<template>
    <nav v-if="links.length > 3" class="mt-4 flex justify-center">
        <div class="flex gap-1">
            <template v-for="(link, i) in links" :key="i">
                <Link
                    v-if="link.url"
                    :href="link.url"
                    v-html="link.label"
                    class="px-3 py-1 border rounded text-sm"
                    :class="
                        link.active
                            ? 'bg-primary-600 text-white'
                            : 'hover:bg-gray-100'
                    "
                />
                <span
                    v-else
                    v-html="link.label"
                    class="px-3 py-1 border rounded text-gray-400 cursor-not-allowed"
                />
            </template>
        </div>
    </nav>
</template>
