<template>
  <AppLayout :title="'Post'">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ post.title }}
      </h2>
    </template>

    <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow mt-6 p-6">
      <img v-if="post.img_url" :src="`/storage/${post.img_url}`" alt="Imagen del post" class="w-full h-auto rounded-lg mb-6" />

      <div class="text-gray-700 dark:text-gray-300 mb-4">
        <p>{{ post.body }}</p>
      </div>

      <div class="text-sm text-gray-500 dark:text-gray-400 mb-4">
        <p>Categoría: {{ post.category }}</p>
        <p>Publicado el: {{ new Date(post.created_at).toLocaleDateString() }}</p>
      </div>

     
      <div class="relative inline-block text-left">
        <div>
          <button @click="toggleOptions" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white dark:bg-gray-700 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Opciones
          </button>
        </div>

        
        <div v-if="showOptions" class="absolute right-0 z-10 mt-2 w-56 rounded-md shadow-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5">
          <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
            <a href="#" @click.prevent="editPost" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600" role="menuitem">Editar</a>
            <a href="#" @click.prevent="deletePost" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600" role="menuitem">Eliminar</a>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import { ref } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';  

const props = defineProps({
  post: Object
});

const showOptions = ref(false);


const toggleOptions = () => {
  showOptions.value = !showOptions.value;
};


const editPost = () => {
  
  console.log("Editar post:", props.post.id);

};


const deletePost = () => {
  
  if (confirm("¿Estás seguro de que deseas eliminar este post?")) {
    console.log("Eliminar post:", props.post.id);
  
  }
};
</script>
