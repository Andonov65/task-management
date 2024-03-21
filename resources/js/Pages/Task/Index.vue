<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, useForm} from '@inertiajs/vue3';
import TaskCard from "@/Components/Task/TaskCard.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import BaseSelect from "@/Components/Base/BaseSelect.vue";
import {computed, ref, watch} from "vue";

const props = defineProps({
    tasks: Object,
    priorities: Array
});

const form = useForm({
    is_completed: 'all'
})

watch(() => form.is_completed,
    () => form.get(route('tasks.index'), {
        preserveState: true,
        preserveScroll: true
    })
)

const PRIORITY_VALUES = {
    'very low': 1,
    'low': 2,
    'medium': 3,
    'high': 4,
    'very high': 5
};

const selectedColumn = ref(null);
const sortDirection = ref('unchanged');

const changeSort = (columnName) => {
    if (selectedColumn.value === columnName) {
        sortDirection.value = sortDirection.value === 'asc' ? 'desc' : 'asc';
    } else {
        selectedColumn.value = columnName;
        sortDirection.value = 'asc';
    }
}

const getColumnValue = (object, columnName) => {
    switch (columnName) {
        case 'name':
            return object.name;
        case 'priority':
            return object.priority;
        case 'status':
            return object.is_completed;
        case 'due_date':
            return object.due_date;
        default:
            return '';
    }
}

const sortedTasks = computed(() => {
    if (sortDirection.value === 'unchanged') return props.tasks.data;

    return props.tasks.data.slice().sort((a, b) => {
        const columnA = getColumnValue(a, selectedColumn.value);
        const columnB = getColumnValue(b, selectedColumn.value);

        if (typeof columnA === 'boolean' && typeof columnB === 'boolean') {
            return sortDirection.value === 'asc' ? columnA - columnB : columnB - columnA;
        } else if (selectedColumn.value === 'priority') {

            return sortDirection.value === 'asc' ?
                PRIORITY_VALUES[columnA.toLowerCase()] - PRIORITY_VALUES[columnB.toLowerCase()] :
                PRIORITY_VALUES[columnB.toLowerCase()] - PRIORITY_VALUES[columnA.toLowerCase()];
        } else {
            const valueA = typeof columnA === 'string' ? columnA.toUpperCase() : columnA;
            const valueB = typeof columnB === 'string' ? columnB.toUpperCase() : columnB;

            if (valueA < valueB) return sortDirection.value === 'asc' ? -1 : 1;
            if (valueA > valueB) return sortDirection.value === 'asc' ? 1 : -1;
            return 0;
        }
    });
});
</script>

<template>
    <Head title="Tasks"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tasks</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-3 gap-4 flex flex-wrap justify-end">
                        <BaseSelect
                            v-model:value="form.is_completed"
                            name="is_completed"
                        >
                            <option value="all">Select</option>
                            <option value="completed">Completed</option>
                            <option value="not_completed">Not completed</option>
                        </BaseSelect>
                        <Link :href="route('tasks.create')">
                            <PrimaryButton class="py-3">
                                Create new task
                            </PrimaryButton>
                        </Link>
                    </div>
                    <div class="relative overflow-x-auto p-3">
                        <table class="w-full border-collapse border border-slate-400 rounded">
                            <thead class="border-b-2 border-black">
                            <tr>
                                <td class="px-3 border border-slate-300"
                                    @click="changeSort('priority')"
                                >
                                    Name
                                </td>
                                <td class="px-3 border border-slate-300">Description</td>
                                <td
                                    class="px-3 border border-slate-300 text-center"
                                    @click="changeSort('priority')"
                                >
                                    Priority
                                </td>
                                <td class="px-3 border border-slate-300 text-center"
                                    @click="changeSort('status')"
                                >
                                    Status
                                </td>
                                <td class="px-3 border border-slate-300"
                                    @click="changeSort('due_date')"
                                >
                                    Due date
                                </td>
                                <td class="px-3 border border-slate-300 text-center">Actions</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr
                                class="border py-2"
                                v-for="task in sortedTasks"
                                :key="task.id"
                            >
                                <TaskCard :task="task"/>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>
