<script setup>
import { computed, defineEmits } from 'vue';
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    links: {
        type: Array,
        required: true,
    },
    nextLink: {
        type: [String, null],
        required: true,
    },
    prevLink: {
        type: [String, null],
        required: true,
    },
});

const pageNumberLinks = computed(() => {
    return props.links.filter(link => /^\d+$/.test(link.label));
});
</script>
<template>
    <div class="flex justify-between items-center mt-4">
        <Link as="button" :href="prevLink"
            class="bg-gray-800 py-2 px-4 text-sm font-medium text-gray-300 hover:bg-gray-700">
        Previous
        </Link>
        <ul class="flex space-x-1">
            <li v-for="link in pageNumberLinks" :key="link.url">
                <Link :href="link.url" v-html="link.label"
                    class="py-2 px-4 leading-tight bg-gray-800 border border-gray-600 text-gray-400"
                    :class="{ 'bg-blue-600 text-white': link.active, 'hover:bg-gray-700 hover:text-white': !link.active }">
                </Link>
            </li>
        </ul>
        <Link as="button" :href="nextLink"
            class="bg-gray-800 py-2 px-4 text-sm font-medium text-gray-300 hover:bg-gray-700">
        Next
        </Link>
    </div>
</template>
