<script setup>
import { ref } from 'vue';
import { Head, router } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({
	categories: {
		type: Array,
		required: true,
	}
})
const imageUrl = (url) => {
    return ('/storage/' + url);
}

</script>

<template>
    <Head title="Categories" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Page Catégories</h2>
                <div class="flex">
                    <button class="mr-5 bg-green-500 rounded-xl py-1 px-4 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Enregistrer</button>
                    <button class="bg-red-500 rounded-xl py-1 px-4 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Annuler</button>
                </div>
            </div>
        </template>
        <div v-if="$page.props.flash.message"
            class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
            role="alert"
        >
            <span class="font-medium">
                {{ $page.props.flash.message }}
            </span>
        </div>
    <div id="category-content" class="w-screen h-screen overflow-hidden grid gap-4 grid-cols-3 grid-rows-3">
        <div class="carousel-item " v-for="category in categories">
            <p class="text-white">{{ category.title }}</p>
            <div v-if="category.pinned_image" class="w-full h-full">
                <img class="h-full" :src="imageUrl(category.pinned_image.filepath)" alt="Pinned Image">
            </div>
            <div v-else>
                <p class="text-white">No pinned image available</p>
            </div>
        </div>
    </div>
    </AuthenticatedLayout>
</template>
<style>

#category-content {
    transform: scale(0.9);
    border: 1px solid red;
}
</style>