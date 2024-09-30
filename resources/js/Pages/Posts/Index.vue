<template>
    <AppLayout title="Posts">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Posts

            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <SearchBar :onSearchInputChange="handleSearchInputChange" />
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 p-4">
                        <CardPost  v-for="post in posts" :key="post.id" :post="post" />
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Store from './Store.vue';
import SearchBar from '@/Components/SearchBar.vue';
import CardPost from '@/Components/CardPost.vue';
import { ref, onMounted } from 'vue';

const posts1 = ref([]);
const props =defineProps({
  posts: Array
});
console.log(props.posts[0].id);

const posteos = [
    {
        id: 2,
        title: 'JOKER 2 ',
        img_url: 'https://m.media-amazon.com/images/M/MV5BNTRlNmU1NzEtODNkNC00ZGM3LWFmNzQtMjBlMWRiYTcyMGRhXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg',
        body: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in dui mauris. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Quisque velit nisi, pretium ut lacinia in, elementum id enim. Curabitur ligula sapien, tincidunt non egestas ut, ultricies eget quam. Aenean ornare velit lacus, ac varius tellus retkectcatus. Sed pretium, ligula sollicitudin luctus euismod, enim mi scelerisque nisl, in fermentum dolor neque sit amet erat. Donec dignissim laoreet stokesc vitae.'
    },
    {
        id: 1,
        title: 'MESSI',
        img_url: 'https://a1.espncdn.com/combiner/i?img=%2Fphoto%2F2022%2F1218%2Fr1108256_1296x729_16%2D9.jpg&w=570&format=jpg',
        body: 'Dios besando la copa del mundo.'
    },
    {
        id: 3,        
        title: 'KPOP',
        img_url: 'https://0.soompi.io/wp-content/uploads/sites/8/2017/04/07233420/teen-top-changjo-smtm.jpg',
        body: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in dui mauris. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Quisque velit nisi, pretium ut lacinia in, elementum id enim. Curabitur ligula sapien, tincidunt non egestas ut, ultricies eget quam. Aenean ornare velit lacus, ac varius tellus retkectcatus. Sed pretium, ligula sollicitudin luctus euismod, enim mi scelerisque nisl, in fermentum dolor neque sit amet erat. Donec dignissim laoreet stokesc vitae.'
    },
    {
        id: 4,
        title: 'Messi',
        img_url: 'https://a1.espncdn.com/combiner/i?img=%2Fphoto%2F2022%2F1218%2Fr1108256_1296x729_16%2D9.jpg&w=570&format=jpg',
        body: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in dui mauris. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Quisque velit nisi, pretium ut lacinia in, elementum id enim. Curabitur ligula sapien, tincidunt non egestas ut, ultricies eget quam. Aenean ornare velit lacus, ac varius tellus retkectcatus. Sed pretium, ligula sollicitudin luctus euismod, enim mi scelerisque nisl, in fermentum dolor neque sit amet erat. Donec dignissim laoreet stokesc vitae.'
    }
    
]


const handleSearchInputChange = (terminoBusqueda) => {
    return console.log('Texto del buscador cambiado:', terminoBusqueda);
};
</script>
