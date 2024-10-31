<template>
    <fwb-navbar>
        <template #logo>
            <fwb-navbar-logo image-url="/img/logo.png" link="#">
                Quizier
            </fwb-navbar-logo>
        </template>
        <template #default="{ isShowMenu }">
            <fwb-navbar-collapse :is-show-menu="isShowMenu">
                <fwb-navbar-link link="#">
                    <Link :href="route('home')"> Home </Link>
                </fwb-navbar-link>
                <fwb-navbar-link link="#">
                    <Link :href="route('quiz.view')"> Quiz </Link>
                </fwb-navbar-link>
                <fwb-navbar-link
                    link="#"
                    v-if="!$page.props.auth.user.username"
                >
                    <Link :href="route('login')"> Login </Link>
                </fwb-navbar-link>
                <fwb-navbar-link
                    link="#"
                    v-if="!$page.props.auth.user.username"
                >
                    <Link :href="route('register')"> Register </Link>
                </fwb-navbar-link>
                <fwb-navbar-link
                    :link="route('dashboard')"
                    v-if="
                        $page.props.auth.user.role_id == 1 ||
                        $page.props.auth.user.role_id == 2
                    "
                >
                    Dashboard
                </fwb-navbar-link>
                <fwb-navbar-link link="#" v-if="$page.props.auth.user.username">
                    <Link
                        :href="
                            route(
                                'user.profile',
                                $page.props.auth.user.username
                            )
                        "
                    >
                        {{ $page.props.auth.user.username }}
                    </Link>
                </fwb-navbar-link>
                <fwb-navbar-link link="#" v-if="$page.props.auth.user.username">
                    <Link as="button" method="post" :href="route('logout')">
                        Logout
                    </Link>
                </fwb-navbar-link>
            </fwb-navbar-collapse>
        </template>
    </fwb-navbar>
</template>

<script setup>
import {
    FwbNavbar,
    FwbNavbarCollapse,
    FwbNavbarLink,
    FwbNavbarLogo,
} from "flowbite-vue";
</script>
