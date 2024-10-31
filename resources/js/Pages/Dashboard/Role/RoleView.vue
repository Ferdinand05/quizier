<template>
    <DashboardLayout title="Role">
        <h2>Roles</h2>
        <div class="mt-3 space-y-3">
            <div>
                <Modal ref="modalCreate">
                    <template #header> Create new role </template>
                    <template #body>
                        <form
                            action=""
                            @submit.prevent="createRole()"
                            method="post"
                            class="space-y-3"
                        >
                            <div>
                                <FwbInput
                                    label="Nama Role"
                                    v-model="formRole.nama_role"
                                ></FwbInput>
                                <small class="text-red-500">{{
                                    formRole.errors.nama_role
                                }}</small>
                            </div>
                            <FwbButton>Create</FwbButton>
                        </form>
                    </template>
                </Modal>
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
                                <th scope="col" class="px-6 py-3">No.</th>
                                <th scope="col" class="px-6 py-3">Nama Role</th>
                                <th scope="col" class="px-6 py-3">
                                    Jumlah User
                                </th>
                                <th scope="col" class="px-6 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="(role, i) in roles"
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                            >
                                <th
                                    scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                >
                                    {{ i + 1 }}
                                </th>
                                <td class="px-6 py-4">{{ role.nama_role }}</td>
                                <td class="px-6 py-4">
                                    {{ role.users.length }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex gap-x-2">
                                        <FwbButton size="sm">Edit</FwbButton>
                                        <FwbButton color="red" size="sm"
                                            >Delete</FwbButton
                                        >
                                    </div>
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
import { FwbButton, FwbInput } from "flowbite-vue";
import { usePage, useForm } from "@inertiajs/vue3";
import { ref } from "vue";

defineProps({
    roles: Object,
});
const modalCreate = ref(null);
const formRole = useForm({
    nama_role: null,
});

function createRole() {
    formRole.post(route("role.store"), {
        onSuccess: () => {
            modalCreate.value.closeModal();
        },
    });
}
</script>
