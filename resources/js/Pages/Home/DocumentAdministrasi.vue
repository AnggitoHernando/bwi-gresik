<script setup>
import HomeLayout from "@/Layouts/HomeLayout.vue";
import { Head } from "@inertiajs/vue3";
import { ref } from "vue";
import { ChevronDown, Download } from "lucide-vue-next";

const activeId = ref(null);

const documents = [
    {
        id: 1,
        title: "SK Pembentukan BWI Kabupaten Gresik",
        file: "/assets/document/SK 90 Kab Gresik.pdf",
    },
    {
        id: 2,
        title: "Berkas BWI Nasichun Amin",
        file: "/assets/document/1. BERKAS BWI NASICHUN AMIN.pdf",
    },
    {
        id: 3,
        title: "Berkas BWI Moh Ismail",
        file: "/assets/document/2. BERKAS BWI (MOH ISMAIL).pdf",
    },
];
const toggle = (id) => {
    activeId.value = activeId.value === id ? null : id;
};
</script>
<template>
    <Head title="Dokumen Administrasi" />
    <HomeLayout>
        <section class="max-w-5xl mx-auto py-10 px-4">
            <h1 class="text-2xl font-bold mb-6 text-slate-800">
                Dokumen Administrasi
            </h1>

            <div class="space-y-4">
                <div
                    v-for="doc in documents"
                    :key="doc.id"
                    class="border rounded-2xl overflow-hidden"
                >
                    <button
                        @click="toggle(doc.id)"
                        class="w-full flex justify-between items-center px-6 py-4 bg-slate-50 hover:bg-slate-100 transition"
                    >
                        <span class="font-semibold text-slate-700">
                            {{ doc.title }}
                        </span>

                        <ChevronDown
                            class="w-5 h-5 text-slate-600 transition-transform duration-200"
                            :class="activeId === doc.id ? 'rotate-180' : ''"
                        />
                    </button>

                    <div
                        v-if="activeId === doc.id"
                        class="bg-white px-4 py-4 border-t space-y-4"
                    >
                        <div class="flex justify-end">
                            <a
                                :href="doc.file"
                                download
                                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl bg-primary text-white hover:opacity-90 transition"
                            >
                                <Download class="w-4 h-4" />
                                Download PDF
                            </a>
                        </div>

                        <iframe
                            :src="doc.file"
                            loading="lazy"
                            class="w-full h-[600px] rounded-xl border"
                        ></iframe>
                    </div>
                </div>
            </div>
        </section>
    </HomeLayout>
</template>
