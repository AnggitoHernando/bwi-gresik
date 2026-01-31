<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head, usePage } from "@inertiajs/vue3";
import { watch, ref, computed } from "vue";
import VerificationPanel from "@/Components/VerificationPanel.vue";
const page = usePage();
const role = page.props.auth.user.role.name;

const documents = ref([
    {
        id: 1,
        name: "KTP Nadzir",
        note: "Scan KTP seluruh pengurus nadzir (PDF)",
        status: "pending",
        statusLabel: "Belum Upload",
    },
    {
        id: 2,
        name: "Surat Pengangkatan Nadzir",
        note: "Dari KUA/BWI (PDF)",
        status: "uploaded",
        statusLabel: "Menunggu Verifikasi",
    },
    {
        id: 3,
        name: "SK Organisasi",
        note: "Jika nadzir berbentuk lembaga",
        status: "approved",
        statusLabel: "Disetujui",
    },
    {
        id: 4,
        name: "NPWP",
        note: "Opsional",
        status: "rejected",
        statusLabel: "Ditolak",
    },
]);
</script>

<template>
    <AdminLayout>
        <Head title="Dashboard" />
        <h1 class="text-2xl font-bold mb-4">Dashboard</h1>
        <div>
            <VerificationPanel :documents="documents" />
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white p-4 rounded shadow">Card 1</div>
            <div class="bg-white p-4 rounded shadow">Card 2</div>
            <div class="bg-white p-4 rounded shadow">Card 3</div>
        </div>
    </AdminLayout>
</template>
