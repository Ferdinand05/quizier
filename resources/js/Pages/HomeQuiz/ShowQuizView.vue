<template>
    <Head title="Quiz"> </Head>
    <div class="m-5 mb-10">
        <div class="flex justify-between">
            <FwbButton color="red" @click="back()">Kembali</FwbButton>
            <div>
                <vue-countdown
                    @end="finishQuiz()"
                    :time="time"
                    v-slot="{ days, hours, minutes, seconds }"
                    >Waktu : {{ minutes }} Menit, {{ seconds }} Detik.
                </vue-countdown>
            </div>
        </div>
        <div class="mx-10 md:mx-36 space-y-3 mt-12">
            <div class="border-b py-3">
                <h5 class="font-bold">{{ quiz.data.nama_quiz }}</h5>
                <small>{{ quiz.data.deskripsi }}</small>
            </div>
            <!-- parent soal -->

            <div class="space-y-3 pt-2">
                <!-- soal -->
                <div v-for="(soal, index) in questions.data" :key="soal.id">
                    <!-- $startIndex = ($currentPage - 1) * $itemsPerPage + 1; -->
                    <div class="flex gap-x-1">
                        <span>
                            {{
                                (questions.meta.current_page - 1) *
                                    questions.meta.per_page +
                                1
                            }}.
                        </span>
                        <div v-html="soal.pertanyaan"></div>
                    </div>
                    <!-- pilihan ganda -->
                    <div>
                        <FwbRadio
                            class="cursor-pointer"
                            v-for="(opsi, index) in soal.options"
                            :key="opsi.index"
                            @change="
                                addAnswer(soal.id, opsi.id, quiz.data.ulid)
                            "
                            :name="soal.id"
                            :label="opsi.jawaban"
                            :value="opsi.id"
                            v-model="userAnswer[soal.id]"
                            :disabled="formAnswer.processing"
                        >
                        </FwbRadio>
                        <span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="flex justify-around">
            <!-- Previous Button -->
            <Link
                :href="questions.links?.prev"
                :class="
                    questions.links?.prev
                        ? 'flex items-center justify-center px-3 h-8 text-sm font-semibold text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white'
                        : 'flex items-center justify-center px-3 h-8 text-sm font-medium text-gray-400 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-gray-400 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-500 dark:hover:text-white'
                "
            >
                < Sebelumnya
            </Link>

            <FwbButton
                type="submit"
                color="green"
                v-if="questions.meta.current_page == questions.meta.last_page"
                @click="submitQuiz()"
                >Selesai</FwbButton
            >

            <!-- Next Button -->
            <Link
                :href="questions.links.next"
                :class="
                    questions.links.next
                        ? 'flex items-center justify-center px-3 h-8 text-sm font-semibold text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white'
                        : 'flex items-center justify-center px-3 h-8 text-sm font-medium text-gray-400 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-gray-400 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-500 dark:hover:text-white'
                "
            >
                Selanjutnya >
            </Link>
        </div>
    </div>
    <AlertMessage v-show="$page.props.flash.message">
        {{ $page.props.flash.message }}
    </AlertMessage>
    <div class="absolute bottom-0 left-0 right-0">
        <Footer></Footer>
    </div>
</template>

<script setup>
import { Head, router } from "@inertiajs/vue3";
import { useForm, usePage } from "@inertiajs/vue3";
import VueCountdown from "@chenfengyuan/vue-countdown";
import Footer from "../../Components/Footer.vue";
import AlertMessage from "../../Components/AlertMessage.vue";
import { computed, ref, onMounted } from "vue";
import { FwbButton, FwbRadio } from "flowbite-vue";
import Swal from "sweetalert2";
defineProps({
    quiz: Object,
    questions: Object,
    userAnswer: Object,
});

const page = usePage({});
console.log(page.props.userAnswer);
const formAnswer = useForm({
    question_id: null,
    option_id: null,
    quiz_id: null,
});

function addAnswer(question_id, option_id, quiz_id) {
    formAnswer.question_id = question_id;
    formAnswer.option_id = option_id;
    formAnswer.quiz_id = quiz_id;

    formAnswer.post(route("add.answer"), {
        preserveScroll: true,
        preserveState: true,
    });
}

function back() {
    Swal.fire({
        title: "Apakah anda yakin ?",
        text: "Apakah anda yakin akan keluar dari quiz ? ",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Keluar",
    }).then((result) => {
        if (result.isConfirmed) {
            router.visit(route("quiz.view"));
        }
    });
}

const time = page.props.quiz.data.durasi * 60 * 1000;

const formFinishQuiz = useForm({
    quiz_id: page.props.quiz.data.ulid,
});

function submitQuiz() {
    Swal.fire({
        title: "Apakah anda yakin ?",
        text: "Pastikan soal selesai . Score akan segera ditampilkan",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Submit",
    }).then((result) => {
        if (result.isConfirmed) {
            finishQuiz();
        }
    });
}

function finishQuiz() {
    formFinishQuiz.post(route("quiz.finish"), {
        preserveScroll: true,
        preserveState: true,
    });
}
</script>
