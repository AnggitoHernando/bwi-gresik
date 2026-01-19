<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import HomeLayout from "@/Layouts/HomeLayout.vue";
import { Head } from "@inertiajs/vue3";
import { CircleDollarSign, MapPin, TrendingUp } from "lucide-vue-next";
import { ref } from "vue";

const selengkapnya = ref(null);
const toggle = (section) => {
    selengkapnya.value = selengkapnya.value === section ? null : section;
};

const strukturs = [
    {
        jabatan: "Ketua",
        nama: "Ir. Moh Ismail Hamim, MM",
        gambar: "/assets/images/ProfilKosong.jpeg",
    },
    {
        jabatan: "Wakil Ketua",
        nama: "Dr. Sutono, S.Ag., M.Pd.L, M.E",
        gambar: "/assets/images/Pengurus/WakilKetua.jpeg",
    },
    {
        jabatan: "Sekretaris",
        nama: "Hj. Nelly Afroh, M.Pd.I",
        gambar: "/assets/images/ProfilKosong.jpeg",
    },
    {
        jabatan: "Bendahara",
        nama: "H. Rodli, S.Ag",
        gambar: "/assets/images/ProfilKosong.jpeg",
    },
];

const strukturDewanPertimbangan = [
    {
        jabatan: "Ketua",
        nama: "Drs. Moh. Ersat, M.HI",
        gambar: "/assets/images/ProfilKosong.jpeg",
    },
    {
        jabatan: "Anggota",
        nama: "Hamim, S.Sos., M.M",
        gambar: "/assets/images/ProfilKosong.jpeg",
    },
    {
        jabatan: "Anggota",
        nama: "Fathoni Muhammad",
        gambar: "/assets/images/Pengurus/fathoni.jpeg",
    },
];

const strukturDevisi = [
    {
        jabatan: "Pembinaan Nazhir dan Pengelolaan Wakaf",
        nama: "Ahmad Hadi, ST",
        gambar: "/assets/images/Pengurus/hadi.jpeg",
    },
    {
        jabatan: "Pembinaan Nazhir dan Pengelolaan Wakaf",
        nama: "Dr. Muhammad Shohib",
        gambar: "/assets/images/Pengurus/shohib.jpeg",
    },
    {
        jabatan: "Hubungan Masyarakat, Sosialisasi dan Literasi",
        nama: "H. Nasichun  Amin, S.Ag., M.A",
        gambar: "/assets/images/ProfilKosong.jpeg",
    },
    {
        jabatan: "Kerjasama, Kelembagaan dan Advokasi",
        nama: "H. Muhammad Thoha Mahsun, S.Ag., M.Pd.I., M.H",
        gambar: "/assets/images/Pengurus/toha.jpeg",
    },
    {
        jabatan: "Pendataan, Sertifikasi dan Ruislagh",
        nama: "Wasono Gigih Lanang Sejati, S.ST",
        gambar: "/assets/images/ProfilKosong.jpeg",
    },
    {
        jabatan: "Pengawasan dan Tata Kelola",
        nama: "M. Khusnul Khuluq, S.Ag., M.Pd",
        gambar: "/assets/images/Pengurus/khuluq.jpeg",
    },
    {
        jabatan: "Pengawasan dan Tata Kelola",
        nama: "Muhyiddin Abror, M.Pd.I.",
        gambar: "/assets/images/ProfilKosong.jpeg",
    },
];
</script>
<template>
    <Head title="Home" />
    <HomeLayout>
        <section class="bg-gradient-to-br from-primary to-secondary text-white">
            <div class="max-w-7xl mx-auto px-6 py-24">
                <h1 class="text-4xl md:text-6xl font-bold mb-6">
                    Wakaf Hari Ini,<br />Manfaat Sepanjang Masa
                </h1>
                <p class="max-w-xl text-lg mb-10">
                    Website resmi Badan Wakaf Indonesia Kabupaten Gresik sebagai
                    pusat informasi, edukasi, dan layanan wakaf yang transparan
                    dan amanah.
                </p>
                <a
                    href="#wakaf"
                    class="inline-block px-8 py-4 rounded-2xl bg-white text-primary font-semibold"
                >
                    Mulai Berwakaf
                </a>
            </div>
        </section>

        <section id="about" class="py-20">
            <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-12">
                <div>
                    <h2 class="text-3xl font-bold mb-6">Tentang Kami</h2>
                    <p class="text-slate-600">
                        Badan Wakaf Indonesia (BWI) Kabupaten Gresik adalah
                        perwakilan BWI di tingkat kabupaten yang bertugas
                        membina nazhir (pengelola wakaf), mengelola aset wakaf,
                        serta mengembangkan perwakafan produktif di wilayah
                        Gresik, sesuai UU Wakaf No. 41 Tahun 2004, dengan
                        kepengurusan yang dilantik dan aktif berkoordinasi
                        dengan pemerintah daerah untuk memaksimalkan manfaat
                        wakaf bagi masyarakat.
                    </p>
                </div>
                <div
                    class="rounded-3xl bg-secondary h-64 flex items-center justify-center text-primary"
                >
                    <img
                        class="rounded-xl"
                        src="/assets/images/pengurus/FotoPengurus.jpeg"
                        alt="Foto Pengurus BWI Gresik"
                    />
                </div>
            </div>
        </section>

        <section id="wakaf" class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold mb-4">
                        Yuk, Berwakaf Sekarang
                    </h2>
                    <p class="text-slate-600">
                        Wakaf bukan soal seberapa besar, tapi seberapa ikhlas
                        dan konsisten manfaatnya untuk umat.
                    </p>
                </div>
                <div class="grid md:grid-cols-3 gap-8">
                    <div
                        class="p-8 rounded-3xl border hover:shadow-xl transition"
                    >
                        <div class="flex justify-center mb-4">
                            <CircleDollarSign class="w-12 h-12 text-primary" />
                        </div>
                        <h3 class="text-xl text-center font-semibold mb-3">
                            Wakaf Uang
                        </h3>
                        <p class="text-slate-600">
                            Mudah, fleksibel, dan dapat disalurkan untuk
                            berbagai program produktif.
                        </p>
                    </div>
                    <div
                        class="p-8 rounded-3xl border hover:shadow-xl transition"
                    >
                        <div class="flex justify-center mb-4">
                            <MapPin class="w-12 h-12 text-primary" />
                        </div>
                        <h3 class="text-xl text-center font-semibold mb-3">
                            Wakaf Tanah
                        </h3>
                        <p class="text-slate-600">
                            Untuk masjid, sekolah, pesantren, dan fasilitas
                            sosial lainnya.
                        </p>
                    </div>
                    <div
                        class="p-8 rounded-3xl border hover:shadow-xl transition"
                    >
                        <div class="flex justify-center mb-4">
                            <TrendingUp class="w-12 h-12 text-primary" />
                        </div>
                        <h3 class="text-xl text-center font-semibold mb-3">
                            Wakaf Produktif
                        </h3>
                        <p class="text-slate-600">
                            Dikelola secara profesional agar hasilnya
                            berkelanjutan.
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <section id="struktur-kepemimpinan" class="py-20">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold mb-4">
                        Struktur Kepemimpinan
                    </h2>
                    <p class="text-slate-600">Pengurus BWI Kabupaten Gresik</p>
                </div>

                <div class="mb-2">
                    <h2 class="text-2xl md:text-3xl font-bold mb-4">
                        Dewan Pertimbangan
                    </h2>
                </div>
                <div class="grid sm:grid-cols-2 md:grid-cols-4 gap-8 mb-3">
                    <div
                        v-for="DewanPertimbangan in strukturDewanPertimbangan"
                        class="bg-white rounded-3xl p-6 text-center shadow-sm"
                    >
                        <img
                            :src="DewanPertimbangan.gambar"
                            alt="Avatar pengurus"
                            class="w-48 h-48 mx-auto rounded-full mb-4 bg-secondary"
                        />
                        <h4 class="font-semibold">
                            {{ DewanPertimbangan.jabatan }}
                        </h4>
                        <p class="text-sm text-slate-500">
                            {{ DewanPertimbangan.nama }}
                        </p>
                    </div>
                </div>
                <div
                    v-if="selengkapnya !== 'struktur'"
                    class="flex mb-3 justify-center"
                >
                    <PrimaryButton @click="toggle('struktur')"
                        >Lihat Selengkapnya</PrimaryButton
                    >
                </div>
                <div v-if="selengkapnya === 'struktur'">
                    <div class="mb-2">
                        <h2 class="text-2xl md:text-3xl font-bold mb-4">
                            Badan Pelaksana
                        </h2>
                    </div>
                    <div class="grid sm:grid-cols-2 md:grid-cols-4 gap-8 mb-3">
                        <div
                            v-for="struktur in strukturs"
                            class="bg-white rounded-3xl p-6 text-center shadow-sm"
                        >
                            <img
                                :src="struktur.gambar"
                                alt="Avatar pengurus"
                                class="w-48 h-48 mx-auto rounded-full mb-4 bg-secondary"
                            />
                            <h4 class="font-semibold">
                                {{ struktur.jabatan }}
                            </h4>
                            <p class="text-sm text-slate-500">
                                {{ struktur.nama }}
                            </p>
                        </div>
                    </div>
                    <div class="mb-2">
                        <h2 class="text-2xl md:text-3xl font-bold mb-4">
                            Divisi-devisi
                        </h2>
                    </div>
                    <div class="grid sm:grid-cols-2 md:grid-cols-4 gap-8 mb-3">
                        <div
                            v-for="devisi in strukturDevisi"
                            class="bg-white rounded-3xl p-6 text-center shadow-sm"
                        >
                            <img
                                :src="devisi.gambar"
                                alt="Avatar pengurus"
                                class="w-48 h-48 mx-auto rounded-full mb-4 bg-secondary"
                            />
                            <h4 class="font-semibold">{{ devisi.jabatan }}</h4>
                            <p class="text-sm text-slate-500">
                                {{ devisi.nama }}
                            </p>
                        </div>
                    </div>
                </div>
                <div
                    v-if="selengkapnya === 'struktur'"
                    class="flex mb-3 justify-center mb-2"
                >
                    <PrimaryButton @click="toggle(null)"
                        >Perkecil</PrimaryButton
                    >
                </div>
            </div>
        </section>
    </HomeLayout>
</template>
