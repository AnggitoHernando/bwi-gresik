<script setup>
import { router } from "@inertiajs/vue3";
import { ArrowUp, ArrowDown, ArrowUpDown } from "lucide-vue-next";

const props = defineProps({
    columns: {
        type: Array,
        required: true,
    },
    rows: {
        type: Array,
        required: true,
    },
    filters: {
        type: Object,
        default: () => ({
            sort: null,
            direction: null,
            search: null,
        }),
    },
    routeName: {
        type: String,
        required: true,
    },
});

const toggleSort = (column) => {
    if (!column.sortable) return;

    const currentSort = props.filters.sort;
    const currentDirection = props.filters.direction;

    const direction =
        currentSort === column.key && currentDirection === "asc"
            ? "desc"
            : "asc";

    router.get(
        route(props.routeName),
        {
            ...props.filters,
            sort: column.key,
            direction,
            page: 1,
        },
        {
            preserveState: true,
            replace: true,
        }
    );
};
</script>

<template>
    <div class="overflow-x-auto rounded border">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th
                        v-for="col in columns"
                        :key="col.key"
                        class="px-4 py-3 text-left font-semibold"
                    >
                        <div
                            v-if="col.sortable"
                            class="flex items-center gap-1 cursor-pointer"
                            @click="toggleSort(col)"
                        >
                            {{ col.label }}

                            <span class="ml-1 inline-flex">
                                <ArrowUp
                                    v-if="
                                        filters.sort === col.key &&
                                        filters.direction === 'asc'
                                    "
                                    class="w-4 h-4 text-primary-600"
                                />

                                <ArrowDown
                                    v-else-if="
                                        filters.sort === col.key &&
                                        filters.direction === 'desc'
                                    "
                                    class="w-4 h-4 text-primary-600"
                                />

                                <ArrowUpDown
                                    v-else
                                    class="w-4 h-4 text-gray-400"
                                />
                            </span>
                        </div>

                        <span v-else>
                            {{ col.label }}
                        </span>
                    </th>
                </tr>
            </thead>

            <tbody>
                <tr v-if="rows.length === 0">
                    <td :colspan="columns.length" class="text-center py-8">
                        <span v-if="filters.search">
                            Data dengan kata kunci
                            <strong>"{{ filters.search }}"</strong>
                            tidak ditemukan
                        </span>

                        <span v-else> Belum ada data </span>
                    </td>
                </tr>

                <tr
                    v-else
                    v-for="row in rows"
                    :key="row.id"
                    class="capitalize border-t hover:bg-gray-50"
                >
                    <td v-for="col in columns" :key="col.key" class="px-4 py-3">
                        <slot :name="`cell-${col.key}`" :row="row">
                            {{ row[col.key] }}
                        </slot>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
