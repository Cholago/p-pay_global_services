<template>
    <Head title="Profile" />
    <AuthenicatedDashboardLayout>
        <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
            <Head title="Profile" />
            <h1 class="mb-8 text-3xl font-bold">Profile</h1>
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <UpdateProfileInformationForm
                    :must-verify-email="mustVerifyEmail"
                    :status="status"
                    class="max-w-xl"
                />
            </div>
            <div class="mt-6 p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <UpdatePasswordForm class="max-w-xl" />
            </div>
            <!--
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <DeleteUserForm class="max-w-xl" />
            </div>
            -->
        </div>
    </AuthenicatedDashboardLayout>
</template>
<script setup>
import AuthenicatedDashboardLayout from "@/Layouts/AuthenicatedDashboardLayout.vue";
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head, usePage} from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const user = usePage().props.auth.user;

</script>
