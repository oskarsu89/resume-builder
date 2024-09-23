<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    resumes: Array
});

const hasResumes = computed(() => props.resumes.length > 0);
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
                            <h3 class="text-lg font-bold mb-4">Your Resumes:</h3>
                            <ul>
                                <li v-for="resume in props.resumes" :key="resume.id" class="mb-2">
                                    {{ resume.title }}
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
