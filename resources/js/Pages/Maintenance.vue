<script setup>
import { Head } from "@inertiajs/vue3";
import HomeLayout from "@/Layouts/HomeLayout.vue";
</script>

<template>
    <Head title="Sedang Maintenance" />
    <HomeLayout>
        <div
            class="min-h-screen bg-gradient-to-b from-slate-50 to-slate-100 flex items-center justify-center px-4 py-6 sm:p-6"
        >
            <div class="max-w-3xl w-full">
                <div
                    class="bg-white rounded-3xl shadow-xl border border-slate-200 overflow-hidden"
                >
                    <div class="p-6 sm:p-8 md:p-12 text-center">
                        <div
                            class="mx-auto mb-6 w-20 h-20 rounded-full bg-primary/10 flex items-center justify-center"
                        >
                            <img
                                src="/assets/images/logo-bwi.png"
                                class="w-20 h-20 rounded-xl flex items-center justify-center"
                            />
                        </div>

                        <h1
                            class="text-xl sm:text-2xl md:text-3xl font-semibold text-slate-800 mb-3"
                        >
                            Halaman Sedang Diperbaiki
                        </h1>

                        <p
                            class="text-sm sm:text-base text-slate-600 max-w-xl mx-auto mb-6 sm:mb-8"
                        >
                            Halaman ini sedang dalam proses perbaikan dan
                            penyempurnaan. Kami berupaya agar layanan dapat
                            segera digunakan kembali dengan optimal.
                        </p>

                        <div
                            class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-3 sm:gap-4 mb-8 sm:mb-10"
                        >
                            <div class="rounded-2xl border p-4">
                                <p class="text-sm text-slate-500">Status</p>
                                <p class="font-medium text-slate-800">
                                    Perbaikan Halaman
                                </p>
                            </div>
                            <div class="rounded-2xl border p-4">
                                <p class="text-sm text-slate-500">Estimasi</p>
                                <p class="font-medium text-slate-800">
                                    Segera Tersedia
                                </p>
                            </div>
                        </div>

                        <div
                            class="flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center"
                        >
                            <a
                                href="/"
                                class="inline-flex items-center justify-center rounded-xl bg-primary px-6 py-3 text-white font-medium hover:opacity-90 transition"
                            >
                                Kembali ke Home
                            </a>
                        </div>
                    </div>

                    <div
                        class="bg-slate-50 border-t px-4 sm:px-6 py-3 sm:py-4 text-center text-xs sm:text-sm text-slate-500"
                    >
                        © {{ new Date().getFullYear() }} BWI Kabupaten Gresik.
                        Seluruh hak cipta dilindungi.
                    </div>
                </div>
            </div>
        </div>
    </HomeLayout>
</template>
