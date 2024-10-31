<template>
    <Layout title="Profile">
        <div>
            <div class="ms-24">
                <div class="mb-10 mt-5">
                    <form
                        @submit.prevent="updatePicture()"
                        method="post"
                        enctype="multipart/form-data"
                    >
                        <div>
                            <img
                                :src="
                                    userForm.preview
                                        ? userForm.preview
                                        : imageUrl + user.picture
                                "
                                alt="profile picture"
                                class="w-36 rounded-full mb-1 border-2 border-gray-500"
                            />
                        </div>
                        <div>
                            <input
                                class="text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                id="small_size"
                                type="file"
                                @change="changePicture($event)"
                            />
                            <FwbButton size="sm" type="submit" class="ml-2"
                                >Ganti</FwbButton
                            >
                        </div>
                        <small class="text-red-500">{{
                            userForm.errors.picture
                        }}</small>
                    </form>
                </div>
                <div class="mb-12">
                    <div class="mb-3">
                        <h2>
                            {{ user.name }}
                            <span class="text-gray-400">{{
                                user.username
                            }}</span>
                        </h2>
                        <h5>
                            {{ user.email }}
                        </h5>
                    </div>

                    <small class="text-gray-700"
                        >Bergabung pada
                        {{
                            Intl.DateTimeFormat("id", {
                                day: "numeric",
                                month: "long",
                                year: "numeric",
                            }).format(new Date(user.created_at))
                        }}</small
                    >
                </div>
            </div>
        </div>
    </Layout>
</template>

<script setup>
import { FwbButton, FwbInput } from "flowbite-vue";
import Layout from "../../../Layouts/Layout.vue";
import { useForm, usePage } from "@inertiajs/vue3";
defineProps({
    user: Object,
});
const page = usePage();
const imageUrl = "/storage/picture/";
const userForm = useForm({
    picture: null,
    preview: null,
    _method: "put",
});

function changePicture(e) {
    userForm.picture = e.target.files[0];
    userForm.preview = URL.createObjectURL(e.target.files[0]);
}

function updatePicture() {
    userForm.post(route("user.update.picture"), {
        forceFormData: true,
    });
}
</script>
