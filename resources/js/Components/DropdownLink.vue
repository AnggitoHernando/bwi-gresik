<script setup>
import { Menu, MenuButton, MenuItems, MenuItem } from "@headlessui/vue";
import { ChevronDown } from "lucide-vue-next";

defineProps({
    label: {
        type: String,
        default: "Menu",
    },
});
</script>

<template>
    <Menu as="div" class="relative inline-block text-left">
        <MenuButton
            class="inline-flex items-center gap-2 rounded-xl border px-4 py-2 text-sm font-medium hover:bg-gray-50 transition"
        >
            {{ label }}
            <ChevronDown class="w-4 h-4" />
        </MenuButton>

        <!-- Items -->
        <MenuItems
            class="absolute right-0 mt-2 w-48 origin-top-right rounded-xl border bg-white shadow-lg focus:outline-none z-50"
        >
            <div class="p-1">
                <slot />
            </div>
        </MenuItems>
    </Menu>
</template>
