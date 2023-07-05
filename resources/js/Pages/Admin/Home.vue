<script setup>
import { ref } from 'vue';
import { Head, router } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

</script>

<template>
    <Head title="Home" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Page Home</h2>
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
    <div id="home-content" class="w-screen h-screen flex overflow-hidden">
        <div id="left-header" class="w-1/4 bg-white h-full flex" :class="{'fullscreen': showAnimation}">
            <div id="image-left-header">
            </div>
        </div>
        <div id="right-header" class="w-full flex">
            <div class="content-right-header text-white flex flex-col w-1/2">
                <h1 class="text-6xl font-bold fit-content m-auto" contenteditable="">Victoria Dos Santos</h1>
                <h2 class="text-lg font-semibold text-gray-300 my-4 fit-content m-auto" contenteditable="">Libre & Vivant</h2>
                <p class="text-lg font-semibold text-gray-300 mb-10 content-editable" contenteditable="">
                    Bonjour, je m'appelle Victoria, j'ai fait de la photographie une passion qui permet de rendre les personnes heureuses, de laisser une émotion sur certaines photographies que personne n'arriverait à voir. Aujourd'hui je me présente à vous afin de pouvoir rendre vos moments encore plus magiques et d'en faire des souvenirs inoubliables.
                </p>
                <button class="cursor-text text-lg font-semibold bg-red-500 rounded-full duration-300 ease-in w-fit m-auto px-5 py-2" contenteditable="">Découvrir mon travail</button>
            </div>
        </div>
    </div>
    </AuthenticatedLayout>
</template>

<style>
#home-content {
    transform: scale(0.9);
    border: 1px solid red;
}
.content-editable {
    position: relative;
    border: 1px solid transparent;
    transition: ease-in .3s;
}
.content-editable:focus {
    outline: 1px solid red;
}
.content-editable:hover {
    border: 1px solid red;
}
.content-editable::before {
    transition: ease-in .3s;
}
.content-editable:hover::before {
  content: "Cliquer pour éditer";
  position: absolute;
  top: 0;
  right: 0;
  background-color: #ff0000;
  color: white;
  padding: 5px 10px;
  font-size: 1rem;
}
.content-editable:focus::before {
  display: none;
  color: white;
}
#left-header {
    position: absolute;
    display: block;
    top: 0;
    left: 0;
    z-index: 1;
    transform-origin: bottom left;
    -ms-transform: skew(20deg, 0deg);
    -webkit-transform: skew(20deg, 0deg);
    transform: skew(20deg, 0deg);
    box-shadow: 15px 5px 15px rgba(0,0,0,0.5);
    background-image: repeating-linear-gradient(-45deg, rgba(255,255,255, 0.25), rgba(255,255,255, 0.25) 1px, transparent 1px, transparent 6px);
    background-size: cover;
}
#image-left-header {
    position: absolute;
    width: 35vw;
    height: 35vw;
    left: calc(100% - 17.5vw);
    top: 20%;
    -ms-transform: skew(-20deg, 0deg);
    -webkit-transform: skew(-20deg, 0deg);
    transform: skew(-20deg, 0deg);
    background-image: url('./../../img/header/logo.png');
    background-size: contain;
    background-repeat: no-repeat;
}
#right-header {
    background-image: url('./../../img/header/image.jpeg');
    background-size: cover;
    background-repeat: no-repeat;
}
.content-right-header {
    text-align: center;
    margin: auto 10% auto auto;
}
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
#left-header.fullscreen {
    width: 130vw;
    transition: .5s ease-in-out;
    /* Autres styles spécifiques au mode plein écran */
}
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
