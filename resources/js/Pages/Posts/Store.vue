<template>
  <button @click="showModal = true" class="px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white rounded-md font-semibold ml-4">Crear Post</button>
  
  <Modal2 
    v-if="showModal"
    :onCloseModal="closeModal" 
    :onSaveAction="handleSaveAction" 
    :titulo="'Crear Post'">
    
   
    <form @submit.prevent="handleSaveAction" enctype="multipart/form-data">
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Título</label>
        <input v-model="title" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required />
      </div>
      
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Contenido</label>
        <textarea v-model="body" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required></textarea>
      </div>
      
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Categoría</label>
        <input v-model="category" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required />
      </div>
      
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Subir Imagen</label>
        <input @change="handleFileChange" type="file" class="mt-1 block w-full" accept="image/*" name="image"/>
      </div>
      
    </form>
  </Modal2>
</template>

<script setup>
import Modal2 from '@/Components/Modal2.vue';
import { ref } from 'vue';
import axios from 'axios';

const props = defineProps({});


const title = ref('');
const body = ref('');
const category = ref('');
const img_file = ref('');  
const showModal = ref(false);

const handleSaveAction = () => {
    createPost();
};

const closeModal = () => {
  showModal.value = false;
};

const createPost = () => {
  const formData = new FormData();
  formData.append('title', title.value);
  formData.append('body', body.value);
  formData.append('category', category.value);
  formData.append('image', img_file.value);  


  axios.post('/post', formData, {
    headers: {
      'Content-Type': 'multipart/form-data'
    }
  })
  .then(response => {
   
    setTimeout(() => {
      closeModal();
    }, 2000);
  })
  .catch(error => {
    console.error('Error al crear el post', error);
  });
};


const handleFileChange = async (event) => {
    const file = event.target.files[0];

    if (file) {
        if (file.type === 'image/jpeg' || file.type === 'image/png' || file.type === 'image/jpg' || file.type === 'image/gif') {
            try {
                const formData = new FormData();
                formData.append('image', file); 

                const response = await axios.post('/image/upload', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    },
                    
                });

                console.log('Imagen guardada correctamente');
                // Guardar el path de la imagen devuelto por el servidor
                img_file.value = response.data.file_path;
            } catch (error) {
                console.error(error.response.data.errors);
                console.error(fileUploadErrors.value);
            }
        } else {
            console.error('El archivo debe ser de tipo jpeg, png, jpg o gif');    
                }
    }
};

</script>
