<script setup lang="ts">
import AuthLayout from '@/Layouts/AuthLayout.vue';
import { Head } from '@inertiajs/vue3';

defineOptions({
  layout: AuthLayout
});

</script>

<template>
  <Head title="Tenants" />

  <template slot="headerText">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tenants</h2>
  </template>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
        <div class="p-6 text-gray-900">Tenants!</div>
      </div>
    </div>
  </div>
</template>
