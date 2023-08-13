<script setup>
import { computed, ref } from "vue";
import dayjs from "dayjs";
import { usePage } from "@inertiajs/vue3";

// Define the edit event, this will be emited when the Set time button is clicked
const emit = defineEmits(["edit"]);

// Define the user computed property from the usePage Inertia helper
const user = computed(() => {
    return usePage().props.auth.user;
});

// Define the current time by adding the offset from the users previously saved time or 0 for the default value
const currentTime = ref(
    dayjs()
        .add(user.value.hourOffset, "hour")
        .add(user.value.minuteOffset, "minute")
);

// Update the current time every second while adding the offset, to make sure it shows the time set by the user
function updateCurrentTime() {
    currentTime.value = dayjs()
        .add(user.value.hourOffset, "hour")
        .add(user.value.minuteOffset, "minute");
}
// Update the current time every second
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
