<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm } from "@inertiajs/vue3";
import { Head } from '@inertiajs/vue3';
import { ref } from "vue";
import vueFilePond, { setOptions } from "vue-filepond";
import "filepond/dist/filepond.min.css";
import "filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css";
import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type";
import FilePondPluginImagePreview from "filepond-plugin-image-preview";
import axios from "axios";

const props = defineProps({
        categories: {
            type: Array,
            required: true,
        }
    })
const selectedCategory = ref()
const filepondGalleryInput = ref(null); // Reference the input to clear the files later

const FilePond = vueFilePond(
    FilePondPluginFileValidateType,
    FilePondPluginImagePreview
);

const form = useForm({
    category: '',
    gallery: [],
});
const submit = () => {
    form
        .transform((data) => {
            return {
                ...data,
                gallery: data.gallery.map(item => item.serverId) // Pluck only the serverIds
            }
        })
        .put(route('upload-images'), {
            onStart: () => {
                console.log(form);
            },
            onSuccess: () => {
                filepondGalleryInput.value.removeFiles();
            },
        });
};
// Set global options on filepond init
const handleFilePondInit = () => {
    setOptions({
        credits: false,
        server: {
            url: '/filepond',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        }
    });
};

// Set the server id from response
const handleFilePondGalleryProcess = (error, file) => {
    form.gallery.push({id: file.id, serverId: file.serverId});
};
// Remove the server id on file remove
const handleFilePondGalleryRemoveFile = (error, file) => {
    form.gallery = form.gallery.filter(item => item.id !== file.id);
}

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Dashboard</h2>
        </template>
        <div v-if="$page.props.flash.message"
            class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
            role="alert"
        >
            <span class="font-medium">
                {{ $page.props.flash.message }}
            </span>
        </div>

        <form @submit.prevent="submit">
            <div>
                <label class="block font-medium text-sm text-gray-700">
                    <span>Name</span>
                </label>
                <select v-model="form.category" name="category">
                    <option v-for="category in categories" :value="category.id" :key="category.id">
                        {{ category.title }}
                    </option>
                </select>
                <div v-if="form.errors.category" class="text-red-500">{{ form.errors.category }}</div>
            </div>
            <label class="block font-medium text-sm text-gray-700">
                <span>Gallery</span>
            </label>
            <FilePond
                name="gallery"
                ref="filepondGalleryInput"
                class-name="my-pond"
                allow-multiple="true"
                accepted-file-types="image/*"
                @init="handleFilePondInit"
                @processfile="handleFilePondGalleryProcess"
                @removefile="handleFilePondGalleryRemoveFile"
            />
            <button
                type="submit"
                class="inline-flex items-center justify-center mt-3 p-3 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition w-full"
            >
                Submit
            </button>
        </form>
    </AuthenticatedLayout>
</template>
