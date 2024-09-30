<template>
    <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
        <Head title="Banks" />
        <h1 class="mb-8 text-3xl pl-2 sm:pl-0 font-bold">
            <Link class="text-primary-600 hover:text-primary-500" href="/banks">Banks</Link>
            Create
        </h1>

        <div class="max-w-3xl bg-white sm:rounded-lg shadow  overflow-hidden">
            <form @submit.prevent="store">
                <div class="flex flex-wrap -mb-12 -mr-6 p-8">
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
                <div class="flex flex-wrap pt-3  p-8">
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
    },
    data() {
        return {
            form: this.$inertia.form({
                bank_name: null,
                bank_code: null,
                swift_code: null,
                email: null,
                phone_number: null,
                country_id: null,
                state: null,
                city: null,
                postal_code: null,
                address: null,
                
            }),  
        };
    },
    methods: {
        store() {
            this.form.post('/banks')
        },

    },
};
</script>
