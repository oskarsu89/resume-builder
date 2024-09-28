<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
    modelValue: {
        type: Object,
        required: true,
        default: () => ({
            job_title: '',
            company: '',
            start_date: '',
            end_date: '',
            description: ''
        })
    },
    errors: {
        type: Object,
        default: () => ({})
    },
    index: {
        type: Number,
        required: true
    }
});

const emit = defineEmits(['update:modelValue']);

// Function to handle input changes
const updateField = (field, value) => {
    emit('update:modelValue', { ...props.modelValue, [field]: value });
};

// Get specific error for the field
const getFieldError = (field) => {
    return props.errors && props.errors[`employmentHistory.${props.index}.${field}`];
};
</script>

<template>
    <div class="mt-6 space-y-6">
        <!-- Job Title -->
        <div>
            <InputLabel for="job_title" value="Job Title" />
            <TextInput id="job_title" type="text" class="mt-1 block w-full" v-model="modelValue.job_title"
                @input="updateField('job_title', $event.target.value)" required />
            <InputError :message="getFieldError('job_title')" class="mt-2" />
        </div>

        <!-- Company -->
        <div>
            <InputLabel for="company" value="Company" />
            <TextInput id="company" type="text" class="mt-1 block w-full" v-model="modelValue.company"
                @input="updateField('company', $event.target.value)" required />
            <InputError :message="getFieldError('company')" class="mt-2" />
        </div>

        <!-- Start Date -->
        <div>
            <InputLabel for="employment_start_date" value="Start Date" />
            <TextInput id="employment_start_date" type="date" class="mt-1 block w-full" v-model="modelValue.start_date"
                @input="updateField('start_date', $event.target.value)" required />
            <InputError :message="getFieldError('start_date')" class="mt-2" />
        </div>

        <!-- End Date -->
        <div>
            <InputLabel for="employment_end_date" value="End Date" />
            <TextInput id="employment_end_date" type="date" class="mt-1 block w-full" v-model="modelValue.end_date"
                @input="updateField('end_date', $event.target.value)" required />
            <InputError :message="getFieldError('end_date')" class="mt-2" />
        </div>

        <!-- Description -->
        <div>
            <InputLabel for="description" value="Description" />
            <TextInput id="description" class="mt-1 block w-full" v-model="modelValue.description"
                @input="updateField('description', $event.target.value)" rows="3" required />
            <InputError :message="getFieldError('description')" class="mt-2" />
        </div>
    </div>
</template>