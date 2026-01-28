<script setup>
import { ref, computed, watch } from "vue";
import {
    Listbox,
    ListboxButton,
    ListboxOptions,
    ListboxOption,
} from "@headlessui/vue";
import { ChevronDown } from "lucide-vue-next";

const props = defineProps({
    modelValue: {
        type: [String, null],
        default: null,
    },
    options: {
        type: Array,
        default: () => [],
    },
    id: {
        type: String,
        default: "",
        required: true,
    },
    placeholder: {
        type: String,
        default: "Pilih data",
    },
});
const emit = defineEmits(["update:modelValue"]);

const model = computed({
    get: () => props.modelValue,
    set: (val) => emit("update:modelValue", val),
});
</script>
<template>
    <Listbox :id="props.id" v-model="model">
        <div class="relative">
            <ListboxButton
                class="p-2 w-full input bg-gray-100 rounded-lg flex items-center justify-between"
            >
                <span>{{ model || placeholder }}</span>
                <ChevronDown class="w-4 h-4 text-slate-500" />
            </ListboxButton>

            <ListboxOptions
                class="absolute z-10 mt-2 w-full rounded-xl bg-white border shadow-sm"
            >
                <ListboxOption
                    v-for="item in options"
                    :key="item.id"
                    :value="item.name"
                    v-slot="{ active, selected }"
                >
                    <li
                        class="px-4 py-3 cursor-pointer"
                        :class="active ? 'bg-slate-100' : ''"
                    >
                        <p class="text-sm font-medium">
                            {{ item.name }}
                        </p>
                        <p class="text-xs text-slate-500">
                            {{ item.desc }}
                        </p>
                    </li>
                </ListboxOption>
            </ListboxOptions>
        </div>
    </Listbox>
</template>
