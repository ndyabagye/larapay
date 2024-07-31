<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from "@/Layouts/AppLayout.vue";
import Hero from "@/Pages/Hero.vue";
import GradientHero from "@/Pages/GradientHero.vue";
import { Button } from "@/Components/ui/button";

defineOptions({
    layout: AppLayout
})

defineProps<{
    canLogin?: boolean;
    canRegister?: boolean;
}>();

</script>

<template>

    <Head title="Welcome" />
    
    <GradientHero/>
    <!-- <Hero/> -->

</template>
