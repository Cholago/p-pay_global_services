<template>
    <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
        <Head title="Users" />
        <div class="md:flex md:items-center md:justify-between mb-8">
            <div class="min-w-0 flex-1">
            <h1 class="text-2xl pl-2 sm:pl-0 font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
                <Link class="text-primary-600 hover:text-primary-500" href="/users">Users</Link>
                Profile
            </h1>
            </div>
            <div v-if="!user.is_admin" class="mt-4 flex md:ml-4 md:mt-0 pl-2 sm:pl-0">
                <Link class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50" :href="`/users/${user.id}/edit`">
                    <span>Edit</span>
                </Link>
            </div>
        </div>

        <div class="overflow-hidden bg-white shadow sm:rounded-lg">
            <div class="px-4 py-6 sm:px-6">
                <h3 class="text-base font-semibold leading-7 text-gray-900">User Information</h3>
            </div>
            <div class="border-t border-gray-100">
                <dl class="divide-y divide-gray-100">
                    <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-900">Full name</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ user.first_name }} {{ user.middle_name }} {{ user.last_name }}</dd>
                    </div>
                    <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-900">Email address</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ user.email }}</dd>
                    </div>
                    <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-900">Phone</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ user.phone }}</dd>
                    </div>

                    <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-900">Status</dt>
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                            <span
                                v-if="user.active"
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
                        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> {{ formatDate(user.created_at ) }}</dd>
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
import { PaperClipIcon, CalendarDaysIcon, CreditCardIcon } from '@heroicons/vue/20/solid'
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
        Modal,
        XMarkIcon,
        SecondaryButton
    },
    mixins: [General],
    layout: AuthenicatedDashboardLayout,
    props: {
        user: Object,
    },
    data() {
        return {
        };
    },
    methods: {
        
    },
};
</script>
