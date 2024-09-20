<template>
    <DashboardLayout title="Dashboard">
        <h2>Dashboard</h2>
        <div class="grid grid-cols-4 gap-x-3">
            <div class="bg-red-500 p-2 text-center bg-opacity-80 rounded-sm">
                <div class="text-3xl">Quiz</div>
                <div class="text-2xl">10</div>
            </div>
            <div class="bg-green-500 p-2 text-center bg-opacity-80 rounded-sm">
                <div class="text-3xl">Quiz</div>
                <div class="text-2xl">10</div>
            </div>
            <div class="bg-sky-500 p-2 text-center bg-opacity-80 rounded-sm">
                <div class="text-3xl">Quiz</div>
                <div class="text-2xl">10</div>
            </div>
            <div class="bg-gray-500 p-2 text-center bg-opacity-80 rounded-sm">
                <div class="text-3xl">Quiz</div>
                <div class="text-2xl">10</div>
            </div>
        </div>
    </DashboardLayout>
</template>

<script setup>
import DashboardLayout from "../../Layouts/DashboardLayout.vue";
</script>
