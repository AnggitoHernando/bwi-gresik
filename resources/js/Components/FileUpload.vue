<script setup>
import { ref } from "vue";
import { UploadCloud, X } from "lucide-vue-next";

const props = defineProps({
    modelValue: {
        type: [File, null],
        default: null,
    },
    accept: {
        type: String,
        default: ".pdf,.jpg,.jpeg,.png",
    },
    maxSize: {
        type: Number,
        default: 5,
    },
});

const emit = defineEmits(["update:modelValue"]);

const file = ref(null);
const error = ref(null);

const handleFile = (e) => {
    const selected = e.target.files?.[0] || e.dataTransfer?.files?.[0];
    if (!selected) return;

    if (selected.size > props.maxSize * 1024 * 1024) {
        error.value = `Ukuran maksimal ${props.maxSize}MB`;
        return;
    }

    file.value = selected;
    error.value = null;
    emit("update:modelValue", selected);
};

const removeFile = () => {
    file.value = null;
    emit("update:modelValue", null);
};
</script>

<template>
    <div class="space-y-2">
        <label
            class="flex cursor-pointer flex-col items-center justify-center gap-2 rounded-xl border-2 border-dashed border-slate-300 bg-white p-6 text-center transition hover:border-primary hover:bg-slate-50"
            @dragover.prevent
            @drop.prevent="handleFile"
        >
            <UploadCloud class="h-8 w-8 text-slate-500" />

            <p class="text-sm text-slate-600">
                <span class="font-semibold text-primary">Klik upload</span>
                atau drag file ke sini
            </p>

            <p class="text-xs text-slate-400">
                {{ accept }} • Max {{ maxSize }}MB
            </p>

            <input
                type="file"
                class="hidden"
                :accept="accept"
                @change="handleFile"
            />
        </label>

        <div
            v-if="file"
            class="flex items-center justify-between rounded-lg border bg-slate-50 px-4 py-2"
        >
            <div>
                <p
                    class="text-sm font-medium text-slate-700 truncate max-w-[220px]"
                >
                    {{ file.name }}
                </p>
                <p class="text-xs text-slate-500">
                    {{ (file.size / 1024 / 1024).toFixed(2) }} MB
                </p>
            </div>

            <button
                type="button"
                @click="removeFile"
                class="rounded-full p-1 text-slate-500 hover:bg-red-100 hover:text-red-600"
            >
                <X class="h-4 w-4" />
            </button>
        </div>

        <p v-if="error" class="text-xs text-red-600">
            {{ error }}
        </p>
    </div>
</template>
