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
    <div class="bg-white w-screen h-screen">
        <div class="relative w-full h-full flex desktop" style="
            perspective: 1000px;
            transform-style: preserve-3d;
        ">
            <div class="left-wall flex">
                <div class="content-right-header text-white flex flex-col w-2/3 m-auto">
                    <h1 class="text-6xl font-bold glowing-text">Victoria Dos Santos</h1>
                    <h2 class="text-lg font-semibold text-gray-300 my-4">Libre & Vivant</h2>
                    <p class="text-lg font-semibold text-gray-300 mb-10">
                        Bonjour, je m'appelle Victoria, j'ai fait de la photographie une passion qui permet de rendre les personnes heureuses, de laisser une émotion sur certaines photographies que personne n'arriverait à voir. Aujourd'hui je me présente à vous afin de pouvoir rendre vos moments encore plus magiques et d'en faire des souvenirs inoubliables.
                    </p>
                    <button @click="animateAndRedirect" class="text-lg font-semibold bg-red-500 hover:bg-white hover:text-red-500 rounded-full duration-300 ease-in w-fit m-auto px-5 py-2">Découvrir mon travail</button>
                </div>
            </div>
            <div class="bg-slate-700 right-wall flex">
                <div class="w-3/5 grid grid-cols-4 grid-rows-5 gap-4 m-auto">
                    <div class="row-span-1 col-start-1 m-auto row-start-2 p-5 bg-red-800"><img src="../../img/HP/img-1.jpg"/></div>
                    <div class="row-span-2 col-start-2 row-start-3"><img src="../../img/HP/img-2.jpg"/></div>
                    <div class="row-span-2 col-start-3 row-start-2"><img src="../../img/HP/img-3.jpg"/></div>
                    <div class="row-span-3 col-start-4 row-start-2"><img src="../../img/HP/img-4.jpg"/></div>
                </div>
            </div>
            <div class="bg-red-500 sol"></div>
        </div>
        <div class="mobile">
            <h1>TEST</h1>
        </div>
    </div>
</template>

<style>
body {
    overflow: hidden;
}
.left-wall {
    position: absolute;
    width: 60%;
    height: 90%;
    transform: rotateY(45deg);
    left: -5px;
    background: url('../../img/HP/stonedwall.png');
    background-size: 65%;
    background-position-x: left;
}
.right-wall {
    position: absolute;
    width: 60%;
    height: 90%;
    transform: rotateY(-45deg);
    right: -5px;
}
.sol {
    background: url('../../img/HP/parquet.png');
    background-size: 30%;
    position: absolute;
    width: 100%;
    height: 100%;
    transform: rotateX(90deg);
    top: 40%;
}
.glowing-text {
    text-shadow: 0 0 20px #fff, 0 0 20px #ff0000, 0 0 22px #ff0000, 0 0 25px #ff0000, 0 0 30px #ff0000;
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
}
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
#left-header.fullscreen {
    width: 130vw;
    transition: .5s ease-in-out;
    /* Autres styles spécifiques au mode plein écran */
}
.mobile {
    display: none;
}
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
@media screen and (max-width: 767px) {
    .mobile {
        display: block;
    }
    .desktop {
        display: none;
    }
}
</style>
