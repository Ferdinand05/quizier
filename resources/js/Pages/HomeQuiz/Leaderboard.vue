<template>
    <Layout title="Leaderboard">
        <div>
            <h2>Leaderboard</h2>
            <p>Kerjakan quiz dan jadilah yang terbaik.</p>
        </div>
        <div class="mt-5">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mb-10">
                <div
                    class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white dark:bg-gray-900"
                >
                    <div>
                        <div>
                            <FwbSelect
                                placeholder="Filter Quiz"
                                :options="namaQuiz"
                                v-model="selectedQuiz"
                                @change="filterQuiz()"
                            ></FwbSelect>
                        </div>
                    </div>
                </div>
                <table
                    class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
                >
                    <thead
                        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                    >
                        <tr>
                            <th scope="col" class="p-4">Rank</th>
                            <th scope="col" class="px-6 py-3">Nama</th>
                            <th scope="col" class="px-6 py-3">Skor</th>
                            <th scope="col" class="px-6 py-3">Quiz</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(r, i) in results.data"
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                        >
                            <th class="w-4 p-4 text-center">
                                {{ i + 1 }}
                            </th>
                            <th
                                scope="row"
                                class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white"
                            >
                                <img
                                    class="w-10 h-10 rounded-full"
                                    :src="imageUrl + r.user.picture"
                                    alt="Jese image"
                                />
                                <div class="ps-3">
                                    <div class="text-base font-semibold">
                                        {{ r.user.name }}
                                    </div>
                                    <div class="font-normal text-gray-500">
                                        {{ r.user.email }}
                                    </div>
                                </div>
                            </th>
                            <td class="px-6 py-4">{{ r.skor }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div
                                        class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"
                                    ></div>
                                    {{ r.quiz.nama_quiz }}
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </Layout>
</template>

<script setup>
import { FwbSelect } from "flowbite-vue";
import Layout from "../../Layouts/Layout.vue";
import { useForm, usePage } from "@inertiajs/vue3";
import { ref } from "vue";
defineProps({
    results: Object,
    quiz: Object,
});

const imageUrl = "/storage/picture/";
const page = usePage({});
const namaQuiz = [];
page.props.quiz.forEach((item) => {
    namaQuiz.push({
        value: item.ulid,
        name: item.nama_quiz,
    });
});

const selectedQuiz = ref();
const formFilterQuiz = useForm({
    id: null,
});
function filterQuiz() {
    formFilterQuiz.id = selectedQuiz.value;
    formFilterQuiz.get(route("quiz.leaderboard"), {
        preserveScroll: true,
        preserveState: true,
    });
}
</script>
