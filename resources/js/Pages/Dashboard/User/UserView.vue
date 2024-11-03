<template>
    <DashboardLayout title="User Dashboard">
        <div class="space-y-3">
            <div>
                <h2>Users</h2>
            </div>
            <div>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table
                        class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
                    >
                        <thead
                            class="text-xs text-gray-700 uppercase dark:text-gray-400"
                        >
                            <tr>
                                <th
                                    scope="col"
                                    class="px-6 py-3 bg-gray-50 dark:bg-gray-800"
                                >
                                    No.
                                </th>
                                <th scope="col" class="px-6 py-3">Name</th>
                                <th
                                    scope="col"
                                    class="px-6 py-3 bg-gray-50 dark:bg-gray-800"
                                >
                                    Username
                                </th>
                                <th scope="col" class="px-6 py-3">Email</th>
                                <th scope="col" class="px-6 py-3">Role</th>
                                <th scope="col" class="px-6 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="(user, i) in users.data"
                                class="border-b border-gray-200 dark:border-gray-700"
                            >
                                <th
                                    scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800"
                                >
                                    {{ i + 1 }}
                                </th>
                                <td class="px-6 py-4">{{ user.name }}</td>
                                <td
                                    class="px-6 py-4 bg-gray-50 dark:bg-gray-800"
                                >
                                    {{ user.username }}
                                </td>
                                <td class="px-6 py-4">{{ user.email }}</td>
                                <td class="px-6 py-4 font-semibold">
                                    {{ user.role }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex space-x-1">
                                        <Modal
                                            ref="modalEdit"
                                            buttonType="Edit"
                                            position="center"
                                        >
                                            <template #header
                                                >Edit User
                                                {{ user.username }}</template
                                            >
                                            <template #body>
                                                <form
                                                    action=""
                                                    @submit.prevent="
                                                        editUser(user, i)
                                                    "
                                                    method="post"
                                                >
                                                    <div class="mb-2">
                                                        <FwbInput
                                                            type="text"
                                                            label="Username"
                                                            v-model="
                                                                user.username
                                                            "
                                                        ></FwbInput>
                                                    </div>
                                                    <div class="mb-2">
                                                        <FwbInput
                                                            type="text"
                                                            label="Name"
                                                            v-model="user.name"
                                                        ></FwbInput>
                                                    </div>
                                                    <div class="mb-3">
                                                        <FwbSelect
                                                            label="Pilih Kategori"
                                                            Placeholder="Pilih Kategori"
                                                            :options="
                                                                roleOption
                                                            "
                                                            v-model="
                                                                user.role_id
                                                            "
                                                        ></FwbSelect>
                                                    </div>
                                                    <FwbButton
                                                        type="submit"
                                                        size="sm"
                                                    >
                                                        Update
                                                    </FwbButton>
                                                </form>
                                            </template>
                                        </Modal>
                                        <FwbButton
                                            size="sm"
                                            color="red"
                                            @click="deleteUser(user.id)"
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
import { FwbButton, FwbInput, FwbSelect } from "flowbite-vue";
import DashboardLayout from "../../../Layouts/DashboardLayout.vue";
import { usePage, useForm } from "@inertiajs/vue3";
import Modal from "../../../Components/Modal.vue";
import { ref } from "vue";
import Swal from "sweetalert2";
defineProps({
    users: Object,
});
const page = usePage({});
const roleOption = [];
page.props.roles.forEach((element) => {
    roleOption.push({
        name: element.nama_role,
        value: element.id,
    });
});

const formEditUser = useForm({
    username: null,
    name: null,
    role_id: null,
    id: null,
});
const modalEdit = ref(null);
function editUser(user, index) {
    (formEditUser.username = user.username),
        (formEditUser.name = user.name),
        (formEditUser.role_id = user.role_id);
    formEditUser.id = user.id;

    formEditUser.put(route("user.update", user.id), {
        preserveState: true,
        onSuccess: () => {
            modalEdit.value[index].closeModal();
        },
    });
}

function deleteUser(id) {
    formEditUser.id = id;

    Swal.fire({
        title: "Apakah kamu yakin ?",
        text: "kamu akan segera menghapus data ini",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Hapus!",
    }).then((result) => {
        if (result.isConfirmed) {
            formEditUser.delete(route("user.destroy", id), {
                onSuccess: () => {
                    Swal.fire({
                        title: "Good job!",
                        text: "Data sudah terhapus!",
                        icon: "success",
                    });
                },
            });
        }
    });
}
</script>
