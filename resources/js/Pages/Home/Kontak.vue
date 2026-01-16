<script setup>
import HomeLayout from "@/Layouts/HomeLayout.vue";
import { Head } from "@inertiajs/vue3";
import { MapPin, Phone, Mail } from "lucide-vue-next";
</script>
<template>
    <Head title="Kontak" />
    <HomeLayout>
        <section class="bg-slate-50 min-h-screen py-16">
            <div class="max-w-7xl mx-auto px-6">
                <!-- Header -->
                <div class="text-center mb-14">
                    <h1 class="text-3xl md:text-4xl font-bold text-slate-800">
                        Kontak Kami
                    </h1>
                    <p class="mt-4 text-slate-600 max-w-2xl mx-auto">
                        Badan Wakaf Indonesia (BWI) Kabupaten Gresik siap
                        melayani pertanyaan, konsultasi, dan informasi seputar
                        perwakafan.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <div class="bg-white rounded-3xl p-8 shadow-sm">
                        <h2 class="text-xl font-semibold mb-6 text-slate-800">
                            Informasi Kontak
                        </h2>

                        <ul class="space-y-5 text-slate-600">
                            <li class="flex items-start gap-4">
                                <div
                                    class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center"
                                >
                                    <MapPin class="w-5 h-5 text-primary" />
                                </div>
                                <span>
                                    Kantor Kementerian Agama Kabupaten Gresik<br />
                                    Jl. Dr. Wahidin Sudirohusodo, Gresik
                                </span>
                            </li>

                            <li class="flex items-center gap-4">
                                <div
                                    class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center"
                                >
                                    <Phone class="w-5 h-5 text-primary" />
                                </div>
                                <span>081278092387</span>
                            </li>

                            <li class="flex items-center gap-4">
                                <div
                                    class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center"
                                >
                                    <Mail class="w-5 h-5 text-primary" />
                                </div>
                                <span>bwigresik@gmail.com</span>
                            </li>
                        </ul>

                        <div class="mt-8">
                            <h3
                                class="text-sm font-semibold text-slate-700 mb-3"
                            >
                                Jam Pelayanan
                            </h3>
                            <p class="text-slate-600">
                                Senin – Jumat : 08.00 – 15.00 WIB
                            </p>
                        </div>
                    </div>

                    <div class="bg-white rounded-3xl p-8 shadow-sm">
                        <h2 class="text-xl font-semibold mb-6 text-slate-800">
                            Lokasi Kantor
                        </h2>

                        <div
                            class="w-full h-[300px] rounded-2xl overflow-hidden border"
                        >
                            <iframe
                                class="w-full h-full"
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"
                                src="https://www.google.com/maps?q=Kantor%20Kementerian%20Agama%20Kabupaten%20Gresik&output=embed"
                            ></iframe>
                        </div>

                        <div
                            class="mt-8 flex items-center gap-4 p-4 rounded-2xl bg-primary/5"
                        >
                            <img
                                src="/assets/images/logo-bwi.png"
                                alt="Logo BWI"
                                class="w-14 h-14 object-contain"
                            />
                            <div>
                                <p class="text-sm font-semibold text-slate-800">
                                    Badan Wakaf Indonesia
                                </p>
                                <p class="text-xs text-slate-600">
                                    Perwakilan Kabupaten Gresik
                                </p>
                                <span
                                    class="inline-block mt-1 text-xs font-medium px-3 py-1 rounded-full bg-primary/10 text-primary"
                                >
                                    Lembaga Resmi
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </HomeLayout>
</template>
