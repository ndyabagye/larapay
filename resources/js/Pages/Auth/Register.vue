<script setup lang="ts">
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import {Label} from '@/Components/ui/label';
import {Input} from '@/Components/ui/input';
import {Head, Link, useForm} from '@inertiajs/vue3';
import GuestLayout from "@/Layouts/GuestLayout.vue";
import {cn} from "@/lib/utils";
import {buttonVariants} from "@/Components/ui/button";


const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => {
            form.reset('password', 'password_confirmation');
        },
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Register"/>
        <template #form-link>
            <Link href="/login" :class="cn(
        buttonVariants({ variant: 'ghost' }),
        'absolute right-4 top-4 md:right-8 md:top-8',
      )">Login
            </Link>
        </template>

        <template #title>Welcome</template>
        <template #description>Enter your details to signup</template>

        <template #form>
            <form @submit.prevent="submit">
                <div>
                    <Label for="name">Name</Label>

                    <Input
                        id="name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.name"
                        required
                        autofocus
                        autocomplete="name"
                    />

                    <InputError class="mt-2" :message="form.errors.name"/>
                </div>

                <div class="mt-4">
                    <Label for="email">Email</Label>

                    <Input
                        id="email"
                        type="email"
                        class="mt-1 block w-full"
                        v-model="form.email"
                        required
                        autocomplete="username"
                    />

                    <InputError class="mt-2" :message="form.errors.email"/>
                </div>

                <div class="mt-4">
                    <Label for="password">Password</Label>

                    <Input
                        id="password"
                        type="password"
                        class="mt-1 block w-full"
                        v-model="form.password"
                        required
                        autocomplete="new-password"
                    />

                    <InputError class="mt-2" :message="form.errors.password"/>
                </div>

                <div class="mt-4">
                    <Label for="password_confirmation">Confirm Password</Label>
                    <Input
                        id="password_confirmation"
                        type="password"
                        class="mt-1 block w-full"
                        v-model="form.password_confirmation"
                        required
                        autocomplete="new-password"
                    />

                    <InputError class="mt-2" :message="form.errors.password_confirmation"/>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <Link
                        :href="route('login')"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Already registered?
                    </Link>

                    <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Register
                    </PrimaryButton>
                </div>
            </form>
        </template>

    </GuestLayout>
</template>
