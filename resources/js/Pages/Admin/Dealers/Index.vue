<template>
    <AuthenicatedDashboardLayout>
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
            <Head title="Dealers" />
            <h1 class="mb-8 text-3xl font-bold pl-2 sm:pl-0">Dealers</h1>
            <div class="flex items-center justify-between mb-6 mx-2 sm:mx-0">
                <search-filter
                    v-model="form.search"
                    class="mr-4 w-full max-w-md"
                    @reset="reset"
                >
                </search-filter>
                <Link class="btn-primary" href="/dealers/create">
                    <span>Add</span>
                    <span class="hidden md:inline">&nbsp;Dealer</span>
                </Link>
            </div>
            <div class="bg-white rounded-md shadow overflow-x-auto">
                <table class="w-full whitespace-nowrap">
                    <tr class="font-semibold">
                        <th class="py-4 pl-4 pr-3 text-left">Name</th>
                        <th class="pb-4 pt-6 px-6 text-left">Email</th>
                        <th class="pb-4 pt-6 px-6 text-left">Phone</th>
                        <th class="pb-4 pt-6 px-6 text-left">Bank</th>
                        <th class="pb-4 pt-6 px-6 text-left">Status</th>
                        <th class="pb-4 pt-6 px-6 text-left">Date Created</th>
                    </tr>
                    <tr
                        v-for="dealer in dealers.data"
                        :key="dealer.id"
                        class="hover:bg-gray-100 focus-within:bg-gray-100"
                    >
                        <td class="border-t">
                            <Link
                                class="flex items-center px-6 py-4 focus:text-primary-500"
                                :href="`/dealers/${dealer.id}`"
                                tabindex="-1"
                            >
                                {{ dealer.user.first_name }} {{ dealer.user.last_name }}
                            </Link>
                        </td>
                        <td class="border-t">
                            <Link
                                class="flex items-center px-6 py-4 focus:text-primary-500"
                                :href="`/dealers/${dealer.id}`"
                                tabindex="-1"
                            >
                                {{ dealer.user.email }}
                            </Link>
                        </td>
                        <td class="border-t">
                            <Link
                                class="flex items-center px-6 py-4 focus:text-primary-500"
                                :href="`/dealers/${dealer.id}`"
                                tabindex="-1"
                            >
                                {{ dealer.user.phone }}
                            </Link>
                        </td>
                        <td class="border-t">
                            <Link
                                class="flex items-center px-6 py-4 focus:text-primary-500"
                                :href="`/dealers/${dealer.id}`"
                                tabindex="-1"
                            >
                                {{ dealer.bank.bank_name }}
                            </Link>
                        </td>
                        <td class="border-t">
                            <Link
                                class="flex items-center px-6 py-4 focus:text-primary-500"
                                :href="`/dealers/${dealer.id}`"
                                tabindex="-1"
                            >
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
                            </Link>
                        </td>
                        <td class="border-t">
                            <Link
                                class="flex items-center px-6 py-4 focus:text-primary-500"
                                :href="`/dealers/${dealer.id}`"
                                tabindex="-1"
                            >
                                {{ formatDate(dealer.created_at) }}
                            </Link>
                        </td>
                    </tr>

                    <tr v-if="dealers.data.length === 0">
                        <td class="px-6 py-4 border-t text-center" colspan="6">
                            No dealer found.
                        </td>
                    </tr>
                </table>   
            </div>
            <Pagination class="mt-6" :links="dealers.links" />
        </div>

    </AuthenicatedDashboardLayout>
</template>

<script>
import AuthenicatedDashboardLayout from "@/Layouts/AuthenicatedDashboardLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import SearchFilter from "@/Components/SearchFilter.vue";
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
        SearchFilter,
        AuthenicatedDashboardLayout,
    },
    mixins: [General],
    props: {
        filters: Object,
        dealers: Object,
    },
    data() {
        return {
            form: {
                search: this.filters.search,
                //trashed: this.filters.trashed,
            },
        };
    },
    watch: {
        form: {
            deep: true,
            handler: throttle(function () {
                this.$inertia.get('/dealers', pickBy(this.form), { preserveState: true })

            }, 150),
        },
    },
    methods: {
        reset() {
            this.form = mapValues(this.form, () => null);
        },
    },
};
</script>