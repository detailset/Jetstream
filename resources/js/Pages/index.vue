<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Inertia } from '@inertiajs/inertia';

defineProps({
    cars: Array,
});

const destroy = (id) => {
    if(confirm('Are you sure you want delete?')){

    Inertia.delete(route('cars.destroy', id));
    
    }
};

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Dashboard
            </h2>
        </template>
        <div class="py-12">
            <div class="pb-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <Link href="cars/create" class="text-base italic text-gray-500">
                Add a new car &rarr;
                </Link>
                <div class="p-6 mt-2 overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <div v-for="car in cars.slice().reverse()" :key="car.id">

                        <div class="m-auto">

                            <div class="float-right">
                                <Link :href="route('cars.edit', car.id)"
                                    class="pb-2 italic text-blue-500 border-b border-dotted">
                                Edit &rarr;
                                </Link>
                                  
                                  <div>
                                    <button @click="destroy(car.id)" class="pb-2 italic text-red-500 border-dotted">Delete &rarr;
                                    </button>
                                  </div>

                            </div>

                            <span class="italic font-bold text-blue-500 uppercase font-xs">
                                Founded: {{ car.founded }}
                            </span>

                            <span class="italic font-bold text-blue-500 uppercase font-xs">
                                This is for Testing Git Branch
                            </span>
                            <h2 class="text-5xl text-gray-700 hover:text-gray-500">

                                <Link :href="route('cars.show', car.id)">
                                Name: {{ car.car_name }}
                                </Link>
                                
                            </h2>
                            <p class="py-6 text-lg text-gray-700">
                                Description: {{ car.description }}
                            </p>
                            <p class="py-2 text-lg text-gray-700">
                                Price: {{ car.price }}
                            </p>
                            <p class="py-2 text-lg text-gray-700">
                                Added By: {{ car.name }}
                            </p>
                            <hr class="mt-4 mb-8">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </AppLayout>
</template>