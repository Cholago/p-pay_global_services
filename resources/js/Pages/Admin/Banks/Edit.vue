<template>
    <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
        <Head title="Banks"/>
        <h1 class="mb-8 pl-2 sm:pl-0 text-3xl font-bold">
            <Link class="text-primary-600 hover:text-primary-500" href="/banks">Banks</Link>
            Edit
        </h1>

        <div class="max-w-3xl bg-white sm:rounded-lg shadow overflow-hidden">
            <form @submit.prevent="store">
                <div class="flex flex-wrap -mb-12 -mr-6 p-6">
                    <div class="pb-8 pr-6 w-full lg:w-1/3">
                        <InputLabel for="bank_name" value="Bank name*" />
                        <TextInput
                            id="bank_name"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.bank_name"
                            required
                            autofocus
                            autocomplete="bank_name"
                        />
                        <InputError class="mt-2" :message="form.errors.bank_name" />
                    </div>

                    <div class="pb-8 pr-6 w-full lg:w-1/3">
                        <InputLabel for="name" value="Bank code*" />
                        <TextInput
                            id="bank_code"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.bank_code"
                            autofocus
                            autocomplete="bank_code"
                        />

                        <InputError class="mt-2" :message="form.errors.bank_code" />
                    </div>

                    <div class="pb-8 pr-6 w-full lg:w-1/3">
                        <InputLabel for="name" value="Swift code" />
                        <TextInput
                            id="swift_code"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.swift_code"
                            required
                            autofocus
                            autocomplete="swift_code"
                        />

                        <InputError class="mt-2" :message="form.errors.swift_code" />
                    </div>
                </div>
                <div class="flex flex-wrap pt-3 p-6">
                    <div class="pb-8 pr-0 sm:pr-6 w-full lg:w-1/2">
                        <InputLabel for="email" value="Email*" />

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

                    <div class="pb-8 w-full lg:w-1/2">
                        <InputLabel for="phone_number" value="Phone Number*" />
                        <vue-tel-input 
                            v-model="form.phone_number"
                            required
                            mode="international"
                            class="mt-1 border-gray-300 focus:border-primary-500 focus:ring-primary-500 rounded-md shadow-sm"
                        ></vue-tel-input>
                        <InputError class="mt-2" :message="form.errors.phone_number" />
                    </div>

                    <div class="pb-8 pr-0 sm:pr-6 w-full lg:w-1/2">
                        <InputLabel for="country_id" value="Country*" />
                        <select id="country_id" v-model="form.country_id" class="mt-1 block w-full rounded-md border-0 py-2 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-primary-600 sm:text-sm sm:leading-6">
                            <option v-for="country in countries" :key="country.id" :value="country.id">{{ country.name }}</option>
                        </select>
                        <InputError class="mt-2" :message="form.errors.country_id" />
                    </div>

                    <div class="pb-8 w-full lg:w-1/2">
                        <InputLabel for="state" value="State" />
                        <TextInput
                            id="state"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.state"
                        />
                        <InputError class="mt-2" :message="form.errors.state" />
                    </div>
                    <div class="pb-8 pr-0 sm:pr-6 w-full lg:w-1/2">
                        <InputLabel for="city" value="City" />
                        <TextInput
                            id="city"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.city"
                        />
                        <InputError class="mt-2" :message="form.errors.city" />
                    </div> 

                    <div class="pb-8 w-full lg:w-1/2">
                        <InputLabel for="postal_code" value="Postal Code" />
                        <TextInput
                            id="postal_code"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.postal_code"
                            autocomplete="new-password"
                        />
                        <InputError class="mt-2" :message="form.errors.postal_code" />
                    </div>
                    <div class="pb-8 w-full">
                        <InputLabel for="address" value="Address" />
                        <TextInput
                            id="address"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.address"
                        />
                        <InputError class="mt-2" :message="form.errors.address" />
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
        countries: Array,
        bank: Object,

    },
    data() {
        return {
            form: this.$inertia.form({
                bank_name: this.bank.bank_name,
                bank_code: this.bank.bank_code,
                swift_code: this.bank.swift_code,
                email: this.bank.email,
                phone_number: this.bank.phone_number,
                country_id: this.bank.country_id,
                state: this.bank.state,
                city: this.bank.city,
                postal_code: this.bank.postal_code,
                address: this.bank.address,
                active: this.bank.active ? 1 : 0,
                
            }),  
        };
    },
    methods: {
        store() {
            this.form.post(`/banks/${this.bank.id}/edit`)
        },

    },
};
</script>
