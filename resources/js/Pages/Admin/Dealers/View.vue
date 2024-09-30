<template>
    <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
        <Head title="Dealers" />
        <div class="md:flex md:items-center md:justify-between mb-8">
            <div class="min-w-0 flex-1">
                <h1 class="text-2xl pl-2 sm:pl-0 font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
                    <Link class="text-primary-600 hover:text-primary-500" href="/dealers">Dealers</Link>
                    View
                </h1>
            </div>
            <div class="mt-4 flex md:ml-4 md:mt-0 pl-2 sm:pl-0">
                <Link class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50" :href="`/dealers/${dealer.id}/edit`">
                    <span>Edit</span>
                </Link>
            </div>
        </div>

        <div class="overflow-hidden bg-white shadow sm:rounded-lg">
            <div class="px-4 py-6 sm:px-6">
                <h3 class="text-base font-semibold leading-7 text-gray-900">Dealer Information</h3>
            </div>
            <div class="border-t border-gray-100">
                <dl class="divide-y divide-gray-100">
                    <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"> 
                        <dt class="text-sm font-medium text-gray-900">Dealer Name</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ dealer.user.first_name }} {{ dealer.user.last_name }}</dd>
                    </div>
                    <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"> 
                        <dt class="text-sm font-medium text-gray-900">Email</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ dealer.user.email }}</dd>
                    </div>
                    <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"> 
                        <dt class="text-sm font-medium text-gray-900">Phone</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ dealer.user.phone }}</dd>
                    </div>
                    <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"> 
                        <dt class="text-sm font-medium text-gray-900">Bank</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ dealer.bank.bank_name }}</dd>
                    </div>
                    <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"> 
                        <dt class="text-sm font-medium text-gray-900">Country</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ dealer.country.name }}</dd>
                    </div>
                    <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"> 
                        <dt class="text-sm font-medium text-gray-900">State</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ dealer.state }}</dd>
                    </div>
                    <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"> 
                        <dt class="text-sm font-medium text-gray-900">City</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ dealer.city }}</dd>
                    </div>
                    <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"> 
                        <dt class="text-sm font-medium text-gray-900">Address</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ dealer.address }}</dd>
                    </div>
                    <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"> 
                        <dt class="text-sm font-medium text-gray-900">Postal Code</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ dealer.postal_code }}</dd>
                    </div>
                    <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"> 
                        <dt class="text-sm font-medium text-gray-900">Status</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                            <span
                                v-if="dealer.user.active"
                                class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20"
                                >Active</span
                            >
                            <span
                                v-else
                                class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/20"
                                >Inactive</span
                            >
                        </dd>
                    </div>
                    <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"> 
                        <dt class="text-sm font-medium text-gray-900">Date Created</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> {{ formatDate(dealer.created_at ) }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</template>

<script>
import AuthenicatedDashboardLayout from "@/Layouts/AuthenicatedDashboardLayout.vue";
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import LoadingButton from '@/Components/LoadingButton.vue';
import SecondaryButton from "@/Components/SecondaryButton.vue";
import Modal from "@/Components/Modal.vue";
import TextInput from '@/Components/TextInput.vue';
import { Head, Link } from "@inertiajs/vue3";
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
        SecondaryButton
    },
    mixins: [General],
    layout: AuthenicatedDashboardLayout,
    props: {
        dealer: Object,
    },
    data() {
        return {
        };
    },
}
</script>