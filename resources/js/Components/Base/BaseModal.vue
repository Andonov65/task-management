<script setup>
import {computed, onMounted, onUnmounted, useSlots} from "vue";
import BaseCard from "@/Components/Base/BaseCard.vue";

const props = defineProps({
    show: {
        type: Boolean,
        required: true
    },
    maxWidth: {
        type: String,
        default: '2xl',
    },
})

const closeOnEscape = (e) => {
    if (e.key === 'Escape') {
        close();
    }
};

const emit = defineEmits(['close', 'after-leave'])
const close = () => {
    emit('close')
}

onMounted(() => document.addEventListener('keydown', closeOnEscape));

onUnmounted(() => {
    document.removeEventListener('keydown', closeOnEscape);
    document.body.style.overflow = null;
});

const slots = useSlots()

const maxWidthClass = computed(() => {
    return {
        sm: 'sm:max-w-sm',
        md: 'sm:max-w-md',
        lg: 'sm:max-w-lg',
        xl: 'sm:max-w-xl',
        '2xl': 'sm:max-w-2xl',
        '3xl': 'sm:max-w-3xl',
        '4xl': 'sm:max-w-4xl',
        '5xl': 'sm:max-w-5xl',
        '6xl': 'sm:max-w-6xl',
    }[props.maxWidth];
});
</script>
<template>
    <Teleport to="body">
        <Transition leave-active-class="duration-200" @after-leave="emit('after-leave')">
            <div v-show="show" class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50 mb-3" scroll-region>
                <Transition
                    enter-active-class="ease-out duration-300"
                    enter-from-class="opacity-0"
                    enter-to-class="opacity-100"
                    leave-active-class="ease-in duration-200"
                    leave-from-class="opacity-100"
                    leave-to-class="opacity-0"

                >
                    <div v-show="show" class="fixed inset-0 transform transition-all" @click="close">
                        <div class="absolute inset-0 bg-gray-500 opacity-75"/>
                    </div>
                </Transition>

                <Transition
                    enter-active-class="ease-out duration-300"
                    enter-from-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    enter-to-class="opacity-100 translate-y-0 sm:scale-100"
                    leave-active-class="ease-in duration-200"
                    leave-from-class="opacity-100 translate-y-0 sm:scale-100"
                    leave-to-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"

                >

                    <div
                        v-show="show"
                        class="mb-6 bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:mx-auto max-h-[90vh]"
                        :class="maxWidthClass"
                    >
                        <BaseCard>
                            <template #header v-if="slots.header">
                                <div class="flex justify-between">
                                    <slot name="header"></slot>
                                    <button @click="close" class="px-2 bg-white rounded">X</button>
                                </div>
                            </template>
                            <div class="p-4 overflow-y-auto max-h-[90vh]">
                                <slot/>
                            </div>
                        </BaseCard>
                    </div>
                </Transition>
            </div>
        </Transition>
    </Teleport>
</template>
