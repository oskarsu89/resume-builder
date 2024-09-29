<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DangerButton from '@/Components/DangerButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { Head, router } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    resumes: Array
});

const hasResumes = computed(() => props.resumes.length > 0);

const deleteResume = (resume) => {
    if (confirm('Are you sure you want to delete this resume?')) {
        router.delete(route('resume.destroy', resume.id), {
            onSuccess: () => {
                console.log('Resume deleted successfully');
            },
            onError: (errors) => {
                console.error(errors);
            }
        });
    }
};

const editResume = (resume) => {
    router.visit(route('resume.edit', resume.id));
};

const downloadResume = (resume) => {
    window.location.href = route('resume.download', resume.id);
};
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <!-- Display resumes if available -->
                        <template v-if="hasResumes">
                            <h2 class="text-xl font-bold mb-4">Your Resumes:</h2>
                            <ul>
                                <li v-for="resume in props.resumes" :key="resume.id"
                                    class="mb-2 flex justify-between items-center">
                                    <h3 class="font-semibold text-l text-gray-800 leading-tight">{{ resume.title }}</h3>
                                    <div class="flex space-x-4 mt-2">
                                        <!-- Edit Button -->
                                        <SecondaryButton @click="editResume(resume)">
                                            Edit
                                        </SecondaryButton>

                                        <!-- Edit Button -->
                                        <PrimaryButton @click="downloadResume(resume)">
                                            Download
                                        </PrimaryButton>

                                        <!-- Delete Button -->
                                        <DangerButton @click="deleteResume(resume)">
                                            Delete
                                        </DangerButton>
                                    </div>
                                </li>
                            </ul>
                        </template>

                        <!-- Fallback if no resumes are available -->
                        <template v-else>
                            <p>No resumes have been created yet.</p>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>