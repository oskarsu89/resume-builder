<script setup>
import SecondaryButton from '@/Components/SecondaryButton.vue';
import EmploymentHistoryForm from './EmploymentHistoryForm.vue';
import { ref, watch } from 'vue';

const props = defineProps({
    modelValue: Array,
    errors: Object
});

const emit = defineEmits(['update:modelValue']);

// Ensure reactive data for employment history
const employmentHistory = ref(props.modelValue);

// Watch for changes and emit back to parent
watch(employmentHistory, (newValue) => {
    emit('update:modelValue', newValue);
}, { deep: true });

const addEmployment = () => {
    employmentHistory.value.push({
        job_title: '',
        company: '',
        start_date: '',
        end_date: '',
        description: ''
    });
};

const removeEmployment = (index) => {
    employmentHistory.value.splice(index, 1);
};
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Employment History</h2>
        </header>

        <div v-for="(employment, index) in employmentHistory" :key="index">
            <EmploymentHistoryForm v-model="employmentHistory[index]" :errors="errors" :index="index" />

            <div class="mt-2 text-right">
                <button @click="removeEmployment(index)" class="text-red-600 hover:text-red-900 rounded-md px-3 py-2 border border-red-400 transition hover:bg-red-100 hover:text-red-700 focus:outline-none focus-visible:ring-[#FF2D20]">
                    Remove employment
                </button>
            </div>
        </div>

        <SecondaryButton @click="addEmployment" class="mt-6">
            Add employment
        </SecondaryButton>
    </section>
</template>
