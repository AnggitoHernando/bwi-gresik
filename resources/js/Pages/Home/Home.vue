<script setup>
import HomeLayout from "@/Layouts/HomeLayout.vue";
import { Head } from "@inertiajs/vue3";
import { CircleDollarSign, MapPin, TrendingUp } from "lucide-vue-next";
const strukturs = [
    { jabatan: "Ketua", nama: "Nama Ketua", gambar: "" },
    { jabatan: "Wakil Ketua", nama: "Nama Wakil Ketua", gambar: "" },
    { jabatan: "Sekretaris", nama: "Nama Sekretaris", gambar: "" },
    { jabatan: "Bendahara", nama: "Nama Bendahara", gambar: "" },
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
                    Pusat informasi dan layanan wakaf resmi BWI Kabupaten
                    Gresik.
                </p>
                <a
                    href="#wakaf"
                    class="inline-block px-8 py-4 rounded-2xl bg-white text-primary font-semibold"
                >
                    Mulai Berwakaf
                </a>
            </div>
        </section>

        <!-- About -->
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
                    Ilustrasi Kegiatan
                </div>
            </div>
        </section>

        <!-- Wakaf -->
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

                <div class="grid sm:grid-cols-2 md:grid-cols-4 gap-8">
                    <div
                        v-for="struktur in strukturs"
                        class="bg-white rounded-3xl p-6 text-center shadow-sm"
                    >
                        <img
                            src="https://www.manypixels.co/static/illustrations/Islamic-People.svg"
                            alt="Avatar pengurus"
                            class="w-24 h-24 mx-auto rounded-full mb-4 bg-secondary"
                        />
                        <h4 class="font-semibold">{{ struktur.jabatan }}</h4>
                        <p class="text-sm text-slate-500">
                            {{ struktur.nama }}
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </HomeLayout>
</template>
