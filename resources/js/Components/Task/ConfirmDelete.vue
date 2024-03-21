<script setup>
import BaseModal from "@/Components/Base/BaseModal.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

defineProps({
    show: {
        type: Boolean,
        required: true
    },
    task: Object
});

const emit = defineEmits(['update:show'])
</script>

<template>
    <BaseModal max-width="xl" :show="show" @close="emit('update:show', false)">
        <template #header>
            <div>Are you sure you want to delete</div>
        </template>
        <div class="flex flex-wrap justify-end">
            <Link class="mx-1" method="delete" as="button" :href="route('tasks.destroy', task)">
                <PrimaryButton>
                    Yes
                </PrimaryButton>
            </Link>
            <PrimaryButton class="mx-1" @click="emit('update:show', false)">
                No
            </PrimaryButton>
        </div>
    </BaseModal>
</template>

<style scoped>

</style>
