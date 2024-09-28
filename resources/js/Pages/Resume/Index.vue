<script setup>
import { watch } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import ResumeTitleForm from './Partials/ResumeTitleForm.vue';
import PersonalDetailsForm from './Partials/PersonalDetailsForm.vue';
import EmploymentHistory from './Partials/EmploymentHistory.vue';
import Education from './Partials/Education.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const form = useForm({
    resumeTitle: {
        title: ''
    },
    personalDetails: {
        first_name: '',
        last_name: '',
        email: '',
        phone: '',
        address: ''
    },
    employmentHistory: [
        { job_title: '', company: '', start_date: '', end_date: '', description: '' }
    ],
    education: [
        { institution: '', degree: '', field_of_study: '', start_date: '', end_date: '' }
    ],
    processing: false,
});

// Watchers to clear errors
watch(() => form.employmentHistory, (newValue) => {
    if (newValue.length > 0) {
        // Clear error if there's at least one entry
        delete form.errors.employmentHistory;
    }
}, { deep: true });

watch(() => form.education, (newValue) => {
    if (newValue.length > 0) {
        // Clear error if there's at least one entry
        delete form.errors.education;
    }
}, { deep: true });

const submitForm = () => {
    console.log('Form data before submission:', form);

    form.post(route('resume.store'), {
        onSuccess: () => {
            console.log('Form submitted successfully');
        },
        onError: (errors) => {
            console.error('Form submission errors:', errors);
        },
        onFinish: () => {
            console.log('Form submission finished');
        }
    });
};
</script>

<template>

    <Head title="Resume details" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Resume details</h2>
        </template>

        <div class="py-12">
            <form @submit.prevent="submitForm" class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <!-- Resume title -->
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <ResumeTitleForm v-model="form.resumeTitle" :errors="form.errors" />
                </div>

                <!-- Personal Details Section -->
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <PersonalDetailsForm v-model="form.personalDetails" :errors="form.errors" />
                </div>

                <!-- Work Experience Section -->
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <EmploymentHistory v-model="form.employmentHistory" :errors="form.errors" />
                    <!-- Error message for empty employment history -->
                    <div v-if="form.errors.employmentHistory" class="text-red-500 mt-4">
                        {{ form.errors.employmentHistory }}
                    </div>
                </div>

                <!-- Education Section -->
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <Education v-model="form.education" :errors="form.errors" />
                    <!-- Error message for empty education history -->
                    <div v-if="form.errors.education" class="text-red-500 mt-4">
                        {{ form.errors.education }}
                    </div>
                </div>

                <PrimaryButton :loading="form.processing" type="submit">
                    Save and Build CV
                </PrimaryButton>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
