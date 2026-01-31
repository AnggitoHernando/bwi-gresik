<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head, usePage } from "@inertiajs/vue3";
import { watch, ref, computed } from "vue";
import VerificationPanel from "@/Components/VerificationPanel.vue";
const page = usePage();
const { confirm, success } = useSwal();
import { useSwal } from "@/Composables/useSwal";
const isVerified = computed(
    () =>
        page.props.auth.user.role.name !== "nadzir" ||
        page.props.auth.user.nadzir?.status === "approved",
);

const props = defineProps({
    listDokumen: {
        type: Object,
        default: () => ({}),
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
});

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
    <AdminLayout>
        <Head title="Dashboard" />
        <h1 class="text-2xl font-bold mb-4">Dashboard</h1>
        <div v-if="!isVerified">
            <VerificationPanel
                :totalDokumen="totalDokumen"
                :approved="approved"
                :percent="percent"
                :statusVerified="isVerified"
                :documents="listDokumen"
            />
        </div>
        <div v-else>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white p-4 rounded shadow">Card 1</div>
                <div class="bg-white p-4 rounded shadow">Card 2</div>
                <div class="bg-white p-4 rounded shadow">Card 3</div>
            </div>
        </div>
    </AdminLayout>
</template>
