<script setup>
import Pagination from '@/Components/Pagination.vue'
import {computed, ref} from "vue";
import { Link } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import DateFormatter from '@/Utils/DateFormatter';

const props = defineProps({
    tickets: Array,
})

const currentPage = ref(1);
const perPage = ref(10);

const formatDate = (date) => {
  return DateFormatter.formatDate(date);
};

const paginatedTickets = computed(() => {
    let start = (currentPage.value - 1) * perPage.value;
    let end = start + perPage.value;
    return props.tickets.slice(start, end);
})
</script>

<template>
    <AuthenticatedLayout>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <h1 class="text-2xl font-semibold text-gray-100">Tickets</h1>
                <a href="/tickets/create"
                   class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Create Ticket
                </a>
            </div>
            <div class="overflow-x-auto shadow  sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-700">
                    <thead class="">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                            ID
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                            Submitted
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                            Title
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                            User
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                            Priority
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                            &nbsp;
                        </th>

                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                    <tr v-for="ticket in paginatedTickets" :key="ticket.id">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">{{ ticket.id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">{{ formatDate(ticket.created_at) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-100">{{ ticket.title }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">{{ ticket.user.name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">{{ ticket.priority }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">{{ ticket.status }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                            <Link :href="route('tickets.show', [ticket.id])">
                                View
                            </Link>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <Pagination
                    :total-items="tickets.length"
                    :current-page.sync="currentPage"
                    :per-page="perPage"
                    @update:currentPage="currentPage = $event"
                />
            </div>
        </div>
    </AuthenticatedLayout>

</template>

