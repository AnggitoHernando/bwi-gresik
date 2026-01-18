<script setup>
import { Menu, MenuButton, MenuItems, MenuItem } from "@headlessui/vue";
import { Menu as MenuIcon, PanelLeft, ChevronDown } from "lucide-vue-next";
import { Link, usePage } from "@inertiajs/vue3";

const page = usePage();
defineEmits(["toggleCollapse", "toggleMobile"]);
const namaUser = page.props.auth.user.name ?? "";
</script>

<template>
    <header
        class="h-16 flex items-center px-6 border-b bg-white border-gray-200"
    >
        <button
            class="md:hidden p-2 rounded hover:bg-gray-100"
            @click="$emit('toggleMobile')"
        >
            <MenuIcon class="w-5 h-5 text-gray-700" />
        </button>

        <button
            class="hidden md:block p-2 rounded hover:bg-primary"
            @click="$emit('toggleCollapse')"
        >
            <PanelLeft class="w-5 h-5 text-gray-400" />
        </button>

        <div class="ml-auto">
            <Menu as="div" class="relative inline-block text-left">
                <MenuButton
                    class="flex items-center gap-2 px-3 py-2 rounded text-sm font-medium text-gray-700 hover:bg-primary hover:text-white"
                >
                    {{ namaUser }}
                    <ChevronDown class="w-4 h-4" />
                </MenuButton>

                <MenuItems
                    class="absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded shadow z-50"
                >
                    <MenuItem as="template" v-slot="{ active }">
                        <Link
                            href="/profile"
                            class="block px-4 py-2 text-sm"
                            :class="active ? 'bg-secondary' : ''"
                        >
                            Profile
                        </Link>
                    </MenuItem>

                    <MenuItem as="template" v-slot="{ active }">
                        <Link
                            method="post"
                            href="/logout"
                            as="button"
                            class="w-full text-left px-4 py-2 text-sm"
                            :class="active ? 'bg-secondary' : ''"
                        >
                            Logout
                        </Link>
                    </MenuItem>
                </MenuItems>
            </Menu>
        </div>
    </header>
</template>
