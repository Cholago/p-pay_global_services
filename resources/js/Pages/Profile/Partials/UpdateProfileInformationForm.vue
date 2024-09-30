<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Profile Information</h2>

            <p class="mt-1 text-sm text-gray-600">
                Update your account's profile
            </p>
        </header>

        <form @submit.prevent="form.patch(route('profile.update'))" class="mt-6 space-y-6">
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

            <div>
                <InputLabel for="name" value="Middle name" />
                <TextInput
                    id="middle_name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.middle_name"
                    autofocus
                    autocomplete="middle_name"
                />

                <InputError class="mt-2" :message="form.errors.middle_name" />
            </div>

            <div>
                <InputLabel for="name" value="Last name" />
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

            <div>
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    readonly
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div v-if="user.email_verified_at === null">
                <p class="text-sm mt-2 text-gray-800">
                    Your email address is unverified.
                    <Link
                        :href="route('verification.send')"
                        method="post"
                        as="button"
                        class="underline font-semibold leading-6 text-primary-600 hover:text-primary-500"
                    >
                        Click here to re-send the verification email.
                    </Link>
                </p>

                <div
                    v-show="status === 'verification-link-sent'"
                    class="mt-2 font-medium text-sm text-green-600"
                >
                    A new verification link has been sent to your email address.
                </div>
            </div>

            <div>
                <InputLabel for="name" value="Phone" />

                <vue-tel-input 
                    v-model="form.phone"
                    mode="international"
                    :defaultCountry="'ke'"
                    class="border-gray-300 focus:border-primary-500 focus:ring-primary-500 rounded-md shadow-sm"
                    required
                ></vue-tel-input>
                <InputError class="mt-2" :message="form.errors.phone" />
            </div>

            <div class="flex items-center gap-4">
                <LoadingButton :loading="form.processing" class="btn-primary flex w-full justify-center">{{ form.processing ? "Saving" : "Save" }}</LoadingButton>
                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import LoadingButton from '@/Components/LoadingButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const user = usePage().props.auth.user;

const form = useForm({
    first_name: user.first_name,
    middle_name: user.middle_name,
    last_name: user.last_name,
    email: user.email,
    phone: user.phone,
});
</script>
