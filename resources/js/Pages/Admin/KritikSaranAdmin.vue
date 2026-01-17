<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import BaseTable from "@/Layouts/Table/BaseTable.vue";
import Pagination from "@/Layouts/Table/Pagination.vue";
import TableFilters from "@/Layouts/Table/TableFilters.vue";
import { Head, router } from "@inertiajs/vue3";
import ActionButton from "@/Components/ButtonWithIcon.vue";
import { Trash2 } from "lucide-vue-next";
import { ref, watch } from "vue";
import { useSwal } from "@/Composables/useSwal";

const { confirm, success } = useSwal();
const { items, filters } = defineProps({
    items: Object,
    filters: Object,
});

const columns = [
    { label: "Nama", key: "nama", sortable: true },
    { label: "Email", key: "email", sortable: true },
    { label: "Pesan", key: "pesan", sortable: true },
    { label: "Aksi", key: "actions" },
];
const search = ref("");

watch(search, (value) => {
    router.get(
        route("admin.kritik.index"),
        { search: value },
        {
            preserveState: true,
            replace: true,
        }
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
</script>

<template>
    <AdminLayout>
        <Head title="Kritik & Saran" />
        <h1 class="text-2xl font-bold mb-4">Kritik & Saran</h1>
        <div class="flex items-center justify-between mb-4">
            <TableFilters
                v-model="search"
                placeholder="Cari mobil, brand, plat..."
            />
        </div>
        <BaseTable
            :columns="columns"
            :rows="items.data"
            :filters="filters"
            route-name="admin.kritik.index"
        >
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
