<template>
    <DashboardLayout title="Dashboard">
        <h2>Dashboard</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-y-1 md:gap-x-3">
            <div class="bg-red-500 p-2 text-center bg-opacity-80 rounded-sm">
                <div class="text-3xl">Category Quiz</div>
                <div class="text-2xl">{{ categoryQuizCount }}</div>
            </div>
            <div class="bg-green-500 p-2 text-center bg-opacity-80 rounded-sm">
                <div class="text-3xl">Quiz</div>
                <div class="text-2xl">{{ quizCount }}</div>
            </div>
            <div class="bg-sky-500 p-2 text-center bg-opacity-80 rounded-sm">
                <div class="text-3xl">Result</div>
                <div class="text-2xl">{{ resultCount }}</div>
            </div>
            <div class="bg-gray-500 p-2 text-center bg-opacity-80 rounded-sm">
                <div class="text-3xl">User</div>
                <div class="text-2xl">{{ userCount }}</div>
            </div>
        </div>
    </DashboardLayout>
</template>

<script setup>
import DashboardLayout from "../../Layouts/DashboardLayout.vue";
defineProps({
    resultCount: {
        type: Number,
        default: 0,
    },
    userCount: {
        type: Number,
        default: 0,
    },
    categoryQuizCount: {
        type: Number,
        default: 0,
    },
    quizCount: {
        type: Number,
        default: 0,
    },
});
</script>
