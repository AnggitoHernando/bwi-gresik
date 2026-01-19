<script setup>
import { Menu, MenuButton, MenuItems, MenuItem } from "@headlessui/vue";
import { ChevronDown } from "lucide-vue-next";

defineProps({
    labelDropdown: {
        type: String,
        default: "Menu",
    },
});
</script>

<template>
    <Menu as="div" class="relative inline-block text-left">
        <MenuButton
            class="inline-flex items-center gap-2 rounded-xl border px-4 py-2 text-sm font-medium bg-white text-gray-800 hover:bg-gray-50 transition"
        >
            {{ labelDropdown }}
            <ChevronDown class="w-4 h-4" />
        </MenuButton>

        <MenuItems
            class="z-50 focus:outline-none fixed inset-x-5 bottom rounded-2xl border bg-white shadow-xl md:absolute md:inset-auto md:right-0 md:mt-4 md:w-48 md:rounded-xl"
        >
            <div class="p-3">
                <slot />
            </div>
        </MenuItems>
    </Menu>
</template>
