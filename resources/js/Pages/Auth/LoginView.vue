<template>
    <Layout title="Login">
        <div>
            <section class="dark:bg-gray-900">
                <div
                    class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0"
                >
                    <Link
                        href="#"
                        class="flex items-center text-2xl font-semibold text-gray-900 dark:text-white"
                    >
                        <img
                            class="w-24 h-24 mr-2"
                            src="../../../../public/img/logo.png"
                            alt="logo"
                        />
                    </Link>
                    <div
                        class="w-full mb-14 bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700"
                    >
                        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                            <h1
                                class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white"
                            >
                                Sign in to your account
                            </h1>
                            <form
                                class="space-y-4 md:space-y-6"
                                action="#"
                                method="post"
                                @submit.prevent="login()"
                            >
                                <div>
                                    <label
                                        for="email"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                        >Email</label
                                    >
                                    <input
                                        type="email"
                                        name="email"
                                        id="email"
                                        v-model="formLogin.email"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="name@company.com"
                                    />
                                    <small class="text-red-500">{{
                                        formLogin.errors.email
                                    }}</small>
                                </div>
                                <div>
                                    <label
                                        for="password"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                        >Password</label
                                    >
                                    <input
                                        type="password"
                                        name="password"
                                        id="password"
                                        v-model="formLogin.password"
                                        placeholder="••••••••"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    />
                                    <small class="text-red-500">{{
                                        formLogin.errors.password
                                    }}</small>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-start">
                                        <div class="flex items-center h-5">
                                            <input
                                                id="remember"
                                                aria-describedby="remember"
                                                type="checkbox"
                                                class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800"
                                                v-model="formLogin.remember_me"
                                            />
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label
                                                for="remember"
                                                class="text-gray-500 dark:text-gray-300"
                                                >Remember me</label
                                            >
                                        </div>
                                    </div>
                                    <a
                                        href="#"
                                        class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500"
                                        >Lupa password?</a
                                    >
                                </div>
                                <div class="w-full text-center space-y-2">
                                    <button
                                        type="submit"
                                        class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                    >
                                        Login
                                    </button>
                                    <hr />
                                    <a
                                        :href="route('auth.redirect')"
                                        class="text-white bg-[#4285F4] hover:bg-[#4285F4]/90 focus:ring-4 focus:outline-none focus:ring-[#4285F4]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#4285F4]/55 me-2 mb-2"
                                    >
                                        <svg
                                            class="w-4 h-4 me-2"
                                            aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="currentColor"
                                            viewBox="0 0 18 19"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M8.842 18.083a8.8 8.8 0 0 1-8.65-8.948 8.841 8.841 0 0 1 8.8-8.652h.153a8.464 8.464 0 0 1 5.7 2.257l-2.193 2.038A5.27 5.27 0 0 0 9.09 3.4a5.882 5.882 0 0 0-.2 11.76h.124a5.091 5.091 0 0 0 5.248-4.057L14.3 11H9V8h8.34c.066.543.095 1.09.088 1.636-.086 5.053-3.463 8.449-8.4 8.449l-.186-.002Z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                        Sign in with Google
                                    </a>
                                </div>

                                <p
                                    class="text-sm font-light text-gray-500 dark:text-gray-400"
                                >
                                    Belum punya akun ?
                                    <Link
                                        :href="route('register')"
                                        class="font-medium text-blue-600 hover:underline dark:text-blue-500"
                                        >Daftar</Link
                                    >
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </Layout>
</template>

<script setup>
import Layout from "../../Layouts/Layout.vue";
import { useForm, usePage } from "@inertiajs/vue3";

const formLogin = useForm({
    email: null,
    password: null,
    remember_me: false,
});

function login() {
    formLogin.post(route("login.store"), {
        preserveScroll: true,
        preserveState: true,
    });
}
</script>
