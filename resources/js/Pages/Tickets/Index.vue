<script setup>
import Pagination from '@/Components/Pagination.vue'
import { Link } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import dateFormatter from '@/Utils/dateFormatter';
import Breadcrumbs from "@/Components/Breadcrumbs.vue";
import Filter from "@/Pages/Tickets/Filter.vue";

const props = defineProps({
    tickets: Object,
    priorities: Object,
    statuses: Object,
    filters: Object,
})

const formatDate = dateFormatter.formatDate;

const breadcrumbs = [
    {
        title: 'Dashboard',
        href: '/dashboard'
    },
    {
        title: 'Tickets',
        href: '/tickets'
    }
];
</script>

<template>
    <AuthenticatedLayout>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-100">Tickets</h1>
                    <Breadcrumbs :items="breadcrumbs" />
                </div>
                <a href="/tickets/create"
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Create Ticket
                </a>
            </div>
            <Filter :filters="filters" :priorities="priorities" :statuses="statuses" />
            <div class="overflow-x-auto shadow  sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-700">
                    <thead class="">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                ID
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                Submitted
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                Title
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                User
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                Priority
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                &nbsp;
                            </th>

                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        <tr v-for="ticket in tickets.data" :key="ticket.id">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">{{ ticket.id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">{{
                                formatDate(ticket.created_at) }}</td>
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
                <Pagination :links="tickets.links" :nextLink="tickets.next_page_url"
                    :prevLink="tickets.prev_page_url" />
            </div>
        </div>
    </AuthenticatedLayout>

</template>
