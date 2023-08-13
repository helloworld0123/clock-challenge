<script setup>
import { computed, ref } from "vue";
import dayjs from "dayjs";
import { usePage } from "@inertiajs/vue3";

const emit = defineEmits(["edit"]);

const user = computed(() => {
    return usePage().props.auth.user;
});

const currentTime = ref(
    dayjs()
        .add(user.value.hourOffset, "hour")
        .add(user.value.minuteOffset, "minute")
);

function updateCurrentTime() {
    currentTime.value = dayjs()
        .add(user.value.hourOffset, "hour")
        .add(user.value.minuteOffset, "minute");
}

setInterval(updateCurrentTime, 1000);
</script>

<template>
    <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
        <div
            class="flex flex-row justify-between bg-white overflow-hidden shadow-sm sm:rounded-lg items-center"
        >
            <div class="p-6 font-bold text-3xl text-gray-900">
                {{ currentTime.format("HH:mm:ss") }}
            </div>
            <div class="p-6">
                <button
                    @click="emit('edit', dayjs())"
                    type="button"
                    class="py-1 px-2 inline-flex justify-center items-center gap-2 rounded-md border border-transparent font-semibold text-blue-500 hover:text-blue-700 focus:outline-none focus:ring-2 ring-offset-white focus:ring-blue-500 focus:ring-offset-2 transition-all text-sm"
                >
                    Set time
                </button>
            </div>
        </div>
    </div>
</template>
