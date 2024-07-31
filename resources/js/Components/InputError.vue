<script setup lang="ts">
import {Label} from "@/Components/ui/label";

defineProps<{
    message?: string;
}>();
</script>

<template>
    <div v-show="message">
        <p class="text-xs font-medium text-red-600">
            {{ message }}
        </p>
    </div>
</template>
