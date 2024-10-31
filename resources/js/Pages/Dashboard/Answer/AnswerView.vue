<template>
    <DashboardLayout title="Answers">
        <div>
            <h2>User Answers</h2>
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
                            <th scope="col" class="px-6 py-3">Nama</th>
                            <th scope="col" class="px-6 py-3">Quiz</th>
                            <th scope="col" class="px-6 py-3">Question_id</th>
                            <th scope="col" class="px-6 py-3">Option_id</th>
                            <th scope="col" class="px-6 py-3">Date</th>
                            <th scope="col" class="px-6 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(a, i) in answers.data"
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                        >
                            <th
                                scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                            >
                                {{ a.user.name }}
                            </th>
                            <td class="px-6 py-4">{{ a.quiz.nama_quiz }}</td>
                            <td class="px-6 py-4">{{ a.question_id }}</td>
                            <td class="px-6 py-4">{{ a.option_id }}</td>
                            <td class="px-6 py-4">{{ a.created_at }}</td>
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
import { usePage, useForm } from "@inertiajs/vue3";
defineProps({
    answers: Object,
});
</script>
