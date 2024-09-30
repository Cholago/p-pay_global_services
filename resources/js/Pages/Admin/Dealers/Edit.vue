<template>
    <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
        <Head title="Dealers" />
        <h1 class="mb-8 pl-2 sm:pl-0 text-3xl font-bold">
            <Link
                class="text-primary-600 hover:text-primary-500"
                href="/dealers"
                >Dealers</Link
            >
            Edit
        </h1>

        <div class="max-w-3xl bg-white sm:rounded-lg shadow overflow-hidden">
            <form @submit.prevent="submit">
                <div class="flex flex-wrap -mb-12 -mr-6 p-6">
                    <div class="pb-8 pr-6 w-full lg:w-1/3">
                        <InputLabel for="first_name" value="First name*" />
                        <TextInput
                            id="first_name"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.first_name"
                            required
                            autofocus
                            autocomplete="first_name"
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors.first_name"
                        />
                    </div>
                    <div class="pb-8 pr-6 w-full lg:w-1/3">
                        <InputLabel for="middle_name" value="Middle name" />
                        <TextInput
                            id="middle_name"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.middle_name"
                            autocomplete="middle_name"
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors.middle_name"
                        />
                    </div>
                    <div class="pb-8 pr-6 w-full lg:w-1/3">
                        <InputLabel for="last_name" value="Last name*" />
                        <TextInput
                            id="last_name"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.last_name"
                            required
                            autocomplete="last_name"
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors.last_name"
                        />
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
                            autocomplete="email"
                        />
                    </div>
                    <div class="pb-8 w-full lg:w-1/2">
                        <InputLabel for="name" value="Phone*" />
                        <vue-tel-input 
                            v-model="form.phone"
                            required
                            mode="international"
                            class="mt-1 border-gray-300 focus:border-primary-500 focus:ring-primary-500 rounded-md shadow-sm"
                            placeholder="Enter phone number"
                        ></vue-tel-input>
                        <InputError class="mt-2" :message="form.errors.phone" />
                    </div>
                    <div class="pb-8 pr-0 sm:pr-6 w-full lg:w-1/2">
                        <InputLabel for="bank_id" value="Bank*" />
                        <select
                            id="bank_id"
                            class="mt-1 block w-full rounded-md border-0 py-2 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-primary-600 sm:text-sm sm:leading-6"
                            v-model="form.bank_id"
                            required
                        >
                            <option value="">Select a bank</option>
                            <option v-for="bank in banks" :key="bank.id" :value="bank.id">{{ bank.bank_name }}</option>
                        </select>
                        <InputError class="mt-2" :message="form.errors.bank_id" />
                    </div>
                    <div class="pb-8 pr-0 sm:pr-6 w-full lg:w-1/2">
                        <InputLabel for="country_id" value="Country*" />
                        <select
                            id="country_id"
                            class="mt-1 block w-full rounded-md border-0 py-2 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-primary-600 sm:text-sm sm:leading-6"
                            v-model="form.country_id"
                            required
                        >
                            <option value="">Select a country</option>
                            <option v-for="country in countries" :key="country.id" :value="country.id">{{ country.name }}</option>
                        </select>
                        <InputError class="mt-2" :message="form.errors.country_id" />
                    </div>
                    <div class="pb-8 pr-0 sm:pr-6 w-full lg:w-1/2">
                        <InputLabel for="state" value="State*" />
                        <TextInput
                            id="state"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.state"
                            required
                            autocomplete="state"
                        />
                        <InputError class="mt-2" :message="form.errors.state" />
                    </div>
                    <div class="pb-8 pr-0 sm:pr-6 w-full lg:w-1/2">
                        <InputLabel for="city" value="City*" />
                        <TextInput
                            id="city"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.city"
                            required
                            autocomplete="city"
                        />
                        <InputError class="mt-2" :message="form.errors.city" />
                    </div>
                    <div class="pb-8 pr-0 sm:pr-6 w-full lg:w-1/2">
                        <InputLabel for="postal_code" value="Postal Code*" />
                        <TextInput
                            id="postal_code"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.postal_code"
                            required
                            autocomplete="postal_code"
                        />
                        <InputError class="mt-2" :message="form.errors.postal_code" />
                    </div>
                    <div class="pb-8 w-full">
                        <InputLabel for="address" value="Address*" />
                        <TextInput
                            id="address"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.address"
                            required
                            autocomplete="address"
                        />
                        <InputError class="mt-2" :message="form.errors.address" />
                    </div>
                </div>
                <div class="flex flex-wrap pt-3 p-6 border-t border-gray-900/10">
                    <div class="pb-4 pr-0 sm:pr-6 w-full lg:w-1/2">
                        <InputLabel for="active" value="Dealer Status" />
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

                <div
                        class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8"
                    >
                        <LoadingButton
                            :loading="form.processing"
                            class="btn-primary"
                            >{{
                                form.processing ? "Saving" : "Save"
                            }}</LoadingButton
                        >
                    </div>
            </form>
        </div>
    </div>
</template>
<script>
import AuthenicatedDashboardLayout from "@/Layouts/AuthenicatedDashboardLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import LoadingButton from "@/Components/LoadingButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link } from "@inertiajs/vue3";
import {
    PaperClipIcon,
    CalendarDaysIcon,
    CreditCardIcon,
} from "@heroicons/vue/20/solid";
import { XMarkIcon } from "@heroicons/vue/24/outline";
import General from "@/Mixins/General";

export default {
    components: {
        Head,
        Link,
        AuthenicatedDashboardLayout,
        InputError,
        InputLabel,
        LoadingButton,
        TextInput,
        PaperClipIcon,
        CalendarDaysIcon,
        CreditCardIcon,
        XMarkIcon,
        SecondaryButton,
    },
    mixins: [General],
    layout: AuthenicatedDashboardLayout,
    props: {
        dealer: Object,
        countries: Array,
        banks: Array,
    },
    data() {
        return {
            form: this.$inertia.form({
                first_name: this.dealer.user.first_name,
                middle_name: this.dealer.user.middle_name,
                last_name: this.dealer.user.last_name,
                email: this.dealer.user.email,
                phone: this.dealer.user.phone,
                country_id: this.dealer.country_id,
                bank_id: this.dealer.bank_id,
                state: this.dealer.state,
                city: this.dealer.city,
                address: this.dealer.address,
                postal_code: this.dealer.postal_code,
                active: this.dealer.user.active ? 1 : 0,
            }),
        };
    },
    methods: {
        submit() {
            this.form.put(route("dealers.update", this.dealer.id));
        },
    },
};
</script>
