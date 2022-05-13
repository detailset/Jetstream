<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import JetInput from '@/Jetstream/Input.vue';
import JetButton from '@/Jetstream/Button.vue';
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue';

const form = useForm({
    name: '',
    founded: '',
    description: '',
    price: '',
    image: '',
});

defineProps({
    errors: Object,
});


const submit = () => {
    form.post(route('cars.store'), {
        onFinish: () => form.reset('name', 'founded', 'description', 'price', 'image'),
    });
};

</script>

<template>
    <AppLayout title="Add Cars">

        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
                <div class="p-6 overflow-hidden bg-white shadow-xl sm:rounded-lg">

                    <JetValidationErrors class="mb-4" />

                    <form @submit.prevent="submit">

                        <div>
                            <JetInput id="name" v-model="form.name" type="text" class="block w-full mt-1" autofocus
                                placeholder="Name..." />
                        </div>

                        <div v-if="errors.name" class="text-sm text-red-600 ">
                            {{ errors.name }}
                        </div>

                        <div class="mt-4">

                            <JetInput id="founded" v-model="form.founded" type="number" class="block w-full mt-1"
                                placeholder="Founded..." />
                        </div>

                        <div v-if="errors.founded" class="text-sm text-red-600 ">
                            {{ errors.founded }}
                        </div>

                        <div class="mt-4">

                            <JetInput id="description" v-model="form.description" type="text" class="block w-full mt-1"
                                placeholder="Description..." />
                        </div>

                        <div v-if="errors.description" class="text-sm text-red-600 ">
                            {{ errors.description }}
                        </div>

                        <div class="mt-4">

                            <JetInput id="price" v-model="form.price" type="number" class="block w-full mt-1"
                                placeholder="Price..." />
                        </div>

                        <div v-if="errors.price" class="text-sm text-red-600 ">
                            {{ errors.price }}
                        </div>

                        <div>
                            <JetInput id="image" @input="form.image = $event.target.files[0]" type="file" class="block w-full mt-4"
                                placeholder="Select File..." />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <JetButton :type="submit" class="ml-4" :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing">
                                Save
                            </JetButton>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </AppLayout>
</template>