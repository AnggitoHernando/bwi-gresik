<script setup>
import { ref } from "vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import {
    Listbox,
    ListboxButton,
    ListboxOptions,
    ListboxOption,
} from "@headlessui/vue";
import { ChevronDown } from "lucide-vue-next";
import Combobox from "@/Components/Combobox.vue";
import FileUpload from "@/Components/FileUpload.vue";

const props = defineProps({
    listKecamatan: {
        type: Array,
        default: () => [],
    },
});

const form = useForm({
    jenisNadzir: "",
    namaNadzir: "",
    namaLembaga: "",
    kecamatan: "",
    email: "",
    password: "",
    password_confirmation: "",
    checklist_pendaftaran_nadzir: "",
    daftar_tanah_wakaf: "",
});

const templates = [
    {
        id: 1,
        title: "Checklist Pendaftaran Nadzir",
        file: "/assets/document/template/CheckListPendaftaranNazhir.doc",
    },
    {
        id: 2,
        title: "Daftar Tanah Wakaf",
        file: "/assets/document/template/DAFTAR DATA TANAH WAKAF.xlsx",
    },
    {
        id: 3,
        title: "Surat Permohonan Tanda Bukti Daftar Nadzir Ke KUA dan BWI",
        file: "/assets/document/template/SURAT_PERMOHONAN_TANDA_BUKTI_DAFTAR_NAZHIR_KE_KUA_&_BWI_KAB_GRESIK.docx",
    },
    {
        id: 4,
        title: "Daftar Kekayaan Di Tanah Wakaf (Khusus Nadzir Lembaga/Badan)",
        file: "/assets/document/template/DAFTAR KEKAYAAN DI TANAH WAKAF.docx",
    },
    {
        id: 5,
        title: "Surat Pernyataan Siap Diaudit (Khusus Nadzir Lembaga/Badan)",
        file: "/assets/document/template/SURAT PERNYATAAN BERSEDIA DIAUDIT.docx",
    },
];

const optionNadzirs = [
    { id: 1, name: "Perorangan", desc: "Nadzir perseorangan" },
    { id: 2, name: "Organisasi", desc: "Nadzir berbentuk organisasi" },
    { id: 3, name: "Badan Hukum", desc: "Nadzir berbadan hukum" },
];
const selectedNadzir = ref(optionNadzirs[0]);

const submit = () => {
    // form.post(route('register'), {
    //     onFinish: () => form.reset('password', 'password_confirmation'),
    // });
    console.log("hai");
};
</script>

<template>
    <GuestLayout
        title="Pendaftaran Nadzir"
        description="Lengkapi data untuk pendaftaran akun nadzir"
    >
        <Head title="Pendaftaran Nadzir" />
        <div class="bg-slate-50 border border-slate-200 rounded-2xl p-5 mb-8">
            <h3 class="text-sm font-semibold text-slate-800 mb-1">
                Template Berkas Pendaftaran
            </h3>
            <p class="text-xs text-slate-500 mb-4">
                Unduh template berikut, isi sesuai ketentuan, lalu unggah pada
                form di bawah.
            </p>

            <ul class="space-y-3">
                <li
                    v-for="template in templates"
                    class="flex items-center justify-between"
                >
                    <span class="text-sm text-slate-700">
                        {{ template.title }}
                    </span>
                    <a
                        :href="template.file"
                        class="text-sm text-primary hover:underline flex items-center gap-1"
                    >
                        Download
                    </a>
                </li>
            </ul>
        </div>

        <form @submit.prevent="submit">
            <div class="mb-2">
                <InputLabel
                    for="jenisNadzir"
                    class="mb-2"
                    value="Jenis Nadzir"
                />

                <Listbox id="jenisNadzir" v-model="selectedNadzir">
                    <div class="relative">
                        <ListboxButton
                            class="p-2 w-full input bg-gray-100 rounded-lg flex items-center justify-between"
                        >
                            <span>{{ selectedNadzir.name }}</span>
                            <ChevronDown class="w-4 h-4 text-slate-500" />
                        </ListboxButton>

                        <ListboxOptions
                            class="absolute z-10 mt-2 w-full rounded-xl bg-white border shadow-sm"
                        >
                            <ListboxOption
                                v-for="item in optionNadzirs"
                                :key="item.id"
                                :value="item"
                                v-slot="{ active, selected }"
                            >
                                <li
                                    class="px-4 py-3 cursor-pointer"
                                    :class="active ? 'bg-slate-100' : ''"
                                >
                                    <p class="text-sm font-medium">
                                        {{ item.name }}
                                    </p>
                                    <p class="text-xs text-slate-500">
                                        {{ item.desc }}
                                    </p>
                                </li>
                            </ListboxOption>
                        </ListboxOptions>
                    </div>
                </Listbox>

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div v-if="selectedNadzir.name !== 'Perorangan'" class="mt-4">
                <InputLabel for="namaLembaga" value="Nama Lembaga" />

                <TextInput
                    id="namaLembaga"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.namaLembaga"
                    required
                    autofocus
                    placeholder="Nama Lembaga"
                    autocomplete="namaLembaga"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="namaNadzir" value="Nama Nadzir" />

                <TextInput
                    id="namaNadzir"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.namaNadzir"
                    required
                    autofocus
                    placeholder="Nama Nadzir Sesuai Dengan SK"
                    autocomplete="namaNadzir"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="kecamatan" value="Kecamatan" />
                <Combobox
                    v-model="form.kecamatan"
                    :options="listKecamatan"
                    label-key="nama_kecamatan"
                    value-key="id"
                    placeholder="Ketik Kecamatan"
                />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel
                    for="checklist_pendaftaran_nadzir"
                    value="Checklist Pendaftaran Nadzir"
                />
                <FileUpload
                    v-model="form.checklist_pendaftaran_nadzir"
                    accept=".pdf"
                    :maxSize="10"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel
                    for="daftar_tanah_wakaf"
                    value="Daftar Tanah Wakaf"
                />
                <FileUpload
                    v-model="form.daftar_tanah_wakaf"
                    accept=".xlsx ,.xls"
                    :maxSize="10"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel
                    for="password_confirmation"
                    value="Confirm Password"
                />

                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                />

                <InputError
                    class="mt-2"
                    :message="form.errors.password_confirmation"
                />
            </div>

            <div class="mt-4 flex items-center justify-end">
                <Link
                    :href="route('login')"
                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    Sudah Punya Akun?
                </Link>

                <PrimaryButton
                    class="ms-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Daftar
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
