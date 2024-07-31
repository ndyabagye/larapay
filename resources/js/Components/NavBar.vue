<script setup lang="ts">
import {Breadcrumb} from '@/Components/ui/breadcrumb';

import GlobalSearchPopover from "@/Components/GlobalSearchPopover.vue";
import {Avatar, AvatarImage} from '@/Components/ui/avatar';
import {Button} from '@/Components/ui/button';
import {
  DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuLabel, DropdownMenuSeparator, DropdownMenuShortcut,
  DropdownMenuTrigger,
} from "@/Components/ui/dropdown-menu";
import {LogOut, User, Bell, Sun, MoonStar, Menu,} from 'lucide-vue-next'
import {router, Link} from '@inertiajs/vue3'

import {useAppStore} from "@/stores/app";

const store = useAppStore()

const toggleMode = () => {
  store.toggleTheme();
};
</script>

<template>
  <nav
      class="flex items-center justify-between h-[64px] border-b-[1px] px-4 fixed z-40 top-0 bg/background/80 backdrop-blur border-border"
      :style="{width: store.navWidth}">
    <div class="w-24 hidden lg:block">
      <Breadcrumb/>
    </div>
    <div class="w-2/5 hidden lg:block">
      <GlobalSearchPopover/>
    </div>
    <Button
        variant="outline"
        class="p-[6px] w-8 h-8 transition-all duration-200 block lg:hidden"
        :class="store.sidebarExpanded ? 'bg-transparent' : 'dark:bg-white'"
        @click="store.toggleSidebar()"
    >
      <Menu class="transition-all duration-500 text-black"/>
    </Button>
    <div class="flex items-center">
      <Button variant="outline" class="border-0 p-[6px] w-8 h-8">
        <Bell/>
      </Button>
      <Button variant="outline" class="border-0 p-[6px] ml-2 w-8 h-8" @click="toggleMode">
        <Sun v-if="store.isDark"/>
        <MoonStar v-else/>
      </Button>
      <div class="border-x-[1px] border-gray-300 h-[24px] w-[1px] mx-2"></div>
      <DropdownMenu>
        <DropdownMenuTrigger as-child>
          <Button variant="outline" class="border-0 flex items-center max-w-[200px] truncate w-full justify-start">
            <Avatar class="h-8 w-8">
              <AvatarImage src="https://github.com/radix-vue.png"></AvatarImage>
            </Avatar>
            <span class="mx-2 hidden md:flex justify-start flex-col items-start">
              <span class="mb-0">{{ $page.props.auth.user.name }}</span>
            </span>
          </Button>
        </DropdownMenuTrigger>
        <DropdownMenuContent class="w-56 relative mr-4">
          <DropdownMenuLabel>{{ $page.props.auth.user.name }}</DropdownMenuLabel>
          <span class="mb-0 text-xs italic px-1 text-muted-foreground">{{ $page.props.auth.user.email }}</span>
          <DropdownMenuSeparator/>
          <DropdownMenuItem>
            <Link :href="route('profile.edit')" class="flex items-center">
              <User class="mr-2 h-4 w-4"/>
              <span>Profile</span>
            </Link>
          </DropdownMenuItem>
          <DropdownMenuSeparator/>
          <DropdownMenuItem>
            <Link :href="route('logout')" class="flex items-center justify-between w-full" method="post" as="button">
              <div class="flex items-center">
                <LogOut class="mr-2 h-4 w-4"/>
                <span>Log out</span>
              </div>
              <div>

                <DropdownMenuShortcut>⇧⌘Q</DropdownMenuShortcut>
              </div>
            </Link>
          </DropdownMenuItem>
        </DropdownMenuContent>
      </DropdownMenu>
    </div>
  </nav>
</template>

<style scoped>

</style>