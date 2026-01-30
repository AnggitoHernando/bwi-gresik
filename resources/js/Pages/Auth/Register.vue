<script setup>
import { ref, watch } from "vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm, usePage } from "@inertiajs/vue3";
import {
    Listbox,
    ListboxButton,
    ListboxOptions,
    ListboxOption,
} from "@headlessui/vue";
import { ChevronDown } from "lucide-vue-next";
import Combobox from "@/Components/Combobox.vue";
import { Eye, EyeOff } from "lucide-vue-next";
const showPassword = ref(false);
const page = usePage();
import { useSwal } from "@/Composables/useSwal";
import Select from "@/Components/Select.vue";
import JenisNadzir from "../Admin/JenisNadzir.vue";

const { success, error } = useSwal();
const props = defineProps({
    listKecamatan: {
        type: Array,
        default: () => [],
    },
    listJenisNadzir: {
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
});

const submit = () => {
    form.post(route("pendaftaranNadzir.store"), {
        onFinish: () => {
            // form.reset();
        },
    });
};

watch(
    () => page.props.flash,
    (flash) => {
        if (flash?.success) success(flash.success);
        if (flash?.error) error(flash.error);
    },
    { deep: true },
);
</script>

<template>
    <GuestLayout
        title="Pendaftaran Nadzir"
        description="Lengkapi data untuk pendaftaran akun nadzir"
    >
        <Head title="Pendaftaran Nadzir" />

        <form @submit.prevent="submit">
            <div class="mb-2">
                <InputLabel
                    for="jenisNadzir"
                    class="mb-2"
                    value="Jenis Nadzir"
                />

                <Select
                    id="jenisNadzir"
                    v-model="form.jenisNadzir"
                    :options="listJenisNadzir"
                    placeholder="Pilih Jenis Nadzir"
                />

                <InputError class="mt-2" :message="form.errors.jenisNadzir" />
            </div>

            <div v-if="form.jenisNadzir !== 'Perorangan'" class="mt-4">
                <InputLabel for="namaLembaga" value="Nama Lembaga" />

                <TextInput
                    id="namaLembaga"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.namaLembaga"
                    required
                    placeholder="Nama Lembaga"
                    autocomplete="namaLembaga"
                />

                <InputError class="mt-2" :message="form.errors.namaLembaga" />
            </div>

            <div class="mt-4">
                <InputLabel for="namaNadzir" value="Nama Ketua Nadzir" />

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

                <InputError class="mt-2" :message="form.errors.namaNadzir" />
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
                <InputError class="mt-2" :message="form.errors.kecamatan" />
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
                    placeholder="Masukkan Email"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4 relative">
                <InputLabel for="password" value="Password" />

                <input
                    :type="showPassword ? 'text' : 'password'"
                    placeholder="Masukkan password"
                    id="password"
                    v-model="form.password"
                    class="rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary w-full"
                />

                <button
                    type="button"
                    @click="showPassword = !showPassword"
                    class="absolute right-2 bottom-1 -translate-y-1/2 text-gray-500 hover:text-gray-700"
                >
                    <Eye v-if="!showPassword" class="w-5 h-5" />
                    <EyeOff v-else class="w-5 h-5" />
                </button>

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4 relative">
                <InputLabel
                    for="password_confirmation"
                    value="Confirm Password"
                />

                <input
                    :type="showPassword ? 'text' : 'password'"
                    placeholder="Masukkan Ulang password"
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    class="rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary w-full"
                />

                <button
                    type="button"
                    @click="showPassword = !showPassword"
                    class="absolute right-2 bottom-1 -translate-y-1/2 text-gray-500 hover:text-gray-700"
                >
                    <Eye v-if="!showPassword" class="w-5 h-5" />
                    <EyeOff v-else class="w-5 h-5" />
                </button>

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
