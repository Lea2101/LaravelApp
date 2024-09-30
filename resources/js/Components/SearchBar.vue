<template>
    <div class="bg-gray-100 p-4 flex items-center justify-between">
      <div class="flex items-center ml-4">
        <input type="text" v-model="terminoBusqueda" placeholder="Buscar Posts"
            class="w-full sm:w-64 px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500 mr-4 border-r-0" @input="handleSearchInput">
        <button @click="handleSearchInput" class="px-4 py-2 bg-blue-500 hover:bg-gray-700 text-white rounded-md font-semibold">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </button>
      </div>
      <Store />
    </div>
  </template>
  
  <script setup>
  import { ref, defineProps } from 'vue';
  import Store from '@/Pages/Posts/Store.vue';
  
  const props = defineProps({
    
    // Función para manejar el cambio en la entrada de búsqueda
     onSearchInputChange: {
      type: Function,
      required: true
    }
  });
  
  const terminoBusqueda = ref('');
  // Función para manejar el cambio en la entrada de búsqueda
  const handleSearchInput = () => {
    props.onSearchInputChange(terminoBusqueda.value);
  };
  </script>