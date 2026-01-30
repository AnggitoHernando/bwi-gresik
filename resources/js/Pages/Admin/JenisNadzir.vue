<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import BaseTable from "@/Layouts/Table/BaseTable.vue";
import Pagination from "@/Layouts/Table/Pagination.vue";
import TableFilters from "@/Layouts/Table/TableFilters.vue";
import { Head, router, useForm, usePage } from "@inertiajs/vue3";
import ActionButton from "@/Components/ButtonWithIcon.vue";
import { Trash2, PenLine, CircleX, CircleCheck } from "lucide-vue-next";
import { ref, watch } from "vue";
import { useSwal } from "@/Composables/useSwal";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import Modal from "@/Components/ModalBaru.vue";

const { confirm, success } = useSwal();
const { items, filters } = defineProps({
    items: Object,
    filters: Object,
});
const selectedDocument = ref(null);
const showModal = ref(false);
const page = usePage();
const role = page.props.auth.user.role.name;

const columns = [
    { label: "Nama", key: "nama", sortable: true },
    { label: "Status", key: "is_active", sortable: true },
    { label: "Aksi", key: "actions" },
];
const search = ref("");
const loading = ref(false);

const form = useForm({
    id: "",
    nama: "",
    isActive: "",
});

const fieldMap = {
    id: "id",
    nama: "nama",
    isActive: "is_active",
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
        route("admin.jenisNadzir.index"),
        { search: value },
        {
            preserveState: true,
            replace: true,
        },
    );
});

const saveData = () => {
    if (form.id) {
        form.patch(route("admin.jenisNadzir.update", form.id), {
            onSuccess: () => {
                form.reset();
                showModal.value = false;
            },
        });
    } else {
        form.post(route("admin.jenisNadzir.store"), {
            onSuccess: () => {
                form.reset();
                showModal.value = false;
            },
        });
    }
    return;
};

const changeStatus = (jenisNadzir, status) => {
    if (status === "Non Active") {
        form.patch(route("admin.jenisNadzir.nonActive", jenisNadzir), {
            onSuccess: () => {},
        });
    } else {
        form.patch(route("admin.jenisNadzir.active", jenisNadzir), {
            onSuccess: () => {},
        });
    }
};

function deleteItem(row) {
    confirm("Data akan dihapus permanen!").then((result) => {
        if (result.isConfirmed) {
            router.delete(route("admin.jenisNadzir.destroy", row), {
                onSuccess: () => {},
            });
        }
    });
}
</script>

<template>
    <AdminLayout>
        <Head title="Jenis Nadzir" />
        <h1 class="text-2xl font-bold mb-4">Jenis Nadzir</h1>
        <div class="flex items-center justify-between mb-4">
            <TableFilters
                v-model="search"
                placeholder="Cari Jenis Nadzir. . ."
            />
            <div class="mb-2 flex flex-col sm:flex-row justify-end">
                <PrimaryButton @click="openModal()">
                    Tambah Jenis Nadzir
                </PrimaryButton>
            </div>
        </div>
        <BaseTable
            autofocus
            :columns="columns"
            :rows="items.data"
            :filters="filters"
            route-name="admin.jenisNadzir.index"
        >
            <template #cell-is_active="{ row }">
                <p class="text-sm text-slate-700 truncate max-w-[220px]">
                    {{ row.is_active === 0 ? "Tidak Aktif" : "Aktif" }}
                </p>
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
                        v-if="role === 'super-admin'"
                    >
                        <template #icon>
                            <Trash2 class="w-4 h-4 text-white" />
                        </template>
                    </ActionButton>
                    <ActionButton
                        v-if="row.is_active === 0"
                        title="Active"
                        class="bg-green-500"
                        @click="changeStatus(row, 'Active')"
                    >
                        <template #icon>
                            <CircleCheck class="w-4 h-4 text-white" />
                        </template>
                    </ActionButton>
                    <ActionButton
                        v-else
                        title="Non Aktif Data"
                        class="bg-red-800"
                        @click="changeStatus(row, 'Non Active')"
                    >
                        <template #icon>
                            <CircleX class="w-4 h-4 text-white" />
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
                    {{ selectedDocument ? "Edit Data" : "Tambah Data" }}
                </h1>
            </template>
            <form @submit.prevent="saveData">
                <div class="px-6 py-2 space-y-5">
                    <div class="mt-2">
                        <InputLabel for="nama" value="Jenis Nadzir" />

                        <TextInput
                            id="nama"
                            type="text"
                            class="w-full block"
                            v-model="form.nama"
                            required
                            autofocus
                            placeholder="Jenis Nadzir"
                            autocomplete="nama"
                        />

                        <InputError class="mt-2" :message="form.errors.nama" />
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
