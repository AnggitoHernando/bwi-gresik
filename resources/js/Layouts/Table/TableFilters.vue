<script setup>
import { ref, watch } from "vue";
import { Search, X } from "lucide-vue-next";
import debounce from "lodash/debounce";

const props = defineProps({
    modelValue: {
        type: String,
        default: "",
    },
    placeholder: {
        type: String,
        default: "Cari data...",
    },
});

const emit = defineEmits(["update:modelValue"]);

const search = ref(props.modelValue);

watch(
    search,
    debounce((value) => {
        emit("update:modelValue", value);
    }, 400)
);

const clear = () => {
    search.value = "";
    emit("update:modelValue", "");
};
</script>

<template>
    <div class="relative w-full max-w-md">
        <Search
            class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"
        />

        <input
            v-model="search"
            type="text"
            :placeholder="placeholder"
            class="w-full pl-11 pr-10 py-3 border-solid border-gray-300 rounded-xl bg-gray-100 text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500 transition"
        />

        <button
            v-if="search"
            @click="clear"
            type="button"
            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition"
        >
            <X class="w-4 h-4" />
        </button>
    </div>
</template>
