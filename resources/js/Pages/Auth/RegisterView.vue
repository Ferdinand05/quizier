<template>
    <Layout title="Register">
        <section class="dark:bg-gray-900">
            <div
                class="flex flex-col items-center justify-center px-6 py-8 mx-auto mb-14 lg:py-0"
            >
                <a
                    href="#"
                    class="flex items-center text-2xl font-semibold text-gray-900 dark:text-white"
                >
                    <img
                        class="w-24 h-24 mr-2"
                        src="../../../../public/img/logo.png"
                        alt="logo"
                    />
                </a>
                <div
                    class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700"
                >
                    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                        <h1
                            class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white"
                        >
                            Daftarkan dirimu
                        </h1>
                        <form class="space-y-4 md:space-y-6" action="#">
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
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="name@company.com"
                                />
                            </div>
                            <div>
                                <label
                                    for="username"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    >Username</label
                                >
                                <input
                                    type="text"
                                    name="username"
                                    id="username"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="John doe"
                                />
                            </div>
                            <div>
                                <label
                                    for="name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    >Name</label
                                >
                                <input
                                    type="text"
                                    name="name"
                                    id="name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Name"
                                />
                            </div>
                            <div
                                class="grid grid-cols-1 md:grid-cols-2 md:gap-x-2"
                            >
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
                                        placeholder="••••••••"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    />
                                </div>
                                <div>
                                    <label
                                        for="confirm-password"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                        >Konfirmasi password</label
                                    >
                                    <input
                                        type="confirm-password"
                                        name="confirm-password"
                                        id="confirm-password"
                                        placeholder="••••••••"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    />
                                </div>
                            </div>
                            <button
                                type="submit"
                                class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            >
                                Daftar
                            </button>
                            <p
                                class="text-sm font-light text-gray-500 dark:text-gray-400"
                            >
                                Sudah punya akun?
                                <Link
                                    :href="route('login')"
                                    class="font-medium text-blue-600 hover:underline dark:text-blue-500"
                                    >Login</Link
                                >
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </Layout>
</template>

<script setup>
import Layout from "../../Layouts/Layout.vue";
</script>
