<script setup>
import { useForm } from "@inertiajs/vue3";
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({
    priorities: Object,
    statuses: Object,
})

// const priorities = {
//     low: 'Low',
//     medium: 'Medium',
//     high: 'High',
// };

// const statuses = {
//     open: 'Open',
//     in_progress: 'In Progress',
//     closed: 'Closed',
// };



const form = useForm({
    title: '',
    description: '',
    priority: 'low',
    status: 'open',
});

function submit() {
    form.post('/tickets', {
        onSuccess: () => form.reset('title', 'description', 'priority', 'status')
    });
}
</script>

<template>
    <AuthenticatedLayout>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form @submit.prevent="submit">
                    <div class="shadow overflow-hidden sm:rounded-md bg-gray-800 p-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6">
                                <label for="title" class="block text-sm font-medium text-gray-300">Title</label>
                                <input type="text" name="title" id="title" v-model="form.title"
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md bg-gray-700 text-white">
                                <p v-if="form.errors.title" class="text-red-500 text-xs italic">{{ form.errors.title }}
                                </p>
                            </div>

                            <div class="col-span-6">
                                <label for="description"
                                    class="block text-sm font-medium text-gray-300">Description</label>
                                <textarea id="description" name="description" v-model="form.description" rows="3"
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md bg-gray-700 text-white"></textarea>
                                <p v-if="form.errors.description" class="text-red-500 text-xs italic">{{
                                    form.errors.description }}</p>
                            </div>

                            <div class="col-span-6">
                                <label for="priority" class="block text-sm font-medium text-gray-300">Priority</label>
                                <select id="priority" name="priority" v-model="form.priority"
                                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-gray-700 text-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option v-for="(priority, label) in priorities" :value="priority">{{ label }}
                                    </option>
                                </select>
                                <p v-if="form.errors.priority" class="text-red-500 text-xs italic">{{
                                    form.errors.priority }}</p>
                            </div>

                            <div class="col-span-6">
                                <label for="status" class="block text-sm font-medium text-gray-300">Status</label>
                                <select id="status" name="status" v-model="form.status"
                                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-gray-700 text-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option v-for="(status, label) in statuses" :value="status">{{ label }}</option>
                                </select>
                                <p v-if="form.errors.status" class="text-red-500 text-xs italic">{{ form.errors.status
                                    }}</p>
                            </div>
                        </div>

                        <div class="py-6 text-right">
                            <button type="submit"
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Create Ticket
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
