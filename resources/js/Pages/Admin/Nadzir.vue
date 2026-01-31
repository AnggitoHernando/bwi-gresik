<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import BaseTable from "@/Layouts/Table/BaseTable.vue";
import Pagination from "@/Layouts/Table/Pagination.vue";
import TableFilters from "@/Layouts/Table/TableFilters.vue";
import { Head, router } from "@inertiajs/vue3";
import ActionButton from "@/Components/ButtonWithIcon.vue";
import { Trash2, Eye, FileText } from "lucide-vue-next";
import { ref, watch } from "vue";
import { useSwal } from "@/Composables/useSwal";

const { confirm, success } = useSwal();
const { items, filters } = defineProps({
    items: Object,
    filters: Object,
});

console.log(items);

const columns = [
    { label: "Jenis Nadzir", key: "jenis_nadzir", sortable: true },
    { label: "Nama Nadzir", key: "nama_nadzir", sortable: true },
    { label: "Nama Lembaga", key: "nama_lembaga", sortable: true },
    { label: "Kecamatan", key: "kecamatan", sortable: true },
    { label: "File Diupload", key: "file_diupload", sortable: false },
    { label: "Status", key: "status", sortable: false },
    { label: "Aksi", key: "actions" },
];
const search = ref("");

watch(search, (value) => {
    router.get(
        route("admin.nadzir.index"),
        { search: value },
        {
            preserveState: true,
            replace: true,
        },
    );
});
function deleteItem(row) {
    confirm("Data akan dihapus permanen!").then((result) => {
        if (result.isConfirmed) {
            router.delete(route("admin.kritik.destroy", row.id), {
                onSuccess: () => {
                    success("Data berhasil dihapus");
                },
            });
        }
    });
}

const openDocuments = (row) => {
    console.log(row);
};
</script>

<template>
    <AdminLayout>
        <Head title="Nadzir" />
        <h1 class="text-2xl font-bold mb-4">Nadzir</h1>
        <div class="flex items-center justify-between mb-4">
            <TableFilters v-model="search" placeholder="Cari nadzir...." />
        </div>
        <BaseTable
            :columns="columns"
            :rows="items.data"
            :filters="filters"
            route-name="admin.nadzir.index"
        >
            <template #cell-jenis_nadzir="{ row }">
                <p class="text-sm text-slate-700 truncate max-w-[220px]">
                    {{ row.jenis_nadzir.nama }}
                </p>
            </template>
            <template #cell-kecamatan="{ row }">
                <p class="text-sm text-slate-700 truncate max-w-[220px]">
                    {{ row.kecamatan.nama_kecamatan }}
                </p>
            </template>
            <template #cell-file_diupload="{ row }">
                <button
                    @click="openDocuments(row)"
                    class="inline-flex items-center gap-1 text-sm text-emerald-600 hover:text-emerald-800"
                >
                    <FileText class="w-4 h-4" />
                    <span>Lihat Dokumen</span>
                </button>
            </template>
            <template #cell-actions="{ row }">
                <div class="flex items-center gap-2">
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
    </AdminLayout>
</template>
