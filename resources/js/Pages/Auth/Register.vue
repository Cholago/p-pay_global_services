<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    first_name: '',
    middle_name: '',
    last_name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>

        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="mt-4 mb-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Create your account</h2>
        </div>
        <div class="sm:mx-auto sm:w-full sm:max-w-[480px]">
            <div class="bg-white px-6 py-12 shadow sm:rounded-lg sm:px-12">
                <div class="text-sm text-white">
                    ----------------------------------------------------------
                </div>
                <form @submit.prevent="submit">
                    <div>
                        <InputLabel for="name" value="First name" />

                        <TextInput
                            id="first_name"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.first_name"
                            required
                            autofocus
                            autocomplete="first_name"
                        />

                        <InputError class="mt-2" :message="form.errors.first_name" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="name" value="Middle name" />

                        <TextInput
                            id="middle_name"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.middle_name"
                            autofocus
                            autocomplete="name"
                        />

                        <InputError class="mt-2" :message="form.errors.middle_name" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="name" value="Last Name" />

                        <TextInput
                            id="last_name"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.last_name"
                            required
                            autofocus
                            autocomplete="last_name"
                        />

                        <InputError class="mt-2" :message="form.errors.last_name" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="email" value="Email" />

                        <TextInput
                            id="email"
                            type="email"
                            class="mt-1 block w-full"
                            v-model="form.email"
                            required
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
                            autocomplete="new-password"
                        />
                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>
                    <div class="mt-4">
                        <InputLabel for="password_confirmation" value="Confirm Password" />

                        <TextInput
                            id="password_confirmation"
                            type="password"
                            class="mt-1 block w-full"
                            v-model="form.password_confirmation"
                            required
                            autocomplete="new-password"
                        />
                        <InputError class="mt-2" :message="form.errors.password_confirmation" />
                    </div>                    

                    <div>
                        <PrimaryButton class="mt-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Register
                        </PrimaryButton>
                    </div>


                </form>
            </div>
            <p class="mt-10 text-center text-sm text-gray-500">
                Already registered?
                {{ ' ' }}
                <Link :href="route('login')" class="font-semibold leading-6 text-primary-600 hover:text-primary-500">Sign in</Link>
            </p>
        </div>
    </GuestLayout>
</template>
