<template>
    <DashboardLayout title="Category">
        <div class="my-3">
            <h2>Category Quiz</h2>
        </div>
        <div>
            <div class="mb-3">
                <Modal ref="modalCreate">
                    <template #header> Create Category Quiz </template>
                    <template #body>
                        <form
                            action=""
                            @submit.prevent="createCategory()"
                            method="post"
                            class="space-y-3"
                        >
                            <div>
                                <FwbInput
                                    label="Nama Kategori"
                                    type="text"
                                    v-model="formCategory.nama_kategori"
                                ></FwbInput>
                                <small class="text-red-500">{{
                                    formCategory.errors.nama_kategori
                                }}</small>
                            </div>
                            <FwbButton size="sm">Submit</FwbButton>
                        </form>
                    </template>
                </Modal>
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
                            <th scope="col" class="px-6 py-3">Nama</th>
                            <th scope="col" class="px-6 py-3">Jumlah</th>
                            <th scope="col" class="px-6 py-3">
                                Tanggal dibuat
                            </th>
                            <th scope="col" class="px-6 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(c, i) in categories"
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                        >
                            <th
                                scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                            >
                                {{ i + 1 }}
                            </th>
                            <td class="px-6 py-4">{{ c.nama_kategori }}</td>
                            <td class="px-6 py-4">{{ c.quizzes.length }}</td>
                            <td class="px-6 py-4">
                                {{
                                    Intl.DateTimeFormat("id", {
                                        day: "2-digit",
                                        month: "short",
                                        year: "numeric",
                                    }).format(new Date(c.created_at))
                                }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-x-2">
                                    <Modal ref="modal" buttonType="Edit">
                                        <template #header
                                            >Edit Category</template
                                        >
                                        <template #body>
                                            <form
                                                class="space-y-3"
                                                action=""
                                                @submit.prevent="
                                                    editCategory(c, i)
                                                "
                                                method="post"
                                            >
                                                <div>
                                                    <FwbInput
                                                        label="Nama Kategori"
                                                        type="text"
                                                        v-model="
                                                            c.nama_kategori
                                                        "
                                                    ></FwbInput>
                                                    <small
                                                        class="text-red-500"
                                                        >{{
                                                            formCategory.errors
                                                                .nama_kategori
                                                        }}</small
                                                    >
                                                </div>
                                                <FwbButton size="sm"
                                                    >Update</FwbButton
                                                >
                                            </form>
                                        </template>
                                    </Modal>
                                    <FwbButton
                                        color="red"
                                        size="sm"
                                        @click="destroyCategory(c.id)"
                                        >Delete</FwbButton
                                    >
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </DashboardLayout>
</template>

<script setup>
import DashboardLayout from "../../../Layouts/DashboardLayout.vue";
import { FwbButton, FwbInput } from "flowbite-vue";
import Modal from "../../../Components/Modal.vue";
import { useForm, usePage } from "@inertiajs/vue3";
import { ref } from "vue";
import Swal from "sweetalert2";
defineProps({
    categories: Object,
});

const modal = ref(null);
const modalCreate = ref(null);

const formCategory = useForm({
    id: null,
    nama_kategori: null,
});

function createCategory() {
    formCategory.post(route("category.store"), {
        onSuccess: () => {
            modalCreate.value.closeModal();
        },
        onFinish: () => {
            formCategory.reset("nama_kategori");
        },
    });
}

function editCategory(category, index) {
    formCategory.id = category.id;
    formCategory.nama_kategori = category.nama_kategori;

    formCategory.put(route("category.update", category.id), {
        preserveState: true,
        onSuccess: () => {
            modal.value[index].closeModal();
        },
    });
}

function destroyCategory(id) {
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
            formCategory.id = id;
            formCategory.delete(route("category.destroy", id));
        }
    });
}
</script>
