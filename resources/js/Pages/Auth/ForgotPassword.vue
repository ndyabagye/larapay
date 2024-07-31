<script setup lang="ts">
import InputError from '@/Components/InputError.vue';
import {Label} from '@/Components/ui/label';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import {Input} from '@/Components/ui/input';
import {Head, useForm, Link} from '@inertiajs/vue3';
import GuestLayout from "@/Layouts/GuestLayout.vue";
import {cn} from "@/lib/utils";
import {buttonVariants} from "@/Components/ui/button";


defineProps<{
    status?: string;
}>();

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <GuestLayout>
        <Head title="Forgot Password"/>

        <template #form-link>
            <Link href="/login" :class="cn(
        buttonVariants({ variant: 'ghost' }),
        'absolute right-4 top-4 md:right-8 md:top-8',
      )">Login
            </Link>
        </template>

        <template #title>Reset Password</template>
        <template #description>Forgot your password? No problem. Just let us know your email address and we will email
            you a password reset
            link that will allow you to choose a new one.
        </template>

        <template #form>
            <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                {{ status }}
            </div>

            <form @submit.prevent="submit">
                <div>
                    <Label for="email">Email</Label>

                    <Input
                        id="email"
                        type="email"
                        class="mt-1 block w-full"
                        v-model="form.email"
                        required
                        autofocus
                        autocomplete="username"
                    />

                    <InputError class="mt-2" :message="form.errors.email"/>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Email Password Reset Link
                    </PrimaryButton>
                </div>
            </form>
        </template>
    </GuestLayout>
</template>
