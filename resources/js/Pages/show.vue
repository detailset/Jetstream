<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({

      name: String,
      image: String,
      price: String,
      founded: String,
      description: String,

});

</script>

<template>
      <AppLayout title="Car Details">
            <template #header>
                  <h2 class="text-xl font-semibold leading-tight text-gray-800">
                        Dashboard
                  </h2>
            </template>

            <div class="py-12">

                  <div class="text-center">

                        <img class="w-5/12 m-auto mb-8 rounded-lg shadow-xl h-2/4" :src="image" alt="Car Image">

                        <h1 class="text-2xl text-gray-600 uppercase bold">
                              {{ name }}
                        </h1>

                  </div>

            </div>

            <div class="py-10 text-center">

                  <span class="italic font-bold text-blue-500 uppercase font-xs">
                        Founded: {{ founded }}
                  </span>
                  <p class="py-6 text-lg text-gray-700">
                        Description: {{ description }}
                  </p>

                  <p class="py-2 text-lg text-gray-700">
                        Price Range: {{ price }}
                  </p>

                  <hr class="mt-4 mb-8">

                  <Link :href="route('cars.index')" class="pb-2 text-base italic text-blue-500 border-b border-dotted">
                  Go Back &rarr;
                  </Link>

            </div>
      </AppLayout>
</template>
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
