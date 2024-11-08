<template>
    <DashboardLayout title="Option Page">
        <h2>Option</h2>

        <div class="my-3">
            <div class="md:w-[50%] mb-3">
                <FwbSelect
                    placeholder="Filter"
                    :options="questionOptions"
                    v-model="formFilterOption.id"
                    @change="filterOption()"
                ></FwbSelect>
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table
                    class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
                >
                    <thead
                        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                    >
                        <tr>
                            <th scope="col" class="px-6 py-3">No</th>
                            <th scope="col" class="px-6 py-3">Jawaban</th>
                            <th scope="col" class="px-6 py-3">Quiz ID</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                            <th scope="col" class="px-6 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(o, i) in options.data"
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                        >
                            <th
                                scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                            >
                                {{ i + 1 }}
                            </th>
                            <td class="px-6 py-4">{{ o.jawaban }}</td>
                            <td class="px-6 py-4">{{ o.question.quiz_id }}</td>
                            <td class="px-6 py-4">
                                <fwb-badge
                                    :type="
                                        o.is_correct == 1 ? 'default' : 'dark'
                                    "
                                    >{{
                                        o.is_correct == 1 ? "True" : "False"
                                    }}</fwb-badge
                                >
                            </td>
                            <td class="px-6 py-4">
                                <a
                                    href="#"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                                    >Edit</a
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
import { FwbBadge, FwbSelect } from "flowbite-vue";
import DashboardLayout from "../../../Layouts/DashboardLayout.vue";
import { useForm, usePage } from "@inertiajs/vue3";

defineProps({
    options: Object,
    questions: Object,
});

const page = usePage({});
const questionOptions = [];
page.props.questions.data.forEach((element) => {
    questionOptions.push({
        value: element.id,
        name: element.pertanyaan,
    });
});

const formFilterOption = useForm({
    id: "",
});

function filterOption() {
    formFilterOption.get(route("option.index"), {
        preserveScroll: true,
        preserveState: true,
    });
}
</script>
