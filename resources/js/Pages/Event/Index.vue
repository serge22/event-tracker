<template>
    <div v-for="event in events" :key="event.id">
        {{ event.id }}
    </div>
</template>

<script setup>
defineProps({
    events: Array,
})
</script>
