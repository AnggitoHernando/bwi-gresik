<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import BaseTable from "@/Layouts/Table/BaseTable.vue";
import Pagination from "@/Layouts/Table/Pagination.vue";
import TableFilters from "@/Layouts/Table/TableFilters.vue";
import { Head, router, useForm, usePage } from "@inertiajs/vue3";
import ActionButton from "@/Components/ButtonWithIcon.vue";
import { Trash2, PenLine, X, FileText } from "lucide-vue-next";
import { ref, watch, computed } from "vue";
import { useSwal } from "@/Composables/useSwal";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import Modal from "@/Components/ModalBaru.vue";
import Select from "@/Components/Select.vue";
import FileUpload from "@/Components/FileUpload.vue";

const { confirm, success } = useSwal();
const props = defineProps({
    items: {
        type: Object,
        default: () => ({}),
    },
    filters: {
        type: Object,
        default: () => ({}),
    },
    listJenisNadzir: {
        type: Array,
        default: () => [],
    },
});
const selectedDocument = ref(null);
const showModal = ref(false);
const page = usePage();

const columns = [
    { label: "Jenis Nadzir", key: "jenis_nadzir", sortable: true },
    { label: "Nama Dokumen", key: "nama_dokumen", sortable: true },
    { label: "Template", key: "template", sortable: false },
    { label: "Aksi", key: "actions" },
];
const search = ref("");
const loading = ref(false);

const form = useForm({
    id: "",
    jenisNadzir: "",
    namaDokumen: "",
    template: null,
});

const fieldMap = {
    id: "id",
    jenisNadzir: "jenis_nadzir",
    namaDokumen: "nama_dokumen",
    template: "template",
};

const assignForm = (row) => {
    Object.keys(fieldMap).forEach((key) => {
        if (row[fieldMap[key]] === "") {
            form[key] = null;
        } else {
            form[key] = row[fieldMap[key]] ?? "";
        }
    });
};

const openModal = (row) => {
    if (row) {
        selectedDocument.value = row;
        assignForm(row);
    } else {
        selectedDocument.value = null;
        form.reset();
    }
    showModal.value = true;
};

const fileNameFromPath = (path) => {
    if (!path) return "";
    return path.split("/").pop();
};

watch(
    () => page.props.flash,
    (flash) => {
        if (flash?.success) success(flash.success);
        if (flash?.error) error(flash.error);
    },
    { deep: true },
);

watch(search, (value) => {
    router.get(
        route("admin.document.index"),
        { search: value },
        {
            preserveState: true,
            replace: true,
        },
    );
});

const saveData = () => {
    if (form.id) {
        if (form.jenisNadzir && typeof form.jenisNadzir === "object") {
            form.jenisNadzir = form.jenisNadzir.nama;
        }
        const hasNewFile = form.template instanceof File;
        if (!hasNewFile) {
            form.template = null;
        }
        form.post(route("admin.document.update", form.id), {
            forceFormData: true,
            _method: "patch",
            onSuccess: () => {
                form.reset();
                form.template = null;
                showModal.value = false;
            },
        });
    } else {
        form.post(route("admin.document.store"), {
            forceFormData: true,
            onSuccess: () => {
                form.reset();
                form.template = null;
                showModal.value = false;
            },
        });
    }
    return;
};

function deleteItem(row) {
    confirm("Data akan dihapus permanen!").then((result) => {
        if (result.isConfirmed) {
            router.delete(route("admin.document.destroy", row), {
                onSuccess: () => {},
            });
        }
    });
}

function deleteTemplate(row) {
    confirm("Template akan dihapus permanen!").then((result) => {
        if (result.isConfirmed) {
            router.delete(route("admin.document.destroyTemplate", row), {
                onSuccess: () => {},
            });
        }
    });
}

const removeFile = () => {
    form.template = null;
};
</script>

<template>
    <AdminLayout>
        <Head title="Dokumen Persyaratan" />
        <h1 class="text-2xl font-bold mb-4">Dokumen Persyaratan</h1>
        <div class="flex items-center justify-between mb-4">
            <TableFilters v-model="search" placeholder="Cari Dokumen...." />
            <div class="mb-2 flex flex-col sm:flex-row justify-end">
                <PrimaryButton @click="openModal()">
                    Tambah Dokumen
                </PrimaryButton>
            </div>
        </div>
        <BaseTable
            :columns="columns"
            :rows="items.data"
            :filters="filters"
            route-name="admin.document.index"
        >
            <template #cell-jenis_nadzir="{ row }">
                <p class="text-sm text-slate-700 truncate max-w-[220px]">
                    {{ row.jenis_nadzir.nama }}
                </p>
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
                        <p
                            class="text-xs text-red-600 cursor-pointer hover:underline"
                            @click="deleteTemplate(row)"
                        >
                            Hapus template
                        </p>
                    </span>
                    <p
                        v-else
                        class="text-sm text-slate-700 truncate max-w-[220px]"
                    >
                        Tidak Ada File Template
                    </p>
                </div>
            </template>
            <template #cell-actions="{ row }">
                <div class="flex items-center gap-2">
                    <ActionButton
                        title="Edit Data"
                        class="bg-blue-700"
                        @click="openModal(row)"
                    >
                        <template #icon>
                            <PenLine class="w-4 h-4 text-white" />
                        </template>
                    </ActionButton>
                    <ActionButton
                        title="Hapus Data"
                        class="bg-red-500"
                        @click="deleteItem(row)"
                    >
                        <template #icon>
                            <Trash2 class="w-4 h-4 text-white" />
                        </template>
                    </ActionButton>
                </div>
            </template>
        </BaseTable>
        <Pagination :links="items.links" :meta="items" />
        <Modal
            :show="showModal"
            width="max-w-3xl"
            @close="showModal = false"
            :closeOnOutside="false"
            rounded="rounded-2xl"
            class="overflow-auto"
        >
            <template #title>
                <h1 class="text-lg font-semibold">
                    {{ selectedDocument ? "Edit Dokumen" : "Tambah Dokumen" }}
                </h1>
            </template>
            <form @submit.prevent="saveData">
                <div class="px-6 py-2 space-y-5">
                    <div class="">
                        <InputLabel
                            for="jenisNadzir"
                            value="Untuk Jenis Nadzir"
                        />

                        <Select
                            id="jenisNadzir"
                            v-model="form.jenisNadzir"
                            :options="listJenisNadzir"
                            placeholder="Pilih Untuk Jenis Nadzir"
                        />

                        <InputError
                            class="mt-2"
                            :message="form.errors.jenisNadzir"
                        />
                    </div>
                    <div class="mt-2">
                        <InputLabel for="namaDokumen" value="Nama Dokumen" />

                        <TextInput
                            id="namaDokumen"
                            type="text"
                            class="w-full block"
                            v-model="form.namaDokumen"
                            required
                            placeholder="Nama Dokumen"
                            autocomplete="namaDokumen"
                        />

                        <InputError
                            class="mt-2"
                            :message="form.errors.namaDokumen"
                        />
                    </div>
                    <div class="mt-2">
                        <InputLabel
                            for="template"
                            value="Template (Jika Ada)"
                        />

                        <FileUpload
                            v-model="form.template"
                            accept=".pdf,.jpg,.jpeg,.png,.doc,.xls,.xlsx"
                            :maxSize="5"
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors.template"
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
    </AdminLayout>
</template>
