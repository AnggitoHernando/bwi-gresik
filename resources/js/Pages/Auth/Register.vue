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
import { Eye, EyeOff } from "lucide-vue-next";
const showPassword = ref(false);

const props = defineProps({
    listKecamatan: {
        type: Array,
        default: () => [],
    },
});

const optionNadzirs = [
    { id: 1, name: "Perorangan", desc: "Nadzir perseorangan" },
    { id: 2, name: "Organisasi", desc: "Nadzir berbentuk organisasi" },
    { id: 3, name: "Badan Hukum", desc: "Nadzir berbadan hukum" },
];

const selectedNadzir = ref(optionNadzirs[0]);
const form = useForm({
    jenisNadzir: selectedNadzir.value.name,
    namaNadzir: "",
    namaLembaga: "",
    kecamatan: "",
    email: "",
    password: "",
    password_confirmation: "",
});

const submit = () => {
    form.post(route("pendaftaranNadzir.store"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
    console.log(form);
};
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

                <InputError class="mt-2" :message="form.errors.jenisNadzir" />
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
