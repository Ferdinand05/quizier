<template>
    <DashboardLayout title="Option Page">
        <h2>Options</h2>
        <div class="space-y-3 mt-3">
            <div>
                <Modal ref="modalCreate">
                    <template #header>Create new Options</template>
                    <template #body>
                        <form action="" method="post"></form>
                    </template>
                </Modal>
            </div>
            <div></div>
        </div>
    </DashboardLayout>
</template>

<script setup>
import DashboardLayout from "../../../Layouts/DashboardLayout.vue";
import Modal from "../../../Components/Modal.vue";
</script>
