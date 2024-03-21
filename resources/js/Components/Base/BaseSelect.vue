<script setup>
import {computed} from "vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";


const props = defineProps({
    name: {
        type: [String, Number],
        default: "",
    },
    value: {
        type: [String, Number, Boolean],
        default: null,
    },
    label: {
        type: String,
        default: "",
    },
    error: {
        type: String,
        required: false
    },
    required: {
        type: Boolean,
        default: false
    },
});

const emit = defineEmits(["update:value", "change"]);
const _value = computed({
    get() {
        return props.value;
    },
    set(val) {
        emit("update:value", val);
    },
});
</script>
<template>
    <div>
        <InputLabel :required="required" v-if="label" :for="name" :value="label" class="mb-1"/>
        <select
            class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
            v-model="_value"
            @change="emit('change', $event.target.value)"
            :required="required"
        >
            <slot>
            </slot>
        </select>
        <InputError :message="error"/>
    </div>
</template>


<style scoped></style>
