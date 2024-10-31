<template>
    <DashboardLayout title="User Dashboard">
        <div class="space-y-3">
            <div>
                <h2>Users</h2>
            </div>
            <div>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table
                        class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
                    >
                        <thead
                            class="text-xs text-gray-700 uppercase dark:text-gray-400"
                        >
                            <tr>
                                <th
                                    scope="col"
                                    class="px-6 py-3 bg-gray-50 dark:bg-gray-800"
                                >
                                    No.
                                </th>
                                <th scope="col" class="px-6 py-3">Name</th>
                                <th
                                    scope="col"
                                    class="px-6 py-3 bg-gray-50 dark:bg-gray-800"
                                >
                                    Username
                                </th>
                                <th scope="col" class="px-6 py-3">Email</th>
                                <th scope="col" class="px-6 py-3">Role</th>
                                <th scope="col" class="px-6 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="(user, i) in users.data"
                                class="border-b border-gray-200 dark:border-gray-700"
                            >
                                <th
                                    scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800"
                                >
                                    {{ i + 1 }}
                                </th>
                                <td class="px-6 py-4">{{ user.name }}</td>
                                <td
                                    class="px-6 py-4 bg-gray-50 dark:bg-gray-800"
                                >
                                    {{ user.username }}
                                </td>
                                <td class="px-6 py-4">{{ user.email }}</td>
                                <td class="px-6 py-4 font-semibold">
                                    {{ user.role }}
                                </td>
                                <td class="px-6 py-4">Edit | Delete</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </DashboardLayout>
</template>

<script setup>
import DashboardLayout from "../../../Layouts/DashboardLayout.vue";
import { usePage, useForm } from "@inertiajs/vue3";
defineProps({
    users: Object,
});
</script>
