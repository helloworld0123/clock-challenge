<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Clock from "@/Components/Clock.vue";
import ClockForm from "@/Components/ClockForm.vue";
import { Head } from "@inertiajs/vue3";
import dayjs from "dayjs";
import { computed, ref } from "vue";

const showUpdateForm = ref(false);
const timeToUpdate = ref(null);
function editTime(time) {
    showUpdateForm.value = true;
    timeToUpdate.value = time;
}
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <Clock @edit="editTime" />
        </div>

        <div v-if="showUpdateForm" class="py-12">
            <ClockForm
                :timeToUpdate="timeToUpdate"
                @cancel="showUpdateForm = false"
            />
        </div>
    </AuthenticatedLayout>
</template>
