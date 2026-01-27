<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";
defineProps({
    title: String,
    description: String,
});
</script>

<template>
    <div
        class="min-h-screen bg-slate-100 flex items-center justify-center px-4"
    >
        <div class="w-full max-w-2xl">
            <div class="text-center mb-6">
                <div class="flex justify-center">
                    <Link href="/">
                        <ApplicationLogo
                            class="h-36 w-36 fill-current text-gray-500"
                        />
                    </Link>
                </div>
                <h1 class="text-2xl font-bold text-slate-800">
                    Badan Wakaf Indonesia
                </h1>
                <p class="text-sm text-slate-500">Kabupaten Gresik</p>
            </div>

            <div
                class="bg-white border border-slate-200 rounded-2xl p-6 md:p-8 shadow-sm"
            >
                <h2 class="text-xl font-semibold text-slate-800 mb-1">
                    {{ title }}
                </h2>
                <p class="text-sm text-slate-500 mb-6">
                    {{ description }}
                </p>

                <slot />
            </div>

            <p class="text-center text-xs text-slate-400 mt-6">
                © {{ new Date().getFullYear() }} BWI Kabupaten Gresik
            </p>
        </div>
    </div>
</template>
