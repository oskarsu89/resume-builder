<!-- resources/js/Pages/Resumes/Edit.vue -->
<script setup>
import { watch } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, router } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import PersonalDetailsForm from '@/Pages/Resume/Partials/PersonalDetailsForm.vue';
import EmploymentHistory from '@/Pages/Resume/Partials/EmploymentHistory.vue';
import Education from '@/Pages/Resume/Partials/Education.vue';

// Define form and populate with resume data
const props = defineProps({
    resume: Object,
});

const form = useForm({
    personalDetails: props.resume.personal_details || {
        first_name: '',
        last_name: '',
        email: '',
        phone: '',
        address: ''
    },
    employmentHistory: props.resume.employment_history || [
        { job_title: '', company: '', start_date: '', end_date: '', description: '' }
    ],
    education: props.resume.education || [
        { institution: '', degree: '', field_of_study: '', start_date: '', end_date: '' }
    ]
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

const updateResume = () => {
    form.put(route('resume.update', props.resume.id), {
        onSuccess: () => {
            console.log('Resume updated successfully');
        },
        onError: (errors) => {
            console.error(errors);
        },
        onFinish: () => {
            console.log('Update process finished');
        }
    });
};

const cancelResumeEdit = () => {
    router.visit(route('dashboard'))
};
</script>

<template>

    <Head title="Edit Resume" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Resume</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <!-- Personal Information -->
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <PersonalDetailsForm v-model="form.personalDetails" :errors="form.errors" />
                </div>

                <!-- Employment History -->
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <EmploymentHistory v-model="form.employmentHistory" :errors="form.errors" />
                    <!-- Error message for empty employment history -->
                    <div v-if="form.errors.employmentHistory" class="text-red-500 mt-4">
                        {{ form.errors.employmentHistory }}
                    </div>
                </div>

                <!-- Education History -->
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <Education v-model="form.education" :errors="form.errors" />
                    <!-- Error message for empty education history -->
                    <div v-if="form.errors.education" class="text-red-500 mt-4">
                        {{ form.errors.education }}
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex space-x-4 mt-6">
                    <PrimaryButton @click="updateResume" :loading="form.processing">
                        Update Resume
                    </PrimaryButton>
                    <SecondaryButton @click="cancelResumeEdit">
                        Cancel
                    </SecondaryButton>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>