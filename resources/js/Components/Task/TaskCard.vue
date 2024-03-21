<script setup>
defineProps({
    task: Object
})
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
</template>

<style scoped>

</style>
