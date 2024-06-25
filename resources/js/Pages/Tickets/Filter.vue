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
    <form @submit.prevent="filter" class="flex flex-col w-full">
        <div class="mb-4 mt-4 grid gap-2 w-full md:grid-cols-4 sm:grid-cols-2 grid-cols-1">
            <div class="form-element">
                <input v-model="filterForm.searchInput" type="text" placeholder="Search" class="input-element" />
            </div>
            <div class="form-element">
                <select v-model="filterForm.priority" class="input-element">
                    <option :value="null">Priority</option>
                    <option v-for="(priority, label) in priorities" :value="priority">{{ label }}</option>
                </select>
            </div>
            <div class="form-element">
                <select v-model="filterForm.status" class="input-element">
                    <option :value="null">Status</option>
                    <option v-for="(status, label) in statuses" :value="status">{{ label }}</option>
                </select>
            </div>
            <div class="form-element">
                <VueDatePicker v-model="filterForm.date" :enable-time-picker="false" range class="datepicker"></VueDatePicker>
            </div>
        </div>
        <div class="flex justify-end gap-2 mb-8">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-6 rounded">Filter</button>
            <button @click="clear" type="reset" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-1 px-6 rounded">Clear</button>
        </div>
    </form>
</template>

<style scoped>
.grid {
    display: grid;
    gap: 8px;
}

.form-element {
    display: flex;
    align-items: center;
    height: 38px;
    width: 100%;
    box-sizing: border-box;
}

.input-element {
    width: 100%;
    height: 100%;
    padding: 4px;
    border-radius: 4px;
    box-sizing: border-box;
}

.datepicker {
    width: 100%;
    height: 100%;
    box-sizing: border-box;
}

.datepicker .dp__input {
    width: 100%;
    height: 38px;
    padding: 8px;
    box-sizing: border-box;
}
</style>