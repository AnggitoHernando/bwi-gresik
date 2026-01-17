<script setup>
const props = defineProps({
    title: String,
    type: {
        type: String,
        default: "button",
    },
});
</script>
<template>
    <button :type="type" :title="title" class="text-white px-2 py-1 rounded">
        <slot name="icon" />
        <slot name="text" />
    </button>
</template>
