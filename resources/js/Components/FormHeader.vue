<script setup lang="ts">
    defineProps({
        header: String,
        headerText: String
    })
</script>

<template>
    <div class="flex flex-col space-y-2 text-center">
        <h1 class="text-2xl font-semibold tracking-tight">
            {{ header }}
        </h1>
        <p class="text-sm text-muted-foreground">
            {{ headerText }}
        </p>
    </div>
</template>

<style scoped>

</style>
