<script setup lang="ts">
import {Link} from "@inertiajs/vue3";
import {Button} from "@/Components/ui/button";
</script>

<template>
    <!--     Hero -->
    <div class="relative overflow-hidden py-24 lg:py-32 min-h-screen bg-blue-200">
        <div
            aria-hidden="true"
            class="flex absolute -top-96 start-1/2 transform -translate-x-1/2"
        >
            <div
                class="bg-gradient-to-r from-background/50 to-background blur-3xl w-[25rem] h-[44rem] rotate-[-60deg] transform -translate-x-[10rem]"/>
            <div
                class="bg-gradient-to-tl blur-3xl w-[90rem] h-[50rem] rounded-full origin-top-left -rotate-12 -translate-x-[15rem] from-primary-foreground via-primary-foreground to-background"/>
        </div>
        <div class="relative z-10">
            <div class="container py-10 lg:py-16">
                <div class="max-w-2xl text-center mx-auto">
                    <div class="mt-5 max-w-2xl">
                        <h1 class="scroll-m-20 text-4xl font-extrabold tracking-tight lg:text-5xl">
                            Lara Pay
                        </h1>
                    </div>
                    <div class="mt-5 max-w-3xl">
                        <p class="text-xl text-muted-foreground">
                            Manage your rent payments in a fast,efficient and secure way
                        </p>
                    </div>
                    <div class="mt-8 gap-3 flex justify-center">
                        <Link href="/login" as="button">
                            <Button size=sm>
                                Get started
                            </Button>
                        </Link>
                        <Link href="#hero-learn-more">
                            <Button size=sm variant=outline>
                                Learn more
                            </Button>
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
