<script setup>
import { ref, computed, watch } from "vue";
import {
    Combobox,
    ComboboxInput,
    ComboboxButton,
    ComboboxOptions,
    ComboboxOption,
    TransitionRoot,
} from "@headlessui/vue";
import { CheckIcon, ChevronsUpDownIcon } from "lucide-vue-next";

const props = defineProps({
    modelValue: {
        type: [Object, String, Number, null],
        default: null,
    },
    options: {
        type: Array,
        default: () => [],
    },

    labelKey: {
        type: String,
        default: "name",
    },
    valueKey: {
        type: String,
        default: "id",
    },

    placeholder: {
        type: String,
        default: "Pilih data",
    },
});

const emit = defineEmits(["update:modelValue"]);

const selected = ref(props.modelValue);
const query = ref("");

watch(
    () => props.modelValue,
    (val) => (selected.value = val),
);

watch(selected, (val) => emit("update:modelValue", val));

const getLabel = (item) => {
    if (!item) return "";
    return String(item[props.labelKey] ?? "");
};

const filteredOptions = computed(() => {
    if (!Array.isArray(props.options)) return [];

    if (!query.value) return props.options;

    const q = query.value.toLowerCase().replace(/\s+/g, "");

    return props.options.filter((item) =>
        getLabel(item).toLowerCase().replace(/\s+/g, "").includes(q),
    );
});
</script>

<template>
    <Combobox v-model="selected">
        <div class="relative w-full">
            <div
                class="relative w-full overflow-hidden shadow-sm rounded-md bg-white border border-gray-300 focus-within:border-primary focus-within:ring-primary"
            >
                <ComboboxInput
                    class="w-full border-none py-2 pl-3 pr-10"
                    :placeholder="placeholder"
                    :displayValue="getLabel"
                    @change="query = $event.target.value"
                />

                <ComboboxButton
                    class="absolute inset-y-0 right-0 flex items-center pr-2"
                >
                    <ChevronsUpDownIcon class="h-5 w-5" />
                </ComboboxButton>
            </div>

            <TransitionRoot
                leave="transition ease-in duration-100"
                leaveFrom="opacity-100"
                leaveTo="opacity-0"
                @after-leave="query = ''"
            >
                <ComboboxOptions
                    class="absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-sm shadow-lg"
                >
                    <div
                        v-if="filteredOptions.length === 0"
                        class="px-4 py-2 text-primary"
                    >
                        Data tidak ditemukan
                    </div>

                    <ComboboxOption
                        v-for="item in filteredOptions"
                        :key="item[valueKey]"
                        :value="item"
                        as="template"
                        v-slot="{ selected, active }"
                    >
                        <li
                            class="relative cursor-pointer select-none py-2 pl-10 pr-4"
                            :class="{
                                'bg-primary text-white': active,
                                '': !active,
                            }"
                        >
                            <span
                                class="block truncate"
                                :class="{
                                    'font-semibold': selected,
                                    'font-normal': !selected,
                                }"
                            >
                                {{ getLabel(item) }}
                            </span>

                            <span
                                v-if="selected"
                                class="absolute inset-y-0 left-0 flex items-center pl-3"
                            >
                                <CheckIcon class="h-5 w-5" />
                            </span>
                        </li>
                    </ComboboxOption>
                </ComboboxOptions>
            </TransitionRoot>
        </div>
    </Combobox>
</template>
