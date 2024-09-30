<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="mt-4 mb-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Sign in to your account</h2>
        </div>
        <div class="sm:mx-auto sm:w-full sm:max-w-[480px] md:w-full">
            <div class="bg-white px-6 py-12 shadow sm:rounded-lg sm:px-12">
                <div class="text-sm text-white">
                    ----------------------------------------------------------
                </div>
                <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                    {{ status }}
                </div>
                <form @submit.prevent="submit">
                    <div>
                        <InputLabel for="email" value="Email" />

                        <TextInput
                            id="email"
                            type="email"
                            class="mt-1 block w-full"
                            v-model="form.email"
                            required
                            autofocus
                            autocomplete="username"
                        />

                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="password" value="Password" />

                        <TextInput
                            id="password"
                            type="password"
                            class="mt-1 block w-full"
                            v-model="form.password"
                            required
                            autocomplete="current-password"
                        />

                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>

                    <div class="flex items-center justify-between mt-4">
                        <div class="flex items-center">
                            <Checkbox name="remember" v-model:checked="form.remember" />
                            <label for="remember-me" class="ml-3 block text-sm leading-6 text-gray-900">Remember me</label>
                        </div>

                        <div class="text-sm leading-6">
                            <Link v-if="canResetPassword"
                            :href="route('password.request')" class="font-semibold text-primary-600 hover:text-primary-500">Forgot password?</Link>
                        </div>
                    </div>
                    <div>
                        <PrimaryButton class="mt-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            SIGN IN
                        </PrimaryButton>
                    </div>

                </form>
            </div>
            <!--
            <p class="mt-10 text-center text-sm text-gray-500">
                Not a member?
                {{ ' ' }}
                <Link :href="route('register')" class="font-semibold leading-6 text-primary-600 hover:text-primary-500">Sign up</Link>
            </p>
        -->
        </div>   
    </GuestLayout>
</template>
