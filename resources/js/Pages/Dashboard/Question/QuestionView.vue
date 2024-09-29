<template>
    <DashboardLayout title="Questions">
        <h2>Question</h2>
        <div class="mt-3 space-y-3">
            <div>
                <Modal ref="modalCreate">
                    <template #header>Create new Question</template>
                    <template #body>
                        <form
                            action=""
                            method="post"
                            class="space-y-3"
                            @submit.prevent="createQuestion()"
                            enctype="multipart/form-data"
                        >
                            <div>
                                <div class="font-normal">Soal</div>
                                <ckeditor
                                    :editor="editor"
                                    v-model="formQuestion.pertanyaan"
                                    :config="editorConfig"
                                ></ckeditor>
                                <small class="text-red-500">{{
                                    formQuestion.errors.pertanyaan
                                }}</small>
                            </div>
                            <FwbInput
                                type="number"
                                label="Point"
                                v-model="formQuestion.point"
                            ></FwbInput>
                            <div>
                                <FwbSelect
                                    label="Masuk kedalam Quiz : "
                                    placeholder="Pilih Quiz"
                                    :options="quizOptions"
                                    v-model="formQuestion.quiz_id"
                                ></FwbSelect>
                                <small class="text-red-500">{{
                                    formQuestion.errors.quiz_id
                                }}</small>
                            </div>
                            <FwbButton :disabled="formQuestion.processing"
                                >Submit</FwbButton
                            >
                        </form>
                    </template>
                </Modal>
            </div>
            <div>
                <div
                    class="relative overflow-x-auto shadow-md sm:rounded-lg break-words"
                >
                    <table
                        class="w-full break-words text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
                    >
                        <thead
                            class="text-xs break-words text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                        >
                            <tr>
                                <th scope="col" class="px-6 py-3">Soal</th>
                                <th scope="col" class="px-6 py-3">Quiz</th>
                                <th scope="col" class="px-6 py-3">Points</th>
                                <th scope="col" class="px-6 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="(q, i) in questions.data"
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                            >
                                <td
                                    scope="row"
                                    class="px-6 py-4 font-medium max-w-md break-words text-gray-900 dark:text-white"
                                >
                                    <div v-html="q.pertanyaan"></div>
                                </td>
                                <td class="px-6 py-4">
                                    {{ q.quiz.nama_quiz }}
                                </td>
                                <td class="px-6 py-4">{{ q.points }}</td>
                                <td class="px-6 py-4 flex gap-x-2">
                                    <Modal ref="modalEdit" buttonType="Edit">
                                        <template #header
                                            >Edit Pertanyaan</template
                                        >
                                        <template #body>
                                            <form
                                                action=""
                                                method="post"
                                                class="space-y-3"
                                                @submit.prevent="
                                                    updateQuestion(q, i)
                                                "
                                            >
                                                <div>
                                                    <div class="font-normal">
                                                        Soal
                                                    </div>
                                                    <ckeditor
                                                        :editor="editor"
                                                        v-model="q.pertanyaan"
                                                        :config="editorConfig"
                                                    ></ckeditor>
                                                    <small
                                                        class="text-red-500"
                                                        >{{
                                                            formEditQuestion
                                                                .errors
                                                                .pertanyaan
                                                        }}</small
                                                    >
                                                </div>
                                                <FwbInput
                                                    type="number"
                                                    label="Point"
                                                    v-model="q.points"
                                                ></FwbInput>
                                                <div>
                                                    <FwbSelect
                                                        label="Masuk kedalam Quiz : "
                                                        placeholder="Pilih Quiz"
                                                        :options="quizOptions"
                                                        v-model="q.quiz_id"
                                                    ></FwbSelect>
                                                    <small
                                                        class="text-red-500"
                                                        >{{
                                                            formEditQuestion
                                                                .errors.quiz_id
                                                        }}</small
                                                    >
                                                </div>
                                                <FwbButton
                                                    :disabled="
                                                        formEditQuestion.processing
                                                    "
                                                    >Submit</FwbButton
                                                >
                                            </form>
                                        </template>
                                    </Modal>
                                    <FwbButton
                                        size="sm"
                                        color="red"
                                        @click="destroyQuestion(q.id)"
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
import { useForm, usePage } from "@inertiajs/vue3";
import { FwbButton, FwbInput, FwbSelect, FwbTextarea } from "flowbite-vue";
import { ref } from "vue";
import Swal from "sweetalert2";
import { Ckeditor } from "@ckeditor/ckeditor5-vue";
import {
    ClassicEditor,
    Bold,
    Essentials,
    Heading,
    Indent,
    IndentBlock,
    Italic,
    Link,
    List,
    MediaEmbed,
    Paragraph,
    Table,
    Undo,
} from "ckeditor5";
import "ckeditor5/ckeditor5.css";
const editor = ClassicEditor;
const editorConfig = {
    toolbar: [
        "undo",
        "redo",
        "|",
        "heading",
        "|",
        "bold",
        "italic",
        "|",
        "link",
        "insertTable",
        "|",
        "bulletedList",
        "numberedList",
        "indent",
        "outdent",
    ],
    plugins: [
        Bold,
        Essentials,
        Heading,
        Indent,
        IndentBlock,
        Italic,
        Link,
        List,
        Paragraph,
        Table,
        Undo,
    ],
};

defineProps({
    questions: Object,
});
const modalCreate = ref(null);
const modalEdit = ref(null);
const page = usePage({});

const quizOptions = [];
page.props.quiz.forEach((element) => {
    quizOptions.push({
        value: element.ulid,
        name: element.nama_quiz,
    });
});

const formQuestion = useForm({
    pertanyaan: "",
    quiz_id: "",
    point: 1,
});

function createQuestion() {
    formQuestion.post(route("question.store"), {
        preserveState: true,
        forceFormData: true,
        onSuccess: () => {
            modalCreate.value.closeModal();
        },
    });
}

const formEditQuestion = useForm({
    id: null,
    pertanyaan: "",
    quiz_id: "",
    point: 1,
});
function updateQuestion(q, i) {
    formEditQuestion.id = q.id;
    formEditQuestion.pertanyaan = q.pertanyaan;
    formEditQuestion.quiz_id = q.quiz_id;
    formEditQuestion.point = q.points;

    formEditQuestion.put(route("question.update", q.id), {
        onSuccess: () => {
            modalEdit.value[i].closeModal();
        },
    });
}

function destroyQuestion(id) {
    Swal.fire({
        title: "Apakah kamu yakin?",
        text: "data yang dihapus tidak bisa dikembalikan!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Hapus",
    }).then((result) => {
        if (result.isConfirmed) {
            formEditQuestion.id = id;
            formEditQuestion.delete(route("question.destroy", id));
        }
    });
}
</script>
