<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <section
        class="bg-gradient-to-r from-[#007d0d] via-green-500 to-emerald-400"
    >
        <div
            class="flex flex-col items-center justify-center px-6 py-8 mx-auto h-screen lg:py-0"
        >
            <div
                class="w-full bg-white/10 backdrop-blur-md border border-white/30 rounded-2xl shadow-lg md:mt-0 sm:max-w-md xl:p-0"
            >
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <div class="flex justify-center">
                        <Link href="/">
                            <ApplicationLogo
                                class="h-36 w-36 fill-current text-gray-500"
                            />
                        </Link>
                    </div>
                    <span
                        class="block mb-2 text-xl font-medium text-white text-center"
                        >Badan Wakaf Indonesia Kabupaten Gresik</span
                    >
                    <slot />
                </div>
            </div>
        </div>
    </section>
</template>
