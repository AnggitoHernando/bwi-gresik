<script setup>
import { Link } from "@inertiajs/vue3";
import {
    LayoutDashboard,
    MessageSquare,
    User,
    Dock,
    Settings,
} from "lucide-vue-next";
const props = defineProps({
    collapsed: Boolean,
    mobile: Boolean,
    open: Boolean,
    pageNow: String,
});

const active = "bg-secondary rounded-xl hover:bg-primary hover:text-white";

defineEmits(["close"]);
</script>

<template>
    <aside
        class="bg-white border-r border-gray-200 h-screen transition-all duration-200 flex flex-col"
        :class="[
            mobile
                ? open
                    ? 'w-64 translate-x-0'
                    : '-translate-x-full w-64'
                : collapsed
                  ? 'w-20'
                  : 'w-64',
        ]"
    >
        <div class="h-16 flex items-center justify-between px-4">
            <div class="font-bold text-lg truncate">
                <div
                    v-if="!collapsed"
                    class="flex items-center gap-2 font-bold text-primary"
                >
                    <img
                        src="/assets/images/logo-bwi.png"
                        class="w-8 h-8 rounded-xl flex items-center justify-center"
                    />
                    <span class="hidden sm:block">BWI Kab Gresik</span>
                </div>
                <div v-else>
                    <img
                        src="/assets/images/logo-bwi.png"
                        class="w-8 h-8 rounded-xl flex items-center justify-center"
                    />
                </div>
            </div>
            <button
                v-if="mobile"
                class="p-3 text-right md:hidden"
                @click="$emit('close')"
            >
                ✕
            </button>
        </div>

        <nav class="p-4 space-y-2">
            <div
                class="rounded"
                :class="[
                    pageNow == '/dashboard' ? active : 'hover:bg-secondary',
                ]"
            >
                <Link
                    :href="route('dashboard')"
                    class="flex items-center gap-3 p-2"
                >
                    <LayoutDashboard class="w-5 h-5" />
                    <span v-if="!collapsed">Dashboard</span>
                </Link>
            </div>

            <div
                class="rounded"
                :class="[
                    pageNow == '/kritik-saran' ? active : 'hover:bg-secondary',
                ]"
            >
                <Link
                    :href="route('admin.kritik.index')"
                    class="flex items-center gap-3 p-2"
                >
                    <MessageSquare class="w-5 h-5" />
                    <span v-if="!collapsed">Kritik & Saran</span>
                </Link>
            </div>

            <div
                class="rounded"
                :class="[
                    pageNow == '/type-document' ? active : 'hover:bg-secondary',
                ]"
            >
                <Link
                    :href="route('admin.document.index')"
                    class="flex items-center gap-3 p-2"
                >
                    <Dock class="w-5 h-5" />
                    <span v-if="!collapsed">Dokumen Persyaratan</span>
                </Link>
            </div>

            <div
                class="rounded"
                :class="[
                    pageNow == '/jenis-nadzir' ? active : 'hover:bg-secondary',
                ]"
            >
                <Link
                    :href="route('admin.jenisNadzir.index')"
                    class="flex items-center gap-3 p-2"
                >
                    <Settings class="w-5 h-5" />
                    <span v-if="!collapsed">Jenis Nadzir</span>
                </Link>
            </div>

            <div
                class="rounded"
                :class="[pageNow == '/nadzir' ? active : 'hover:bg-secondary']"
            >
                <Link
                    :href="route('admin.nadzir.index')"
                    class="flex items-center gap-3 p-2"
                >
                    <User class="w-5 h-5" />
                    <span v-if="!collapsed">Nadzir</span>
                </Link>
            </div>
        </nav>
    </aside>
</template>
