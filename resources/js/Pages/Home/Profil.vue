<script setup>
import HomeLayout from "@/Layouts/HomeLayout.vue";
import { Head } from "@inertiajs/vue3";
import { ref } from "vue";
import ModalBaru from "@/Components/ModalBaru.vue";

const activities = [
    {
        title: "Ujian Kompetensi",
        desc: "Ujian Kompetensi & Sertifikasi SKKNI Bidang Pengelolaan Wakaf 2",
        image: "/assets/images/Kegiatan1.jpeg",
    },
    {
        title: "Pelantikan Pengurus",
        desc: "Pelantikan Pengurus BWI Gresik 2023-2026",
        image: "/assets/images/Kegiatan2.jpeg",
    },
    {
        title: "Pengurus BWI",
        desc: "Pengurus BWI Kab Gresik 2023-2026",
        image: "/assets/images/pengurus/FotoPengurus.jpeg",
    },
];

const showModal = ref(false);
const selected = ref(null);

const openModal = (item) => {
    selected.value = item;
    showModal.value = true;
};

const closeModal = () => {
    showModal.value = false;
    selected.value = null;
};
</script>

<template>
    <Head title="Profil" />
    <HomeLayout>
        <div class="bg-slate-50 text-slate-800">
            <section class="relative bg-white overflow-hidden">
                <div class="max-w-6xl mx-auto px-6 py-20">
                    <h1
                        class="text-4xl md:text-5xl font-bold mb-6 leading-tight"
                    >
                        Apa itu
                        <span class="text-primary"
                            >Badan Wakaf Indonesia Kabupaten Gresik</span
                        >?
                    </h1>
                    <p class="text-lg text-slate-600 max-w-3xl">
                        Badan Wakaf Indonesia (BWI) Kabupaten Gresik adalah
                        perwakilan BWI di tingkat daerah yang berperan dalam
                        pembinaan, pengembangan, dan pengawasan pengelolaan
                        wakaf di wilayah Kabupaten Gresik agar dikelola secara
                        profesional, transparan, dan memberikan manfaat
                        berkelanjutan bagi masyarakat.
                    </p>
                </div>
            </section>

            <section class="max-w-6xl mx-auto px-6 py-16">
                <div class="grid md:grid-cols-2 gap-12 items-start">
                    <div class="space-y-6">
                        <p class="text-slate-700 leading-relaxed">
                            BWI Kabupaten Gresik hadir sebagai penghubung antara
                            wakif, nazhir, dan masyarakat di wilayah Kabupaten
                            Gresik. Fokus utama BWI adalah memastikan harta
                            wakaf dikelola secara amanah, produktif, dan sesuai
                            dengan prinsip syariah.
                        </p>
                        <p class="text-slate-700 leading-relaxed">
                            Dengan pendekatan tata kelola modern dan berbasis
                            regulasi nasional, BWI Kabupaten Gresik mendorong
                            transformasi wakaf dari yang bersifat konsumtif
                            menjadi wakaf produktif yang mampu menopang
                            kesejahteraan sosial, pendidikan, kesehatan, dan
                            pemberdayaan ekonomi masyarakat Gresik.
                        </p>
                    </div>
                    <div class="bg-primary/5 rounded-3xl p-8">
                        <ul class="space-y-4">
                            <li class="flex gap-4">
                                <span
                                    class="w-2 h-2 mt-2 rounded-full bg-primary"
                                ></span>
                                <p class="text-slate-700">
                                    Merupakan perwakilan resmi BWI di tingkat
                                    kabupaten
                                </p>
                            </li>
                            <li class="flex gap-4">
                                <span
                                    class="w-2 h-2 mt-2 rounded-full bg-primary"
                                ></span>
                                <p class="text-slate-700">
                                    Bersinergi dengan Kemenag, Pemda, dan nazhir
                                    daerah
                                </p>
                            </li>
                            <li class="flex gap-4">
                                <span
                                    class="w-2 h-2 mt-2 rounded-full bg-primary"
                                ></span>
                                <p class="text-slate-700">
                                    Berorientasi pada pengembangan wakaf
                                    produktif di Gresik
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
            </section>

            <section class="max-w-6xl mx-auto px-6 py-20">
                <div class="grid md:grid-cols-2 gap-12 items-start">
                    <div>
                        <h2 class="text-3xl font-bold mb-4">Dasar Hukum</h2>
                        <p class="text-slate-600 mb-6">
                            Pelaksanaan tugas dan fungsi BWI Kabupaten Gresik
                            berlandaskan pada peraturan perundang-undangan yang
                            berlaku di bidang perwakafan.
                        </p>
                        <ul class="space-y-4">
                            <li class="p-6 rounded-2xl bg-white border">
                                <p class="font-semibold">
                                    Undang-Undang Nomor 41 Tahun 2004
                                </p>
                                <p class="text-slate-600 text-sm">
                                    Tentang Wakaf
                                </p>
                            </li>
                            <li class="p-6 rounded-2xl bg-white border">
                                <p class="font-semibold">
                                    Peraturan Pemerintah Nomor 42 Tahun 2006
                                </p>
                                <p class="text-slate-600 text-sm">
                                    Pelaksanaan Undang-Undang Wakaf
                                </p>
                            </li>
                            <li class="p-6 rounded-2xl bg-white border">
                                <p class="font-semibold">
                                    Peraturan Badan Wakaf Indonesia
                                </p>
                                <p class="text-slate-600 text-sm">
                                    Terkait pembinaan dan pengelolaan wakaf
                                </p>
                            </li>
                        </ul>
                    </div>
                    <div class="bg-primary/5 rounded-3xl p-10">
                        <h3 class="text-2xl font-bold mb-6 text-primary">
                            Ruang Lingkup
                        </h3>
                        <ul class="space-y-4">
                            <li class="flex gap-4">
                                <span class="text-primary font-bold">01</span>
                                <p class="text-slate-700">
                                    Pembinaan dan peningkatan kapasitas nazhir
                                    wakaf di Kabupaten Gresik
                                </p>
                            </li>
                            <li class="flex gap-4">
                                <span class="text-primary font-bold">02</span>
                                <p class="text-slate-700">
                                    Pengawasan dan pendataan aset wakaf agar
                                    dikelola secara amanah
                                </p>
                            </li>
                            <li class="flex gap-4">
                                <span class="text-primary font-bold">03</span>
                                <p class="text-slate-700">
                                    Pengembangan wakaf produktif berbasis
                                    potensi lokal daerah
                                </p>
                            </li>
                            <li class="flex gap-4">
                                <span class="text-primary font-bold">04</span>
                                <p class="text-slate-700">
                                    Edukasi dan sosialisasi wakaf kepada
                                    masyarakat
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
            </section>

            <section class="bg-white">
                <div class="max-w-6xl mx-auto px-6 py-20">
                    <div class="grid md:grid-cols-2 gap-12">
                        <div class="p-10 rounded-3xl border bg-slate-50">
                            <h2 class="text-2xl font-bold mb-4 text-primary">
                                Visi
                            </h2>
                            <p class="text-slate-700 leading-relaxed">
                                Terwujudnya pengelolaan wakaf di Kabupaten
                                Gresik yang profesional, amanah, dan produktif
                                untuk kesejahteraan masyarakat.
                            </p>
                        </div>
                        <div class="p-10 rounded-3xl border bg-slate-50">
                            <h2 class="text-2xl font-bold mb-6 text-primary">
                                Misi
                            </h2>
                            <ul class="space-y-4">
                                <li class="flex gap-4">
                                    <span class="text-primary font-bold"
                                        >01</span
                                    >
                                    <p class="text-slate-700">
                                        Meningkatkan kualitas dan kapasitas
                                        nazhir wakaf di Kabupaten Gresik
                                    </p>
                                </li>
                                <li class="flex gap-4">
                                    <span class="text-primary font-bold"
                                        >02</span
                                    >
                                    <p class="text-slate-700">
                                        Mendorong pengembangan wakaf produktif
                                        dan inovatif berbasis potensi lokal
                                        Gresik
                                    </p>
                                </li>
                                <li class="flex gap-4">
                                    <span class="text-primary font-bold"
                                        >03</span
                                    >
                                    <p class="text-slate-700">
                                        Mewujudkan tata kelola wakaf yang
                                        transparan, akuntabel, dan sesuai
                                        regulasi
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
            <section class="bg-white">
                <div class="max-w-6xl mx-auto px-6 py-20">
                    <h2 class="text-3xl font-bold mb-4">
                        Kegiatan BWI Kabupaten Gresik
                    </h2>
                    <p class="text-slate-600 mb-10 max-w-3xl">
                        Dokumentasi berbagai kegiatan Badan Wakaf Indonesia
                        Kabupaten Gresik.
                    </p>

                    <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6">
                        <div
                            v-for="item in activities"
                            :key="item.title"
                            class="group cursor-pointer"
                            @click="openModal(item)"
                        >
                            <div class="relative overflow-hidden rounded-3xl">
                                <img
                                    :src="item.image"
                                    :alt="item.title"
                                    class="w-full h-64 object-cover group-hover:scale-105 transition duration-500"
                                />
                                <div
                                    class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition"
                                ></div>
                            </div>
                            <div class="mt-4">
                                <p class="font-semibold">{{ item.title }}</p>
                                <p class="text-sm text-slate-600">
                                    {{ item.desc }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <ModalBaru
                        :show="showModal"
                        :close-on-outside="true"
                        @close="closeModal"
                        width="max-w-5xl"
                    >
                        <img
                            :src="selected?.image"
                            :alt="selected?.title"
                            class="w-full max-h-[80vh] object-contain bg-black"
                        />
                        <div class="p-6">
                            <div class="text-xl font-bold">
                                {{ selected?.title }}
                            </div>
                            <p class="text-slate-600 mt-2">
                                {{ selected?.desc }}
                            </p>
                        </div>
                    </ModalBaru>
                </div>
            </section>

            <section class="max-w-6xl mx-auto px-6 py-20">
                <div class="text-center max-w-3xl mx-auto">
                    <p class="text-xl font-medium text-slate-800">
                        BWI Kabupaten Gresik berkomitmen menjadikan wakaf
                        sebagai instrumen strategis pembangunan sosial dan
                        ekonomi masyarakat secara berkelanjutan.
                    </p>
                </div>
            </section>
        </div>
    </HomeLayout>
</template>
