<script setup>
const props = defineProps({
    items: Array
});

const isActive = (index) => {
    return index === props.items.length - 1;
};
</script>

<template>
    <div>
        <ul class="flex items-center space-x-2">
            <li v-for="(item, index) in items" :key="index">
                <a :href="item.href" :class="{
                    'text-white': isActive(index),
                    'text-gray-600': !isActive(index),
                    'font-semibold': isActive(index),
                    'hover:underline': !isActive(index)
                }">
                    {{ item.title }}
                </a>
                <span v-if="index !== items.length - 1" class="text-gray-600">/</span>
            </li>
        </ul>
    </div>
</template>
