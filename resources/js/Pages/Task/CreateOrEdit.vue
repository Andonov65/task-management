<script setup>
import Modal from "@/Components/Modal.vue";
import BaseTextarea from "@/Components/Base/BaseTextarea.vue";
import BaseInput from "@/Components/Base/BaseInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {useForm} from "@inertiajs/vue3";
import BaseSelect from "@/Components/Base/BaseSelect.vue";
import {ref} from "vue";

const props = defineProps({
    priorities: Array,
    task: {
        type: Object,
        default: null
    }
})

const form = useForm({
    name: props.task?.name ?? '',
    description: props.task?.description ?? '',
    priority: props.task?.priority ?? '',
    due_date: props.task?.due_date ?? '',
});

const submit = () => {
    props.task ?
        form.put(route('tasks.update', props.task), {
            onSuccess() {
                form.reset()
            }
        }) :
    form.post(route('tasks.store'), {
        onSuccess() {
            form.reset()
        }
    })
}
</script>

<template>
    <Modal>
        <template #header>{{ task ? ('Edit ' + task.name) : 'Create new task'}}</template>
        <form @submit.prevent="submit">
            <div class="flex flex-col gap-4">
                <BaseInput
                    v-model:value="form.name"
                    :required="true"
                    name="name"
                    :error="form.errors.name"
                    label="Name"
                />
                <BaseSelect
                    v-model:value="form.priority"
                    :required="true"
                    name="priority"
                    :error="form.errors.priority"
                    label="Priority"
                >
                    <option value="">Select</option>
                    <option v-for="(priority, i) in priorities" :key="i" :value="priority">
                        {{ priority }}
                    </option>
                </BaseSelect>
                <BaseInput
                    v-model:value="form.due_date"
                    :required="true"
                    name="due_date"
                    type="datetime-local"
                    :error="form.errors.due_date"
                    label="Due date"
                />
                <BaseTextarea
                    v-model:value="form.description"
                    :required="true"
                    name="description"
                    :error="form.errors.description"
                    label="Description"
                />
                <PrimaryButton class="self-end" :disabled="form.processing">
                    Save
                </PrimaryButton>
            </div>
        </form>
    </Modal>
</template>

<style scoped>

</style>
