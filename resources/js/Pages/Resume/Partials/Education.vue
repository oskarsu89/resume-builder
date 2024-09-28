<script setup>
import SecondaryButton from '@/Components/SecondaryButton.vue';
import EducationForm from './EducationForm.vue';
import { ref, watch } from 'vue';

const props = defineProps({
    modelValue: Array,
    errors: Object
});

const emit = defineEmits(['update:modelValue']);

// Ensure reactive data for education history
const education = ref(props.modelValue);

// Watch for changes and emit back to parent
watch(education, (newValue) => {
    emit('update:modelValue', newValue);
}, { deep: true });

const addEducation = () => {
    education.value.push({
        institution: '',
        degree: '',
        field_of_study: '',
        start_date: '',
        end_date: ''
    });
};

const removeEducation = (index) => {
    education.value.splice(index, 1);
};
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Education</h2>
        </header>

        <div v-for="(edu, index) in education" :key="index">
            <EducationForm v-model="education[index]" :errors="errors" :index="index" />

            <div class="mt-2 text-right">
                <button @click="removeEducation(index)"
                    class="text-red-600 hover:text-red-900 rounded-md px-3 py-2 border border-red-400 transition hover:bg-red-100 hover:text-red-700 focus:outline-none focus-visible:ring-[#FF2D20]">
                    Remove education
                </button>
            </div>
        </div>

        <SecondaryButton @click="addEducation" class="mt-6">
            Add education
        </SecondaryButton>
    </section>
</template>