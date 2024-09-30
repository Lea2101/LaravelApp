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
  
        <div class="text-sm text-gray-500 dark:text-gray-400">
          <p>Categoría: {{ post.category }}</p>
          <p>Publicado el: {{ new Date(post.created_at).toLocaleDateString() }}</p>
        </div>
      </div>
    </AppLayout>
  </template>
  
  <script setup>
  import AppLayout from '@/Layouts/AppLayout.vue';  
  const props = defineProps({
    post: Object
  });
  </script>
  