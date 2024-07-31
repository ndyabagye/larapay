<template>
  <ScrollArea class="h-screen">
      <slot/>
    <ScrollBar class="z-50"/>
  </ScrollArea>
</template>

<script setup lang="ts">
import {ScrollArea, ScrollBar} from '@/Components/ui/scroll-area'
</script>
