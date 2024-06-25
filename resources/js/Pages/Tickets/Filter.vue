<script setup>
import { useForm } from "@inertiajs/vue3";
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

const props = defineProps({
    priorities: Object,
    statuses: Object,
    filters: Object,
})

const filterForm = useForm({
    searchInput: props.filters.searchInput ?? null,
    status: props.filters.status ?? null,
    priority: props.filters.priority ?? null,
    date: props.filters.date ?? null,
})

const filter = () => {
    filterForm.get(
        route('tickets.index'),
        {
            preserveState: true,
            preserveScroll: true,
        },
    )
}
const clear = () => {
    filterForm.searchInput = null
    filterForm.status = null
    filterForm.priority = null
    filterForm.date = null
    filter()
}

</script>
<template>
    <form @submit.prevent="filter" class="flex justify-center">
        <div class="mb-8 mt-4 flex flex-wrap gap-2">
            <div class="flex flex-nowrap items-center">
                <input v-model="filterForm.searchInput" type="text" placeholder="search" class="w-50" />
            </div>

            <div class="flex flex-nowrap items-center">
                <select v-model="filterForm.priority" class="input-filter-l w-28">
                    <option :value="null">Priority</option>
                    <option v-for="(priority, label) in priorities" :value="priority">{{ label }}
                    </option>
                </select>
                <select v-model="filterForm.status" class="input-filter-r w-28">
                    <option :value="null">Status</option>
                    <option v-for="(status, label) in statuses" :value="status">{{ label }}</option>
                </select>
            </div>

            <div class="flex flex-nowrap items-center">
                <VueDatePicker v-model="filterForm.date" range class="w-50"></VueDatePicker>
            </div>

            <button type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Filter</button>
            <button @click="clear" type="reset"
                class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Clear</button>
        </div>
    </form>
</template>
