<template>
    <div></div>
</template>

<script setup>
import {useToast} from "vue-toastification";
import {onMounted, watch} from "vue";
import useBase from "@/Mixin/base.js";

const toast = useToast();

const {success, error} = useBase();
const errorFunc = (val) => {
    toast.error(val);
};

const successFunc = (val) => {
    toast.success(val);
};

const reset = () => {
    setTimeout(() => success.value = null, 1)
    setTimeout(() => error.value = null, 1)

}
const handleSuccess = () => {
    if (success.value) {
        setTimeout(() => successFunc(success.value))
        reset()
    }
}
const handleError = () => {
    if (error.value) {
        setTimeout(() => errorFunc(error.value))
        reset()
    }
}
onMounted(() => {
    handleSuccess();
    handleError()
})

watch(
    success,
    handleSuccess,
);

watch(
    error,
    handleError,
);


</script>

<style scoped></style>
