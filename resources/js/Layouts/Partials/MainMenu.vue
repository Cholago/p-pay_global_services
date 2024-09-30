<template>
    <ul role="list" class="-mx-2 space-y-1">
        <li v-for="item in navigation" :key="item.name">
            <Link
                :href="item.href"
                :class="[
                    isUrl(item.href)
                        ? 'bg-gray-50 text-primary-600'
                        : 'text-gray-700 hover:text-primary-600 hover:bg-gray-50',
                    'group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold',
                ]"
            >
                <component
                    :is="item.icon"
                    :class="[
                        isUrl(item.href)
                            ? 'text-primary-600'
                            : 'text-gray-400 group-hover:text-primary-600',
                        'h-6 w-6 shrink-0',
                    ]"
                    aria-hidden="true"
                />
                {{ item.name }}
            </Link>
        </li>
    </ul>

</template>
<script>
import { Link } from '@inertiajs/vue3'
import {
    Bars3Icon,
    BellIcon,
    CalendarIcon,
    ChartPieIcon,
    Cog6ToothIcon,
    DocumentDuplicateIcon,
    FolderIcon,
    HomeIcon,
    UsersIcon,
    XMarkIcon,
    MagnifyingGlassIcon
} from "@heroicons/vue/24/outline";
import { ChevronDownIcon, BanknotesIcon, CreditCardIcon } from "@heroicons/vue/20/solid";


const navigationd = [
    {
        name: "Dashboard",
        href: "/dashboard",
        icon: HomeIcon,
        current: route().current("dashboard"),
    },
   
    {
        name: "Users",
        href: "/users",
        icon: UsersIcon,
        current: route().current("users"),
    },
    /*
    {
        name: "Payments",
        href: route("payments"),
        icon: CreditCardIcon,
        current: route().current("payments"),
    },
    {
        name: "Pending Payment",
        href: route("pendingpayments"),
        icon: BanknotesIcon,
        current: route().current("pendingpayments"),
    },
    */
    //{ name: 'Calendar', href: '#', icon: CalendarIcon, current: false },
    //{ name: 'Documents', href: '#', icon: DocumentDuplicateIcon, current: false },
    //{ name: "Reports", href: "#", icon: ChartPieIcon, current: false },
];

export default {
    components: {
        Link,
        Bars3Icon,
        BellIcon,
        CalendarIcon,
        ChartPieIcon,
        Cog6ToothIcon,
        DocumentDuplicateIcon,
        FolderIcon,
        HomeIcon,
        UsersIcon,
        XMarkIcon,
        MagnifyingGlassIcon,
        ChevronDownIcon, BanknotesIcon, CreditCardIcon 
    },
    data() {
        return {
            navigation: [
                {
                    name: "Dashboard",
                    href: "/dashboard",
                    icon: HomeIcon,
                    current: route().current("dashboard"),
                },
            
                {
                    name: "Users",
                    href: "/users",
                    icon: UsersIcon,
                    current: route().current("users"),
                },

            ]

        }
    },
    methods: {
        isUrl(...urls) {
            let currentUrl = this.$page.url.substr(1)
            if (urls[0] === '') {
                return currentUrl === ''
            }
            return urls.filter((url) => currentUrl.startsWith(url)).length
        },
    },
}

</script>