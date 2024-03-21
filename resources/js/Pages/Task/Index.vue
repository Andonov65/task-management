<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import TaskCard from "@/Components/Task/TaskCard.vue";

defineProps({
    tasks: Object
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
                    <div class="relative overflow-x-auto">
                        <table class="w-full border-collapse border border-slate-400">
                            <thead class="border-b-2 border-black">
                            <tr>
                                <td class="px-3 border border-slate-300">Name</td>
                                <td class="px-3 border border-slate-300">Description</td>
                                <td class="px-3 border border-slate-300 text-center">Priority</td>
                                <td class="px-3 border border-slate-300 text-center">Status</td>
                                <td class="px-3 border border-slate-300">Due date</td>
                                <td class="px-3 border border-slate-300 text-center">Actions</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr
                                class="border py-2"
                                v-for="task in tasks.data"
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
