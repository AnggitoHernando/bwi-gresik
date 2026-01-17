<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head } from "@inertiajs/vue3";
</script>

<template>
    <AdminLayout>
        <Head title="Dashboard" />
        <h1 class="text-2xl font-bold mb-4">Dashboard</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white p-4 rounded shadow">Card 1</div>
            <div class="bg-white p-4 rounded shadow">Card 2</div>
            <div class="bg-white p-4 rounded shadow">Card 3</div>
        </div>
    </AdminLayout>
</template>
