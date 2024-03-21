<script setup>
import ConfirmDelete from "@/Components/Task/ConfirmDelete.vue";
import {ref} from "vue";

defineProps({
    task: Object
})

const showDelete = ref(false);
</script>

<template>
        <td class="font-semibold px-3 border border-slate-300">
            {{task.name}}
        </td>
        <td class="text-xs px-3 border border-slate-300">
            {{task.description}}
        </td>
        <td class="font-semibold text-center px-3 border border-slate-300">
            {{task.priority}}
        </td>
        <td class="px-3 border border-slate-300 text-center" :class="task.is_completed ? 'text-green-500' : 'text-red-500'">
            {{ task.is_completed ? 'Completed' : 'Not completed' }}
        </td>
        <td class="px-3 border border-slate-300">
            {{task.due_date}}
        </td>
        <td class="px-3 border border-slate-300 flex flex-wrap justify-end">
            <Link v-if="!task.is_completed" class="text-green-600 mx-1" method="post" as="button" :href="route('tasks.completed', task)">
                Mark as completed
            </Link>
            <Link class="text-indigo-600 mx-1" :href="route('tasks.edit', task)">
                Edit
            </Link>
            <Link href="#help" preserve-state preserve-scroll @click="showDelete = true"
                  class="text-red-600 mx-1">Delete
            </Link>
            <ConfirmDelete v-model:show="showDelete" :task="task" />
        </td>
</template>

<style scoped>

</style>
