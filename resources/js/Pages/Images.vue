<template>
    <NavBar />
  <Head title="Images" />
  <h1 class="text-white text-4xl text-center py-10">{{ category.title }}, {{ category.year }}</h1>
  <main class="container m-auto mb-10" :class="columns">
    <img v-for="image in images" :src="imageUrl(image.filename)" class="w-full mb-3 gap-3 m-auto"/>
  </main>
</template>

<script setup>
import NavBar from './../Components/Navbar.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
	images: {
		type: Array,
		required: true,
	},
    category: {
        type: Array,
        required: true,
    }
})
const imageUrl = (url) => {
    return ('/storage/galleries/' + url);
}

const imagesCount = props.images.length;
var columns = 'columns-3';
console.log(imagesCount);

if (imagesCount < 3 && imagesCount > 1) {
    columns = 'columns-2';
} else if (imagesCount < 2 && imagesCount > 0) {
    columns = 'columns-1'
}

</script>

<style>

</style>
