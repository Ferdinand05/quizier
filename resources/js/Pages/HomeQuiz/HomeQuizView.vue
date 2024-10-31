<template>
    <Layout title="Quiz">
        <main class="space-y-5">
            <div>
                <h2>Quiz</h2>
                <p>Pilih dan selesaikan quiz dengan baik dan benar.</p>
            </div>
            <div>
                <div class="w-full flex justify-between">
                    <div>
                        <FwbSelect
                            :options="category"
                            placeholder="Pilih Kategori"
                            @change="filterCategory()"
                            v-model="selectedCategory"
                        ></FwbSelect>
                    </div>
                    <div>
                        <Link
                            :href="route('quiz.leaderboard')"
                            class="bg-blue-700 font-medium rounded-md px-2 py-1.5 text-white"
                            >Leaderboard</Link
                        >
                    </div>
                </div>
                <!-- quiz items -->
                <div>
                    <div
                        class="grid sm:grid-cols-2 md:grid-cols-3 gap-2 md:gap-4 mt-4 mb-10"
                    >
                        <!-- item -->

                        <div
                            v-for="q in quiz.data"
                            class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700"
                        >
                            <FwbBadge class="inline-flex">{{
                                q.category
                            }}</FwbBadge>
                            <a href="#">
                                <h5
                                    class="hover:text-gray-700 mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"
                                >
                                    {{ q.nama_quiz }}
                                </h5>
                            </a>
                            <p
                                class="mb-3 font-normal text-gray-700 dark:text-gray-400"
                            >
                                {{ q.deskripsi }}
                            </p>
                            <Link
                                v-if="$page.props.auth.user.username"
                                :href="route('homequiz.show', q.ulid)"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            >
                                Kerjakan
                                <svg
                                    class="rtl:rotate-180 w-3.5 h-3.5 ms-2"
                                    aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 14 10"
                                >
                                    <path
                                        stroke="currentColor"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M1 5h12m0 0L9 1m4 4L9 9"
                                    />
                                </svg>
                            </Link>
                            <div v-else class="text-red-500 font-semibold">
                                Buat akun untuk mengerjakan Quiz
                            </div>
                            <div
                                class="flex mt-2 gap-x-3 text-gray-700 text-sm"
                            >
                                <span>{{ q.jumlah_soal }} Soal</span>
                                <span>{{ q.durasi }} Menit</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </Layout>
</template>

<script setup>
import { usePage, useForm } from "@inertiajs/vue3";
import Layout from "../../Layouts/Layout.vue";
import { FwbBadge, FwbSelect } from "flowbite-vue";
import { ref } from "vue";
defineProps({
    quiz: Object,
    categories: Object,
});
const page = usePage({});
const category = [
    {
        value: "",
        name: "Semua",
    },
];
page.props.categories.forEach((item) => {
    category.push({
        value: item.id,
        name: item.nama_kategori,
    });
});
const selectedCategory = ref();
const formFilterCategory = useForm({
    category: null,
});

function filterCategory() {
    formFilterCategory.category = selectedCategory.value;
    formFilterCategory.get(route("quiz.view"), {
        preserveState: true,
        preserveScroll: true,
    });
}
</script>
