<script setup>
import { ref, watch } from "vue";
import { usePage } from "@inertiajs/vue3";
import Sidebar from "@/Components/Admin/Sidebar.vue";
import Navbar from "@/Components/Admin/Navbar.vue";
import { useSwal } from "@/Composables/useSwal";
const page = usePage();
const pageNow = ref(page.url);
console.log(page.props);

const sidebarCollapsed = ref(false);
const mobileSidebarOpen = ref(false);
const { success, error } = useSwal();

watch(
    () => page.props.flash,
    (flash) => {
        if (flash?.success) success(flash.success);
        if (flash?.error) error(flash.error);
    },
    { deep: true },
);
</script>

<template>
    <div class="min-h-screen flex bg-gray-100">
        <Sidebar
            class="hidden md:flex"
            :collapsed="sidebarCollapsed"
            @toggleCollapse="sidebarCollapsed = !sidebarCollapsed"
            :pageNow="pageNow"
        />

        <Sidebar
            class="md:hidden fixed inset-y-0 left-0 z-40"
            :collapsed="false"
            :mobile="true"
            :open="mobileSidebarOpen"
            @close="mobileSidebarOpen = false"
            :pageNow="pageNow"
        />

        <div
            v-if="mobileSidebarOpen"
            class="fixed inset-0 bg-black/40 z-30 md:hidden"
            @click="mobileSidebarOpen = false"
        />

        <div class="flex-1 flex flex-col">
            <Navbar
                @toggleCollapse="sidebarCollapsed = !sidebarCollapsed"
                @toggleMobile="mobileSidebarOpen = !mobileSidebarOpen"
            />

            <main class="flex-1">
                <div class="p-6 max-w-7xl w-full mx-auto">
                    <slot />
                </div>
            </main>
        </div>
    </div>
</template>
