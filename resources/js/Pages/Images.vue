<template>
  <Head title="Images" />
  <h1>Test</h1>
    <div class="carousel-item" v-for="image in images" :key="image.id" ref="carouselItems">
          <div class="carousel-box">
              <img src="@vite"/>
          </div>
    </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { router, Head } from '@inertiajs/vue3';

const props = defineProps({
	images: {
		type: Array,
		required: true,
	}
})

</script>

<style>
body {
  background: black;
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
