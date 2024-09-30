<template>
    <div class="rounded-md bg-green-100 p-4 mb-4" v-if="$page.props.flash.success && show">
        <div class="flex">
            <div class="flex-shrink-0">
                <CheckCircleIcon class="h-5 w-5 text-green-400" aria-hidden="true" />
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-green-800">{{ $page.props.flash.success }}</p>
            </div>
            <div class="ml-auto pl-3">
                <div class="-mx-1.5 -my-1.5">
                    <button @click="show = false" type="button" class="inline-flex rounded-md bg-green-50 p-1.5 text-green-500 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 focus:ring-offset-green-50">
                        <span class="sr-only">Dismiss</span>
                        <XMarkIcon class="h-5 w-5" aria-hidden="true" />
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="rounded-md bg-red-100 p-4 mb-4" v-if="($page.props.flash.error || isString($page.props.flash.error)) && show">
        <div class="flex">
            <div class="flex-shrink-0">
                <XCircleIcon class="h-5 w-5 text-red-400" aria-hidden="true" />
            </div>
            <div class="ml-3">
                <p  v-if="isString($page.props.flash.error)" class="text-sm font-medium text-red-800">{{ $page.props.flash.error }}</p>
                <!--
                <div v-else class="text-sm font-medium text-red-800">
                    <span v-if="Object.keys($page.props.errors).length === 1">There is one form error.</span>
                    <span v-else>There are {{ Object.keys($page.props.errors).length }} form errors.</span>
                </div>
                -->
            </div>
            <div class="ml-auto pl-3">
                <div class="-mx-1.5 -my-1.5">
                    <button @click="show = false" type="button" class="inline-flex rounded-md bg-red-50 p-1.5 text-red-500 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-offset-2 focus:ring-offset-red-50">
                        <span class="sr-only">Dismiss</span>
                        <XMarkIcon class="h-5 w-5" aria-hidden="true" />
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { CheckCircleIcon, XMarkIcon, XCircleIcon } from '@heroicons/vue/20/solid'

export default {
    components: {
        CheckCircleIcon,
        XMarkIcon,
        XCircleIcon
    },
    data() {
        return {
        show: true,
        }
    },
    watch: {
        '$page.props.flash': {
        handler() {
            this.show = true
        },
        deep: true,
        },
    },
    methods: {

        isString(value) {
            return typeof value === 'string';
        }
    },
}
</script>