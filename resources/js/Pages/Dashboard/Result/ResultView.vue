<template>
    <DashboardLayout title="Result">
        <div>
            <h2>User Result</h2>
        </div>
        <div class="mt-10">
            <div class="relative overflow-x-auto">
                <table
                    class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
                >
                    <thead
                        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                    >
                        <tr>
                            <th scope="col" class="px-6 py-3">No</th>
                            <th scope="col" class="px-6 py-3">Nama</th>
                            <th scope="col" class="px-6 py-3">Quiz</th>
                            <th scope="col" class="px-6 py-3">Skor</th>
                            <th scope="col" class="px-6 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(r, i) in results.data"
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                        >
                            <td class="px-6 py-4">{{ i + 1 }}</td>
                            <td class="px-6 py-4">{{ r.user.name }}</td>
                            <td class="px-6 py-4">{{ r.quiz.nama_quiz }}</td>
                            <td class="px-6 py-4">{{ r.skor }}</td>
                            <td>
                                <FwbButton size="sm" color="red"
                                    >Delete</FwbButton
                                >
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </DashboardLayout>
</template>

<script setup>
import { FwbButton } from "flowbite-vue";
import DashboardLayout from "../../../Layouts/DashboardLayout.vue";
defineProps({
    results: Object,
});
</script>
