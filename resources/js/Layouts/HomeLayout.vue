<script setup>
import { ref } from "vue";
import { Link, usePage } from "@inertiajs/vue3";
import KritikSaran from "@/Components/KritikSaran.vue";

const mobileOpen = ref(false);
const page = usePage();

const navs = [
    { name: "Home", href: "/", route: "homepage" },
    { name: "Profil", href: "/profil", route: "homepage.profil" },
    {
        name: "Dokumen Administrasi",
        href: "/dokumen-administrasi",
        route: "homepage.documentAdministrasi",
    },
    { name: "Kontak", href: "/kontak", route: "homepage.kontak" },
];

const isActive = (href) => page.url === href;
</script>

<template>
    <div class="bg-slate-50 text-slate-800 min-h-screen">
        <header
            class="fixed top-0 inset-x-0 z-50 bg-white/80 backdrop-blur border-b"
        >
            <div
                class="max-w-7xl mx-auto px-4 h-16 flex items-center justify-between"
            >
                <Link :href="route('homepage')">
                    <div class="flex items-center gap-2 font-bold text-primary">
                        <img
                            src="/assets/images/logo-bwi.png"
                            class="w-14 h-14 rounded-xl flex items-center justify-center"
                        />
                        <span class="hidden sm:block"
                            >Badan Wakaf Indonesia Kabupaten Gresik</span
                        >
                    </div>
                </Link>

                <!-- Desktop -->
                <nav
                    class="hidden md:flex items-center gap-8 text-sm font-medium"
                >
                    <Link
                        v-for="nav in navs"
                        :key="nav.href"
                        :href="route(nav.route)"
                        class="text-sm font-medium text-gray-700 transition"
                        :class="
                            isActive(nav.href)
                                ? 'font-black text-primary'
                                : 'hover:text-primary'
                        "
                    >
                        {{ nav.name }}
                    </Link>

                    <Link
                        href="#wakaf"
                        class="px-5 py-2 rounded-xl bg-primary text-white hover:bg-primary/90"
                        >Mulai Wakaf</Link
                    >
                </nav>

                <!-- Mobile button -->
                <button
                    @click="mobileOpen = !mobileOpen"
                    class="md:hidden w-10 h-10 rounded-xl border flex items-center justify-center"
                >
                    ☰
                </button>
            </div>

            <!-- Mobile Menu -->
            <div v-if="mobileOpen" class="md:hidden bg-white border-t">
                <div class="px-6 py-4 space-y-4 text-sm">
                    <Link
                        href="#about"
                        @click="mobileOpen = false"
                        class="block"
                        >Tentang Kami</Link
                    >
                    <Link
                        href="#wakaf"
                        @click="mobileOpen = false"
                        class="block"
                        >Wakaf</Link
                    >
                    <Link
                        href="/berita"
                        @click="mobileOpen = false"
                        class="block"
                        >Berita</Link
                    >
                    <Link
                        href="#wakaf"
                        @click="mobileOpen = false"
                        class="block text-center px-4 py-3 rounded-xl bg-primary text-white"
                        >Mulai Wakaf</Link
                    >
                </div>
            </div>
        </header>

        <main class="pt-16">
            <slot />
        </main>
        <KritikSaran />

        <!-- Footer -->
        <footer class="bg-primary mt-24">
            <div class="max-w-7xl mx-auto px-6 py-12">
                <div class="grid md:grid-cols-3 gap-8">
                    <div
                        class="bg-white/20 backdrop-blur-md border border-white/30 rounded-xl p-10"
                    >
                        <div
                            class="flex items-center gap-2 font-bold text-primary mb-4"
                        >
                            <img
                                src="/assets/images/logo-bwi.png"
                                class="w-20 h-20 rounded-xl flex items-center justify-center"
                            />
                            <h4 class="font-semibold text-white text-sm">
                                Badan Wakaf Indonesia Kabupaten Gresik
                            </h4>
                        </div>
                        <p class="text-sm text-white">
                            Menjadi jembatan kebaikan melalui pengelolaan wakaf
                            yang inovatif dan produktif di Kabupaten Gresik. BWI
                            Kabupaten Gresik berupaya mentransformasi wakaf
                            menjadi instrumen pemberdayaan masyarakat yang
                            berdaya guna dan penuh keberkahan.
                        </p>
                    </div>
                    <div>
                        <h4 class="font-semibold text-white text-lg mb-4">
                            Menu
                        </h4>
                        <ul class="space-y-2 text-sm text-secondary">
                            <li><Link href="#about">Tentang Kami</Link></li>
                            <li><Link href="#wakaf">Wakaf</Link></li>
                            <li><Link href="/berita">Berita</Link></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-semibold text-white text-lg mb-4">
                            Kontak
                        </h4>
                        <p class="text-sm text-secondary">Gresik, Jawa Timur</p>
                    </div>
                </div>
                <div
                    class="text-secondary border-t border-white/20 mt-10 pt-6 text-center text-sm"
                >
                    © 2026 BWI Kabupaten Gresik
                </div>
            </div>
        </footer>
    </div>
</template>
