<script setup>
import { watch, ref, computed } from "vue";
import { useForm, usePage } from "@inertiajs/vue3";
import BaseTable from "@/Layouts/Table/BaseTable.vue";
import PrimaryButton from "./PrimaryButton.vue";
import { FileText } from "lucide-vue-next";
import Modal from "@/Components/ModalBaru.vue";
import InputLabel from "@/Components/InputLabel.vue";
import FileUpload from "@/Components/FileUpload.vue";
import InputError from "@/Components/InputError.vue";
import SecondaryButton from "./SecondaryButton.vue";
const page = usePage();
const nadzirId = page.props.auth.user.nadzir?.id;

const showModal = ref(false);
const props = defineProps({
    documents: {
        type: Object,
        default: () => ({}),
        required: true,
    },
    statusVerified: {
        type: Boolean,
    },
    totalDokumen: {
        type: Number,
        default: 0,
    },
    approved: {
        type: Number,
        default: 0,
    },
    percent: {
        type: Number,
        default: 0,
    },
    filters: {
        type: Object,
        default: () => ({}),
    },
});

const form = useForm({
    nadzirDocumentId: "",
    nadzirId: nadzirId,
    typeDocumentId: "",
    filepath: null,
});

const columns = [
    { label: "Dokumen", key: "nama_dokumen", sortable: false },
    { label: "Tipe Dokumen", key: "allowed_types", sortable: false },
    { label: "Template", key: "template", sortable: false },
    { label: "File", key: "file_path", sortable: false },
    { label: "Status", key: "status_verifikasi", sortable: false },
    { label: "Aksi", key: "actions" },
];

const fileNameFromPath = (path) => {
    if (!path) return "";
    return path.split("/").pop();
};

const accept = ref("");
const selectedDocument = ref("");
const acceptFile = (row) => {
    const exts = row.allowed_types;

    if (!exts || exts.length === 0) {
        return ""; // fallback → semua file
    }
    accept.value = exts.map((ext) => `.${ext}`).join(",");
};

const openModal = (row) => {
    form.nadzirDocumentId = row.nadzir_document_id;
    form.typeDocumentId = row.id;
    selectedDocument.value = row.nama_dokumen;

    acceptFile(row);

    showModal.value = true;
};
const saveData = () => {
    form.post(route("admin.dashboard.store"), {
        forceFormData: true,
        onSuccess: () => {
            form.reset();
            form.filepath = null;
            showModal.value = false;
        },
    });
};
</script>

<template>
    <div class="space-y-6">
        <div
            v-if="!statusVerified"
            class="mb-6 rounded-2xl border border-yellow-200 bg-yellow-50 p-4"
        >
            <h2 class="text-lg font-semibold text-yellow-800">
                Akun Belum Terverifikasi
            </h2>
            <p class="mt-1 text-sm text-yellow-700">
                Lengkapi dan unggah dokumen berikut untuk melanjutkan proses
                verifikasi.
            </p>
        </div>

        <div class="mb-6 rounded-2xl bg-white p-4 shadow">
            <div class="mb-2 flex items-center justify-between text-sm">
                <span class="font-medium text-gray-700"
                    >Progress Verifikasi</span
                >
                <span class="text-gray-500"
                    >{{ approved }} dari {{ totalDokumen }} dokumen
                    disetujui</span
                >
            </div>
            <div class="h-3 w-full overflow-hidden rounded-full bg-gray-200">
                <div
                    class="h-full rounded-full bg-primary transition-all"
                    :style="{ width: percent + '%' }"
                ></div>
            </div>
        </div>

        <div class="rounded-2xl bg-white shadow">
            <div class="border-b p-4">
                <h3 class="text-base font-semibold">
                    Daftar Dokumen Verifikasi
                </h3>
            </div>

            <BaseTable
                :columns="columns"
                :rows="documents"
                :filters="filters"
                route-name="dashboard"
            >
                <template #cell-allowed_types="{ row }">
                    <div class="flex flex-wrap gap-2">
                        <span
                            v-for="type in row.allowed_types"
                            :key="type"
                            class="px-2 py-0.5 text-xs rounded bg-secondary"
                        >
                            {{ type.toUpperCase() }}
                        </span>
                    </div>
                </template>
                <template #cell-template="{ row }">
                    <div class="flex items-center gap-2">
                        <FileText class="h-5 w-5 text-slate-500" />
                        <span
                            v-if="row.template"
                            class="text-sm text-slate-700 truncate max-w-[220px]"
                        >
                            <a :href="`/storage/${row.template}`">
                                {{ fileNameFromPath(row.template) }}
                            </a>
                        </span>
                        <p
                            v-else
                            class="text-sm text-slate-700 truncate max-w-[220px]"
                        >
                            Tidak Ada File Template
                        </p>
                    </div>
                </template>
                <template #cell-file_path="{ row }">
                    <div class="flex items-center gap-2">
                        <FileText class="h-5 w-5 text-slate-500" />
                        <span
                            v-if="row.file_path"
                            class="text-sm text-slate-700 truncate max-w-[220px]"
                        >
                            <a :href="`/storage/${row.file_path}`">
                                {{ fileNameFromPath(row.file_path) }}
                            </a>
                        </span>
                        <p
                            v-else
                            class="text-sm text-slate-700 truncate max-w-[220px]"
                        >
                            Belum Ada File Yang Diupload
                        </p>
                    </div>
                    <p
                        v-if="
                            row.keterangan_penolakan !== null &&
                            row.status_verifikasi === 'Ditolak'
                        "
                        class="rounded-full px-3 py-1 text-xs font-semibold bg-red-100 text-red-800"
                    >
                        {{ row.keterangan_penolakan }}
                    </p>
                </template>
                <template #cell-status_verifikasi="{ row }">
                    <td class="p-3">
                        <span
                            :class="[
                                'rounded-full px-3 py-1 text-xs font-semibold',
                                row.status_verifikasi ===
                                    'Belum Diverifikasi' &&
                                    'bg-yellow-100 text-yellow-800',
                                row.status_verifikasi === 'Disetujui' &&
                                    'bg-green-100 text-green-800',
                                row.status_verifikasi === 'Ditolak' &&
                                    'bg-red-100 text-red-800',
                                row.status_verifikasi === 'Belum Upload' &&
                                    'bg-red-100 text-red-800',
                            ]"
                        >
                            {{ row.status_verifikasi }}
                        </span>
                    </td>
                </template>

                <template #cell-actions="{ row }">
                    <div class="flex items-center gap-2">
                        <PrimaryButton
                            v-if="row.nadzir_document_id === null"
                            @click="openModal(row)"
                        >
                            Upload
                        </PrimaryButton>
                        <SecondaryButton
                            v-if="
                                row.nadzir_document_id !== null &&
                                row.status_verifikasi !== 'Disetujui'
                            "
                            @click="openModal(row)"
                        >
                            Upload Ulang
                        </SecondaryButton>
                    </div>
                </template>
            </BaseTable>
        </div>
        <div class="mt-4 text-xs text-gray-500">
            * Dokumen akan diverifikasi oleh admin. Proses membutuhkan waktu
            maksimal 1x24 jam kerja.
        </div>
        <Modal
            :show="showModal"
            width="max-w-3xl"
            @close="showModal = false"
            :closeOnOutside="false"
            rounded="rounded-2xl"
            class="overflow-auto"
        >
            <template #title>
                <h1 class="text-lg font-semibold uppercase">
                    Upload {{ selectedDocument }}
                </h1>
            </template>
            <form @submit.prevent="saveData">
                <div class="px-6 py-2 space-y-5">
                    <div class="mt-2">
                        <InputLabel for="filepath" value="Masukkan Dokumen" />

                        <FileUpload
                            v-model="form.filepath"
                            :accept="accept"
                            :maxSize="5"
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors.filepath"
                        />
                    </div>

                    <div class="mt-8 py-4 flex items-center justify-end">
                        <PrimaryButton
                            class="ms-4"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            Simpan
                        </PrimaryButton>
                    </div>
                </div>
            </form>
        </Modal>
    </div>
</template>
