<template>
    <div>
        <Head :title="title"></Head>
    </div>
    <main>
        <Navbar></Navbar>
        <article class="px-16 pt-5">
            <slot />
        </article>
        <footer>
            <Footer></Footer>
        </footer>
    </main>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import Navbar from "../Components/Navbar.vue";
import Footer from "../Components/Footer.vue";
defineProps({ title: String });
</script>
