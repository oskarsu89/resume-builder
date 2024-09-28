<script setup>
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
  modelValue: Object,
  errors: Object
});
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                Resume title
            </h2>
        </header>

        <div class="mt-6 space-y-6">
            <div>
                <TextInput
                    id="title"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="modelValue.title"
                    required
                    autofocus
                    autocomplete="title"
                />

                <InputError v-if="errors && errors['resumeTitle.title']" :message="errors['resumeTitle.title']" class="mt-2" />
            </div>
        </div>
    </section>
</template>
