<template>
    <DashboardLayout title="Quiz">
        <h2>Quiz</h2>
        <div class="mt-4 space-y-3">
            <div>
                <!-- SECTION - MODAL -->
                <Modal ref="modalCreate" position="top-center">
                    <template #header> Create new Quiz </template>
                    <template #body>
                        <form
                            action=""
                            method="post"
                            @submit.prevent="createQuiz()"
                        >
                            <div class="space-y-3 mb-3">
                                <FwbInput
                                    label="Nama Kuis"
                                    size="sm"
                                    v-model="formQuiz.nama_quiz"
                                ></FwbInput>
                                <small>{{ formQuiz.errors.nama_quiz }}</small>
                                <FwbInput
                                    label="Deskripsi"
                                    size="sm"
                                    v-model="formQuiz.deskripsi"
                                ></FwbInput>
                                <small>{{ formQuiz.errors.deskripsi }}</small>
                                <FwbInput
                                    label="Jumlah Soal"
                                    size="sm"
                                    type="number"
                                    v-model="formQuiz.jumlah_soal"
                                ></FwbInput>
                                <small>{{ formQuiz.errors.jumlah_soal }}</small>
                                <FwbInput
                                    type="number"
                                    label="Waktu (Menit)"
                                    v-model="formQuiz.durasi"
                                ></FwbInput>
                                <small>{{ formQuiz.errors.durasi }} </small>

                                <FwbSelect
                                    placeholder="Pilih Kategori"
                                    label="Kategori"
                                    :options="categoryOptions"
                                    v-model="formQuiz.category_id"
                                ></FwbSelect>
                                <small>{{ formQuiz.errors.category_id }}</small>
                            </div>
                            <FwbButton size="sm">Submit</FwbButton>
                        </form>
                    </template>
                </Modal>
                <!-- END -->
            </div>
            <div>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table
                        class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
                    >
                        <thead
                            class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                        >
                            <tr>
                                <th scope="col" class="px-6 py-3">No</th>
                                <th scope="col" class="px-6 py-3">Nama Quiz</th>
                                <th scope="col" class="px-6 py-3">Deskripsi</th>
                                <th scope="col" class="px-6 py-3">
                                    Jumlah Soal
                                </th>
                                <th scope="col" class="px-6 py-3">Waktu</th>
                                <th scope="col" class="px-6 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="(q, i) in quiz"
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                            >
                                <th
                                    scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                >
                                    {{ i + 1 }}
                                </th>
                                <td class="px-6 py-4">{{ q.nama_quiz }}</td>
                                <td class="px-6 py-4">{{ q.deskripsi }}</td>
                                <td class="px-6 py-4">{{ q.jumlah_soal }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-around">
                                        {{ q.durasi }} Menit
                                    </div>
                                </td>
                                <td class="px-6 py-4 flex space-x-1">
                                    <Modal
                                        buttonType="Edit"
                                        ref="modalEdit"
                                        position="top-center"
                                    >
                                        <template #header> Edit Quiz </template>
                                        <template #body>
                                            <form
                                                action=""
                                                method="post"
                                                @submit.prevent="
                                                    updateQuiz(q, i)
                                                "
                                            >
                                                <div class="space-y-3 mb-3">
                                                    <FwbInput
                                                        label="Nama Kuis"
                                                        size="sm"
                                                        v-model="q.nama_quiz"
                                                    ></FwbInput>
                                                    <small>{{
                                                        formEditQuiz.errors
                                                            .nama_quiz
                                                    }}</small>
                                                    <FwbInput
                                                        label="Deskripsi"
                                                        size="sm"
                                                        v-model="q.deskripsi"
                                                    ></FwbInput>
                                                    <small>{{
                                                        formEditQuiz.errors
                                                            .deskripsi
                                                    }}</small>
                                                    <FwbInput
                                                        label="Jumlah Soal"
                                                        size="sm"
                                                        type="number"
                                                        v-model="q.jumlah_soal"
                                                    ></FwbInput>
                                                    <small>{{
                                                        formEditQuiz.errors
                                                            .jumlah_soal
                                                    }}</small>
                                                    <FwbInput
                                                        type="number"
                                                        label="Waktu (Menit)"
                                                        v-model="q.durasi"
                                                    ></FwbInput>
                                                    <small
                                                        >{{
                                                            formEditQuiz.errors
                                                                .durasi
                                                        }}
                                                    </small>

                                                    <FwbSelect
                                                        placeholder="Pilih Kategori"
                                                        label="Kategori"
                                                        :options="
                                                            categoryOptions
                                                        "
                                                        v-model="q.category_id"
                                                    ></FwbSelect>
                                                    <small>{{
                                                        formEditQuiz.errors
                                                            .category_id
                                                    }}</small>
                                                </div>
                                                <FwbButton size="sm"
                                                    >Submit</FwbButton
                                                >
                                            </form>
                                        </template>
                                    </Modal>
                                    <FwbButton
                                        color="red"
                                        size="xs"
                                        @click="destroyQuiz(q.ulid)"
                                        >Delete</FwbButton
                                    >
                                </td>
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
import Modal from "../../../Components/Modal.vue";
import { FwbButton, FwbInput, FwbSelect } from "flowbite-vue";
import { useForm, usePage } from "@inertiajs/vue3";
import Swal from "sweetalert2";
import { ref } from "vue";
defineProps({
    categories: Object,
    quiz: Object,
});
const page = usePage({});
const categoryOptions = [];
page.props.categories.forEach((element) => {
    categoryOptions.push({
        value: element.id,
        name: element.nama_kategori,
    });
});

const modalCreate = ref(null);

const formQuiz = useForm({
    id: null,
    category_id: "",
    nama_quiz: null,
    deskripsi: null,
    jumlah_soal: null,
    durasi: null,
});

function createQuiz() {
    formQuiz.post(route("quiz.store"), {
        onSuccess: () => {
            modalCreate.value.closeModal();
        },
    });
}

function destroyQuiz(id) {
    formQuiz.id = id;
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            formQuiz.delete(route("quiz.destroy", id));
        }
    });
}

const formEditQuiz = useForm({
    ulid: null,
    category_id: "",
    nama_quiz: null,
    deskripsi: null,
    jumlah_soal: null,
    durasi: null,
});

const modalEdit = ref(null);
function updateQuiz(data, index) {
    formEditQuiz.ulid = data.ulid;
    formEditQuiz.nama_quiz = data.nama_quiz;
    formEditQuiz.deskripsi = data.deskripsi;
    formEditQuiz.jumlah_soal = data.jumlah_soal;
    formEditQuiz.durasi = data.durasi;
    formEditQuiz.category_id = data.category_id;

    formEditQuiz.put(route("quiz.update", data.ulid), {
        onSuccess: () => {
            modalEdit.value[index].closeModal();
            Swal.fire({
                title: "Good job!",
                text: "You clicked the button!",
                icon: "success",
            });
        },
    });
}
</script>
