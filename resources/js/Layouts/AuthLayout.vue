<template>
  <ScrollArea class="h-screen">
    <div>
      <SideBar/>
      <div class="relative app-container dashboard-main"
           :style="`left: ${store.wrapperLeftOffset}px; width: calc(100% -${store.wrapperLeftOffset}px)`">
        <NavBar/>
        <div class="p-2 lg:p-6 max-w-[1440px] m-auto mt-[64px]">
          <!--      everything will slot here-->
          <slot/>
        </div>
      </div>
    </div>
    <ScrollBar class="z-50"/>
  </ScrollArea>
</template>

<script setup lang="ts">
import {ScrollArea, ScrollBar} from '@/Components/ui/scroll-area'
import SideBar from "@/Components/SideBar.vue";
import {useAppStore} from "@/stores/app";
import {onMounted} from "vue";
import NavBar from "@/Components/NavBar.vue";

const store = useAppStore();

onMounted(() => {
  useAppStore().initTheme();
});
</script>
