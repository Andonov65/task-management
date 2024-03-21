<script setup>
import {computed} from "vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";


const props = defineProps({
    name: {
        type: String,
        required: true
    },
    label: {
        type: String,
        required: false
    },
    placeholder: {
        type: String,
        required: false
    },
    type: {
        type: String,
        default: 'text'
    },
    error: {
        type: String,
        required: false
    },
    value: {
        type: [String, Number],
        default: null,
    },
    required: {
        type: Boolean,
        default: false
    },
})
const emit = defineEmits(["update:value", 'input']);
const _value = computed({
    get() {
        return props.value;
    },
    set(val) {
        emit("update:value", val);
        emit('input', val)
    },
});
</script>
<template>
    <div>
        <InputLabel :required="required" v-if="label" :for="name" :value="label" class="mb-1"/>

        <div class="flex">
            <TextInput
                :id="name"
                :name="name"
                :type="type"
                class=" block w-full"
                :placeholder="placeholder"
                v-model="_value"
                :required="required"
            />
            <slot></slot>
        </div>
        <InputError :message="error"/>
    </div>
</template>

<style scoped></style>
