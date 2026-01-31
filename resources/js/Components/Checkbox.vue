<script setup>
import { Check } from "lucide-vue-next";
import { computed } from "vue";

const props = defineProps({
    modelValue: {
        type: [Boolean, Array],
        default: false,
    },
    value: {
        type: [String, Number, Boolean],
        default: true,
    },
    label: {
        type: String,
        default: "",
    },
    disabled: {
        type: Boolean,
        default: false,
    },
});

const emit = defineEmits(["update:modelValue"]);

const isChecked = computed(() => {
    if (Array.isArray(props.modelValue)) {
        return props.modelValue.includes(props.value);
    }
    return props.modelValue;
});

const toggle = () => {
    if (props.disabled) return;

    if (Array.isArray(props.modelValue)) {
        const newValue = isChecked.value
            ? props.modelValue.filter((v) => v !== props.value)
            : [...props.modelValue, props.value];
        emit("update:modelValue", newValue);
    } else {
        emit("update:modelValue", !props.modelValue);
    }
};
</script>

<template>
    <label
        class="flex items-center gap-3 select-none"
        :class="[disabled ? 'opacity-50 cursor-not-allowed' : 'cursor-pointer']"
        @click="!disabled && toggle()"
    >
        <span
            class="relative flex h-5 w-5 items-center justify-center rounded-md border transition-all"
            :class="
                isChecked
                    ? 'bg-primary border-primary text-white'
                    : 'bg-white border-gray-300'
            "
        >
            <Check v-if="isChecked" class="h-4 w-4" />
        </span>

        <span class="text-sm text-gray-700">
            {{ label }}
        </span>
    </label>
</template>

<style scoped>
span {
    transition:
        background-color 0.15s ease,
        border-color 0.15s ease;
}
</style>
