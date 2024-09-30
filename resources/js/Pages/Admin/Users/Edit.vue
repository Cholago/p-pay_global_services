<template>
    <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
        <Head title="Users"/>
        <h1 class="mb-8 pl-2 sm:pl-0 text-3xl font-bold">
            <Link class="text-primary-600 hover:text-primary-500" href="/users">Users</Link>
            Edit
        </h1>

        <div class="max-w-3xl bg-white sm:rounded-lg shadow overflow-hidden">
            <form @submit.prevent="store">
                <div class="flex flex-wrap -mb-12 -mr-6 p-6">
                    <div class="pb-8 pr-6 w-full lg:w-1/3">
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

                    <div class="pb-8 pr-6 w-full lg:w-1/3">
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

                    <div class="pb-8 pr-6 w-full lg:w-1/3">
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
                </div>
                <div class="flex flex-wrap pt-3 p-6">
                    <div class="pb-8 pr-0 sm:pr-6 w-full lg:w-1/2">
                        <InputLabel for="email" value="Email" />

                        <TextInput
                            id="email"
                            type="email"
                            class="mt-1 block w-full"
                            v-model="form.email"
                            readonly
                            autocomplete="username"
                        />

                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>
                    <div class="pb-8 w-full lg:w-1/2">
                        <InputLabel for="name" value="Phone" />
                        <vue-tel-input 
                            v-model="form.phone"
                            required
                            mode="international"
                            class="mt-1 border-gray-300 focus:border-primary-500 focus:ring-primary-500 rounded-md shadow-sm"
                        ></vue-tel-input>
                        <InputError class="mt-2" :message="form.errors.phone" />
                    </div>

                </div>
                <div class="flex flex-wrap pt-3 p-6 border-t border-gray-900/10">
                    <div class="pb-4 pr-0 sm:pr-6 w-full lg:w-1/2">
                        <InputLabel for="active" value="Account Status" />
                        <select
                            id="active"
                            class="mt-1 block w-full border-gray-300 focus:border-primary-500 focus:ring-primary-500 rounded-md shadow-sm"
                            v-model="form.active"
                            required
                        >
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                        <InputError class="mt-2" :message="form.errors.active" />
                    </div>
                </div>
                <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
                    <LoadingButton :loading="form.processing" class="btn-primary">{{ form.processing ? "Saving" : "Save" }}</LoadingButton>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import AuthenicatedDashboardLayout from "@/Layouts/AuthenicatedDashboardLayout.vue";
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import LoadingButton from '@/Components/LoadingButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link } from "@inertiajs/vue3";

export default {
    components: {
        Head,
        Link,
        AuthenicatedDashboardLayout,
        InputError,
        InputLabel,
        LoadingButton,
        TextInput
    },
    layout: AuthenicatedDashboardLayout,
    props: {
        states: Array,
        user: Object,

    },
    data() {
        return {
            form: this.$inertia.form({

                first_name: this.user.first_name,
                middle_name: this.user.middle_name,
                last_name: this.user.last_name,
                email: this.user.email,
                phone: this.user.phone,
                active: this.user.active ? 1 : 0,
            }),  
        };
    },
    methods: {
        store() {
            this.form.post(`/users/${this.user.id}/edit`)
        },

    },
};
</script>
