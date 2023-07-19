<script setup>
import { ref } from 'vue';
import { Head, router } from '@inertiajs/vue3';

const showAnimation = ref(false);

const animateAndRedirect = () => {
  showAnimation.value = true;
  setTimeout(() => {
    router.visit('/works');
  }, 1000); // Temps de l'animation en millisecondes
};
</script>

<template>
    <Head title="Welcome" />
    <div class="bg-red-500 w-screen h-screen">
        <div class="relative w-full h-full">
            <img class="w-1/2 absolute z-10 bottom-12 xl:top-1/2 right-12" src="./../../img/header/image.jpeg" alt="">
            <img class="w-1/2 absolute blur-xl invert bottom-10 right-10" src="./../../img/header/image.jpeg" alt="">
        </div>
        <header class="w-full h-full flex absolute top-0">
                <div class="content-right-header text-white flex flex-col w-5/6">
                    <h1 class="text-6xl font-bold">Victoria Dos Santos</h1>
                    <h2 class="text-lg font-semibold text-gray-300 my-4">Libre & Vivant</h2>
                    <p class="text-lg font-semibold text-gray-300 mb-10">
                        Bonjour, je m'appelle Victoria, j'ai fait de la photographie une passion qui permet de rendre les personnes heureuses, de laisser une émotion sur certaines photographies que personne n'arriverait à voir. Aujourd'hui je me présente à vous afin de pouvoir rendre vos moments encore plus magiques et d'en faire des souvenirs inoubliables.
                    </p>
                    <button @click="animateAndRedirect" class="text-lg font-semibold bg-red-500 hover:bg-white hover:text-red-500 rounded-full duration-300 ease-in w-fit m-auto px-5 py-2">Découvrir mon travail</button>
                </div>
        </header>
    </div>
</template>

<style>
body {
    overflow: hidden;
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
    background-size: 100%;
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
