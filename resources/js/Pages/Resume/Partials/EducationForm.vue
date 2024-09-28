<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
    modelValue: {
        type: Object,
        required: true,
        default: () => ({
            institution: '',
            degree: '',
            field_of_study: '',
            start_date: '',
            end_date: ''
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
    return props.errors && props.errors[`education.${props.index}.${field}`];
};
</script>

<template>
    <div class="mt-6 space-y-6">
        <!-- Institution -->
        <div>
            <InputLabel for="institution" value="Institution" />
            <TextInput id="institution" type="text" class="mt-1 block w-full" v-model="modelValue.institution"
                @input="updateField('institution', $event.target.value)" required />
            <InputError :message="getFieldError('institution')" class="mt-2" />
        </div>

        <!-- Degree -->
        <div>
            <InputLabel for="degree" value="Degree" />
            <TextInput id="degree" type="text" class="mt-1 block w-full" v-model="modelValue.degree"
                @input="updateField('degree', $event.target.value)" required />
            <InputError :message="getFieldError('degree')" class="mt-2" />
        </div>

        <!-- Field of Study -->
        <div>
            <InputLabel for="field_of_study" value="Field of Study" />
            <TextInput id="field_of_study" type="text" class="mt-1 block w-full" v-model="modelValue.field_of_study"
                @input="updateField('field_of_study', $event.target.value)" required />
            <InputError :message="getFieldError('field_of_study')" class="mt-2" />
        </div>

        <!-- Start Date -->
        <div>
            <InputLabel for="start_date" value="Start Date" />
            <TextInput id="start_date" type="date" class="mt-1 block w-full" v-model="modelValue.start_date"
                @input="updateField('start_date', $event.target.value)" required />
            <InputError :message="getFieldError('start_date')" class="mt-2" />
        </div>

        <!-- End Date -->
        <div>
            <InputLabel for="end_date" value="End Date" />
            <TextInput id="end_date" type="date" class="mt-1 block w-full" v-model="modelValue.end_date"
                @input="updateField('end_date', $event.target.value)" required />
            <InputError :message="getFieldError('end_date')" class="mt-2" />
        </div>
    </div>
</template>