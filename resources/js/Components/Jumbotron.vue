<template>
    <div class="mt-16">
        <fwb-jumbotron
            header-text="Siap uji pengetahuanmu?"
            sub-text="Pilih kategori favoritmu, jawab pertanyaannya, dan lihat seberapa jauh kamu bisa melangkah!"
        >
            <div
                class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0"
            >
                <Link
                    :href="route('quiz.view')"
                    class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900"
                >
                    Kerjakan Quiz
                    <svg
                        class="w-3.5 h-3.5 ml-2 rtl:rotate-180"
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
            </div>
        </fwb-jumbotron>
    </div>
</template>

<script setup>
import { FwbJumbotron } from "flowbite-vue";
</script>
