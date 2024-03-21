<template>
    <div>
        <InputLabel :required="required" v-if="label" :for="name" :value="label" class="mb-1"/>

        <div class="flex">
            <textarea
                :id="name"
                :name="name"
                class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                :placeholder="placeholder"
                v-model="_value"
            />
        </div>

        <InputError :message="error"/>
    </div>
</template>

<script>
export default {
    name: "BaseTextarea"
}
</script>

<script setup>
import {computed} from "vue";
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
    }
});

const emit = defineEmits(["update:value",]);
const _value = computed({
    get() {
        return props.value;
    },
    set(val) {
        emit("update:value", val);
    },
});
</script>

<style scoped>

</style>
