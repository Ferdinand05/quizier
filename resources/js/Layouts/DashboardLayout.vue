<template>
    <header>
        <Head :title="title"></Head>
    </header>

    <main>
        <Sidebar></Sidebar>

        <div class="p-4 sm:ml-64">
            <slot></slot>
        </div>
    </main>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import { FwbDropdown, FwbListGroup, FwbListGroupItem } from "flowbite-vue";
import Sidebar from "../Components/Sidebar.vue";
defineProps({ title: String });
</script>
