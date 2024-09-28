<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
  modelValue: Object,
  errors: Object,
});
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                Personal details
            </h2>
        </header>

        <div class="mt-6 space-y-6">
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="modelValue.first_name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError v-if="errors && errors['personalDetails.first_name']" :message="errors['personalDetails.first_name']" class="mt-2" />
            </div>

            <div>
                <InputLabel for="surname" value="Surname" />

                <TextInput
                    id="surname"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="modelValue.last_name"
                    required
                    autofocus
                    autocomplete="surname"
                />

                <InputError v-if="errors && errors['personalDetails.last_name']" :message="errors['personalDetails.last_name']" class="mt-2" />
            </div>

            <div>
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="modelValue.email"
                    required
                    autocomplete="username"
                />

                <InputError v-if="errors && errors['personalDetails.email']" :message="errors['personalDetails.email']" class="mt-2" />
            </div>

            <div>
                <InputLabel for="phone" value="Phone" />

                <TextInput
                    id="phone"
                    type="tel"
                    class="mt-1 block w-full"
                    v-model="modelValue.phone"
                    required
                    autocomplete="tel"
                />

                <InputError v-if="errors && errors['personalDetails.phone']" :message="errors['personalDetails.phone']" class="mt-2" />
            </div>

            <div>
                <InputLabel for="address" value="Address" />

                <TextInput
                    id="address"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="modelValue.address"
                    required
                    autocomplete="address"
                />

                <InputError v-if="errors && errors['personalDetails.address']" :message="errors['personalDetails.address']" class="mt-2" />
            </div>
        </div>
    </section>
</template>
