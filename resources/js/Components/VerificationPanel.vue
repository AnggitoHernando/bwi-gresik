<script setup>
import { watch, ref, computed } from "vue";
const props = defineProps({
    documents: {
        type: Array,
        required: true,
    },
});
const approvedCount = computed(
    () => props.documents.filter((d) => d.status === "approved").length,
);

// console.log(props.documents.filter((d) => d.status === "approved"));
// console.log(approvedCount);

const progressPercent = computed(() =>
    props.documents.length === 0
        ? 0
        : Math.round((approvedCount.value / props.documents.length) * 100),
);
</script>

<template>
    <div class="space-y-6">
        <div class="mb-6 rounded-2xl border border-yellow-200 bg-yellow-50 p-4">
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
                    >{{ approvedCount }} dari {{ documents.length }} dokumen
                    disetujui</span
                >
            </div>
            <div class="h-3 w-full overflow-hidden rounded-full bg-gray-200">
                <div
                    class="h-full rounded-full bg-primary transition-all"
                    :style="{ width: progressPercent + '%' }"
                ></div>
            </div>
        </div>

        <div class="rounded-2xl bg-white shadow">
            <div class="border-b p-4">
                <h3 class="text-base font-semibold">
                    Daftar Dokumen Verifikasi
                </h3>
            </div>

            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-left text-gray-600">
                    <tr>
                        <th class="p-3">Dokumen</th>
                        <th class="p-3">Keterangan</th>
                        <th class="p-3">Status</th>
                        <th class="p-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="item in documents"
                        :key="item.id"
                        class="border-t"
                    >
                        <td class="p-3 font-medium">{{ item.name }}</td>
                        <td class="p-3 text-gray-600">{{ item.note }}</td>
                        <td class="p-3">
                            <span
                                :class="[
                                    'rounded-full px-3 py-1 text-xs font-semibold',
                                    item.status === 'pending' &&
                                        'bg-yellow-100 text-yellow-800',
                                    item.status === 'uploaded' &&
                                        'bg-blue-100 text-blue-800',
                                    item.status === 'approved' &&
                                        'bg-green-100 text-green-800',
                                    item.status === 'rejected' &&
                                        'bg-red-100 text-red-800',
                                ]"
                            >
                                {{ item.statusLabel }}
                            </span>
                        </td>
                        <td class="p-3">
                            <button
                                v-if="item.status !== 'approved'"
                                class="rounded-lg bg-primary px-4 py-2 text-xs font-semibold text-white hover:opacity-90"
                            >
                                Upload File
                            </button>
                            <span v-else class="text-xs text-gray-400"
                                >Selesai</span
                            >
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Info note -->
        <div class="mt-4 text-xs text-gray-500">
            * Dokumen akan diverifikasi oleh admin. Proses membutuhkan waktu
            maksimal 1x24 jam kerja.
        </div>
    </div>
</template>
