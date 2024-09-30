<template>
    <AuthenicatedDashboardLayout>
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
            <Head title="Signin Logs" />
            <h1 class="mb-8 text-3xl font-bold pl-2 sm:pl-0">Signin Logs</h1>  
            <div class="flex items-center justify-between mb-6 mx-2 sm:mx-0">
                <Filters v-model="form.search" @reset="reset" class="mr-4 max-w-md">
                    <label class="block text-gray-700">Order By</label>
                    <select v-model="form.order_by" class="select-primary mt-1 w-full">
                        <option value="asc">Ascending</option>
                        <option value="desc">Descending</option>
                    </select>
                    <label class="block text-gray-700">User Email</label>
                    <select v-model="form.user" class="select-primary mt-1 w-full">
                        <option :value="null" selected>All</option>
                        <option v-for="user in users" :key="user.id" :value="user.id">{{ user.email }}</option>
                    </select>
                </Filters>
            </div>

            <div class="bg-white rounded-md shadow overflow-x-auto">
                <table class="w-full whitespace-nowrap">
                    <tr class="font-semibold">
                        <th class="py-4 pl-4 pr-3 text-left">Name</th>
                        <th class="pb-4 pt-6 px-3 text-left">Email</th>
                        <th class="pb-4 pt-6 px-3 text-left">Ip Address</th>
                        <th class="pb-4 pt-6 px-3 text-left">Action</th>
                        <th class="pb-4 pt-6 px-3 text-left">Time</th>
                    </tr>
                    <tr v-for="signinlog in signinlogs.data" :key="signinlog.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                        <td class="border-t py-4 pl-4 pr-3 text-left">
                            {{ signinlog.user.first_name }} {{ signinlog.user.last_name }}
                        </td>
                        <td class="border-t py-4 pl-4 pr-3 text-left">
                            {{ signinlog.user.email }}
                        </td>
                        <td class="border-t py-4 pl-4 pr-3 text-left">
                            {{ signinlog.ip_address }}
                        </td>
                        <td class="border-t py-4 pl-4 pr-3 text-left">
                            {{ signinlog.action == 'login' ? 'Signin' : 'Signout' }}
                        </td>
                        <td class="border-t py-4 pl-4 pr-3 text-left">
                            {{ formatDate(signinlog.created_at) }}
                        </td>
                    </tr>
                    <tr v-if="signinlogs.data.length === 0">
                        <td class="px-6 py-4 border-t text-center" colspan="6">No signin log found.</td>
                    </tr>
                </table>
            </div>
            <Pagination class="mt-6" :links="signinlogs.links" />
        </div>

    </AuthenicatedDashboardLayout>
    
</template>

<script>
import AuthenicatedDashboardLayout from "@/Layouts/AuthenicatedDashboardLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import Filters from "@/Components/Filters.vue";
import mapValues from 'lodash/mapValues';
import throttle from 'lodash/throttle';
import pickBy from 'lodash/pickBy';
import { Head, Link } from "@inertiajs/vue3";
import General from "@/Mixins/General";

export default {
    components: {
        Head,
        Link,
        Pagination,
        Filters,
        AuthenicatedDashboardLayout,
    },
    mixins: [General],
    props: {
        filters: Object,
        signinlogs: Object,
        users: Array,
    },
    data() {
        return {
            form: {
                search: this.filters.search,
                user: this.filters.user,
                order_by: this.filters.order_by,
            },
        };
    },
    methods: {
        reset() {
            this.form = mapValues(this.form, () => null);
        },
    },
    watch: {
        form: {
            deep: true,
            handler: throttle(function () {
                this.$inertia.get('/signinlogs', pickBy(this.form), { preserveState: true })
            }, 150),
        },
    },
};
</script>

