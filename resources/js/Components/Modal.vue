<script setup>

import {useModal} from "/vendor/emargareten/inertia-modal"
import BaseModal from "@/Components/Base/BaseModal.vue";
import {useSlots} from "vue";

const {show, close, redirect} = useModal()
const props = defineProps({
    maxWidth: {
        type: String,
        default: '2xl',
    },
})
const slots = useSlots()
</script>

<template>

    <BaseModal :show="show" @close="close" @after-leave="()=>redirect({preserveState: true, preserveScroll:true})"
               :max-width="maxWidth">
        <template #header v-if="slots.header">
            <slot name="header"></slot>
        </template>
        <slot></slot>
    </BaseModal>
</template>
