<template>
    <fwb-footer class="border-t">
        <fwb-footer-copyright
            by="Ferdinand™"
            href="/"
            copyright-message="All Rights Reserved."
        />
        <fwb-footer-link-group>
            <fwb-footer-link href="#"> About </fwb-footer-link>
            <fwb-footer-link href="#"> Privacy Policy </fwb-footer-link>
            <fwb-footer-link href="#"> Licensing </fwb-footer-link>
            <fwb-footer-link href="#"> Contact </fwb-footer-link>
        </fwb-footer-link-group>
    </fwb-footer>
</template>

<script setup>
import {
    FwbFooter,
    FwbFooterCopyright,
    FwbFooterLink,
    FwbFooterLinkGroup,
} from "flowbite-vue";
</script>
