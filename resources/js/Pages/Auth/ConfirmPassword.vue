<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import {Label} from '@/Components/ui/label';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import {Input} from '@/Components/ui/input';
import {Head, Link, useForm} from '@inertiajs/vue3';
import {cn} from "@/lib/utils";
import {buttonVariants} from "@/Components/ui/button";

const form = useForm({
    password: '',
});

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => {
            form.reset();
        },
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Confirm Password"/>

        <template #form-link>
            <Link href="/" :class="cn(
        buttonVariants({ variant: 'ghost' }),
        'absolute right-4 top-4 md:right-8 md:top-8',
      )">Home
            </Link>
        </template>


        <template #title>Confirm Password</template>
        <template #description>
            This is a secure area of the application. Please confirm your password before continuing.
        </template>

        <template #form>
            <form @submit.prevent="submit">
                <div>
                    <Label for="password">Password</Label>
                    <Input
                        id="password"
                        type="password"
                        class="mt-1 block w-full"
                        v-model="form.password"
                        required
                        autocomplete="current-password"
                        autofocus
                    />
                    <InputError class="mt-2" :message="form.errors.password"/>
                </div>

                <div class="flex justify-end mt-4">
                    <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Confirm
                    </PrimaryButton>
                </div>
            </form>
        </template>
    </GuestLayout>
</template>
