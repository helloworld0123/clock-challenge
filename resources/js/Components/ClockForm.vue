<script setup>
import InputLabel from "@/Components/InputLabel.vue";
import { useForm } from "@inertiajs/vue3";
import dayjs from "dayjs";
import { ref } from "vue";

// Define the cancel event
const emit = defineEmits(["cancel"]);

// Define props: timeToUpdate is the current time the Set time was clicked
const props = defineProps({
    timeToUpdate: Object,
});

// Define reactive variables
// hour and minute are the values from the current time
const hour = ref(dayjs(props.timeToUpdate).format("HH"));
const minute = ref(dayjs(props.timeToUpdate).format("mm"));

// Define the form that will be submitted to the api using useForm from Inertia
const form = useForm({
    hourOffset: 0,
    minuteOffset: 0,
});

// Define the hours and minutes arrays to be used for the select fields. Padding it with 0 ex: 00, 01, 02, etc.
const hours = Array.from(Array(24).keys()).map((hour) =>
    hour.toString().padStart(2, "0")
);

const minutes = Array.from(Array(60).keys()).map((hour) =>
    hour.toString().padStart(2, "0")
);

// Submit the form to the api
// The hourOffset and minuteOffset are calculated by subtracting the current time from the time selected in the form
function submit() {
    form.transform((data) => ({
        hourOffset: dayjs().hour(hour.value).diff(dayjs(), "hour"),
        minuteOffset: dayjs().minute(minute.value).diff(dayjs(), "minute"),
    })).post("/update-time");
}
</script>

<template>
    <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
        <form @submit.prevent="submit">
            <div
                class="flex flex-row justify-between bg-white overflow-hidden shadow-sm sm:rounded-lg items-center"
            >
                <div class="p-6 w-full flex flex-row justify-between">
                    <div class="flex flex-row gap-4">
                        <div>
                            <InputLabel for="hour-field">Hour</InputLabel>
                            <select
                                v-model="hour"
                                id="hour-field"
                                class="py-3 px-4 pr-9 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500"
                            >
                                <option v-for="hour in hours" :key="hour">
                                    {{ hour }}
                                </option>
                            </select>
                        </div>
                        <div>
                            <InputLabel for="minute-field">Minutes</InputLabel>
                            <select
                                v-model="minute"
                                id="minute-field"
                                class="py-3 px-4 pr-9 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500"
                            >
                                <option v-for="minute in minutes" :key="minute">
                                    {{ minute }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="flex flex-row gap-4 items-center">
                        <button
                            type="submit"
                            class="py-3 px-4 inline-flex justify-center items-center gap-2 rounded-md border border-transparent font-semibold bg-blue-500 text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all text-sm dark:focus:ring-offset-gray-800"
                        >
                            Save

                            <svg
                                class="w-6 h-auto"
                                width="17"
                                height="16"
                                viewBox="0 0 24 24"
                                fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M17 3H5C3.89 3 3 3.9 3 5V19C3 20.1 3.89 21 5 21H19C20.1 21 21 20.1 21 19V7L17 3M19 19H5V5H16.17L19 7.83V19M12 12C10.34 12 9 13.34 9 15S10.34 18 12 18 15 16.66 15 15 13.66 12 12 12M6 6H15V10H6V6Z"
                                />
                            </svg>
                        </button>

                        <button
                            @click="emit('cancel')"
                            type="button"
                            class="py-3 px-4 inline-flex justify-center items-center gap-2 rounded-md border border-transparent font-semibold text-blue-500 hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all text-sm"
                        >
                            Cancel

                            <svg
                                class="w-6 h-auto"
                                width="17"
                                height="16"
                                viewBox="0 0 24 24"
                                fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M19,6.41L17.59,5L12,10.59L6.41,5L5,6.41L10.59,12L5,17.59L6.41,19L12,13.41L17.59,19L19,17.59L13.41,12L19,6.41Z"
                                />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>
