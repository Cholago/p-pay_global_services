<template>
    <AuthenicatedDashboardLayout>
        <div class="max-w-15xl mx-auto sm:px-6 lg:px-8">
            <dl class="mx-auto grid grid-cols-1 gap-px bg-gray-900/5 sm:grid-cols-2 lg:grid-cols-4">
                <Link href="#">
                    <div class="flex flex-wrap items-baseline justify-between gap-x-4 gap-y-2 bg-white px-4 py-10 sm:px-6 xl:px-8">
                        <dt class="text-sm font-medium leading-6 text-gray-500">Total Customers</dt>
                        <dd class="w-full flex-none text-3xl font-medium leading-10 tracking-tight text-gray-900">{{ 0 }}</dd>
                    </div>
                </Link>
                <Link href="#">
                    <div class="flex flex-wrap items-baseline justify-between gap-x-4 gap-y-2 bg-white px-4 py-10 sm:px-6 xl:px-8">
                        <dt class="text-sm font-medium leading-6 text-gray-500">Total Disbursed</dt>
                        <dd class="w-full flex-none text-3xl font-medium leading-10 tracking-tight text-gray-900">Ksh {{ 0 }}</dd>
                    </div>
                </Link>
                    <Link href="#">
                    <div class="flex flex-wrap items-baseline justify-between gap-x-4 gap-y-2 bg-white px-4 py-10 sm:px-6 xl:px-8">
                        <dt class="text-sm font-medium leading-6 text-gray-500">Total Charges</dt>
                        <dd class="w-full flex-none text-3xl font-medium leading-10 tracking-tight text-gray-900">Ksh {{ 0 }}</dd>
                    </div>
                </Link>
                <Link href="#">
                    <div class="flex flex-wrap items-baseline justify-between gap-x-4 gap-y-2 bg-white px-4 py-10 sm:px-6 xl:px-8">
                        <dt class="text-sm font-medium leading-6 text-gray-500">Total Collection</dt>
                        <dd class="w-full flex-none text-3xl font-medium leading-10 tracking-tight text-gray-900">Ksh {{ 0 }}</dd>
                    </div>
                </Link>
                
            </dl>
        </div>
    </AuthenicatedDashboardLayout>
</template>
<script>
import AuthenicatedDashboardLayout from '@/Layouts/AuthenicatedDashboardLayout.vue';
import { Head, Link } from '@inertiajs/vue3';


export default {
    components: {
        Head,
        Link,
        AuthenicatedDashboardLayout,
    },

    props: {
        totalUsers: Number,
    },

};

</script>