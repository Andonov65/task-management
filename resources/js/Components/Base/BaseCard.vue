<script setup>
import {useSlots} from 'vue'

const slots = useSlots()
</script>

<template>
    <div class="rounded-lg bg-white shadow-sm">
        <div v-if="slots.header" class="p-4 bg-gray-50 font-semibold uppercase">
            <slot name="header"></slot>
        </div>
        <slot></slot>
    </div>
</template>

<style scoped>

</style>
